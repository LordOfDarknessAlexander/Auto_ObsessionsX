<?php
require_once 'html.php';
html::doctype();
?>
<html lang="en">
<head>
<?php
html::title('Registration thank you page');
html::charset();
?>
    <link rel="stylesheet" type="text/css" href="Users/includes.css">
    <style type="text/css">
    p { text-align:center; }
    table, tr, td, form { margin:auto;	width:180px; text-align:center; border:0; }
    form input { margin:auto; }
    img { border:0; }
    input.fl-left { float:left; }
    #submit { float:left; }
    </style>
</head>
<body>
<div id="container">
<div id="header">
<h1>Auto-Obsessions Thank you</h1>
<div id="reg-navigation">
	<p>&nbsp;</p>
	<ul>
		<li><a href="index.php">Cancel</a></li>
	</ul>
</div>
</div>
<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a><br>
    <a href='credits.php' title='Credits'>Credits</a><br>
    <a href='profiles.php' title='Player Profile'>Profile</a><br>
    <a href='index.php' title='Home Page'>Home</a><br>
</div><!--end of side column and menu -->
<?php
//require 'Users/includes/header-thanks.php';
//require 'include/nav.php';
//require 'Users/includes/info-col-cards.php';
?>
<div id="content"><!-- Start of the thank you page content. -->
    <div id="midcol">
        <h2>Thank you for registering</h2>
        <h3>To confirm your registration confirm your email for us </h3>
    </div>
</div>
</div>
	<!-- End of the thank you page content. -->
<?php
require 'phtml/legal.php';
html::footer();
?>