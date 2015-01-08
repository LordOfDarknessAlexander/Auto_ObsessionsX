<?php
//PHP directives are processed when the page is requested from the server,
//after processing tje full html page will be dispatched to the users browser
$PAGE_TITLE = "Auto Obsessions";
//$AO_OWNER = "Adam glazer";
$AO_COPYRIGHT = "Auto Obsessions, C 2014, All Rights Reserved";
$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"];	//root path on server
//include code to generate page's html header
require_once("./include/header.php");
//include meta-document html header body here!
//elements declared here will be processed
//as existing within the html <body> element
require_once("main.php");
//end of html document body
require_once("./include/footer.php");
?>