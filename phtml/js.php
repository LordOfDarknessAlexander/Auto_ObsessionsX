<?php function addJS($str){
?>
<script type='text/javascript' src='<?php echo "js/".$str.".js";?>'></script>
<?php
}
$paths = array(
    'globals',
    'LoadAssets',
    '2D/SpriteSheet',
    '2D/Animation',
    '2D/Sprite',
    //game entities
    'Player',
    'Enemy',
    'vehicle',
    //jquery bindings
    'jqueryLib',
    //game states
    'state/Garage',
    //Auction and Repair states is dependant upon userGarage in Garage.js
    //to push cars or modify cars in the users garage, so parse first
    'state/Repair',
    'state/Auction',
    'state/AuctionSelect',
    'state/Add_Funds',
    //
    'program'	//main javascript program
);
foreach($paths as $p){addJS($p);}
?>