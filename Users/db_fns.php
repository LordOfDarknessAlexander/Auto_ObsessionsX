<?php

function db_connect() 
{
	/*
   $host= 'localhost';
   $db = 'bookmarks';
   $manager = 'root';
   $passW = '';
   $port = '14147';
   $result = new mysqli($host, $manager , $passW, $db,$port);
   if(!$result)
   {
	  die("Database connection failed: ");
   }
   else
   {
      echo "Connection is created";
	  return $result;
   }*/
   /* Created By Adam Khoury @ www.developphp.com 
-----------------------June 19, 2008-----------------------*/
//***  "die()" will exit the script and show an error if something goes wrong with the "connect" or "select" functions. 
//***  A "mysql_connect()" error usually means your connection specific details are wrong 
//***  A "mysql_select_db()" error usually means the database does not exist.
// Place db host name. Usually is "localhost" but sometimes a more direct string is needed
$db_host = "localhost";
// Place the username for the MySQL database here
$db_username = "root"; 
// Place the password for the MySQL database here
$db_pass = "Dante777";
// Place the name for the MySQL database here
$db_name = "users";

mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
mysql_select_db("$db_name") or die("no database by that name");
}
?>
