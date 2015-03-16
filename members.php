<?php
require 'include/html.php';
require 'include/dbConnect.php';
//require 'secure.php';
session_start();
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
?>
<html lang=en>
<head>
    <title>Member's page</title>
    <meta charset=utf-8>
    <link rel='stylesheet' type='text/css' href='Users/includes.css'>
    <!-- Include JS File Here -->
</head>
<body>
<div id='container'>
<?php
require 'includes/nav.php';
require 'includes/info-col.php';
//require 'includes/metaHeader.php';
//require 'includes/header-members.php';
//require 'my_parse_file.php';
?>
	<div id='content'><!-- Start of the member's page content. -->
        <h2>Welcome to the Members' Page 
<?php
//if(isset($_SESSION['fname']))
//{
	//echo $_SESSION['fname'];
	//$sname = $_SESSION['uname'];
	//$sname = $_SESSION['fname'];
//}

if(isset($_SESSION['uname']))
{
	echo $_SESSION['uname'];
	//$sname = $_SESSION['uname'];
	//$sname = $_SESSION['fname'];
}
?>
        </h2>

        <div id='midcol'>
<?php
//Query the database

$q = "SELECT * FROM users WHERE uname = '$_SESSION[uname]'";		
$result = mysqli_query ($AO_DB->con, $q);
$loggedIn = true;
//Count the returned rows
if(mysqli_num_rows($result) != 0)
{
	//Turn the results in to an array
	while($rows = $result->fetch_assoc())
	{
		$uname = $rows['uname'];
		$money = $rows['money'];
		$m_marker = $rows['m_marker'];
		$tokens = $rows['tokens'];
		$prest = $rows['prestige'];
		
		echo "<div id ='playerData'>
            <label>Player: $uname</label>
            <label id='cash'>Money: $money</label>
            <label id='tokens'>Tokens: $tokens</label>
            <label id='prest'>Prestige: $prest</label>
            <label id='markers'>Mile Markers: $m_marker</label>
            </div>";
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

            <div id='mid-left-col'>
</body>
                <h3>Member's Events</h3>
                <p>Welcome to the members area.<br>
                <br>Browse the many portals here: Play as a guest or log in and save your progress.<br>
                Enter one of our events to win prizes.<br>Get a hold of our Merchandise today!</p>
            </div><!--end mid-left-col-->
            <div id='mid-right-col'>
                <h3>Special offers to Members only.</h3>
              <!--  <div id='nav'>
                    <a href='index.php' title='Play Game'>Play Game</a>
                </div>-->
               
                <p><b>T-Shirts &pound;100.00</b></p>
                <img alt='Polo shirt' title='Polo shirt' height='207' src='Users/images/polo.png' width='280'><br>
				<div id='nav'>
				 <a href='index.php' title='Play Game'>Play Game</a>
				 </div>
                <br>
            </div><!--end  mid-rid-col-->
        </div><!--end mid-col-->
    </div><!-- End of the Members' page content. -->
</div><!--end container-->
<?php
require 'phtml/legal.php';
html::footer();
?>