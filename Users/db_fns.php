<?php

function db_connect() 
{
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
   }
}
?>
