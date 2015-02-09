<?php
//Connect to car db
mysql_connect ("localhost", "root", "Dante777") or die("You Suck");
mysql_select_db ("cars") or die(mysql_error());

$id = stripcslashes($REQUEST ['id']);
$image = mysql_query ("SELECT * FROM description WHERE id = $id");
$image = mysql_fetch_assoc($image);
$image = $image['image'];

header("Content-type: image/jpg");
echo $image;

?>