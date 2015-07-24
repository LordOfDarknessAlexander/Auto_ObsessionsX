//Application main
var AutoObessesions = {};
var engnRv = true;
var Allowance = {
    CAP:( (1000 * 60) * 60) * 24,  //86400000,  //3000,
    //INV_CAP:1.0 / CAP,    //inverse cap, multiply by this instead of dividing by CAP!
    getDelta:function(){
        //get diffrence between last time and now        
        return Date.now() - Allowance.getLastTime();
    },
    getLastTime:function(){
        //the last time the user collected their allowance
        if(Storage.local !== null){
            if('_lastAllowanceTime' in Storage.local){
                return parseInt(Storage.local._lastAllowanceTime);
                //userStats.money = 225000;
            }
        }
        return 0;
    },
    setLastTime:function(){
        if(Storage.local !== null){
            var time = Date.now()	//a time of 0
            Storage.local._lastAllowanceTime = JSON.stringify(time);
        }
    },
    getRefreshMS:function(){
        //return time left until button can be clicked
        return Allowance.CAP - Allowance.getDelta();
    },
    getRefreshPerc:function(){
        return Allowance.getDelta() / Allowance.CAP;
    }
};

function garageDoor(){
	backgroundY -= speed;
    
	if(backgroundY == -1 * height){
		backgroundY = -1000;
	}
}
function init(){
	//console.log('Program.init called');
	aoTimer.update();
	var now = getTimestamp(), //in milliseconds
		dt = aoTimer.getDT();
		//console.log('init, dt ' + dt.toString());
		
	AuctionSell.update(dt);	
	switchStates();
	
	if(!stop){
		frameID = requestAnimFrame(init);	
		//update(0.33);assetLoader.sounds.engine.play();
		
		// if( (timer >= 300.00) && (timer <= 900.00)){
			// appState = GAME_MODE.MAIN_MENU;
			// mainMenu();  
		// }  
		//timer++;
		//ticker++;
	}
    
	if (audioEnabled() && engnRv == true) {
	    assetLoader.sounds.engine.play();
	    engnRv = false;
	}
}
function update(dTime){
    //main update loog for game
    //console.log(dTime.toString());
	// if(auctionOver){
		//restarted = true;
	//}
    //update active user's auctions
	
	//timer++;
}
Auction.initialSetup = function(){
	//called as initial update
	//to bypass the delay due to ajax calls when auction is initialized
	//console.log('initial setup called');
	console.log('Auction.initialSetup called');
	aoTimer.update();
		
	context.clearRect(0, 0, canvas.width, canvas.height);
	cancelAnimFrame();
	frameID = requestAnimFrame(Auction.setup);	
}
Auction.setup = function(){
	//this is called every frame
	aoTimer.update();
    var dt = aoTimer.getDT();
	//console.log(dt.toString());
		
	context.clearRect(0, 0, canvas.width, canvas.height);
	
	if(!auctionStop){
		Auction.update(dt);
		frameID = requestAnimFrame(Auction.setup);	//recursive call, bad
		//appState = GAME_MODE.AUCTION;
	}
}
function auctionMode(dt){
    //in-Auction update, core of game logic
    //ticker = 0;
    stop = true;

    //$('#money').html(money);
    Auction.setup();//auctionInit();  
}
function load(){
//<php if(loggedIn() ){>
    var funcName = 'js/program.js load()';
    
    jq.post('pas/query.php',
        function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                jq.setErr(funcName, 'Error:ajax response returned null! Could not load user data');
                return;
            }
            //alert('ajax response recieved:' + JSON.stringify(data) );
            //
            //set user data
            //
            var s = data.stats;
            
            //userStats = {
                //money:s.money,
                //tokens:s.tokens,
                //prestige:s.prestige,
                //marker:s.m_marker
            //};
            _curCarID = s.car_id;
            //console.log('cur car id:' + _curCarID.toString() );
            setStatBar(s);
            //
            //set user garage
            //
            var len = data.garage.length;
            
            if(len == 0){
                //exit early is user has no cars
                jq.setErr(funcName, 'user has no cars! Vist the store to purchase some!');
                return;
            }
            var args = [];
            
            for(var i = 0; i < len; i++){
                var obj = data.garage[i];
                args.push(VehicleFromDB(obj) ); //adds ajax request object to array
            }
            
            $.when.apply($, args).done(function(){
                //the UI is dependant on the users garage being loaded,
                //so init ui after all ajax calls have completed
                Garage.initUI();
                AuctionSell.load();//data.sales);
                setHomeImg();
            }).fail(function(){
                //console.log(f
                jq.setErr(funcName, 'loading game resources failed, abort!');
            });
        },
        function(jqxhr){
            //call will fail if result is not properly formated JSON!
            //alert(
            jq.setErr(funcName, 'ajax call failed! Reason: ' + jqxhr.responseText);
            //console.log(funcName + ', loading game resources failed, abort!');
        }
    );
