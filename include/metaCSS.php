<?php function incCSS($str){
    //the html within this function will be injected at the call site
?>
<link rel='stylesheet' href='<?php echo "css/".$str.".css";?>' type='text/css' media='screen'>
<?php
}

$paths = array(
    'auto',
    //
    'gameMenu',
    'auction',
    'LoseAuction',
    //
    'carView',
    'register'
);
foreach($paths as $p){incCSS($p);}
?>