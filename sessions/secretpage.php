<?php
session_start();
//if sessionvariable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) 	{
	header('Location: http://localhost/phpsols/sessions/login.php');
	exit;
	}
	
	?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<form id="logoutForm" method="post" action="">
<input name="logout" type="submit" id="logout" value="Log out">
</form>


