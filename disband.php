<?php
// This is the user account disband page.
//users go to this page to remove their account,
//or admins may user this page to disband accounts violating the Terms of Service or End User Agreement
//
//session_start();//access the current session.
//Must be a logged in user to disband your account, else 
/*if(!loggedIn() ){
    //user not logged in, redirect to loggin
	header('location:login.php');
	exit();
}*/
//if(!isset($_SESSION) || !isset($_SESSION['user_id']) ){
    //user not logged in, redirect to loggin
//	header('location:login.php');
//	exit();
//}
//
require_once 're.php';
require_once 'html.php';
require_once 'dbConnect.php';
require_once 'pas/remove.php';
html::docType();
?>
<html lang=en>
<head>
<?php
html::charset();
html::title('Account Disband Page');
?>
    <link rel='stylesheet' type='text/css' href='includes.css'>
</head>
<body>

<div id='container'>
<h1>Disband User Account</h1>

<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>
</div><!--end of side column and menu -->
    <div id='reg-navigation'>
        <a href='members.php'>Cancel</a><br>
    </div>
    <div id='content'><!--Start of page content-->
<?php
// This section processes submissions from the login form.
// Check if the form has been submitted:
$loggedIn = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{	// Validate the email address:
	if(!empty($_POST['email'])){    //AND isEmail($_POST['email'])
        //$e = $_POST['email'];
        $e = mysqli_real_escape_string($AO_DB->con, $_POST['email']);
	} 
	else{
		echo "<p class='error'>Invalid email address.</p><br>";
	}
	// Validate the password:
	if(!empty($_POST['psword']) AND isPassword($_POST['psword']) ){
        //$p = isPassword($_POST['psword']);
        $p = mysqli_real_escape_string($AO_DB->con, $_POST['psword']);
	}
	else{
		echo "<p class='error'>Invalid password</p><br>";   //, must be 8-12 character long and not contain whitespace, or special characters.</p><br>";
	}
    
	if(isset($e) && isset($p) ){
		//if no problems
        //echo "email:$e";><br><php
        //echo "password:$p";><br><php

        $res = pasRemove::userAccount($e, $p);
        
        if(!$res){
            echo "<p class='error'>Error Removing account!</p><br>";
            //header('location:index.php');   //redirect to AO home web-page
            //exit();
        }
        //else user removed account, sign out and close session!
        //log user out, cancel the session
        /*$_SESSION = array(); // Destroy the variables.
        session_destroy(); // Destroy the session itself.
        setcookie(session_name(), '', time() - 3600); // Destroy the cookie.
        setcookie('PHPSESSID', ", time()-3600,'/', ", 0, 0);//Destroy the cookie
        */
        //header('location:index.php');   //redirect to AO home web-page
        //exit();
	} 
	else{   //there was a problem
		echo "<p class='error'>The provided email or password do not match our records. Please try again.</p><br>";
	}
}
?>
<div id='confirmFields'>
    <h2>Please Confirm Your account information</h2>
    <form action='disband.php' method='post'>
        <p><label class='label' for='email'>Email Address:</label><br>
        <input id='email' type='text' name='email' size='30' maxlength='60' value='<?php if(isset($e)){echo $e;}?>'></p>
        <p><label class='label' for='psword'>Password:</label><br>
        <input id='psword' type='password' name='psword' size='12' maxlength='12' value='<?php if(isset($p) ){echo $p;}?>'></p>
        <p><input id='submit' type='submit' name='submit' value='Confirm'></p>
    </form>
</div>
    </div><!--end content-->
<?php require 'phtml/legal.php';?>
</div><!--root div-->
<?php html::footer();?>