<?php 
function logged_In() 
{
	return (isset($_SESSION['user_id'])) ? true : false;
}

function user_Exists($uname)
{
	$uname = sanitize($uname);
	return (mysql_result(mysqli_query("SELECT COUNT ('user_id') FROM  'users' WHERE 'uname' = '$uname'"), 0) == 1);
}

function email_Exists($email)
{
	$email = sanitize($email);
	return (mysql_result(mysqli_query("SELECT COUNT ('user_id') FROM  'users' WHERE 'email' = '$email'"), 0) == 1) ? true : false;
}
function user_Active($uname)
{
	$uname = sanitize($uname);
	return (mysql_result(mysqli_query("SELECT COUNT ('user_id') FROM  'users' WHERE 'uname' = '$uname' AND 'confirm'"), 0) == 1);
}

?>