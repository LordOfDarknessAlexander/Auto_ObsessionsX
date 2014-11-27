//$(function()	//shorthand for $(document).ready(
$(document).ready(function()
{
	function init()
	{
	  if (!stop) 
	  {
	    requestAnimFrame(init);
	  
	  	update();
	  	
	    if((timer >= 300.00) && (timer <= 900.00))
		{
			appState = GameMode.Main_Menu;
		  mainMenu();
		  
		}  
		timer++;
	    ticker++;
	  }
	
	}
	
	function auctionInit()
	{
	  if (!auctionStop) 
	  {
	    requestAnimFrame( auctionInit);
	    
	  	update();
		timer ++;
	    ticker++;
	  }
	
	}

	
//
//TODO, access from html database, or other markup file
//
//test, user ca select between 3 cars
//var currentCar = null;
var userGarage = [
	Vehicle('images/vehicle.jpg'),
	Vehicle('images/vehicle.jpg'),
	Vehicle('images/vehicle.jpg')
];
var currentCar = userGarage[0];	//copy constructed car, altering currentCar doesn't change usergarage[0]

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
	var doc=reader.responseXML;
  
	return doc;
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

//LOAD Vehicle XML, this was working, now can't find source file!
/*if(loadXMLDoc('../vehicles.xml') == false)
{	//loading xml resource failed, display warning
	window.open("/pdf/2014Schedule.pdf", "_blank");		//display warning page
}
*/
/*
var vDoc = document.querySelector('link[rel="import"]');	//document Vehicles.html
var vehicles = document.getElementById('Vehicles');
var cn = vehicles.firstChild;
for(var carNode in vehicles.childNodes){
	var newCar = Vehicle(car)
	//instantiate js object or retain html node 'car' for read only access
}
*/

function initGarage()
{	//initilize user's garage will available cars,
	//accessed from user.xml, referenced from database vehicle.xml
	//parse user xml
	//get user with ID
	//var userNode = getElementById('');
	//for(child in userNode)
	//{
		//var carID = child.getAttributeById('id');
		//userGarage.push(VehicleXML.getElementById(carID) );
	//}
	return;
}
function addCar(car)
{	//call after user wins auction, adding car to garage and user.xml
	//
	//var garage = userNode.getElementById('garage');
	//if(node with id exists){
		//alert('already own car with id:' + car.id);
	//}else
	//{
		//garage.addNode('<ch>' + car.id + '</ch>');
		//commit changes to server
	//}
}

//Show asset loading progress
//@datatype {integer} progress - Number of assets loaded
//@datatype {integer} total - Total number of assets
assetLoader.progress = function(progress, total) 
{
  //$('.progress-bar')
  var pBar = document.getElementById('progress-bar');
  pBar.value = progress / total;
  //$('.p')
  document.getElementById('p').innerHTML = Math.round(pBar.value * 100) + "%";
}

//Load the splash screen first
assetLoader.finished = function() 
{
 switchStates();
}

//Garage Doors	
splashImage.onload = function()
{
	context.drawImage(splashImage, 0,0);
	

};
//Main Background of game
backgroundImage.onload = function()
{
	context.drawImage(backgroundImage, 50, -10);
}	
	
function garageDoor()
{
	backgroundY -= speed;
	if(backgroundY == -1 * height)
	{
		backgroundY = -1000;
	}
}	
//States
var appState;
appState = GameMode.Splash;	//app may only exist in one state at a time

function switchStates( GameMode) 
{	 //call various update based on appState
	 switch (GameMode) 
	 {
	 	 case Splash:
		        splash();
		        break;
		        
		  case Main_Menu:
		        mainMenu();
		    	break;  
		           
	      case Auction:
		        auctionMode();
		        break;
		        
		  case Repair:
		        repairState();
		        break;
		        
		  case AddFunds:
		    	addFundsMode();
		    	
		    default:
		         Running; 
	     // etc...
	 }
}

function update(deltaTime)
{
    garageDoor();
	//Order of draws matters
    context.drawImage(backgroundImage, 0,-10);
    context.drawImage(splashImage, 0, backgroundY);
    timer++;
	
	if(appState == GameMode.Auction)
	{
		//this shouldn't happen every update otherwise,
		updatePlayer();
		//call bidder ai functions
		bidTimers();
		enemyBidding();
		currentBidder();
		//price();
		if(playerDidBid)
		{
			bidderCooldown++;
			enemyCanBid = false;
		}
	  
	  	if(bidderCooldown >= ENEMY_WAIT)
	  	{
	  		enemyCanBid = true;
	  		bidderCooldown = 0;
	  		
	  	}
	  	
	  	renderAuction();
	  	findEndBidder();
	}
		
}

//Game Loop 

function updatePlayer() 
{
  
  player.update();
  player.draw();

}


//Sort Items arrays
function shuffleArray(array) 
{
    var counter = array.length, temp, index;

    // While there are elements in the array
    while (counter > 0) 
    {
        // Pick a random index
        index = Math.floor(Math.random() * counter);

        // Decrease counter by 1
        counter--;

        // And swap the last element with it
        temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
       
    }

    return array;
}




//Show the splash after loading all assets 
function splash() 
{
  
  init();
	
  
  $('#progress').hide();
  $('#splash').show();
  $('.sound').show();  
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
   
  $('#progress').hide();
  $('#splash').hide();
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
  appState = GameMode.Running;
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
  appState = GameMode.Running;
  
  switchStates();

  if(appState == GameMode.Running)
  {
	console.log("Run , run squirrel");

  }	

  assetLoader.sounds.gameOver.pause();
  assetLoader.sounds.bg.currentTime = 0;
  assetLoader.sounds.bg.loop = true;
  assetLoader.sounds.bg.play();
      
}
function resetStates()
{
	appState = GameMode.Running;
}

function auctionMode()
{	//in-Auction update, core of game logic
   context.clearRect(0, 0, canvas.width, canvas.height);
   auctionStop = false;
   appState = GameMode.Auction;
   ticker = 0;
   stop = true;
   //money = 50000;
   playerBid = 0;
   
   auctionInit();
  
   shuffleArray(enemyBids);
   shuffleArray(bidders);

   context.font = '26px arial, sans-serif';  
      	
	if(appState == GameMode.Auction)
	{
		console.log("Snap, crackle , pop");
	}
	else
	{
		auctionStop = true;
		appState = GameMode.Running;
		
		resetStates();
	}  	 
  
   auctionMode.update = function() 
   {
     playerBidding();
     
   }
  
  $('#Auction').show();
  $('#menu').removeClass('gameMenu');
  $('#menu').addClass('Auction');
  $('.sound').show();

  assetLoader.sounds.gameOver.pause();
  assetLoader.sounds.bg.currentTime = 0;
  assetLoader.sounds.bg.loop = true;
  assetLoader.sounds.bg.play();
}


//Repair State
function repairState()
{	//repair state update
	stop = true;
	
	appState = GameMode.Repair;
	// this.stop;
	if(appState == GameMode.Repair)
	{
		console.log("Man im in repairmode");	
	}	
}
function addFundsMode()
{	//store update
	stop = true;
	appState = GameMode.AddFunds;
	if(appState == GameMode.AddFunds)
	{
		console.log("save your money u cants save the world");
	}		
}
//End the game and restart
function gameOver() 
{
	//$('.game-over').style.display = 'true';
	document.getElementById('game-over').style.display = 'true';
	resetStates();
	stop = true;
	auctionStop = true;
	//Show a message that player has insufficient funds
	$('#money').html(money);	//set value in the html element
	$('#game-over').show();
	//reset AI timers
	startEndBids = [false,false,false,false];
	endBidTimers = [0,0,0,0];
	// assetLoader.sounds.bg.pause();
	assetLoader.sounds.gameOver.currentTime = 0;
	assetLoader.sounds.gameOver.play();
}

//push vehicle in to inventory and tell player he won bidding
function sold() 
{
	//$('.sold').style.display = 'true';
	document.getElementById('sold').style.display = 'true';
	stop = true;
	auctionStop = true;
	
	for(var i = 0; i < enemyBids.length; i++)
	{
		$('#enemyBid').html(enemyBids[i]);	//write enemy bid to html?
	}
	
	$('#sold').show();
	assetLoader.sounds.bg.pause();
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
  //delete splash
  //delete credits
  //delete menu image, since the game can not navigate back to this screen after clicking
  startGame();
});
//GameOver screen restart button
$('.restart').click(function() 
{
  $('#game-over').hide();
  $('#gameMenu').hide();

  resetStates();
  startGame();
});

//InMenuButtons
//auction Button
$('#auction').click(function() 
{
	$('#auction').show();
	$('#gameMenu').hide();
	$('#menu').addClass('auction'); 	
	auctionMode();

});
//Auction State Back Button
$('#auctionBackButton').click(function()
{
	resetStates();
	startGame();
  
	$('#Auction').hide();
	$('#gameMenu').show();
	$('#menu').removeClass('Auction');
	$('#menu').addClass('gameMenu');
	
});
//Inside Auction Bid Button
$('#bid').click(function()
{
	playerBidding();
	playerDidBid = true;
});
//Repair to menu Repair
/*function toogleRepair(){
	$('#gameMenu').toggle();
	$('#RepairShop').toggle();
    //$('#RepairShop').children().toggle(0();
}*/
$('#repair').click(function()
{
	//toggleRepair();
	$('#gameMenu').hide();
	$('#RepairShop').show();
	repairState();
	//appState = GameMode.Repair;
});
//RepairMenu Back Button 
$('#repairBackButton').click(function()
{
	//toggleRepair();
  	$('#RepairShop').hide();
  	$('#gameMenu').show();
	resetStates();
	//appState = gamemode.Main_Menu;
});

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
//
//Funds State interface
//
function addFunds(val)
{
	var MAX_MONEY = 50000000;
	var newTotal = money + val;
	money = newTotal > MAX_MONEY ? MAX_MONEY : newTotal;
}
$('#addAllowanceBtn').click(function()
{	//allowance accumulates every few seconds
	money += 1;
});
$('#addMinorFundsBtn').click(function()
{	//open paypal form
	//transfering game currency to user's account
	addFunds(500);
});
$('#addMediumFundsBtn').click(function()
{	//open paypal form
	//transfering game currency to user's account
	addFunds(1500);
});
$('#addMajorFundsBtn').click(function()
{	//open paypal form
	//transfere game currency to user's account
	addFunds(50000);
});

assetLoader.downloadAll();
});