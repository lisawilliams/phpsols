<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
  $host = 'internal-db.s81050.gridserver.com';
  $db = 'db81050_phpsols';
  $user = 'db81050_phpsols';
  $pwd = 'factional';
  // the password for this core user is factional 
  if ($usertype  == 'read') {
	$user = 'db81050_psread';
	$pwd = 'crankarm';
  } elseif ($usertype == 'write') {
	$user = 'db81050_pswrite';
	$pwd = 'lavalamp';
  } else {
	exit('Unrecognized connection type');
  }
  if ($connectionType == 'mysqli') {
  $conn = new mysqli($host, $user, $pwd, $db);
  if ($conn->mysqli_error) {
    die('Cannot open database');
  }
  return $conn;
} else {
    try {
      return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    } catch (PDOException $e) {
      echo 'Cannot connect to database';
      exit;
    }
  }
}
