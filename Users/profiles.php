<?php
require_once '../include/html.php';
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
<?php
require 'includes/header.php';
require 'includes/nav.php';
require 'includes/info-col.php';
?>
	<div id='content'><!-- Start of page content. -->
<h2>This is page Five</h2>
<p>The page five content. The page five content. The page five content.<br>The page 
five content. The page five content. The page five content.<br>The page five content. The page 
five content. The page five content.<br>The page five content. The page five content. The page 
five content.</p>
	<!-- End of page five content. --></div>
</div>	
<?php
require '../phtml/legal.php';
html::footer();
?>