//Application main
var AutoObessesions = {};


function garageDoor()
{
	backgroundY -= speed;
	if(backgroundY == -1 * height)
	{
		backgroundY = -1000;
	}
}
function update(deltaTime)
{
    //garageDoor();	//should splash update
    
   // context.drawImage(splashImage, 0, backgroundY);
   if(restarted)
   {
   	 console.log("Chicken Fingers restarting");
   }
   timer++;
   if(userLogged)
   {
   		
   		
   		userHUD();
   		console.log("User Screen");
   }
}
Auction.setup = function()
{
	context.clearRect(0, 0, canvas.width, canvas.height);
	
	if(!auctionStop) 
	{
		window.requestAnimFrame(Auction.setup);	//recursive call, bad
		
		update();
		Auction.update();
		
	}
}
function auctionMode(deltaTime)
{	//in-Auction update, core of game logic
   ticker = 0;
   stop = true;
 
   Auction.setup();//auctionInit();
  
}

function createReader()
{
	if(window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
		  
	if(xmlhttp)
	{
		
	}
	else
	{	//open warning page, error loading data
	  window.open("/pdf/2014Schedule.pdf", "_blank");
	}
	
	return xmlhttp;
}

function openDoc(url, reader)
{	//parse xml document in xml DOM object
	reader.open("GET",url,false);
	reader.send();
	var doc=reader.responseXML;	//access DOM object tree
  
	return doc;
}
//$(function()	//shorthand for $(document).ready(
//executed after the html document is processed
$(document).ready(function()
{	//Declare functions and objects dependant on the html
	//document being loaded within this callback,
	//such as jQuery/ui callback bindings,
	//loading assets and 'core' game logic
	Storage.local.clear();
	function init()
	{
	  if (!stop) 
	  {
	  
	    requestAnimFrame(init);
	  
	  	update();
	  
  		delete Register;
  		
	    if((timer >= 300.00) && (timer <= 900.00))
		{
			appState = GAME_MODE.MAIN_MENU;
		  	mainMenu();
		  
		}  
		timer++;
	    ticker++;
	  }
	
	}

function loadCars(doc){
	//carNodes = doc.getElementsByTagName('Vehicle');
	//carsLength = carNodes.length;
	//for(var i = 0; i < carsLength; i++){
		//var item = carNodes.item(i);
		//item.getAttribute("name"); 
		//create new car
	//}
	//use jquery?
	var list = doc.childNodes;
	var node = list[0];	//acessing nodes work
//	var v = node.item(i);
	//var cn = node.childNodes;
	var atrs = node.attributes;
	//TODO:accessing attribute elements breaks...
	
//	var parts = node.getElementById('upgrades');
//	var name = atrs.getNamedItem('name');
//	var n = node.getAttribute('name');
	//var atrs = node.attributes;
	//var n = node.getAttribute('year');
//	var n = node.getAttribute('make');
	//for(var i = 0; i < list.length; i++){
		//userGarage.append(Vehicle(list[i]) )
//	}
}

function loadXMLDoc(url)
{
	reader = createReader();
	var doc = openDoc(url, reader);
	
	if(typeof doc === 'undefined')
	{
		return false;
	}
	loadCars(doc);
	return true;
}

/*
//LOAD Vehicle XML, this was working, now can't find source file!
var vehiclePath = './vehicles.xml';	//should be the location of file on server

if(loadXMLDoc(vehiclePath) == false)
{	//loading xml resource failed, display warning
	window.open("/pdf/2014Schedule.pdf", "_blank");		//display warning page
}


var vDoc = document.querySelector('link[rel="import"]');	//document Vehicles.html
var vehicles = document.getElementById('Vehicles');
var cn = vehicles.firstChild;
for(var carNode in vehicles.childNodes)
{
	var newCar = Vehicle(car);
	//instantiate js object or retain html node 'car' for read only access
}


function initGarage()
{	//initilize user's garage will available cars,
	//accessed from user.xml, referenced from database vehicle.xml
	//parse user xml
	//get user with ID
	var userNode = getElementById('');
	for(child in userNode)
	{
		var carID = child.getAttributeById('id');
		userGarage.push(VehicleXML.getElementById(carID) );
	}
	return;
}
function addCar(car)
{	//call after user wins auction, adding car to garage and user.xml
	var garage = userNode.getElementById('garage');
	if(node with id exists)
	{
		alert('already own car with id:' + car.id);
	}
	else
	{
		garage.addNode('<ch>' + car.id + '</ch>');
		//commit changes to server
	}
}
*/

//Load the splash screen first
assetLoader.finished = function() 
{
	$('#splash').removeClass('#Register');
  	$('#Register').hide();
  	switchStates();
  
}	

//app may only exist in one state at a time
function switchStates( GAME_MODE) 
{	 //call various update based on appState
	switch (GAME_MODE) 
	{
		case SPLASH:
			splash();
		break;
		
		case MAIN_MENU:
			mainMenu();
		break;  
		//do not need auction select
		case AUCTION:
			Auction.update();
		break;
		        
		case REPAIR:
			Repair.update();
		break;
		
		case ADD_FUNDS:
			Store.update();
		break;
		
		case TUTORIAL:
			//Tutorial.update();
		break;
		
		case NEW_USER:
			Register();
			
		break;
		
		case LOGIN_USER:
			//Login.update();
		break;
			
		default:
			RUNNING; 
		// etc...
	}
}

//Show the splash after loading all assets 
function splash() 
{
  init();
  
  $('#progress').hide();
  $('#splash').show();
  $('.sound').show();  
  assetLoader.sounds.engine.play();
}

function Register()
{
	stop = true;
	auctionStop = true;
	context.clearRect(0, 0, canvas.width, canvas.height);
	$('#Register').show();
	//$('#RegisterForm').show();

	getMyContact();
	appState = GAME_MODE.NEW_USER;
	if(appState == GAME_MODE.NEW_USER)
	{
		console.log("Register THis");
	
	}	

}
function userHUD(userName)
{
	context.fillText( "Welcome" + userText,ENEMY_X + 600 , 270);
}
 
//Main Menu  
function mainMenu() 
{ 
  for (var sound in assetLoader.sounds) 
  {
    if (assetLoader.sounds.hasOwnProperty(sound)) 
    {
      assetLoader.sounds[sound].muted = !playSound;
    }
  }
  delete splash;
  
  $('#progress').hide();
  $('#splash').hide();
  $('#Register').hide();
  $('#menu').removeClass('#Register');
  $('#main').show();
  $('#menu').addClass('main');
  $('.sound').show();
}

money = 50000;
// Start the game - reset all variables and entities, spawn ground and water.
function startGame() 
{
	context.clearRect(0, 0, canvas.width, canvas.height);
	//$('#game-over').style.display = 'none';
	document.getElementById('game-over').style.display = 'none';
	document.getElementById('gameMenu').style.display = 'true';  
	$('#money').html(money);
	appState = GAME_MODE.RUNNING;
	player.reset();
	ticker = 0;
	stop = false;
	auctionStop = true;
	
	playerBid = 0;
	
	context.font = '26px arial, sans-serif';
	// Create gradient
	var gradient=context.createLinearGradient(36,40,600,1);
	gradient.addColorStop("0","magenta");
	gradient.addColorStop("0.5","blue");
	gradient.addColorStop("1.0","green");
	// Fill with gradient
	context.fillStyle = gradient;
	//appState = GAME_MODE.RUNNING;
	
	switchStates();
	
	if(appState == GAME_MODE.RUNNING)
	{
	  console.log("Run , run squirrel");
	
	}	
	
	assetLoader.sounds.gameOver.pause();
	assetLoader.sounds.bg.currentTime = 0;
	assetLoader.sounds.bg.loop = true;
	assetLoader.sounds.bg.play();
}

Auction.endAuction = function()
{
	if(endGame)
    {
    	Auction.sold();    	
    }
    else
	{
	  endGame == false;
	}
}

Auction.sold = function()
{	//enemy wins auction, car goes to them
	//$('.sold').style.display = 'true';
	//document.getElementById('sold').style.display = 'true';
	stop = true;
	auctionStop = true;
	
	jq.Auction.menu.hide();
	//jq.Auction.menu.children().hide();
	$('#sold').show();
	//disable user from entering an auction for this car again
	
	//in case of unintended bugs, make sure user doesn't already own car
	if(playerWon && Auction._car !== null)
	{
		var hasCar = false;
		
		for(var i = 0; i < userGarage.length; i++)
		{
			if(Auction._car.name/*id*/ == userGarage[i].name/*id*/)
			{
				hasCar = true;
				break;
			}
		}
		if(!hasCar){
			userGarage.push(Auction._car);	//creates a copy of car, giving it to user
			Auction._car = null;	//no more car to sell
		}
		Garage.save();
	}
	assetLoader.sounds.bg.pause();
	assetLoader.sounds.gameOver.currentTime = 0;
	assetLoader.sounds.gameOver.play();
	assetLoader.sounds.bidder.pause();
	assetLoader.sounds.sold.play();
//	delete Auction;
	endGame = true;
	auctionEnded = true;
	
}

function gameOver() 
{
	//$('.game-over').style.display = 'true';
	auctionStop = true;
	document.getElementById('game-over').style.display = 'true';
	//resetStates();
	stop = true;
		//Show a message that player has insufficient funds
	$('#money').html(money);	//set value in the html element
	//$('#Auction').hide();
	$('#game-over').show();
	//reset AI timers
	startEndBids = [false,false,false,false];
	endBidTimers = [0,0,0,0];
	//
	//disable user from entering auction for this car
	//Auction._car = null;	//no more car to sell
	// assetLoader.sounds.bg.pause();
	assetLoader.sounds.gameOver.currentTime = 0;
	assetLoader.sounds.gameOver.play();		
}

//
//Menu state start game button
//
$('.play').click(function() 
{
  $('#menu').hide();
  $('#gameMenu').show();
  
  delete credits;
  delete mainMenu;
  //delete menu image, since the game can not navigate back to this screen after clicking
  startGame();
});
$('.Register').click(function() 
{
  $('#menu').hide();
  $('#Register').show();
  Register();
  //delete splash
  //delete credits
  //delete menu image, since the game can not navigate back to this screen after clicking
});

/*
//GameOver screen restart button
$('.restart').click(function() 
{
  $('#game-over').hide();
  $('#gameMenu').hide();
  //resetStates();
  //startGame();
  restarted = true;
});
*/
//InMenuButtons
//auction Button
jq.AuctionSelect.backBtn.click(function() 
{
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
	Auction.setup();
	//$('#menu').addClass('auction');
	//AuctionSelect.init();
});
jq.Game.toAuctionBtn.click(function() 
{
	jq.Game.menu.hide();
	jq.AuctionSelect.menu.show();
	//$('#menu').addClass('auction');
	AuctionSelect.init();
});/*
jq.Game.toAuctionBtn.click(function() 
{
	$('#auction').show();
	//$('#gameMenu').hide();
	jq.Game.menu.hide();
	//$('#menu').addClass('auction');
	Auction.init();
	auctionMode();
});*/
//Auction State Back Button
jq.Auction.backBtn.click(function()
{
	//resetStates();
	startGame();
  
	$('#Auction').hide();
	jq.Game.menu.show();
	//var car = userGarage[curCarIndex];
	//jq.Game.homeImg.attr('src', car.getFullPath() );
	//$('#menu').removeClass('Auction');
	//$('#menu').addClass('gameMenu');
	
});
//Inside Auction Bid Button
$('#bid').click(function()
{
	Auction.playerBidding();
	playerDidBid = true;
	//$('#bid').text(
	Auction.setBidBtnText();
});
//Repair to menu Repair
/*function toogleRepair(){
	$('#gameMenu').toggle();
	$('#RepairShop').toggle();
    //$('#RepairShop').children().toggle(0();
}*/
jq.Game.repairBtn.click(function()
{
	//toggleRepair();
	//$('#gameMenu')
	jq.Game.menu.hide();
	jq.RepairShop.menu.show();
	Repair.init();
});
//RepairMenu Back Button 
jq.RepairShop.backBtn.click(function()
{
	//toggleRepair();
  	jq.RepairShop.menu.hide();
 	//$('#gameMenu')
	jq.Game.menu.show();
	resetStates();
	//appState = GAME_MODE.Main_Menu;
});

//function rotateBtns(index)
//{		
	//setCarBtnText(index.data.index, c);
//	setCarBtnText(2, c1);
	/*var btns = [
		$('#carSelBtn0'),
		$('#carSelBtn1'),
		$('#carSelBtn2')
		//$('#carSelBtn3'),
		//$('#carSelBtn4')
		
	];*/
	//btns[0].children('label#make').text('Jaguar');
	//btns[0].children('label#year').text('1969');
	//btns[0].children('label#name').text('E-Type Series II 4.2 Roadster');
	   
	//
	//
	//for(var i = 0; i < btns.length; i++)
	//{
		//var tmp = btns[i];
		//if(tmp.positio.left <= 100)
		//{
			//hide
			//animate
			//tmp.animate({left:'250px'}, 200);
		//}else if(tmp.hidden() )
		//{
			//animate
			//show
		//}
		//else{
			//tmp.animate({right:'50px'}, 200);
		//}
	//}
	
//}
function initUser(userName, pw)
{	//load a registered user after comfirmation from server
}
function initGuest()
{	//loads guest profile, if one does not exist it is created
	if('guest' in Storage.local){
		//returns an object of format {money:number, garage:[]}
		//player = JSON.parse(Storage.local.guest);
	}
	else{
		//create new guest account, to be stored in browser
		//Storage.local.guest = JSON.stringify({money:50000, garage:[]});
	}

}

function saveGameState() 
{
    if (!supportsLocalStorage()) { return false; }
    localStorage["halma.game.in.progress"] = gGameInProgress;
    for (var i = 0; i < kNumPieces; i++) 
    {
	localStorage["halma.piece." + i + ".row"] = gPieces[i].row;
	localStorage["halma.piece." + i + ".column"] = gPieces[i].column;
    }
    localStorage["halma.selectedpiece"] = gSelectedPieceIndex;
    localStorage["halma.selectedpiecehasmoved"] = gSelectedPieceHasMoved;
    localStorage["halma.movecount"] = gMoveCount;
    return true;
}

//$('#guestPlay').click(initGuest);
//Sound Button
$('.sound').click(function() 
{
  var $this = $(this);
  // sound off
  if ($this.hasClass('sound-on')) 
  {
    $this.removeClass('sound-on').addClass('sound-off');
    playSound = false;
  }
  // sound on
  else 
  {
    $this.removeClass('sound-off').addClass('sound-on');
    playSound = true;
  }
  if (canUseLocalStorage) 
  {
    localStorage.setItem('kandi.playSound', playSound);
  }
  // mute or unmute all sounds
  for (var sound in assetLoader.sounds) 
  {
    if (assetLoader.sounds.hasOwnProperty(sound)) 
    {
      assetLoader.sounds[sound].muted = !playSound;
    }
  }
});
//restart GameOver /sold button
$('button#restart').click(function(){
	$('#sold').hide();
	jq.Game.menu.show();
	appState = GAME_MODE.MAIN_MENU;
	delete gameOver;
	auctionEnded = true;
	//delete Auction;
	restarted = true;
	Auction.setup();
	
});

assetLoader.downloadAll();
});