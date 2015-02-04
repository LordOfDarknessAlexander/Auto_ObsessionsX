//Application main
var AutoObessesions = {};

//function getLastAllowanceTime()
//{
	//if(Storage.local !== null)
	//{
		//if('_lastAllowanceTime' in Storage.local)
		//{
			//return parseInt(Storage.locla._lastAllowanceTime);
		//}
	//}
//}
//function setLastAllowanceTime()
//{
	//if(Storage.local !== null)
	//{
		//var time = Date.now()	//a time of 0
		//Storage.local._lastAllowance = time.toString();
	//}
//}
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
    
	if(auctionOver)
	{
		restarted = true;
	}
	/*
	if(restarted)
	{
		console.log("Chicken Fingers restarting");
		//Auction.restart();

		auctionMode();

	}
*/
	AuctionSell.update(deltaTime);

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
		
		Auction.update();
		
	}
}

function auctionMode(deltaTime)
{	//in-Auction update, core of game logic
   ticker = 0;
   stop = true;
   
    //$('#money').html(money);
    Auction.setup();//auctionInit();
  
}

//js.StatBar = {
function setMoney()
{
	$('div#statBar label#money').text('Money: ' + userStats.money.toString() );
}
function setTokens()
{
	$('div#statBar label#tokens').text('Tokens: ' + userStats.tokens.toString() );
}
function setPrestige()
{
	$('div#statBar label#prestige').text('Prestige: ' + userStats.prestige.toString() );
}
function setMarkers()
{	//updates html lable element, within context of the Game menu only
	$('label#mileMarker', jq.Game.menu).text('Mile Markers: ' + userStats.markers.toString() );
}
function setStatBar()
{
    jq.statBar.show();
	setMoney();
	setTokens();
	setPrestige();
	setMarkers();
}
function setAdBG()
{	//set a random ad
	//floor returns an integer, random returns, random returns a float
	var i = Math.floor(Math.random() * (logos.length - 1) ),	//[0,logos.length-1]
		src = "images\\logos\\" + logos[i] + ".png";
	jq.adBar.attr('src', src);
	jq.adBar.show();
}
//$(function()	//shorthand for $(document).ready(
//executed after the html document is processed
function loadGarage(){
    if(Storage.local !== null && '_curCarIndex' in Storage.local){
        Garage._curCarIndex = parseInt(JSON.parse(Storage.local._curCarIndex) );
        //alert("current car is at index:" + Garage._curCarIndex.toString() );
    }
}
$(document).ready(function()
{	//Declare functions and objects dependant on the html
	//document being loaded within this callback,
	//such as jQuery/ui callback bindings,
	//loading assets and 'core' game logic
	//Storage.local.clear();
	//alert('doc ready!');
	loadUser();
    loadGarage();
    jq.Game.setHomeImg();
	//userStats.money = 150;
	//saveUser();
	//jq.Game.homeImg.hide();
	
	function init()
	{
		if(!stop) 
		{
			requestAnimFrame(init);
			
			update(0.33);
			
			//delete Register;	//deleting this every frame is bad idea
			
			//if((timer >= 300.00) && (timer <= 900.00))
			//{
				appState = GAME_MODE.MAIN_MENU;
				mainMenu();
			  
			//}  
			timer++;
			ticker++;
		}	
	}
function openDoc(url, reader)
{	//parse xml document in xml DOM object
	reader.open("GET",url,true);    //breaks if set to false; ASync is good anyways, we want this
	reader.send();  //this is where the current issue is!
    
	var doc = reader.responseXML;	//access DOM object tree
    alert(doc);
	return doc;
}
function createReader()
{   //creates an xml http request
    // code for IE7+, Firefox, Chrome, Opera, Safari
	if(window.XMLHttpRequest)
	{
		return new XMLHttpRequest();
	}
	else{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}

	if(xmlhttp){
		
	}//open warning page, error loading data
	else{	
	  window.open("/pdf/2014Schedule.pdf", "_blank");
	}
	
	return xmlhttp;
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
    //alert(doc);
	//var list = doc.childNodes;
	//var node = list[1];	//acessing nodes work
//	var v = node.item(i);
	//var cn = node.childNodes;
	//var atrs = node.attributes;
	//TODO:accessing attribute elements breaks...
	
//	var parts = node.getElementById('upgrades');
	//var
        //name = atrs.getNamedItem('name'),
        //make = atrs.getNamedItem('make'),
        //year = atrs.getNamedItem('year');
    
    //userGarage.push(Vehicle(name, make, year, 10000) );    //list[i]) )
//	var n = node.getAttribute('name');
	//var atrs = node.attributes;
	//var n = node.getAttribute('year');
//	var n = node.getAttribute('make');
	//for(var i = 0; i < list.length; i++){
		//userGarage.push(Vehicle(list[i]) )
//	}
}

function loadXMLDoc(url)
{
	reader = createReader();
    var doc = openDoc(url, reader);
	
	if(typeof doc === 'undefined' || doc === null)
	{
        alert('could not parse xml from server');
		return false;
	}
	loadCars(doc);
	return true;
}

//Parse ajax functions to send data from within js to ph
function ajax(Id,userId,str,post)
{
    var ajax;
    if (window.XMLHttpRequest)
    {
        ajax=new XMLHttpRequest();//IE7+, Firefox, Chrome, Opera, Safari
    }
    else if (ActiveXObject("Microsoft.XMLHTTP"))
    {
        ajax=new ActiveXObject("Microsoft.XMLHTTP");//IE6/5
    }
    else if (ActiveXObject("Msxml2.XMLHTTP"))
    {
        ajax=new ActiveXObject("Msxml2.XMLHTTP");//other
    }
    else
    {
        alert("Error: Your browser does not support AJAX.");
        return false;
    }
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4&&ajax.status==200)
        {
            document.getElementById(Id).innerHTML=ajax.responseText;
        }
    }
    if (post==false)
    {
        ajax.open("GET",userId +str,true);
        ajax.send(null);
    }
    else
    {
        ajax.open("POST",userId,true);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send(str);
    }
    return ajax;
}

