<?php
require_once 'html.php';
require_once 'dbConnect.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::title('Tutorial Page');
html::charset();
?>
<link rel='stylesheet' type='text/css' href='includes.css'>
</head>
<body>
<div id='container'>
<div id="header">
<h1>Auto-Obsessions</h1>
    <div id="reg-navigation">
        <a href="login.php">Login</a><br>
        <a href="registerUser.php">Register</a><br>
	</div>
</div>
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>
</div><!--end of side column and menu -->
<?php


//require 'Users/includes/info-col.php';
?>
	<div id='content'><!-- Start of the page-specific content. -->
        <h2>Tutorial</h2>
        <p>Auto-Obsessions the game . Easy to play impossible to break the obsession. 
        <br>The page two content. The page two content. The page two content.
        <br>The page two content. The page two content. The page two content.
        <br>The page two content. The page two content. The page two content.</p>
        <!-- End of the page-specific content. -->
    </div>
</div>	
<?php
require 'phtml/legal.php';
html::footer();
?>