<?php
//Configuration info
//Database information
//DB Name
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Dante777';
$db = 'finalpost';

$dbcon = mysqli_connect($dbhost,$dbuser,$dbpass,$db) or die("Could not connect to server");
mysqli_set_charset($dbcon, 'utf8');
//mysql_select_db($db);
?>