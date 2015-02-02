<!doctype html>
<html lang=en>
<head>
<title>Register</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
<div id="container">
<?php
    include 'includes/login-header.php';
?>
<div id="content"><!-- Start of the login page content. -->
<?php

$connection = mysql_connect("localhost","root","Dante777") or die("Could not connect to server");
mysql_select_db("lemon", $connection) or die("Couldn't connect to database");
error_reporting(0);

if($_POST['login'])
{
	if($_POST['username'] && $_POST['password'])
	{
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string(hash("sha512",$_POST['username']));
		$user = mysql_fetch_array(mysql_query("SELECT * FROM 'users' WHERE 'Username' = '$username'"));
		if($user == '0')
		{
			die("That user name does not exist! Try making <i>$username</i> today <a href='loginB.php'>&larr; Back</a>");
		}
		if($user['password'] != $password)
		{
			die("Incorrect password dbags!<a href='loginB.php'>&larr; Back</a> ");
		}
		$salt = hash("sha512", rand() . rand() . rand());
		setcookie("c_user", hash("sha512", $username), time() + 24 * 60 * 60, "/");
		setcookie("c_salt", $salt, time() + 24 * 60 * 60, "/");
		$userID = $user['ID'];
		mysql_query("UPDATE 'users' SET 'Salt'='$salt' WHERE 'ID'= '$userID'");
		die("Stop smoking the white rocks");
	}
}
include "algor.php";
if($logged==true)
{
	die("You are already logged in!");
}	

echo "
<body>
<h2>Login</h2>
	<form action='' method='post'>
	<table>
	<tr>
		<td>
			<b>Username:</b>
		</td>
		<td>
			<input type='text' name='username' style='padding: 4px;' />
		</td>
	</tr>

	<tr>
		<td>
			<b>Password:</b>
		</td>
		<td>
			<input type='password' name='password' style='padding: 4px;' />
		</td>
	</tr>
	<tr>
		<td>
			<input type='submit' value='Login' />
		</td>
	</tr>
	</table>
	</form>
	<br />
	<h6>
		No account? <a href='register.php'>Register Here
	</h6>
</body>
"
?>