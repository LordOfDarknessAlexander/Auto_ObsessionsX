<?php 
require_once 'general.php';
require_once 'include/dbConnect.php';
function logged_In() 
{
	return (isset($_SESSION['user_id'])) ? true : false;
}

function activate($e,$email_code)
{
	$e = mysqli_real_escape_string($e);
	$email_code = mysqli_real_escape_string($email_code);
	
	if(mysql_result(mysqli_query("SELECT COUNT('user_id') FROM 'users' WHERE 'email' = '$e' AND 'email_code'= '$email_code' AND 'confirm' = 0 " ),0) ==1)
	{
		//mysqli_query("UPDATE 'users',  SET 'confirm' = '1' WHERE 'email' = '$e'");
		$q = ("UPDATE 'users',  SET 'confirm' = '1' WHERE 'email' = '$e'");	
		$result = $AO_DB->query($q);
		return true;
	}
	else
	{
		return false;
	}
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
//send email once we registered to activate account
function register_User($register_email,$uname,$email_code)
{
	//website
	//email($register_email, 'Activate your account', "Hello".$uname .", \n\nYou need to activate your account so use the link below:\n\n\n\n http://Auto_ObsessionsX/activate.php
	email($register_email, 'Activate your account', "Hello".$uname .", \n\nYou need to activate your account so use the link below:\n\n\n\n http:localhost//Auto_ObsessionsX/activate.php?email" . $register_email. "&email_code= " . $email_code."\n\n - auto-obsessions;
	");
}
?>