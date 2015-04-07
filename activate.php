
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
require 'Users/includes/dbConnect.php';
$msg='';

if(isset($_GET['email']) && isset($_GET['email_code']))
{
	$code = mysqli_real_escape_string($AO_DB->con,$_GET['email_code']);
	$e =  mysqli_real_escape_string($AO_DB->con,$_GET['email']);
	$a = mysqli_real_escape_string($AO_DB->con,1);
	$q = "UPDATE users SET confirm ='$a' WHERE email='$e' AND email_code='$code' AND confirm = '0' ";
	
	echo "email:$e";?><br><?php
    echo "email_code:$code";?><br><?php
	
	$result = mysqli_query ($AO_DB->con, $q);
	if(!$result)
	{
		die('Could not update data: ' . mysql_error());
	}
	else
	{
	   $ac = "UPDATE users SET confirm ='$a' WHERE email='$e' AND confirm = '0' ";
	   $resultB = mysqli_query ($AO_DB->con, $ac);
	   if($resultB)
	   {
		   echo "Success we have activated your account";
	   }
	   else
	   {
		   echo 'snap u suck';
	   }
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