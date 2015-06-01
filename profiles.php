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