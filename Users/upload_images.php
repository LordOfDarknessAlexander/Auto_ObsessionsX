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
<title>Admin Upload Images Page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
<style type="text/css">
h3.red { color:red; font-size:105%; font-weight:bold; text-align:center;}
</style>
</head>
<body>
<div id="container">
<?php include("includes/header-admin.php"); ?>
<?php include("includes/nav.php"); ?>
<?php include("includes/info-col.php"); ?>
	<div id="content"><!-- Start of search page content. -->
<h2>Upload Images</h2>
<form action="upload_images.php" method="POST" enctype ="multipart/form-data">
	File:
	<input type="file"  name="image"><input type="submit" value="Upload">
</form>


<?php 
//connect to database
//require ('mysqli_connect.php'); 

mysql_connect ("localhost", "root", "Dante777") or die("You Suck");
mysql_select_db ("cars") or die(mysql_error());

//file properties
echo $file = $_FILES['image' ]['tmp_name'];
   
if (!isset($file))
{
	echo "Please select a file";
}
else
{
    $image = addslashes(file_get_contents ($_FILES['image' ]['tmp_name']));
	$image_name = addslashes($_FILES['image' ]['name']);
	$image_size = getimagesize($_FILES['image' ]['tmp_name']);
	
	if($image_size==FALSE)
	{
		echo "Gorguts that's not an image";
	}
	else
	{
		if(!$insert = mysql_query("INSERT INTO description VALUES('','$image_name','$image')"))
		{
			echo "Problem uploading image";
		}
		else
		{
			$lastid = mysql_insert_id();
			echo "Image uploaded. <p/>Your Image:  <p/><img src=get.php?id=$lastid>";
		}
	}
}	

?>

<?php include ('includes/footer.php'); ?>
<!-- End of the search page content. -->
</div>
</div>	
</body>
</html>