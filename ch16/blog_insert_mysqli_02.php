<?php
require_once('../includes/connection.inc.php');
// create database connection
$conn = dbConnect('write');
if (isset($_POST['insert'])) {
  // initialize flag
  $OK = false;
  // create SQL
  $sql = 'INSERT INTO blog (title, article, created)
		  VALUES(?, ?, NOW())';
  // initialize prepared statement
  $stmt = $conn->stmt_init();
  $stmt->prepare($sql);
  // bind parameters and execute statement
  $stmt->bind_param('ss', $_POST['title'], $_POST['article']);
  // execute and get number of affected rows
  $stmt->execute();
  $OK = $stmt->affected_rows;
  // redirect if successful or display error
  if ($OK) {
	header('Location: http://localhost/phpsols/admin/blog_list_mysqli.php');
	exit;
  } else {
	$error = $stmt->error;
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Insert Blog Entry</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Insert New Blog Entry</h1>
<?php if (isset($error)) {
  echo "<p>Error: $error</p>";
} ?>
<form id="form1" method="post" action="" enctype="multipart/form-data">
  <p>
    <label for="title">Title:</label>
    <input name="title" type="text" class="widebox" id="title" value="<?php if (isset($error)) {
	  echo htmlentities($_POST['title'], ENT_COMPAT, 'utf-8');
	} ?>">
  </p>
  <p>
    <label for="article">Article:</label>
    <textarea name="article" cols="60" rows="8" class="widebox" id="article"><?php if (isset($error)) {
	  echo htmlentities($_POST['article'], ENT_COMPAT, 'utf-8');
	} ?></textarea>
  </p>
  <p>
    <label for="category">Sessions:</label>
    <select name="category[]" size="5" multiple id="category">
    <?php
	// get categories
	$getCats = 'SELECT talk_name, talk_id FROM talks
	            ORDER BY talk_id';
	$talks = $conn->query($getCats);
	while ($row = $talk_name->fetch_assoc()) {
	?>
    <option value="<?php echo $row['talk_name']; ?>" <?php
    if (isset($_POST['talks']) && in_array($row['talk_name'], $_POST['category'])) {
	  echo 'selected';
	} ?>><?php echo $row['talk_name']; ?></option>
    <?php } ?>
    </select>
  </p>
  <p>
    <label for="image_id">Uploaded image:</label>
    <select name="image_id" id="image_id">
      <option value="">Select image</option>
            <?php
	  // get the list of images
	  $getImages = 'SELECT image_id, filename
	                FROM images ORDER BY filename';
	  $images = $conn->query($getImages);
	  while ($row = $images->fetch_assoc()) {
	  ?>
      <option value="<?php echo $row['image_id']; ?>"
      <?php
	  if (isset($_POST['image_id']) && $row['image_id'] == $_POST['image_id']) {
		echo 'selected';
	  }
	  ?>><?php echo $row['filename']; ?></option>
      <?php } ?>
    </select>
  </p>
  <p id="allowUpload">
    <input type="checkbox" name="upload_new" id="upload_new">
    <label for="upload_new">Upload new image</label>
  </p>
  <p class="optional">
    <label for="image">Select image:</label>
    <input type="file" name="image" id="image">
  </p>
  <p class="optional">
    <label for="caption">Caption:</label>
    <input name="caption" type="text" class="widebox" id="caption">
  </p>
  <p>
    <input type="submit" name="insert" value="Insert New Entry">
  </p>
</form>
</body>
</html>