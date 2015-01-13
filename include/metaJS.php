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