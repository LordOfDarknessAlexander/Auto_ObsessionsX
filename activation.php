<?php
include 'include/dbConnect.php';
$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
	$code = mysqli_real_escape_string($AO_DB->con,$_GET['code']);
	$c = mysqli_query($connection,"SELECT user_id FROM users WHERE confirm ='$code'");

	if(mysqli_num_rows($c) > 0)
	{
		$count= mysqli_query($AO_DB->con,"SELECT user_id FROM users WHERE confirm='$code' and status='0'");
		if(mysqli_num_rows($count) == 1)
		{
			mysqli_query($AO_DB->con,"UPDATE users SET status='1' WHERE confirm='$code'");
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
}
?>
//HTML Part
<?php echo $msg; ?>