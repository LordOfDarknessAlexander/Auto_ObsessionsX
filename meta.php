<?php
//this php script commands the server to generate
//meta includes(CSS and JS) of the application
require_once 'html.php';
//css to be included in the <head> element of the html document
$css = array(
    'auto',
    //
    'main',   //'gameMenu',
    //'auction',
    'AuctionSell',
    'LoseAuction'
    //'SaleView'
);
foreach($css as $p){
    html::incPHPCSS($p);
}
//include meta javascripts
?>
<script type="text/javascript" src="https://www.paypalobjects.com/js/external/dg.js"></script>
<?php
//global javascripts, to be included in the <head> element of the html document
$js = array(
	'jquery.2.1.1.min',
	'payRequest',
	'Vector',
	'GameMode',
	//'Users',
	'requestAnimationFrame'
);
foreach($js as $p){
    html::incJS($p);
}
?>