//<?php
//}
//else{
    //use local storage!
//}
//?>
}
//app may only exist in one state at a time
function switchStates(){
    //call various update based on appState
	var dt = 16.0;
	switch (appState){
		// case GAME_MODE.SPLASH:
			// splash();
			// garageDoor();
		// break;
		
		case GAME_MODE.MAIN_MENU:
			//mainMenu();
			//console.log('main menu switch');
		break;  
		case GAME_MODE.SALE_VIEW:
			SaleView.update(dt);
		break;
		//do not need auction select
		// case GAME_MODE.AUCTION:
			// Auction.update(dt);
			// setStatBar();
			// console.log('auction switch');
		// break;

		// case GAME_MODE.REPAIR:
			// Repair.update();
			// setStatBar();
		// break;
		
		// case GAME_MODE.ADD_FUNDS:
			// Store.update();
		// break;
		
		// case GAME_MODE.SLOTS:
			// //Slots.update();
			// callSlots();
			// setStatBar();
		// break;
			
		default:
			GAME_MODE.RUNNING; 
			
		// etc...
	}
}
//$(function()	//shorthand for $(document).ready(
//executed after the html document is processed
$(document).ready(
function(){
	//Declare functions and objects dependant on the html
	//document being loaded within this callback,
	//such as jQuery/ui callback bindings,
	//loading assets and 'core' game logic
	//Storage.local.clear();
	//alert('doc ready!');
	//pas.query.loadUser();   //load user stats!
	Allowance.getLastTime();
	//setStatBar();
    load();
	//loadUser();
    //Garage.load();  //load user garage!
    //AuctionSell.load(); //load user sales, after garage!

    //jq.Game.setHomeImg();
    setHomeImg();   //in Garage.js
    setAdBG();
    jq.adBar.hide();
    jq.nav.hide();
	appState = GAME_MODE.MAIN_MENU;
	mainMenu();  
	//jq.setErr('Welcome home, ' + user.name);
	
	
//Load the splash screen first
assetLoader.finished = function(){
    //executed when assetLoader finalizes resource creation
	$('#splash').removeClass('#Slots');
  	$('#Slots').hide();
  	switchStates();  
}

function splash(){
    //Show the splash after loading all assets 
    //init();
    garageDoor();
    $('#progress').hide();
    $('#splash').show();
	$('#splash').removeClass('#Slots');
	 $('#Slots').hide();
	 $('.sound').show();
}

//Main Menu  
function mainMenu() 
{
    assetLoader.toggleAudioMuted();
//   for(var sound in assetLoader.sounds){
//        if(assetLoader.sounds.hasOwnProperty(sound)){
//            assetLoader.sounds[sound].muted = !audioEnabled();
//        }
//    }
    //delete splash;

    $('#progress').hide();
    $('#splash').hide();
    $('#Slots').hide();
    $('#menu').removeClass('#Slots');
    $('#main').show();
    $('#menu').addClass('main');
    $('.sound').show();
    //jq.adBar.show();
}

function callSlots(){
    //change to slots
	stop = true;
	auctionStop = true;
	context.clearRect(0, 0, canvas.width, canvas.height);
	$('#Slots').show();

	appState = GAME_MODE.SLOTS;
	if(appState == GAME_MODE.SLOTS)
	{
		console.log("Register THis Slot Action");
	
	}
}

//money = 50000;
function startGame(){
	//initialize the game state
	context.clearRect(0, 0, canvas.width, canvas.height);
	//document.getElementById('gameMenu').style.display = 'true';  
	//$('#money').html(money);
    jq.adBar.show();
    jq.nav.show();
   
    jq.setErr();
    
	appState = GAME_MODE.RUNNING;
	player.reset();
	//ticker = 0;
	stop = false;
	auctionStop = true;
	//restarted = false;
	playerBid = 0;
	context.font = '26px arial, sans-serif';
	// Create gradient
	var gradient=context.createLinearGradient(36,40,600,1);
	gradient.addColorStop("0.7","green");
	gradient.addColorStop("0.5","blue");
	gradient.addColorStop("1.0","green");
	// Fill with gradient
	context.fillStyle = gradient;
	//temp
	//userStats.money += 0;
	setStatBar();
	switchStates();
	
	if (audioEnabled()) {
	    console.log('audio enabled--Start Game');
        var s = assetLoader.sounds;
        s.gameOver.pause();
        s.bg.currentTime = 0;
        s.bg.loop = true;
        s.bg.play();
        //s.engine.play();
    }    
}
Auction.BackOutofAuction = function(){
	//stops deltatime timer
	stop = true;
	// // auctionStop = true;
	// // goingTimer = 0;
	// startEndBids = [false,false,false,false];
	// endBidTimers = [0,0,0,0];
	// auctionEnded = true;
	// auctionOver = true;
	// endGame = true;
}
Auction.sold = function(){
    //end of auction, car goes to highest bidder
    var ae = audioEnabled();
	stop = true;
	auctionStop = true;
	//goingTimer = 0;
	//startEndBids = [false,false,false,false];
	//endBidTimers = [0,0,0,0];
	
	jq.Auction.menu.hide();
	//jq.Auction.menu.children().hide();
	
	jq.Sold.menu.show();
    
    if(ae){
	    //console.log('audio enabled--Auction.sold');
        var s = assetLoader.sounds;
        s.bg.pause();
        s.gameOver.currentTime = 0;
        s.gameOver.play();
        s.bidder.pause();
    }
    
	//auctionEnded = true;
	//auctionOver = true;
	endGame = true;
	Auction._ended = true;
	
	//disable user from entering an auction for this car again
	//in case of unintended bugs, make sure user doesn't already own car
    if(Auction._car !== null){
        var n = Auction._car.getFullName(),
            sl = $('div#sold label');
        
        if(Auction.playerWon){
            //not the right object!?
            jq.Sold.menu.show();

            if (ae) {
                s.sold.play();
            }
           
            
//<php if(loggedIn() ){>
			//Auction._car.repairs == Auction.vcondition;
            pas.insertCar(Auction);
//<php
//}
//else{?>
            //var hasCar = false;
            
            //for(var i = 0; i < userGarage.length; i++){
                //if(Auction._car.name/*id*/ == userGarage[i].name/*id*/)
                //{
                    //hasCar = true;
                    //break;
                //}
            //}
            //if(!hasCar){
                //sl.html('Congratulations!<br>You won the auction for the ' + n + '<br>Go to the garage to view your prize!');
                //userGarage.push(Auction._car);	//creates a copy of car, giving it to user
                //Auction._car = null;	//no more car to sell
            //}
            //Garage.save();
//<php
//}?>
            setStatBar();
			
			if (audioEnabled()) {
				console.log('audio enabled--Start Game');
				var s = assetLoader.sounds;
				s.sold.pause();
				s.bg.currentTime = 0;
				s.bg.loop = true;
				s.bg.play();
				//s.engine.play();
			}
        }
        else{
            //jq.Sold.menu.show();
            //setHomeImg();
            sl.html('Unfortunately,<br> you lost the auction for the ' + n + '<br>Better luck next time!');

            if (ae) {
                //failure noise
            }

//<php if(loggedIn){>
            pas.insertLoss(Auction._car.id);
//<php
//}
//else{?>
            //playing as guest, use local storage
//<?php
//}?>
        }
    }
    //else auction has no car, should not happen!
	//Auction.close();
	//init();
}
//
//jQuery UI bindings
//
$('.play').click(
function(){
    $('#menu').hide();
    jq.Game.menu.show();
	$('#gameMenu').removeClass('#Slots');
	$('#Slots').hide();
    //can no longer navigate to credits or the root menus anymore
    // delete credits;
    // delete mainMenu;
    //delete menu image, since the game can not navigate back to this screen after clicking
    startGame();
});
//Slots
$('.playSlots').click(
function(){
    jq.Game.menu.hide();
	$('#Slots').show();
    //delete menu image, since the game can not navigate back to this screen after clicking
	callSlots();
});
//
//Main Menu button bindings
//
jq.Game.toGarageBtn.click(
function(){
    jq.adBar.hide();
	jq.Garage.toggle();
    jq.carImg.hide();
	Garage.init();
    jq.setErr();    //clear error when changing pages
});
jq.Game.toAuctionBtn.click(
function(){
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
    jq.carImg.hide();
	AuctionSelect.init();
    jq.adBar.hide();
    jq.setErr();    //clear error when changing pages
});
//
//Main, right menu
//
jq.Game.toProfileBtn.click(Profile.init);
jq.Game.repairBtn.click(
function(){
    //rebind back button to return us to main menu
    jq.RepairShop.backBtn.off().click(
        function(){
            jq.RepairShop.menu.hide();
            setStatBar();
            setAdBG();
            jq.Game.menu.show();
            jq.carImg.show();
            jq.setErr();
        }
    );
	//toggleRepair();
	//$('#gameMenu')
	jq.Game.menu.hide();
	Repair.init();
    jq.carImg.show();
    //$('label#info').text('');
    setAdBG();
    jq.setErr();    //clear error when changing pages
	//saveUser();	//save user stats after purchasing
});

function initGuest()
{	//loads guest profile, if one does not exist it is created
	if('guest' in Storage.local){
		//returns an object of format {money:number, garage:[]}
		player = JSON.parse(Storage.local.guest);
	//	ajax_post();
	}
	else{
		//create new guest account, to be stored in browser
		Storage.local.guest = JSON.stringify({money:50000, garage:[]});
	}
}
//restart GameOver /sold button
jq.Sold.garageBtn.click(
function(){
    jq.Sold.menu.hide();
	jq.Garage.menu.show();
    Garage.init();
    jq.carImg.hide();
    jq.setErr();    //clear error when changing pages
    //appState = GAME_MODE.GARAGE:
});
jq.Sold.homeBtn.click(
function(){
	jq.Sold.menu.hide();
	jq.Game.menu.show();
    setHomeImg();
    jq.carImg.show();
	
	//auctionEnded = false;
	endGame = false;
	//restarted = true;	
    setAdBG();
    jq.setErr();    //clear error when changing pages
    
    appState = GAME_MODE.MAIN_MENU;
});
//Sound Button
jq.sound.click(
function(){
    //references the jq object calling .click, not the function!
    var $this = $(this),
        ae = audioEnabled(),
        on = 'sound-on',
        off = 'sound-off';
        
    if(ae){//$this.hasClass('sound-on')){
        //disable audio
        $this.removeClass(on).addClass(off);
        setAudio(false);
        //playSound = false;
    }
    else{
        //enable audio
        $this.removeClass(off).addClass(on);
        setAudio(true);
        //playSound = true;
    }
    assetLoader.toggleAudioMuted();
    //if(canUseLocalStorage){
    //    localStorage.setItem('kandi.playSound', playSound);
    //}
    // mute or unmute all sounds
    //for(var sound in assetLoader.sounds){
        //if(assetLoader.sounds.hasOwnProperty(sound)){
            //assetLoader.sounds[sound].muted = !ae;
        //}
    //}
});

	assetLoader.downloadAll();
	init();
});