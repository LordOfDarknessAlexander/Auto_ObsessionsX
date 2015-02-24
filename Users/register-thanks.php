<?php
require_once '../include/html.php';
html::doctype();
?>
<html lang="en">
<head>
<?php
html::title('Registration thank you page');
html::charset();
?>
    <link rel="stylesheet" type="text/css" href="includes.css">
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
<?php
require 'includes/header-thanks.php';
require 'includes/nav.php';
require 'includes/info-col-cards.php';
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
require '../phtml/legal.php';
html::footer();
?>