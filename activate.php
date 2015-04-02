<?php
require_once 'users.php';
require_once 'include/dbConnect.php';
$msg='';
if(!empty($_GET['email']) && isset($_GET['email_code']))
{
	$code = mysqli_real_escape_string($AO_DB->con,$_GET['email_code']);
	$e =  mysqli_real_escape_string($AO_DB->con,$_GET['email']);
	$c = mysqli_query($AO_DB->con,"SELECT user_id FROM users WHERE email='$e' AND email_code='$code' ");

	if(mysqli_num_rows($c) > 0)
	{
		$count= mysqli_query($AO_DB->con,"SELECT user_id FROM users WHERE email='$e' AND email_code='$code' AND confirm='0'");
		if(mysqli_num_rows($count) == 1)
		{
			mysqli_query($AO_DB->con,"UPDATE users SET confirm= '1' WHERE email_code='$code'");
			$msg="Your account is activated"; 
		}
		else
		{
			$msg ="Your account is already active, no need to activate again";
		}
	}
	else
	{
	$msg ="Wrong activation code.";
	}
} /*
if(isset($_GET['email'],$_GET['email_code'] === true)
{
	//echo 'set';
	$e		 = trim($_GET['email']);
	$email_code  = trim($_GET['email_code']);
	
	if(email_Exists($e === false))
	{
		$errors[] = 'Oops something went wrong we couldn\'t find that email address';
	}
	else if(activate($e,$email_code) === false)
	{
		$errors[] = 'We had problems activating your account';
	}
	if(empty($errors) === false)
	{
		?>
		<h2>Oops...</h2>
		<?php
		
		echo 'snap';
	}
	else
	{
		header('Location: index.php');
		exit();
	}
	
}
else
{
	header('Location : index.php');
	echo 'Crap';
	exit();
}*/

?>
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
require 'Users/includes/info-col-cards.php';
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