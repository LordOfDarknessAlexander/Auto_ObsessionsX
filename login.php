<?php
require_once 'html.php';
require_once 'dbConnect.php';
require_once 'secure.php';
html::docType();
html::memberStyles();
?>
<html lang=en>
<head>
<?php

html::simpleHead('Login');
?>
  
</head>
<body>
<div id='header'>
    <h1>Auto-Obsessions Login</h1>
    <div id='reg-navigation'>
        <a href='registerUser.php'>Register</a>
        <a href='index.php'>Play Game</a>
    </div>
</div>
<div id='container'>
<div id='content'><!-- Start of the login page content. -->
<?php 
// This section processes submissions from the login form.
// Check if the form has been submitted:
Secure::userLogin();
?>
</div><?php //end container?>

</div><?php //end content?>
<div id='loginfields'>
	<h2>Login</h2>
	<form action='login.php' method='post'>
		Email Address:<br>
		<input id='email' type='text' name='email' size='30' maxlength='60' value='<?php if (isset($_POST['email'])) echo $_POST['email'];?>'><br>
        Password:<br>
		<input id='psword' type='password' name='psword' size='12' maxlength='12' value='<?php if (isset($_POST['psword'])) echo $_POST['psword'];?>'><br>
		<input id='submit' type='submit' name='submit' value='Login'>
	</form>
</div>
<?php html::footer();?>