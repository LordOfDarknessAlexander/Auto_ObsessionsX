<?php
require_once '../include/html.php';
require_once '../include/dbConnect.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::title('Login Page');
html::charset();
?>
<link rel='stylesheet' type='text/css' href='includes.css'>
</head>
<body>
<div id='container'>
<?php
require 'includes/login-header.php';
require 'includes/nav.php';
require 'includes/info-col.php';
?>
<div id='content'><!-- Start of the login page content. -->
<?php 
// This section processes submissions from the login form.
// Check if the form has been submitted:
$logged = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	// Validate the email address:
	if(!empty($_POST['email'])) 
	{
        $e = mysqli_real_escape_string($AO_DB->con, $_POST['email']);
	} 
	else 
	{
		$e = FALSE;
		echo "<p class='error'>You forgot to enter your email address.</p><br>";
	}
	// Validate the password:
	if(!empty($_POST['psword'])) 
	{
        $p = mysqli_real_escape_string($AO_DB->con, $_POST['psword']);
	} 
	else 
	{
		$p = FALSE;
		echo "<p class='error'>You forgot to enter your password.</p><br>";
	}
    
	if($e && $p)
	{
		//if no problems
		// Retrieve the user_id, first_name and user_level for that email/password combination:
        //$users = 'users'; //'users' table in AO_DB, contain all the registered users, and data specific to their profile
        //$getUserInfo = $AO_DB->con->prepare("SELECT user_id, fname, uname, user_level FROM $users WHERE (email='?' AND psword=SHA1('?') )";		
		$q = "SELECT user_id, fname, uname, user_level FROM users WHERE (email='$e' AND psword=SHA1('$p') )";		
		$result = $AO_DB->query($q);
		
        if(mysqli_num_rows($result) == 1) 
		{
			//The user input matched the database record
			// Start the session, fetch the record and insert the three values in an array
			session_start();
            //assign user's entries to session local vars
			$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
			//create boolean set to true for logged in
			$logged = true;
			$_SESSION['user_level'] = (int) $_SESSION['user_level']; // Changes the 1 or 2 user level to an integer.
            //$_SESSION['userID'] = (int)$_SESSION['userID']; //store to make sql quires later!
			
            $url = ($_SESSION['user_level'] === 1) ? 'admin-page.php' : 'members-page.php'; // Ternary operation to set the URL
            mysqli_free_result($result);
            //make the actual page jump. Keep in mind that $url is a relative path.
            //echo "navigating to $url";
			header("Location: $url");
            exit(); //Cancels the rest of the script, NOTE: the execution ends here, the cleanup code will never be called and cause memory issues;
                //mysqli_close($dbcon);
                ob_end_clean(); // Delete the buffer.
		} 
		else 
		{ // No match was made.
			echo "<p class='error'>The email address ($e) and password do not match our records.<br>To register, click the button on the header menu.</p><br>";
		}
	} 
	else 
	{ // If there was a problem.
		echo "<p class='error'>Please try again.</p><br>";
	}
	//mysqli_close($dbcon);
} // End of SUBMIT conditional.
?>
<!-- Display the form fields-->
<div id='loginfields'>
    <h2>Login</h2>
    <form action='login.php' method='post'>
        <label class='label' for='email'>Email Address:</label><br>
        <input id='email' type='text' name='email' size='30' maxlength='60' value='<?php if (isset($_POST['email'])) echo $_POST['email'];?>'><br>
        <label class='label' for='psword'>Password:</label><br>
        <input id='psword' type='password' name='psword' size='12' maxlength='12' value='<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>'>&nbsp;Between 8 and 12 characters
        <input id='submit' type='submit' name='submit' value='Login'>
    </form><br>
</div>
<br>
</div><!--end content-->
<?php require '../phtml/legal.php';?>
</div><!--end container-->
<?php html::footer();?>