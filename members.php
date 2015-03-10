<?php
session_start();
//require 'secure.php';
//secureLogin();

//secureLogin();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{
    //tmp, untill session vars issues are resolved
    //session vars are not persistsing from login.php,
    //one fix could says to change session.path entry in php.ini
    echo 'session vars:<br>';
    echo json_encode($_SESSION);
    echo 'not logged in, navigating to login page';
    //header("Location: login.php");

   exit();
}
html::doctype();
require 'include/html.php';
require 'include/dbConnect.php';

?>
<!doctype html>
<html lang=en>
<head>
<title>Members' page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes/includes.css">
<style type="text/css">
#mid-right-col { text-align:center; margin:auto;margin-right: 50%; margin-top: -10%
}
#midcol h3 { font-size:130%; margin-top:0; margin-bottom:0; 
}
</style>
</head>
<body>
<div id="container">
<?php include("includes/header-members.php"); ?>
<?php include("includes/nav.php"); ?>
<?php include("includes/info-col.php"); ?>


	<div id="content"><!-- Start of the member's page content. -->
<?php
echo '<h2>Welcome to the Members\' Page ';
if (isset($_SESSION['fname']))
{
	echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>
        <div id='midcol'>
<?php
//Query the database

$q = "SELECT * FROM users WHERE uname = '$_SESSION[uname]'";		
$result = mysqli_query ($AO_DB->con, $q);

//Count the returned rows
if(mysqli_num_rows($result) != 0)
{
	//Turn the results in to an array
	while($rows = $result->fetch_assoc())
	{
		$fname = $rows['fname'];
		$money = $rows['money'];
		$m_marker = $rows['m_marker'];
		$tokens = $rows['tokens'];
		$prestige = $rows['prestige'];
		
		echo "<div id ='playerData'> <p>Player: $fname <br> Money: $money <br> Mile Markers: $m_marker <br> Tokens: $tokens<br> Prestige: $prestige</p></div>";
	}
}
else
{
	echo 'No Results';
	//If there was a problem.
    echo "<p class='error'>Please try again.</p>";
	//exit();
}
?>
<div id="mid-left-col">
<h3>Member's Events</h3>
<p>The Members' page content. The Members' page content. The Members' page content.
<br>The Members' page content. The Members' page content. The Members' page content.<br>The Members' page content. 
The Members' page content. The Members' page content.<br>The Members' page content. The Members' page content. 
The Members' page content.</p></div>
<div id="mid-right-col">
<h3>Special offers to Members only.</h3>
<div id="nav">
<ul>
<li><a href="index.php" title="Play Game">Play Game</a></li>
</ul>
</div>
<br>
<p><b>T-Shirts &pound;100.00</b></p>
<img alt="Polo shirt" title="Polo shirt" height="207" src="images/polo.png" width="280"><br>
<br>

</div>
</div></div><!-- End of the Members' page content. -->
</div>	
<?php include('includes/footer.php'); ?></body>
</html>