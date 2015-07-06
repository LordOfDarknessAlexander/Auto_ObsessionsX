<?php
require_once 'html.php';
require_once 'ao.php';
html::doctype();
?>
<html lang=en>
<link rel='stylesheet' type='text/css' href='includes.css'>
<head>
<?php
html::title('Profiles');
html::charset();
?>
</head>
<body>
<div id='container'>
<?php
//require_once 'metaHeader.php';
require 'Users/includes/info-col.php';
eS();
?>


<div id="reg-navigation">
	<a href="login.php">Login</a><br>
	<a href="registerUser.php">Register</a><br>
</div>
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>
</div><!--end of side column and menu -->
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