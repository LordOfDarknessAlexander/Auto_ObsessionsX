<?php
session_start();
//require 'secure.php';
//secureLogin();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1))
{
   header("Location: login.php");
   exit();
}
?>
<!doctype html>
<html lang=en>
<head>
<title>Admin page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
<style type="text/css">
#midcol { width:88%; }
#midcol p { margin-left:-4%; }
</style>
</head>
<body>
<div id="container">
<?php include("includes/header-admin.php"); ?>
<?php include("includes/nav.php"); ?>
<?php include("includes/info-col.php"); ?>
	<div id="content"><!-- Start of the member's page content. -->
<?php
echo '<h2>Welcome to the Admin Page ';
if (isset($_SESSION['fname']))
{
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
	<div id="footer">
		<?php include("includes/footer.php"); ?>
	</div>
</body>
</html>