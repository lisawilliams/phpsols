<?php
include('./includes/title.inc.php'); 
require_once('./includes/connection.inc.php');
// define number of columns in table
define('COLS', 2);
// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;
// set maximum number of records
define('SHOWMAX', 6);
$conn = dbConnect('read');
// prepare SQL to get total records
$getTotal = 'SELECT COUNT(*) FROM images';
// submit query and store result as $totalPix
$total = $conn->query($getTotal);
$row = $total->fetch_row();
$totalPix = $row[0];
// set the current page
$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 0;
// calculate the start row of the subset
$startRow = $curPage * SHOWMAX;
// prepare SQL to retrieve subset of image details
$sql = "SELECT filename, caption FROM images LIMIT $startRow," . SHOWMAX;
// submit the query
$result = $conn->query($sql) or die(mysqli_error());
// extract the first record as an array
$row = $result->fetch_assoc();
// get the name and caption for the main image
if (isset($_GET['image'])) {
  $mainImage = $_GET['image'];
} else {
  $mainImage = $row['filename'];
}
// get the dimensions of the main image
$imageSize = getimagesize('images/'.$mainImage);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Japan Journey
<?php if (isset($title)) {echo "&#8212;{$title}";} ?>
</title>
<link href="styles/journey.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<div id="header">
  <h1>Japan Journey </h1>
</div>
<div id="wrapper">
  <?php include('./includes/menu.inc.php'); ?>
  <div id="maincontent">
    <h2>Images of Japan</h2>
    <p id="picCount">Displaying <?php echo $startRow+1;
    if ($startRow+1 < $totalPix) {
      echo ' to ';
      if ($startRow+SHOWMAX < $totalPix) {
        echo $startRow+SHOWMAX;
      } else {
        echo $totalPix;
      }
    }
    echo " of $totalPix";
    ?></p>
    <div id="gallery">
      <table id="thumbs">
        <tr> 
          <!--This row needs to be repeated-->
          <?php do { 
		  // set caption if thumbnail is same as main image
		  if ($row['filename'] == $mainImage) {
			$caption = $row['caption'];
		  }
		  // if remainder is 0 and not first row, close row and start new one
		  if ($pos++ % COLS === 0 && !$firstRow) {
		    echo '</tr><tr>';
	      }
		  // once loop begins, this is no longer true
		  $firstRow = false;
		  ?>
          <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?image=<?php echo $row['filename']; ?>"><img src="images/thumbs/<?php echo $row['filename']; ?>" alt="<?php echo $row['caption']; ?>" width="80" height="54"></a></td>
          <?php } while ($row = $result->fetch_assoc()); 
		  while ($pos++ % COLS) {
            echo '<td>&nbsp;</td>';
          } 
		  ?>
        </tr>
        <!-- Navigation link needs to go here -->
      </table>
      <div id="main_image">
        <p><img src="images/<?php echo $mainImage; ?>" alt="<?php echo $caption; ?>" <?php echo $imageSize[3]; ?>></p>
        <p><?php echo $caption; ?></p>
      </div>
    </div>
  </div>
  <?php include('./includes/footer.inc.php'); ?>
</div>
</body>
</html>