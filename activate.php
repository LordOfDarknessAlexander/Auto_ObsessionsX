<?php
require_once 'users.php';
require_once 'include/dbConnect.php';
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

?>
<?php
session_start();
$msg='';
echo 'Crackers';
if(isset($_GET['email']) && isset($_GET['email_code']))
{
	//$code = mysqli_real_escape_string($AO_DB->con,$_GET['email_code']);
	//$e =  mysqli_real_escape_string($AO_DB->con,$_GET['email']);
	$e = $_GET['email'];
	$code = $_GET['email_code'];
	$a = '1';
	echo 'Great foods';
	$q = "SELECT user_id, email,email_code FROM users WHERE email='$e' AND email_code='$code' AND confirm = '0')";	
	$result = $AO_DB->query($q);
	
	if($result)
	{
		
		//mysqli_query($AO_DB->con,"UPDATE users SET confirm = '$a' WHERE email='$e' AND email_code='$code' ");
		$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$c = mysqli_query($AO_DB->con,"UPDATE users SET confirm= '1' FROM users WHERE email='$e' AND email_code='$code' ");
		echo '$code';
		echo '$e';
		echo '$a';
		/*
		$count= mysqli_query($AO_DB->con,"SELECT confirm FROM users WHERE email='$e' AND email_code='$code' AND confirm='0'");
		if(mysqli_num_rows($count) == 1)
		{
			
		}
		else
		{
			$msg ="Your account is already active, no need to activate again";
		}*/
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