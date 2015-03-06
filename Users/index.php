<?php
require_once '../include/html.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::title('Home Page');
html::charset();
?>
<link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
<div id="container">
<?php
require 'includes/header.php';
require 'includes/nav.php';
require 'includes/info-col.php';
?>
	<div id="content"><!-- Start of the home page content-->
<h2>This is the Home Page</h2>
<div id="mid-left-col">
<p>The home page content.  </p>
</div>
<div id="mid-right-col">
</div>	<!-- End of the home page content. --></div>
</div>	
<?php 
html::footer();
?>