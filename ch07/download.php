<?php
// define error page
$error = 'http://localhost/phpsols/error.php';
// define the path to the download folder
$filepath = 'C:/xampp/htdocs/phpsols/images/';

$getfile = NULL;

// block any attempt to explore the filesystem
if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) {
  $getfile = $_GET['file'];
} else {
  header("Location: $error");
  exit;
}

if ($getfile) {
  $path = $filepath . $getfile;
  // check that it exists and is readable
  if (file_exists($path) && is_readable($path)) {
	// get the file's size and send the appropriate headers
	$size = filesize($path);
	header('Content-Type: application/octet-stream');
	header('Content-Length: '. $size);
	header('Content-Disposition: attachment; filename=' . $getfile);
	header('Content-Transfer-Encoding: binary');
	// open the file in read-only mode
	// suppress error messages if the file can't be opened
	$file = @ fopen($path, 'r');
	if ($file) {
	  // stream the file and exit the script when complete
	  fpassthru($file);
	  exit;
	} else {
	  header("Location: $error");
	}
  } else {
	header("Location: $error");
  }
}
