<?php 
require ('config.php');

//$fname = $_POST["fname"];
//$lname = $_POST["lname"];	

//$q = 'SELECT * FROM aoCars';   //select all elements
///$result = $AO_DB->query($q);

//$q = 'UPDATE FROM users ( fname, lname ) VALUES ('$fname', '$lname' )';	

//if($_POST["fname"] && $_POST["lname"] )/
if( isset( $_POST) )
{
	if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['money']) && !empty($_POST['tokens']))
	{
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$money = $_POST["money"];
		$tokens = $_POST["tokens"];
		//$q = 'UPDATE users SET fname="Learning JAVA" WHERE user_id=1';
		$q = "UPDATE users SET fname='$fname', lname='$lname', money='$money', tokens='$tokens' WHERE user_id=1";
		//echo ' selected="selected"';
	//	echo 'Thank you '. $_POST['fname'] . ' ' . $_POST['lname'] . ', says the PHP file';
		
		//$q = "UPDATE INTO users ( fname, lname ) VALUES ('$fname', '$lname' )";		
		$result = mysqli_query ($dbcon, $q);
		if(!$result )
		{
		  die('Could not update data: ' . mysql_error());
		}
		else
		{
		  echo '{"fname":"' . $fname . '", "lname":"' . $lname . '"}';
	
		}
		mysqli_close($dbcon);	
		
	}

}
else
{
	$fname = $_POST[" "];
	$lname = $_POST[" "];
	echo "Goody try";
}

?>