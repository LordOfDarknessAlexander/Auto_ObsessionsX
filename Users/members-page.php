<?php
session_start();
//require 'secure.php';
//secureLogin();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{  header("Location: login.php");

   exit();
}
?>
<!doctype html>
<html lang=en>
<head>
<title>Members' page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style type="text/css">
#mid-right-col { text-align:center; margin:auto;margin-right: 25%; margin-top: -10%
}
#midcol h3 { font-size:130%; margin-top:0; margin-bottom:0; 
}
</style>
</head>
<body>
<div id="container">

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


<div id="midcol">
<?php

//Query the database
//Query the database
require ('mysqli_connect.php');
$q = "SELECT * FROM users WHERE money = 0" ;		
$result = mysqli_query ($dbcon, $q);

//Count the returned rows
if( mysqli_num_rows($result) != 0)
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
	echo "No Results";
	//exit();
}
?>

<div id="mid-left-col">
<!---
 <div id='sub'>
	<form id='userForm' action="userInfo.php" method='post'>
	Money: <input type="text" name="money" /><br />
	Mile Markers: <input type="text" name="milemarker" /><br />
	Tokens: <input type="text" name="tokens" /><br />
	Prestige: <input type="text" name="prestige" /><br />
	<button id='sub'>Save</button>
	</form>
	<span id='result'></span> -->
<h3>Member's Events</h3>
<p>Welcome to the members area.
<br>Browse the many portals here: Play as a guest or log in and save your progress.<br>
Enter one of our events to win prizes.<br>Get a hold of our Merchandise today! </p>
</div>
<div id="mid-right-col">
<h3>Special offers to Members only.</h3>
<div id="nav">
<ul>
<li><a href="..\index.php" title="Play Game">Play Game</a></li>
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