<?php 
require_once 'dbConnect.php';
//session_start();

//if (isset($_SESSION['uname']))
if (isset($_SESSION['user_id']))
{
	echo "{$_SESSION['user_id']}";
	if( isset( $_POST) )
	{
		if ( !empty($_POST['money']) || !empty($_POST['tokens']) || !empty($_POST['prestige']) || !empty($_POST['m_marker']))
		{
				$money = $_POST["money"];
				$tokens = $_POST["tokens"];
				$prestige = $_POST["prestige"];
				$marker = $_POST["m_marker"];
				$q = "UPDATE users SET money='$money', tokens='$tokens' ,prestige='$prestige', m_marker='$marker' WHERE   user_id = '$_SESSION[user_id]'";
				//echo "Awesome";
				$result = mysqli_query ($AO_DB->con, $q);
				
                if(!$result )
				{
				  die('Could not update data: ' . mysql_error());
				}
				else
				{
				  echo '{"money":"' . $money . '", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $marker . '"}';
				}
				//mysli_close($AO_DB->con);
		}
		
	}
	else
	{
		echo "Goody try";
	}
}

?>