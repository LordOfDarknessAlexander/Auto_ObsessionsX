<?php
session_start();
require 'includes/secure.php';
//secureLogin();
if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
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
<!-- Include JS File Here -->

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
<?php include("my_parse_file.php"); ?>


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
require ('config.php');
$q = "SELECT * FROM users WHERE user_id = 1" ;		
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
	// If there was a problem.
		echo '<p class="error">Please try again.</p>';
	//exit();
}
//mysqli_close($dbcon);
?>

<div id="mid-left-col">
<script>
function getHostPath(){
    var localExecution = true;
    return localExecution == true ? 'http://localhost/B/'
            : 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/';
}
function ajax_post(){
    // Create our XMLHttpRequest object
    //var dataStr = ''; //args to pass to script
	 var fn = document.getElementById("fname").value;
	 var amoney = document.getElementById("money").value;
     var atokens = document.getElementById("tokens").value;
	 var aprestige = document.getElementById("prestige").value;
	 var amarkers = document.getElementById("m_marker").value;
    //}
    var jqxhr = $.ajax({
        type:'POST',
        url:getHostPath() + 'Users/my_parse_file.php',
        dataType:'json',
        data:{fname:fn,money:amoney,tokens:atokens,prestige:aprestige,m_marker:amarkers}
    }).done(function(data){
        //the response string is converted by jquery into a Javascript object!
        if(data === null){
            alert('Error:ajax response returned null!');
            return;
        }
        alert('ajax response received:' + JSON.stringify(data) );
        //access and set values in the document's html page
		/*
        $('div#statBar label#money').text(data.money);
        $('div#statBar label#tokens').text(data.tokens);
        $('div#statBar label#prestige').text(data.prestige);
        $('div#statBar label#m_marker').text(data.m_marker);*/
    }).fail(function(jqxhr){
        //call will fail if result is not properly formatted JSON!
        alert('ajax call failed! Reason: ' + jqxhr.responseText);
        //throw exception, game can't work without user stats
    });
    
	
	
}
</script>

<h2>Ajax Post to PHP and Get Return Data</h2>
First Name: <input id="fname" name="fname" type="text">  <br><br>
Money: <input id="money" name="money" type="text">  <br><br>
Tokens: <input id="tokens" name="tokens" type="text"> <br><br>
Prestige: <input id="prestige" name="prestige" type="text"> <br><br>
Mile Markers: <input id="m_marker" name="m_marker" type="text"> <br><br>

<input name="myBtn" type="submit" value="Submit Data" onclick="ajax_post();"> <br><br>
<div id="status"></div>
</body>
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