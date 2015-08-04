<?php
//
session_start();//access the current session.
//Must logged in to logout, else redirect to login
if(!isset($_SESSION['user_id']) ){
    //user not logged in, redirect to loggin
	header("location:index.php");
	exit();
}
else{ 
/*
	//log user out, canceling the session
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-3600); // Destroy the cookie.
	setcookie('PHPSESSID', ", time()-3600,'/', ", 0, 0);//Destroy the cookie
	header("location:index.php");*/
/*	$_SESSION['user_id'] = NULL;
    $_SESSION['uname'] = NULL;
	$_SESSION[$UL] = NULL;
	
	session_unset($_SESSION['user_id']);
	session_unset($_SESSION['uname']);
	session_unset($_SESSION[$UL]);   */
	session_destroy();

	header("location:index.php");
	exit();
}
?>