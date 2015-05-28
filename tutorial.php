<?php
require_once 'include/html.php';
require_once 'include/dbConnect.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::title('Login Page');
html::charset();
?>
<link rel='stylesheet' type='text/css' href='Users/includes.css'>
</head>
<body>
<div id='container'>
<?php
require 'include/header.php';
require 'include/nav.php';
require 'Users/includes/info-col.php';
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