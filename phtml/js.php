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
    //
    'entities/parts/part',
    'entities/parts/drivetrain',
    'entities/parts/body',
    'entities/parts/interior',
    'entities/parts/docs',
    'entities/vehicle',
    //game states
    'state/auctionGen',
    'state/Auction',
    'state/AuctionSell',
	'allowance',
	'slots/miniSlots',	
    'program'	//main javascript program
	
	
);
addPHPJS('globals');
addPHPJS('pas');
addPHPJS('2D/meta');
addPHPJS('entities/meta');
//addPHPJS('jqLib');
foreach($paths as $p){
    addJS($p);
}
addPHPJS('state/state');
?>