/*
//LOAD Vehicle XML, this was working, now can't find source file!
var vehiclePath = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/vehicles.xml';	//should be the location of file on server

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

//money = 50000;
// Start the game - reset all variables and entities, spawn ground and water.
function startGame() 
{	//initialize the game state
	context.clearRect(0, 0, canvas.width, canvas.height);
	document.getElementById('gameMenu').style.display = 'true';  
	//$('#money').html(money);
	appState = GAME_MODE.RUNNING;
	player.reset();
	ticker = 0;
	stop = false;
	auctionStop = true;
	restarted = false;
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
	
	setStatBar();
	setAdBG();
	
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

Auction.sold = function()
{	//enemy wins auction, car goes to them
	//$('.sold').style.display = 'true';
	//document.getElementById('sold').style.display = 'true';
	stop = true;
	auctionStop = true;
	goingTimer = 0;
	startEndBids = [false,false,false,false];
	endBidTimers = [0,0,0,0];
	//pGTimer = 0;
	//player.restart();

	jq.Auction.menu.hide();
	//jq.Auction.menu.children().hide();
	jq.Sold.menu.show();
	
	
	//disable user from entering an auction for this car again
	
	//in case of unintended bugs, make sure user doesn't already own car
	if(playerWon && Auction._car !== null)
	{
		//Auction._car is not the right object!?
		$('div#sold label').text(Auction._car.getFullName() );
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
		//userSave();
		Garage.save();
	
		
	}
	assetLoader.sounds.bg.pause();
	assetLoader.sounds.gameOver.currentTime = 0;
	assetLoader.sounds.gameOver.play();
	assetLoader.sounds.bidder.pause();
	assetLoader.sounds.sold.play();
	
	if(playerWon)
	{
		auctionEnded = true
		auctionOver = true;
	}
	else
	{
		endGame = true
	}
	Auction.close();
}
//
//jQuery UI bindings
//
$('.play').click(function() 
{
    $('#menu').hide();
    $('#gameMenu').show();
    //can no longer navigate to credits or the root menus anymore
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
    delete mainMenu;	//don't delete, can still navigate back to this page
    //delete credits
    //delete menu image, since the game can not navigate back to this screen after clicking
});
//InMenuButtons
//auction Button
jq.AuctionSelect.backBtn.click(function() 
{ 	
	setAdBG();
	setStatBar();
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
	//Auction.setup();
	
	//$('#menu').addClass('auction');
	//AuctionSelect.init();
});
jq.Game.toAuctionBtn.click(function() 
{
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
	//$('#menu').addClass('auction');
	//auctionStop = false;
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
jq.Auction.homeBtn.click(function()
{
	//Auction.cancel();	//stop the auction, aborting the sale
	Auction.close();
	//$('#Auction').hide();
	jq.Auction.menu.hide();
	jq.Game.menu.show();
	//jq.Game.menu.children().toggle();	//hides/showns all child elements
	
	setStatBar();
	setAdBG();
	
	var car = Garage.getCurrentCar();
	
	if(car !== null){
		//jq.Game.homeImg.attr('src', car.getFullPath() );
	}
	
});
//Auction State Back Button
jq.Auction.backBtn.click(function()
{
	//resetStates();
	Auction.close();
	//$('#Auction').hide();
	jq.Auction.menu.hide();
	jq.AuctionSelect.menu.show();
	//jq.AuctionSelect.menu.children().toggle();	//hides/showns all child elements
	
});
/*
jq.Auction.buyOutBtn.click(function()
{	
	Auction.buyOut();
});*/
jq.Sold.garageBtn.click(function()
{
	//jq.Sold.menu.
    jq.Sold.menu.hide();
	jq.Garage.menu.show();
    Garage.init();
    //appState = GAME_MODE.GARAGE:
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

	//saveUser();	//save user stats after purchasing
});
//RepairMenu Back Button 
jq.RepairShop.backBtn.click(function()
{
	//toggleRepair();
  	jq.RepairShop.menu.hide();
 	//$('#gameMenu')
	setStatBar();
	setAdBG();
	jq.Game.menu.show();
	//resetStates();
	//appState = GAME_MODE.Main_Menu;
});
jq.Funds.backBtn.click(function()
{
	jq.Funds.toggle();
	setStatBar();
	setAdBG();
	saveUser();
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

//$('#guestPlay').click(initGuest);
//Sound Button
$('.sound').click(function() 
{
    var $this = $(this);    //references the jq object calling .click, not the function!
    // sound off
    if($this.hasClass('sound-on')) 
    {
        $this.removeClass('sound-on').addClass('sound-off');
        playSound = false;
    }
    else // sound on
    {    
        $this.removeClass('sound-off').addClass('sound-on');
        playSound = true;
    }
    
    if(canUseLocalStorage) 
    {
        localStorage.setItem('kandi.playSound', playSound);
    }
    // mute or unmute all sounds
    for(var sound in assetLoader.sounds) 
    {
        if(assetLoader.sounds.hasOwnProperty(sound)) 
        {
            assetLoader.sounds[sound].muted = !playSound;
        }
    }
});
//restart GameOver /sold button
jq.Sold.homeBtn.click(function(){
	jq.Sold.menu.hide();
	jq.Game.menu.show();
	appState = GAME_MODE.MAIN_MENU;
	//delete gameOver;
	auctionEnded = false;
	endGame = false;
	//auctionMode();
	//delete Auction;
	restarted = true;
	//Auction.setup();	
});

assetLoader.downloadAll();
});