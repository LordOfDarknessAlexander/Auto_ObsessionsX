<?php

function db_connect() 
{
   $host= 'localhost';
   $db = 'bookmarks';
   $manager = 'root';
   $passW = 'Dante777';
   $port = '14147';
   $result = new mysqli($host, $manager , $passW, $db,$port);
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
}

?>
