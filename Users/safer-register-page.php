<?php
//require_once '../include/html.php';
//require_once '../include/dbConnect.php';
?>
<!doctype html>
<html lang=en>
<head>
<title>The Login page</title>
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
require ('mysqli_connect.php'); // Connect to the database



// This code inserts a record into the users table
// Has the form been submitted?
/*
function strip($str)
{
    $res = trim($_POST[$str]);
	strip HTML and apply escaping
	return mysqli_real_escape_string($db.$con, strip_tags($res));
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$errors = array(); // Start an array named errors 
	// Trim the title
	$tle = trim($_POST['title']);
	// Strip HTML and apply escaping
	$stripped = mysqli_real_escape_string($dbcon, strip_tags($tle));    //strip('title');
	// Get string lengths
	$strlen = mb_strlen($stripped, 'utf8');
	// Check stripped string
	if( $strlen < 1 ) 
	{
		$errors[] = 'You forgot to enter your title.';
	}
	else
	{
		$title = $stripped;
	}
	// Trim the first name
	$name = trim($_POST['fname']);
	// Strip HTML and apply escaping
	$stripped = mysqli_real_escape_string($dbcon, strip_tags($name));
	// Get string lengths
	$strlen = mb_strlen($stripped, 'utf8');
	// Check stripped string
	if( $strlen < 1 ) 
	{
		$errors[] = 'You forgot to enter your first name.';
	}
	else
	{
		$fn = $stripped;
	}
	// Trim the last name
	$lnme = trim($_POST['lname']);
	// Strip HTML and apply escaping
	$stripped = mysqli_real_escape_string($dbcon, strip_tags($lnme));
	// Get string lengths
	$strlen = mb_strlen($stripped, 'utf8');
	// Check stripped string
	if( $strlen < 1 ) 
	{
		$errors[] = 'You forgot to enter your last name.';
	}
	else
	{
		$ln = $stripped;
	}
	//Set the email variable to FALSE
	$e = FALSE;									
	// Check that an email address has been entered				
	if (empty($_POST['email'])) 
	{
		$errors[] = 'You forgot to enter your email address.';
	}
	//remove spaces from beginning and end of the email address and validate it	
	if (filter_var((trim($_POST['email'])), FILTER_VALIDATE_EMAIL)) 
	{	
		//A valid email address is then registered
		$e = mysqli_real_escape_string($dbcon, (trim($_POST['email'])));
	}
	else
	{									
		$errors[] = 'Your  email address is invalid or you forgot to enter your email address';
	}
	// Check that a password has been entered, if so, does it match the confirmed password
	if (empty($_POST['psword1']))
	{
		$errors[] ='Please enter a valid password';
	}
	if(!preg_match('/^\w{8,12}$/', $_POST['psword1'])) 
	{
		$errors[] = 'Invalid password, use 8 to 12 characters and no spaces.';
	}
	else
	{
		$psword1 = $_POST['psword1'];
	}
	if($_POST['psword1'] == $_POST['psword2']) 
	{
		$p = mysqli_real_escape_string($dbcon, trim($psword1));
	}
	else
	{
		$errors[] = 'Your two password do not match.';
	}
	// Trim the username
	$unme = trim($_POST['uname']);
	// Strip HTML and apply escaping
	$stripped = mysqli_real_escape_string($dbcon, strip_tags($unme));
	// Get string lengths
	$strlen = mb_strlen($stripped, 'utf8');
	// Check stripped string
	if( $strlen < 1 ) 
	{
		$errors[] = 'You forgot to enter your username.';
	}
	else
	{
		$uname = $stripped;
	}
	

	if (empty($errors)) 
	{ 
		// If there were no errors
		//Determine whether the email address has already been registered	
		$q = "SELECT user_id FROM users WHERE email = '$e' ";
		$result=mysqli_query ($dbcon, $q) ; 	
		if (mysqli_num_rows($result) == 0)
		{
			//The mail address was not already registered therefore register the user in the users table
			// Make the query:		
			$q = "INSERT INTO users (user_id, title, fname, lname, email, psword, registration_date, uname) VALUES (' ', '$title', '$fn', '$ln', '$e', SHA1('$p'), NOW(), '$uname' )";		
			$result = @mysqli_query ($dbcon, $q); // Run the query
			if ($result) 
			{ // If the query ran OK
				header ("location: register-thanks.php"); 
				exit();
			} 
			else 
			{ 
				// If the query did not run OK
				// Message
				echo '<h2>System Error</h2>
				<p class="error">You could not be registered due to a system error. We apologize for the inconvenience.</p>'; 
				// Debugging message:
				echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
			} // End of if ($result)
			mysqli_close($dbcon); // Close the database connection
			// Include the footer and stop the script
			include ('includes/footer.php'); 
			exit();
		} 
		else 
		{
			//The email address is already registered 
			echo '<p class="error">The email address is not acceptable because it is already registered</p>';
		}
	}
	else
	{ // Display the errors
		echo '<h2>Error!</h2>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) 
		{ // Display each error
			echo " - $msg<br>\n";
		}
		echo '</p><h3>Please try again.</h3><p><br></p>';
	}// End of if (empty($errors))
} // End of the main Submit conditionals
?>
<div id="midcol">
    <h2>Membership Registration</h2>
    <h3 class="content">Items marked with an asterisk * are essential</h3>
	<form action="safer-register-page.php" method="post">
		<label class="label" for="title">Title*</label><input id="title" type="text" name="title" size="15" maxlength="12" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
		<br><label class="label" for="fname">First Name*</label><input id="fname" type="text" name="fname" size="30" maxlength="30" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
		<br><label class="label" for="lname">Last Name*</label><input id="lname" type="text" name="lname" size="30" maxlength="40" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
		<br><label class="label" for="email">Email Address*</label><input id="email" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
		<br><label class="label" for="psword1">Password*</label><input id="psword1" type="password" name="psword1" size="12" maxlength="12" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >&nbsp;8 
		to 12 characters
		<br><label class="label" for="psword2">Confirm Password*</label><input id="psword2" type="password" name="psword2" size="12" maxlength="12" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" >
		<br><label class="label" for="uname"> User Name*</label><input id="uname" type="text" name="uname" size="12" maxlength="12" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>">&nbsp;6 
		to 12 characters
		<p><input id="submit" type="submit" name="submit" value="Register"></p>
	</form>
</div></div></div>
<?php include ('includes/footer.php'); ?>
<!-- End of the registration page content -->
</body>
</html>