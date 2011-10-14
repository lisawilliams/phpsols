<?php
	require_once('../includes/connection.inc.php');
	//connect to MySQL 
	$conn = dbConnect('read','pdo');
	//prepare the SQL query
	$sql = 'SELECT * FROM images';
	//submit the query and capture the result 
	$result = $conn->query($sql);
	$error = $conn->errorInfo();
	if (isset($error[2])) die($error[2]);
	//find out how many records were retrieved 
	$numRows = $result->rowCount();
	?>
	


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<HEAD>
<BODY>

<p> A total of <?php echo $numRows; ?> records were found.</p>

</body>