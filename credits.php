<?php
require_once 'include/html.php';
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
        <h2>Credits</h2>
        <p>The page four content. The page four content. The page four content.<br>The page 
        four content. The page four content. The page four content.<br>The page four content. The page 
        four content. The page four content.<br>The page four content. The page four content. The page 
        four content.</p>
	<!-- End of the page 4 content. -->
    </div>
</div>	
<?php
require '../phtml/legal.php';
html::footer();
?>