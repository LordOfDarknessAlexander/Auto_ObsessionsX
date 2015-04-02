
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

?>
<?php
require_once 'include/dbConnect.php';

$msg='';
echo 'Crackers';
if(isset($_GET['email']) && isset($_GET['email_code']))
{
	//session_start();
	echo 'Great foods';
	//$code = mysqli_real_escape_string($AO_DB->con,$_GET['email_code']);
	//$e =  mysqli_real_escape_string($AO_DB->con,$_GET['email']);
	$e = $_GET['email'];
	$code = $_GET['email_code'];
	$a = '1';
	
	$q = "SELECT user_id, email,email_code FROM users WHERE email='$e' AND email_code='$code' )";	
	//$q = "UPDATE users SET confirm= '1' FROM users WHERE email='$e' AND email_code='$code' ";
	$result = $AO_DB->query($q);
	if(!$result)
	{
	  die('Could not update data: ' . mysql_error());
	}
	else
	{
	  $q = "UPDATE users SET confirm = '1' FROM users WHERE email='$e' AND email_code='$code' ";
	  $result = $AO_DB->query($q);
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