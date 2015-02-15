<?php

//Query the database
require ('Users/config.php');

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
		//echo "<div id ='playerData'> <p>Player: $fname </div>";

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

<div id="content">

</div>
