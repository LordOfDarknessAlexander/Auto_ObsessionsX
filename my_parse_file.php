<?php 
require ('Users/config.php');

if( isset( $_POST) )
{
	if ( !empty($_POST['money']) || !empty($_POST['tokens']) || !empty($_POST['prestige']) || !empty($_POST['m_marker']))
	{
		
		$money = $_POST["money"];
		$tokens = $_POST["tokens"];
		$prestige = $_POST["prestige"];
		$marker = $_POST["m_marker"];
		
		$q = "UPDATE users SET money='$money', tokens='$tokens' ,prestige='$prestige', m_marker='$marker' WHERE user_id=2";
		echo "Shits awesome";
		$result = mysqli_query ($dbcon, $q);
		if(!$result )
		{
		  die('Could not update data: ' . mysql_error());
		}
		else
		{
		  echo '{"money":"' . $money . '", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $marker . '"}';
	
		}
		mysqli_close($dbcon);	
		
	}
	else if( empty($_POST['money']) || empty($_POST['tokens']) || empty($_POST['prestige']) || empty($_POST['m_marker']))
	{
		$money = $_POST["money"];
		$tokens = $_POST["tokens"];
		$prestige = $_POST["prestige"];
		$marker = $_POST["m_marker"];
		
		$q = "UPDATE users SET money='$money', tokens='$tokens' ,prestige='$prestige', m_marker='$marker' WHERE user_id=2";
		echo "Shits awesome";
		$result = mysqli_query ($dbcon, $q);
		if(!$result )
		{
		  die('Could not update data: ' . mysql_error());
		}
		else
		{
		  echo '{"money":"' . $money . '", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $marker . '"}';
	
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