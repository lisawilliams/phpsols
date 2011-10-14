<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
  $host = 'localhost';
  $db = 'onaroomies2';
  if ($usertype  == 'read') {
	$user = 'onaread2';
	$pwd = 'factional';
  } elseif ($usertype == 'write') {
	$user = 'onawrite2';
	$pwd = 'factional';
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
