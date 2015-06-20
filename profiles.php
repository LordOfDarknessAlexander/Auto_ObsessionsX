<?php
require_once 'html.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::title('Login Page');
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
require 'Users/includes/info-col.php';
?>
	<div id='content'><!-- Start of page content. -->
        <h2>Profile</h2>
        <p>The profile content. 
       </p>
            <!-- End of page five content. -->
    </div>
</div>	
<?php
require 'phtml/legal.php';
html::footer();
?>