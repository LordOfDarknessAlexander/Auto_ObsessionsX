<?php 
require ('config.php');


if( isset( $_POST) )
{
	if (!empty($_POST['fname'])  && !empty($_POST['money']) && !empty($_POST['tokens']) &&!empty($_POST['prestige']) && !empty($_POST['m_marker']))
	{
		$fname = $_POST["fname"];
		$money = $_POST["money"];
		$tokens = $_POST["tokens"];
		$prestige = $_POST["prestige"];
		$markers = $_POST["m_marker"];
		//$q = 'UPDATE users SET fname="Learning JAVA" WHERE user_id=1';
		$q = "UPDATE users SET fname='$fname', money='$money', tokens='$tokens' ,prestige='$prestige', m_marker='$markers' WHERE user_id=user_id";
		
		$result = mysqli_query ($dbcon, $q);
		if(!$result )
		{
		  die('Could not update data: ' . mysql_error());
		}
		else
		{
		  echo '{"fname":"' . $fname . '", "lname":"' . $money . '"}';
	
		}
		mysqli_close($dbcon);	
		
	}

}
else
{
	$fname = $_POST[" "];
	//$lname = $_POST[" "];
	echo "Goody try";
}

?>