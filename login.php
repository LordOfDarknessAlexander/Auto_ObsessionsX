<?php
require_once 'include/html.php';
require_once 'include/dbConnect.php';
html::docType();
?>
<html lang=en>
<head>
<?php
html::charset();
html::title('Login Page');
?>
    <link rel="stylesheet" type="text/css" href="includes/includes.css">
</head>
<body>
<div id="container">
<?php
    //include 'includes/login-header.php';
?>
<div id="content"><!-- Start of the login page content. -->
<?php 
// This section processes submissions from the login form.
// Check if the form has been submitted:
if($_SERVER['REQUEST_METHOD'] == 'POST')
{	// Validate the email address:
	if(!empty($_POST['email'])){
        $e = mysqli_real_escape_string($AO_DB->con, $_POST['email']);
	} 
	else{
		$e = FALSE;
		echo "<p class='error'>You forgot to enter your email address.</p>";
	}
	// Validate the password:
	if(!empty($_POST['psword'])){
        $p = mysqli_real_escape_string($AO_DB->con, $_POST['psword']);
	}
	else{
		$p = FALSE;
		echo "<p class='error'>You forgot to enter your password.</p>";
	}
	if($e && $p){
		//if no problems
        echo "email:$e";?><br><?php
        echo "password:$p";?><br><?php
		// Retrieve the user_id, first_name and user_level for that email/password combination:
		$q = "SELECT user_id, fname,uname, user_level FROM users WHERE (email='$e' AND psword=SHA1('$p') )";		
		$result = $AO_DB->query($q); 
		// Check the result:
        
		//if(@mysqli_num_rows($result) != 0) 
		if (@mysqli_num_rows($result) == 1) 
		{	
			//The user input matched the database record
			// Start the session, fetch the record and insert the three values in an array
			session_start();
			$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$_SESSION['user_level'] = (int) $_SESSION['user_level']; // Changes the 1 or 2 user level to an integer.
			$url = ($_SESSION['user_level'] === 1) ? 'admin.php' : 'Users/members-page.php'; // Ternary operation to set the URL
			
            mysqli_free_result($result);
            
            header('Location: ' . $url); // Makes the actual page jump. Keep in mind that $url is a relative path.
           
            //mysqli_close($dbcon);
            //ob_end_clean(); // Delete the buffer.
            exit(); //Cancels the rest of the script, NOTE: the execution ends here, the cleanup code will never be called and cause memory issues;       
			
			  // Start the session, fetch the record and insert the three values in an array
			  /*
            session_start();
            $_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
            $_SESSION['user_level'] = (int) $_SESSION['user_level']; // Ensure the user level is an integer
            // The login page redirects the user either to the admin page or the users search page
            // Use a ternary operation to set the URL
            $url = ($_SESSION['user_level'] === 51) ? 'admin_page.php' : 'members-page.php';
            header('Location: ' . $url); // The user is directed to the appropriate page
            mysqli_free_result($result);
            exit(); // Cancel the rest of the script*/
		} 
		else 
		{ // No match was made.
            //echo 'error: ' . mysqli_error($AO_DB->con);
			echo "<p class='error'>The email address and password do not match our records.If you need to register, click the Register button on the header menu</p>";
		}
	} 
	else 
	{ // If there was a problem.
		echo "<p class='error'>Please try again.</p>";
	}
	//mysqli_close($dbcon);
} // End of SUBMIT conditional.
?>
<!-- Display the form fields-->
<div id="loginfields">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <p><label class="label" for="email">Email Address:</label>
        <input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>
        <p><label class="label" for="psword">Password:</label>
        <input id="psword" type="password" name="psword" size="12" maxlength="12" value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>" ></p>
        <br><br><p><input id="submit" type="submit" name="submit" value="Login"></p>
    </form>
</div>
<p>&nbsp;</p>
<br>
</div><!--end content-->

</div>
<?php //include ('includes/footer.php'); ?>
</div>
</div>
<?php html::footer();?>