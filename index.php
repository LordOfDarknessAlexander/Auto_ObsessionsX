<?php
//PHP directives are processed when the page is requested from the server,
//after processing tje full html page will be dispatched to the users browser
$PAGE_TITLE = "Auto Obsessions";
//$AO_OWNER = "Adam glazer";
$AO_COPYRIGHT = "Auto Obsessions, C 2014, All Rights Reserved";
$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"];	//root path on server
require_once './include/html.php';
//'session_start();
//login, query user database to determine current car ID

//include code to generate page's html header
//class a{
    //class representing common html Anchor elements used through out docs
    //websites
    //public static function google(){<a href='www.google.ca'>Google</a>}
    //public static function php(){<a href='www.php.php'>PHP</a>}
    //public static function python(){<a href=''>Python</a>}
    //public static function perl(){<a href=''>Perl</a>}
    //public static function javascript(){<a href=''>JavaScript</a>}
    //public static function json(){<a href=''>JSON</a>}
    //public static function css(){<a href=''>CSS</a>}
    //public static function html(){<a href=''>HTML</a>}
    //browsers
    //public static chrome(){<a <a href='www.google.com/chrome/‎'>Google Chrome</a>}
    //public static friefox(){<a href=''>Mozilla Firefox</a>}
    //public static safari(){<a href=''>Safari</a>}
    //public static opera(){<a href=''>Opera</a>}
    //public static explorer(){<a href=''>Internet Explorer</a>}
//};
html::header();
//as existing within the html <body> element
require_once './phtml/main.php';
//end of html document body
html::footer();
?>