<?php
require_once 'html.php';
require_once 'dbConnect.php';
//require_once 'ao.php';
require_once 'secure.php';

//require_once 'secure.php';
html::docType();
?>
<html lang=en>
<head>
<?php
html::charset();
html::title('Login Page');
?>
  <link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>

<div id="container">

<div id="content"><!-- Start of the login page content. -->
<div id='header'>
    <h1>Auto-Obsessions Login</h1>
    <div id='reg-navigation'>
        <a href="registerUser.php">Register</a><br>
        <a href='index.php'>Cancel</a><br>
        <a href='logout.php'>Logout</a><br>
    </div>
</div>   
<?php 
// This section processes submissions from the login form.
// Check if the form has been submitted:

//login();
Secure::userLogin();
?>
<!-- Display the form fields-->
<div id="loginfields">
	<h2>Login</h2>
	<form action="login.php" method="post">
		<p><label class="label" for="email">Email Address:</label><br>
		<input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>
		<p><label class="label" for="psword">Password:</label><br>
		<input id="psword" type="password" name="psword" size="12" maxlength="12" value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>" ></p>
		<p><input id="submit" type="submit" name="submit" value="Login"></p>
	</form>
</div>

</div><!--end content-->

</div>
<?php html::footer();?>