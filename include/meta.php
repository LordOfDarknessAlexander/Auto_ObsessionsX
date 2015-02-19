<?php   //this php script commands the server to generate meta includes(CSS and JS) of the application
require_once 'html.php';

$paths = array(
    'auto',
    //
    'main',   //'gameMenu',
    'auction',
    'AuctionSell',
    'LoseAuction',
    'garage',
    //'register'
);
foreach($paths as $p){html::incPHPCSS($p);}
html::incCSS('register');
//include meta javascripts
?>
<script type="text/javascript" src="https://www.paypalobjects.com/js/external/dg.js"></script>
<?php
$paths = array(
	'jquery.2.1.1.min',
	'payRequest',
	'Vector',
	'GameMode',
	'Users',
	'requestAnimationFrame'
);
foreach($paths as $p){html::incJS($p);}
?>