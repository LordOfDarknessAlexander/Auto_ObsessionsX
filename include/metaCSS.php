<?php
function incCSS($str){
    echo "<link rel='stylesheet' href='css/".$str.".css' type='text/css' media='screen'>";
}
$paths = array(
    "auto",
    //
    "gameMenu",
    "auction",
    "LoseAuction",
    //
    "carView",
    "register"
);
foreach($paths as $p){incCSS($p);}
?>
<!--link rel='stylesheet' href='css/auto.css' type="text/css" media="screen">

<link rel='stylesheet' href='css/gameMenu.css' type="text/css" media="screen">

<link rel='stylesheet' href='css/auction.css' type="text/css" media="screen">
<link rel='stylesheet' href='css/LoseAuction.css' type="text/css" media="screen">

<link rel='stylesheet' href='css/carView.css' type="text/css" media="screen">
<link rel='stylesheet' href='css/register.css' type="text/css" media="screen"-->