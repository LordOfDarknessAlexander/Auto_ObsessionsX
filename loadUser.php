<?php 
require_once 'include/dbConnect.php';
//$uname = $_SESSION[uname];

session_start();

if( isset( $_POST) )
{
	if (isset($_SESSION['uname']))
	{
		$q = "SELECT * FROM users WHERE uname = '$_SESSION[uname]'";	
		$result = mysqli_query ($AO_DB->con, $q);
		//Count the returned rows
		if( mysqli_num_rows($result) != 0)
		{
			//Turn the results in to an array
			while($rows = $result->fetch_assoc())
			{
				$money = $rows['money'];
				$m_marker = $rows['m_marker'];
				$tokens = $rows['tokens'];
				$prestige = $rows['prestige'];
				$varma = array("$money","$tokens","$prestige","$m_marker"); 
				//header( 'Content-Type: application/json' );
				//echo '{"money":"' . $money . '", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $m_marker . '"}';
				//echo '{"money": . $money ", "tokens":"' . $tokens . '","prestige":"' . $prestige . ',"m_marker":"' . $m_marker . '"}';
				//print json_encode( $varma );
				echo json_encode($varma,JSON_FORCE_OBJECT);
				//$varma2 = $_GET['$varma'];
				//print json_encode( $varma2 );
			}
		}
		else
		{
			echo "No Results";
			// If there was a problem.
				echo '<p class="error">Please try again.</p>';
			//exit();
		}
		//mysqli_close($dbcon);
	}
}
?>
<script type="text/javascript">
 var amoney = <?php echo $money ?>;
 var atokens = <?php echo $tokens ?>;
 var aprestige = <?php echo $prestige ?>;
 var amarkers = <?php echo $m_marker ?>;

userLogged = true;
</script>