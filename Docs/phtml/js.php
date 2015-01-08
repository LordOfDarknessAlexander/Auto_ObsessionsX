<!--is parsed first, order matters!-->
<script type="text/javascript" src="js/globals.js"></script>
<script type="text/javascript" src="js/LoadAssets.js"></script> 
<!--2D sprite/animation classes-->
<script type="text/javascript" src="js/2D/SpriteSheet.js"></script>
<script type="text/javascript" src="js/2D/Animation.js"></script>
<script type="text/javascript" src="js/2D/Sprite.js"></script>
<!--game entities-->
<script type="text/javascript" src="js/Player.js"></script> 
<script type="text/javascript" src="js/Enemy.js"></script>
<script type="text/javascript" src="js/vehicle.js"></script>
<!--script type="text/javascript" src="js/entity/parts.js"></script-->
<!--jquery bindings-->
<script type="text/javascript" src="js/jqueryLib.js"></script>
<!--game states, doesn't work if placed in subfolder-->
<script type="text/javascript" src="js/state/Garage.js"></script>
<!--Auction and Repair states is dependant upon userGarage in Garage.js
	to push cars or modify cars in the users garage, so parse first-->
<script type="text/javascript" src="js/state/Repair.js"></script>
<script type="text/javascript" src="js/state/Auction.js"></script>
<script type="text/javascript" src="js/state/AuctionSelect.js"></script>
<script type="text/javascript" src="js/state/Add_Funds.js"></script>
<!--<hp
for(dir in ROOT_DIR."/js/2D/"){add file at path}
for(dir in ROOT_DIR."/js/objects/"){add files}
for(dir in ROOT_DIR."/js/state/"){add files}
?-->
<!--program main-->
<script type="text/javascript" src="js/program.js"></script>