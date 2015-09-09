<?php
function addJS($str){?>
<script type='text/javascript' src='<?php echo "js/$str.js";?>'></script>
<?php
}
function addPHPJS($str){?>
<script type='text/javascript' src='<?php echo "js/$str.php";?>'></script>
<?php
}
$paths = array(
    //'globals',
    'LoadAssets',
    //jquery bindings
    'jqueryLib',
    //'pas',
    //
    //'2D/meta',
    '2D/SpriteSheet',
    '2D/Animation',
    '2D/Sprite',
    //game entities
    //'entities/meta',
    'entities/player',
    'entities/enemy',
	
    //'entities/part',
    'entities/parts/part',
    'entities/parts/drivetrain',
    'entities/parts/body',
    'entities/parts/interior',
    'entities/parts/docs',
    'entities/vehicle',
    //game states
    //'state/meta'
    'state/Garage',
    //'state/Garage/main',
    //'state/Garage/carView',
    //Auction and Repair states is dependant upon userGarage in Garage.js
    //to push cars or modify cars in the users garage, so parse first
    //'state/Repair',
    //'state/Auction/main',
    //'state/Auction/select',
    //'state/Auction/sell',
    'state/auctionGen',
    'state/Auction',
    //'state/AuctionSelect',
    'state/AuctionSell',
    //'state/Add_Funds',
	'allowance',
	'slots/miniSlots',
	
    //
    'program'	//main javascript program
	
);
addPHPJS('globals');
addPHPJS('pas');
//addPHPJS('jqLib');
foreach($paths as $p){addJS($p);}
addPHPJS('state/state');
?>