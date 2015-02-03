<?php
//require_once 'include/html.php';
//require_once 'include/secure.php';
//
session_start();
//secure::adminLogin();
?>
<!doctype html>
<html lang=en>
<head>
<meta charset=utf-8>
<title>Administrators Page</title>
    <link rel="stylesheet" type="text/css" href="includes.css">
</head>
<body>
<div id="container">
<?php
include 'includes/header-admin.php';
include 'includes/nav.php';
include 'includes/info-col.php';
?>
	<div id="content"><!-- Start of the member's page content. -->
<?php
echo '<h2>Welcome to the Admin Page ';
if(isset($_SESSION['fname'])){
	echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>
<div id="midcol">
	<h3>You have permission to:</h3><p>&#9632;Edit and delete a record.</p>
	<p>&#9632;Use the View members button to page through all the members.</p>
	<p>&#9632;Use the Search button to locate a particular member</p>
	<p>&#9632;Use the Users button to locate a member's Username </p>
	<p>&nbsp;</p></div>
<!-- End of the members page content. -->
</div></div>	
</body>
</html>