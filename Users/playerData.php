<?php

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
		$money = $rows['money'];
		$m_marker = $rows['mmarker'];
		$tokens = $rows['tokens'];
		$prestige = $rows['prestige'];
		
		echo "<p>Money: $money <br> Mile Markers: $m_marker <br> Tokens: $tokens<br> Prestige: $prestige</p>";
	}
}
else
{
	echo "No Results";
}



?>
<!doctype html>
<html lang=en>
<head>
<title>Player Data</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
<div id="container">
<?php
   // include 'includes/login-header.php';
   // echo '<p class="error">You forgot to enter your email address.</p>';
?>
<div id="content">

<h1>Player Data </h1>
<p>Hi Bob</p> 


</div>
<?php



//header("Content-type: image/jpg");
//echo $money;
?>