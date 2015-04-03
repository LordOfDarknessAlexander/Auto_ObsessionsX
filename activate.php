
<?php
require_once 'include/html.php';
html::doctype();
?>
<html lang="en">
<head>
<?php
html::title('Registration thank you page');
html::charset();
?>
    <link rel="stylesheet" type="text/css" href="Users/includes.css">
    <style type="text/css">
    p { text-align:center; }
    table, tr, td, form { margin:auto;	width:180px; text-align:center; border:0; }
    form input { margin:auto; }
    img { border:0; }
    input.fl-left { float:left; }
    #submit { float:left; }
    </style>
</head>
<body>
<div id="container">
<?php
require 'Users/includes/header-thanks.php';
require 'include/nav.php';
require 'Users/includes/dbConnect.php';
?>
<?php
session_start();
$msg='';

if(isset($_GET['email']) && isset($_GET['email_code']))
{
	
	echo 'Great foods';
	//$code = mysqli_real_escape_string($AO_DB->con,$_GET['email_code']);
	//$e =  mysqli_real_escape_string($AO_DB->con,$_GET['email']);
	$e = $_GET['email'];
	$code = $_GET['email_code'];
	$a = '1';
	$q = "UPDATE users SET confirm = '$a' WHERE email='$e' AND email_code='$code' ";
	//$q= (mysql_result(mysqli_query("SELECT COUNT ('user_id') FROM  'users' WHERE 'uname' = '$uname' AND 'confirm'"), 0) == 0);
	//$q = "SELECT user_id,uname,email,email_code,confirm FROM users WHERE email='$e' AND email_code='$code' )";	
	  echo "email:$e";?><br><?php
      echo "email_code:$code";?><br><?php
	
	$result = mysqli_query ($AO_DB->con, $q);
	if($result)
	{
		
	 //$rows = $result->fetch_assoc();
	  $q = "UPDATE users SET confirm ='$a' WHERE email='$e' AND email_code='$code' ";
	  $result = mysqli_query ($AO_DB->con, $q);
	   echo "Success we have activated your account";
	}
	else
	{
		die('Could not update data: ' . mysql_error());
	
	}
} 
?>
<div id="content"><!-- Start of the thank you page content. -->
    <div id="midcol">
        <h2>Thank you for registering</h2>
        <h3>Your account is now activated.</h3>
    </div>
</div>
</div>
	<!-- End of the thank you page content. -->
<?php
require 'phtml/legal.php';
html::footer();
?>
<?php echo $msg; ?>