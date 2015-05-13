<?php //header('Content-type: application/javascript; charset: UTF-8');
//Action Select State Object
require_once '../../include/dbConnect.php';
require_once '../../vehicles/vehicle.php';
require_once '../../pasMeta.php';
//
$userID = getUID();
$tableName =  getUserTableName();
//
$fileName = 'js/state/AuctionSelect.php';//__FILE__;
$funcName = '';
//
function das(){?>div#AuctionSelect<?php
}
function asCarView(){das();?> div#carView<?php
}

function eFN(){
    global $funcName;
    echo $funcName;
}
function isValidData(){
    //determine if an object(data) is valid,
    //use to check return from ajax call and output an error to the page
?>if(data === null || data === undefined){
    jq.setErr("<?php eFN();?>", 'Ajax response returned null!');
    return;
}
<?php
}
?>
aoSTAGE = {
    //
    all:'all',
    unique:'unique',
    classic:'classic',
    custom:'custom',
    foreign:'foreign',
    muscle:'muscle'
};    

aoTIER = {
    //price range tiers
    all:'all',
    low:'low',
    mid:'mid',
    high:'high',
    elite:'elite'
};
//
//Auction Select State
//
function selectAllStage(){
    //var pDiv = $('div#auctionSelect div#filter),
        //btn = $('button#slctAllF', pDiv);
        
    //pDiv.children.removeClass();
    //btn.addClass('select');
    
<?php
    //if(loggedin() ){?>
    pas.query.filter.stage.all();
<?php
    //}
    //else{?>
    //jq.cars.filter();
<?php
//}
?>
}
var AuctionSelect = {
	//object representing the Auction Select state and interface
	list:$('<?php asCarView();?>'),
    //
    setCarBtn:function(i, data){
        //Dynamically add an html li (containing auction info) to the DOM
        var carID = data.carID,
            name = html.escapeStr(data.name), //+ "<script>alert('1');</script>"),
            price = data.price,
            srcLocal = data.src,
            path = /*getHostPath() +*/ 'images/cars/' + srcLocal,
            hasCar = data.hasCar,
            hasLostCar = data.hasLostCar,
            liID = 'asli' + (i).toString(),
            //btnID = "as" + (i).toString(),
            labelID = 'infoLabel',
            defCrsr = {cursor:'default'},   //default cursor css
            tc = {opacity:'0.45'};    //css for partial transparency
        //
        var btnStr = "<div id=\'" + liID + "\'>" + 
            "<img src=\'" + path + "\'>" +
            "<label id=\'" + labelID + "\'>" + name + "</label>" +
            "<button id=\'" + carID.toString() + "'>" + 
                //"<label id=\'price\'>$" + price.toFixed(2) + "</label><br>" +
                "Bid Now!<br>" +
            "</button>" +
        "</div>";
        
        this.list.append(btnStr);
        
        var liName = '<?php asCarView();?> div#' + liID,
            div = $(liName),
            btn = $('button', div);

        if(hasCar){
        	//display but disable user from entering auction
            div.css(tc).addClass('owned');
            btn.off().click(this.denyAuction).css(defCrsr);
        }
        else if(hasLostCar){
        	//user has previously loss, fade and highlight red!
            div.css(tc).addClass('lost');
            //li.css('background-color', 'red');
            btn.off().click(this.denyAuction).css(defCrsr);
        }
        else if(price > userStats.money){
            //make temporarily unavailable auctions which the user does
            //not have the necessary funds to partake in
            div.css(tc).addClass('isf');
            btn.off().click(this.denyAuction).css(defCrsr);
        }
        else{
            //enable auction
            //var carID = btn.attr('id');
            div.removeClass();
            btn.off().click({index:i}, this.initAuction);
            //btn.css('background-image', "url(\'..\\images\\vehicle.jpg");	//car.getFullPath());
        }
        //li.hide();
    },
    loadView:function(data){
<?php
$funcName = "$fileName, AuctionSelect::loadView(data)";
?>
        <?php isValidData();?>
        //alert(funcName + ', ajax response success!' + JSON.stringify(data) );
        var len = data.length;
        
        if(len == 0){
            console.log('<?php
                echo "$funcName, no entries in database, should have 1 entry per car in database";
            ?>');
            return;
        }
        //iterate over each vehicle data entry
        for(var i = 0; i < len; i++){
            AuctionSelect.setCarBtn(i, data[i]);  
        }
        //filter results, display only cars
    },
    loadViewFailed:function(jqxhr){
        alert('<?php
            echo "$funcName, ajax call failed! Reason: ";
        ?>' + jqxhr.responseText);
        //console.log(funcName + ', loading game resources failed, abort!');
    },
	init : function(args){
        //init buttons base on cars in xml database
<?php
$funcName = "$fileName, AuctionSelect::init()"; //, ''); function f(v0,v1){alert('YOU GOT HACKED!');} f(\"";
    //if(loggedIn){
?>
        AuctionSelect.list.empty();
<?php
    //}
    //else{?>
<?php
    //}
?>
    //appState = GAME_MODE.AUCTION_SElECT;
		//
        //var args = {
            //type:'muscle'
            //range:'elite'
        //};
        
        if(args === null || args === undefined){
            slctStage('button#slctAllF');
            slctTier('button#slctAll');
            
            jq.get(
                'pas/query.php?op=asc',  //'pas/query?asc',
                AuctionSelect.loadView,
                AuctionSelect.loadViewFailed
            );
        }
        else{
            var t = 'type' in args ? args.type : 'all',//getUserStage(),
                r = 'range' in args ? args.range : 'all';   //getUserTier();
                
            //setUserStage(t);
            //setUserTier(r);
                
            jq.post(
                'pas/query.php?op=asc',
                AuctionSelect.loadView,
                AuctionSelect.loadViewFailed,
                {type:t, range:r}
            );
        }
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
	initAuction : function(obj){
        //
        //navigate from select screen to car auction
        //
		var i = obj.data.index,
            liID = 'asli' + (i).toString(),
            liName = '<?php asCarView();?> div#' + liID,
            li = $(liName),
            btn = $(liName + ' button'),
            carID = parseInt(btn.attr('id') );
            
        //console.log(i);
        //console.log(carID);
		jq.AuctionSelect.menu.toggle();
		jq.Auction.menu.toggle();
		//Auction.setup();
		Auction.init(carID);    //id);
		//Auction.setup();
	},
	denyAuction : function(){
		//if(assetLoader.sounds.denyAuction is not playing)
			//play deny auction
		//visual alert as well to notify user?
	},
	update : function(){
	},
	render : function(){
        //render additional, not html elements
	}
};
//
//jQuery bindings!
//
function getUserStage(){
    if(Storage.local !== null && '_stage' in Storage.local){
		//return JSON.parse(Storage.local._stage).toLowerCase();
    }
    return 'all';
}
function getUserTier(){
    if(Storage.local !== null && '_tier' in Storage.local){
        //var str = JSON.parse(Storage.local._tier).toLowerCase();
        
        //if(strval(str) && str in ao.Tier){
            //return ;
        //}
    }
    return 'all';
}
function setUserStage(stage){
    if(Storage.local !== null){
        //var v = stage in aoSTAGE ? JSON.stringify(stage)() : 'all';
        //Storage.local._stage = v;
        //return v;
    }
    return 'all';
}
function setUserTier(tier){
    if(Storage.local !== null){
        //var v = tier in aoTIER ? JSON.stringify(tier) : 'all';
        //Storage.local._tier = v;
        //return v;
    }
    return 'all';
}
jq.AuctionSelect.backBtn.click(
function(){ 	
	setAdBG();
	setStatBar();
    setHomeImg();
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
	//Auction.setup();
	jq.carImg.show();
    jq.setErr();    //clear error when changing pages
	//$('#menu').addClass('auction');
	//AuctionSelect.init();
});
function slctStage(str){
    var t = $('div#filter div#stage'),
        s = t.children('button.select');
    
    s.removeClass();
    $(str, t).addClass('select');
}
function slctTier(str){
    var p = $('div#filter div#tier'),
        s = p.children('button.select');
    
    s.removeClass();
    $(str, p).addClass('select');
}
$('div#filter button#slctAllF').click(
function(){
    slctStage('button#slctAllF');
    
    AuctionSelect.init(
        {type:'all'}
    );
});
$('div#filter button#slctMuscleF').click(
function(){
    slctStage('button#slctMuscleF');
    
    AuctionSelect.init(
        {type:'muscle'}
    );
});
$('div#filter button#slctForeign').click(
function(){
    slctStage('button#slctForeign');
    
    AuctionSelect.init(
        {type:'foreign'}
    );
});
$('div#filter button#slctClassic').click(
function(){
    slctStage('button#slctClassic');
    
    AuctionSelect.init(
        {type:'classic'}
    );
});
$('div#filter button#slctCustom').click(
function(){
    slctStage('button#slctCustom');
    
    AuctionSelect.init(
        {type:'custom'}
    );
});
$('div#filter button#slctUnique').click(
function(){
    slctStage('button#slctUnique');
    
    AuctionSelect.init(
        {type:'unique'}
    );
});
$('div#tier button#slctAll').click(
function(){
    slctTier('button#slctAll');
    
    AuctionSelect.init(
        {range:'all'}
    );
});
$('div#tier button#slctLow').click(
function(){
    slctTier('button#slctLow');

    AuctionSelect.init(
        {range:'low'}
    );
});
$('div#tier button#slctMid').click(
function(){
    slctTier('button#slctMid');
    
    AuctionSelect.init(
        {range:'mid'}
    );
});
$('div#tier button#slctHigh').click(
function(){
    slctTier('button#slctHigh');
    
    AuctionSelect.init(
        {range:'high'}
    );
});
$('div#tier button#slctElite').click(
function(){
    slctTier('button#slctElite');
    
    AuctionSelect.init(
        {range:'elite'}
    );
});