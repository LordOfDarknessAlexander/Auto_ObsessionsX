<?php   //this php script commands the server to generate meta includes(CSS and JS) of the application
function incCSS($str){
    //the html within this function will be injected at the call site
?>
<link rel='stylesheet' href='<?php echo "css/".$str.".css";?>' type='text/css' media='screen'>
<?php
}
function incPHPCSS($str){?>
    <link rel='stylesheet' href='<?php echo "css/".$str.".php";?>' type='text/css' media='screen'>
<?php
}
$paths = array(
    'auto',
    //
    'main',   //'gameMenu',
    'auction',
    'LoseAuction',
    //
    'carView',
    //'register'
);
foreach($paths as $p){incPHPCSS($p);}
incCSS('register');
//include meta javascripts
?>
<script type="text/javascript" src="https://www.paypalobjects.com/js/external/dg.js"></script>
<?php function incJS($str){
    //this script generates the <script> tags to be included in the <head> of the page's html document
?>
    <script type='text/javascript' src='<?php echo "js/".$str.".js";?>'></script>
<?php
}

$paths = array(
	'jquery.2.1.1.min',
	'payRequest',
	'Vector',
	'GameMode',
	'Users',
	'requestAnimationFrame'
);
foreach($paths as $p){incJS($p);}
?>