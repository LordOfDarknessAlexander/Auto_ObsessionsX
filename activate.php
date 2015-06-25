<?php
require_once 'html.php';
require 'dbConnect.php';
//
html::doctype();
?>
<html lang='en'>
<head>
<?php
html::title('Registration thank you page');
html::charset();
?>
    <link rel='stylesheet' type='text/css' href='includes.css'>
    <style type='text/css'>
    p { text-align:center; }
    table, tr, td, form { margin:auto;	width:180px; text-align:center; border:0; }
    form input { margin:auto; }
    img { border:0; }
    input.fl-left { float:left; }
    #submit { float:left; }
    </style>
</head>
<body>
<div id='container'>
<div id='header'>
<h1>Auto-Obsessions Thank you</h1>
<div id='reg-navigation'>
	<p>&nbsp;</p>
	<ul>
		<li><a href='index.php'>Cancel</a></li>
	</ul>
</div>
</div>
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>
</div><!--end of side column and menu -->
<?php
$msg='';
$E = 'email';

if(isset($_GET[$E]) && isset($_GET['email_code']))
{
    $U = 'users';
	$code = mysqli_real_escape_string($AO_DB->con,$_GET['email_code']);
	$e =  mysqli_real_escape_string($AO_DB->con,$_GET[$E]);
	$a = mysqli_real_escape_string($AO_DB->con,1);
	$q = "UPDATE $U SET confirm ='$a' WHERE $E='$e' AND email_code='$code' AND confirm = '0' ";
	
	echo "email:$e";?><br><?php
    echo "email_code:$code";?><br><?php
	
	$result = mysqli_query ($AO_DB->con, $q);
    
	if(!$result){
		die('Could not update data: ' . mysql_error());
	}
	else{
	   $ac = "UPDATE $U SET confirm ='$a' WHERE $E='$e' AND confirm = '0' ";
	   $resultB = mysqli_query ($AO_DB->con, $ac);
       
        if($resultB){
		   echo 'Success your account has been activated';
        }
        else{
		   echo 'Account could not be activated';
        }
	}
}
?>
<div id='content'><!-- Start of the thank you page content. -->
    <div id='midcol'>
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