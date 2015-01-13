<?php function incCSS($str){
    //the html within this function will be injected at the call site
?>
<link rel='stylesheet' href='<?php echo "css/".$str.".css";?>' type='text/css' media='screen'>
<?php
}
function incPHPCSS($str){?>
    <link rel='stylesheet' href='<?php echo "css/".$str.".php";?>' type='text/css' media='screen'>
<?php
}
//incPHPCSS('auto');
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
//incPHPCSS('main');
//incPHPCSS('auction');
//incPHPCSS('LoseAuction');
//incPHPCSS('repair');
?>