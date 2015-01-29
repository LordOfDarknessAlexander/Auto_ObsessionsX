//Action Select State Object
<?php header('Content-type: application/javascript; charset: UTF-8');
require_once '../../include/dbConnect.php';
require_once '../../vehicles/vehicle.php';
?>
var AuctionSelect =
{	//object representing
	list : $('div#AuctionSelect div#carView ul#auctionCars'),
    setCarBtn:function(carName, i){
        var btnID = "as" + (i).toString(),
            liID = "asli" + (i).toString(),
            labelID = 'infoLabel';
        //<php if(guest){}
            /*var btnStr = "<li id=\'" + liID + "\'>" + 
                "<img src=\'" + car.getFullPath() + "\'>" +
                "<label id=\'" + labelID + "\'>" + car.getFullName() + "-<br>" + car.getInfo() + "</label>" +
                "<button id=\'" + btnID + "\'>" + 
                    "<label id=\'price\'>$" + (car.getPrice() ).toString() + "</label><br>" +
                    "Bid Now!<br>" +
                    //"<label id=\'expireTime\'>Auction expire time!</label>" +
                "</button>" +
            "</li><br>";
            this.list.append(btnStr);*/
        //}?>
        var btn = $('#' + btnID);

        var hasCar = false;
        for(var j = 0; j < userGarage.length; j++)
        {
            var gc = userGarage[j];

            if(carName/*id*/ == gc.getFullName()/*id*/){
                hasCar = true;
                break;
            }
        }

        if(hasCar)
        {	//display but disable user from entering auction
            var li = $('#' + liID);
            li.css('opacity', '0.45');
            btn.off().click(this.denyAuction);
        }
        else
        {
            btn.off().click({index:i}, this.initAuction);
            //btn.css('background-image', "url(\'..\\images\\vehicle.jpg");	//car.getFullPath());
        }
    },
	init : function()
	{	//init buttons base on cars in xml database
		//appState = GAME_MODE.AUCTION_SElECT;
        //if(guest)
            //this.list.empty();
		//
<?php
function setCarBtn($args){
    $i = $args[0];
    $car = Vehicle::fromArray($args[1]);	//ao.xdbCars[i];
?>
    this.setCarBtn('<?php echo $car->getFullName();?>', <?php echo strval($i);?>);
<?php
}

$res = $AO_DB->query('SELECT * FROM aoCars');

if($res){
    $i = 0;
    while($row = mysqli_fetch_array($res) ){
        call_user_func('setCarBtn', array($i, $row) );
        $i++;
    }
    mysqli_free_result($res);
}
else{
    //echo "alert('failed to add entry, error: ' . mysqli_error($AO_DB->con)";
    //?><br><?php
}
    //if(loggedIn){
        //auction cars never change, so load only once to
        //save on calls to server and bandwidth
        //if(auctionCars not loaded){
            //
        //}
    //}
    //else{>
        //playing locally as guest, call JS
    //<php
    //}>
?>
		//for(var i = 0; i < /*ao.*/xdbCars.length; i++)
		//{
			
		//}
	},
	initAuction : function(obj)
	{
		var i = obj.data.index;
        console.log(i);
		jq.AuctionSelect.menu.toggle();
		jq.Auction.menu.toggle();
		//Auction.setup();
		Auction.init(i);
		//Auction.setup();
	},
	denyAuction : function()
	{
		//if(assetLoader.sounds.denyAuction is not playing)
			//play deny auction
		//visual alert as well to notify user?
	},
	update : function()
	{
	},
	render : function()
	{	//render additional, not html elements
	}
};