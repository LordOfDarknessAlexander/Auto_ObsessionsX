<?php header('Content-type: application/javascript; charset: UTF-8');
//Action Select State Object
require_once '../../include/dbConnect.php';
require_once '../../vehicles/vehicle.php';
//require_once '../../pas/pas.php';
//
$userID = 0;
//if(isset($_SESSION['userID']))
    //$userID = $_SESSION['userID'];
//else{
    //exit();   //not logged in as valid user, quit script!
//}
$tableName =  'user' . strval($userID);
//
function hasCar($id){
    global $AO_DB;
    global $aoUsersDB;
    global $tableName;
    
    $carRes = $aoUsersDB->query("SELECT * FROM $tableName WHERE car_id = $id");
    
    if($carRes){
        echo mysqli_num_rows($carRes) != 0 ? 'true' : 'false';
    }
    mysqli_free_result($carRes);
}
?>
var AuctionSelect =
{	//object representing
	list : $('div#AuctionSelect div#carView ul#auctionCars'),
    setCarBtn:function(i, data){
        var carID = data.carID,
            hasCar = data.hasCar,
            hasLostCar = data.hasLostCar,
            liID = "asli" + (i).toString(),
            //btnID = "as" + (i).toString(),
            labelID = 'infoLabel',
            liName = 'div#AuctionSelect div#carView ul#auctionCars li#' + liID,
            li = $(liName),
            btn = $(liName + ' button');
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
        //var btn = $('#' + btnID);
         
        // var hasCar = false;
        
        // for(var j = 0; j < userGarage.length; j++)
        // {
            // var gc = userGarage[j];

            // if(carName/*id*/ == gc.getFullName()/*id*/){
                // hasCar = true;
                // break;
            // }
        // }

        if(hasCar)
        {	//display but disable user from entering auction
            //var li = $('#' + liID);
            li.css('opacity', '0.45');
            btn.off().click(this.denyAuction).css('cursor', 'default');
        }
        else if(hasLostCar)
        {	//user has previously loss, fade and highlight red!
            li.css('opacity', '0.45');
            //li.css('background-color', 'red');
            btn.off().click(this.denyAuction).css('cursor', 'default');
        }
        else{
            //var carID = btn.attr('id');
            btn.off().click({index:i}, this.initAuction);
            //btn.css('background-image', "url(\'..\\images\\vehicle.jpg");	//car.getFullPath());
        }
    },
	init : function()
	{	//init buttons base on cars in xml database
		//appState = GAME_MODE.AUCTION_SElECT;
        //if(loggedIn)
            //this.list.empty();
		//
        var funcName = 'js/state/AuctionSelect.php, AuctionSelect::init()';
        
        /*jq.get('pas/query.php?op=asc',
            function(data){
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
                    return;
                }
                //alert(funcName + ', ajax response success!' + JSON.stringify(data) );
                var len = data.length;
                
                if(len == 0){
                    console.log(funcName + ', something went wrong, should have 1 entry per car in database')
                    return;
                }
                //iterate over each vehicle data entry
                for(var i = 0; i < len; i++){
                    //var carID = data[i].carID,
                        //hasCar = data[i].hasCar;
                        
                    AuctionSelect.setCarBtn(i, data[i]);  
                    //AuctionSelect.setCarBtn(carID, i, hasCar);
                }
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                alert(funcName + 'ajax call failed! Reason: ' + jqxhr.responseText);
                console.log(funcName + ', loading game resources failed, abort!');
            }
        );*/
        $.ajax({
            type:'GET',
            url:getHostPath() + 'pas/query.php?op=asc',
            dataType:'json',
            data:'',    //{carID:obj.carID}
        }).done(function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                alert('Error:ajax response returned null!');
                //finished = true;
                return;
            }
            //alert('AuctionSelect::init(), ajax response success!' + JSON.stringify(data) );
            //do stuff
            var len = data.length;
            
            if(len == 0){
                console.log('AuctionSelect::init(), something went wrong, should have 1 entry per car in database')
                return;
            }
            
            for(var i = 0; i < len; i++){
                //var carID = data[i].carID,
                    //hasCar = data[i].hasCar;
                AuctionSelect.setCarBtn( i, data[i]);
                //AuctionSelect.setCarBtn(carID, i, hasCar);
            }
        }).fail(function(jqxhr){
            //call will fail if result is not properly formated JSON!
            alert('ajax call failed! Reason: ' + jqxhr.responseText);
            console.log('loading game resources failed, abort!');
            //finished = true;
        });
<?php
function setCarBtn($args){
    $id = $args[0];
    $i = $args[2];
    //$car = Vehicle::fromArray($args[1]);	//ao.xdbCars[i];
?>
    //this.setCarBtn(<?php echo strval($id);?>, <?php echo $i;?>, <?php echo hasCar($id);?>);
<?php
}

//$res = $AO_DB->query('SELECT * FROM aoCars');

//if($res){
    //$i = 0;
    //while($row = mysqli_fetch_array($res) ){
        //$id = $row['car_id'];
        //call_user_func('setCarBtn', array($id, $row, $i) );
        //$i++;
    //}
    //mysqli_free_result($res);
//}
//else{
    //no valid enry in database
//}
?>
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

		//for(var i = 0; i < /*ao.*/xdbCars.length; i++)
		//{
			
		//}
	},
	initAuction : function(obj)
	{
		var i = obj.data.index,
            liID = 'asli' + (i).toString(),
            liName = 'div#AuctionSelect div#carView ul#auctionCars li#' + liID,
            li = $(liName),
            btn = $(liName + ' button'),
            carID = parseInt(btn.attr('id') );
            
        console.log(i);
        console.log(carID);
		jq.AuctionSelect.menu.toggle();
		jq.Auction.menu.toggle();
		//Auction.setup();
		Auction.init(carID);    //id);
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
jq.AuctionSelect.backBtn.click(function() 
{ 	
	//setAdBG();
	setStatBar();
    setHomeImg();
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
	//Auction.setup();
	jq.carImg.show();
	//$('#menu').addClass('auction');
	//AuctionSelect.init();
});