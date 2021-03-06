<?php
include('../includes/connection.inc.php');
$conn = dbConnect('write');
// initialize flags
$OK = false;
$deleted = false;
// initialize statement
$stmt = $conn->stmt_init();
// get details of selected record
if (isset($_GET['article_id']) && !$_POST) {
  // prepare SQL query
  $sql = 'SELECT article_id, title, created
          FROM blog WHERE article_id = ?';
  $stmt->prepare($sql);
  // bind the query parameters
  $stmt->bind_param('i', $_GET['article_id']);
  // bind the result to variables
  $stmt->bind_result($article_id, $title, $created);
  // execute the query, and fetch the result
  $stmt->execute();
  $stmt->fetch();
}
// if confirm deletion button has been clicked, delete record
if (isset($_POST['delete'])) {
  // first, delete the references to the article in the cross-reference table
  $sql = 'DELETE FROM article2cat WHERE article_id = ?';
  $stmt->prepare($sql);
  $stmt->bind_param('i', $_POST['article_id']);
  $stmt->execute();
  // then delete the article itself
  $sql = 'DELETE FROM blog WHERE article_id = ?';
  $stmt->prepare($sql);
  $stmt->bind_param('i', $_POST['article_id']);
  $stmt->execute();
  if ($stmt->affected_rows == 1) {
	$deleted = true;
  } else {
	$deleted = false;
    $error = 'There was a problem deleting the record.';
  }
}
// redirect the page if deletion is successful, 
// cancel button clicked, or $_GET['article_id'] not defined
if ($deleted || isset($_POST['cancel_delete']) || !isset($_GET['article_id']))  {
  header('Location: http://localhost/phpsols/admin/blog_list_mysqli.php');
  exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Delete Blog Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Delete Blog Entry </h1>
<?php 
if (isset($error)) {
  echo "<p class='warning'>Error: $error</p>";
} elseif(isset($article_id) && $article_id == 0) { ?>
<p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
<p class="warning">Please confirm that you want to delete the following item. This action cannot be undone.</p>
<p><?php echo $created . ': ' . htmlentities($title, ENT_COMPAT, 'utf-8'); ?></p>
<?php } ?>
<form id="form1" method="post" action="">
    <p>
	<?php if(isset($article_id) && $article_id > 0) { ?>
        <input type="submit" name="delete" value="Confirm Deletion">
	<?php } ?>
		<input name="cancel_delete" type="submit" id="cancel_delete" value="Cancel">
	<?php if(isset($article_id) && $article_id > 0) { ?>
		<input name="article_id" type="hidden" value="<?php echo $article_id; ?>">
	<?php } ?>
    </p>
</form>
</body>
</html>
