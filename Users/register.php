<?php
//require_once '../include/html.php';
//require_once '../include/dbConnect.php';
?>
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
    include 'includes/register-header.php';
    
?>
<div id="content"><!-- Start of the login page content. -->
<?php

$connection = mysql_connect("localhost","root","Dante777") or die("Could not connect to server");
mysql_select_db("lemon", $connection) or die("Couldn't connect to database");

error_reporting(0);

if($_POST["register"])
{	
	if ($_POST['username'] && $_POST['password'])
	{
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string(hash("sha512", $_POST['password']));
		$name = '';
		if($_POST['name'])
		{
			$name = mysql_real_escape_string(strip_tags($_POST['name']));
		}
		$check = mysql_fetch_array(mysql_query("SELECT * FROM 'users' WHERE 'Username'='$username'"));
		if($check == 'null')
		{
			die("That username already exists! Try <i>$username" . rand(1, 50) . "</i> instead! <a href='register.php'>&larr; Back</a>");
		}
		if(!ctype_alnum($username))
		{
			die("Username contains special characters! Only letters and numbers are permitted! <a href='register.php'>&larr; Back</a>");
		}
		if(strlen($username) > 26)
		{
			die("Username must not contain more than 26 characters! <a href='register.php'>&larr; Back</a>");
		}
		$salt = hash("sha512", rand() . rand() . rand());
		mysql_query("INSERT INTO 'users' ('Username', 'Password', 'Name', 'Salt') VALUES ('$username', '$password', '$name', '$salt')");
		setcookie("c_user", hash("sha512", $username), time() + 24 * 60 * 60, "/");
		setcookie("c_salt", $salt, time() + 24 * 60 * 60, "/");
		die("Your account has been created and you are now logged in.");
	}
}
/*include "algor.php";
if($logged==true)
{
	die("You are already logged in!");
}*/

echo "

<body>
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
			<b>Name:</b>
		</td>
		<td>
			<input type='text' name='name' style='padding: 4px;' />
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
			<input type='submit' name='register' value='Register' />
		</td>
	</tr>
	</table>
	</form>
</body>
"
?>