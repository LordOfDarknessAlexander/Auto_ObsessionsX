//Application main
var AutoObessesions = {};

/*function ajax_loadUser()
{
    //loads userStats from php file accessing sql database
    var jqxhr = $.ajax({
        type:'POST',
        url:getHostPath() + 'loadUser.php',
        dataType:'json',
        //data:userStats
		data:''//{money:amoney,tokens:atokens,prestige:aprestige,m_marker:amarkers}
    }).done(function(data){
        //the response string is converted by jquery into a Javascript object!
        if(data === null){
            alert('Error:ajax response returned null!');
            return;
        }
        //alert('ajax response received:' + JSON.stringify(data) );
        //access and set values in the document's html page
		//$('div#statBar label#fname').text(data.uname);
        userStats = {
            money:data.money,
            tokens:data.tokens,
            prestige:data.prestige,
            marker:data.m_marker
        };
        setStatBar();
    }).fail(function(jqxhr){
        //call will fail if result is not properly formatted JSON!
        alert('ajax_loadUser(), call failed! Reason: ' + jqxhr.responseText);
        //throw exception, game can't work without user stats
    });
}*/
function getLastAllowanceTime()
{
	if(Storage.local !== null)
	{
		if('_lastAllowanceTime' in Storage.local)
		{
			return parseInt(Storage.local._lastAllowanceTime);
		}
	}
}
function setLastAllowanceTime()
{
	if(Storage.local !== null)
	{
		var time = Date.now()	//a time of 0
		Storage.local._lastAllowance = time.toString();
	}
}

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
    	//should splash update
    //userLogged = true;
	if(auctionOver)
	{
		restarted = true;
	}

	AuctionSell.update(deltaTime);

	timer++;
	
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
	
function setName()
{
	//$('div#statBar label#fname').text('User: ' + userStats.fn.toString() );
}	
function setMoney()
{
	$('div#statBar label#money').text('Money: ' + userStats.money.toFixed(2) );
	
	if(userStats.money <= 0)
	{
		//userStats.money = 0;
		alert("You are out of money Dude!");
		$('div#statBar label#money').text('Refresh Dough???: ' + userStats.money.toFixed(2) );
	}
}
function setTokens()
{
	$('div#statBar label#tokens').text('Tokens: ' + userStats.tokens.toString() );
	//$('div#auctionStatBar label#tokens').text('Tokens: ' + userStats.tokens.toString() );
}
function setPrestige()
{
	$('div#statBar label#prestige').text('Prestige: ' + userStats.prestige.toString() );
	//$('div#auctionStatBar label#prestige').text('Prestige: ' + userStats.prestige.toString() );
}
function setMarkers()
{	//updates html label element, within context of the Game menu only
	$('label#m_marker').text('Mile Markers: ' + userStats.marker.toString() );
	//$('div#auctionStatBar label#m_marker').text('Mile Markers: ' + userStats.marker.toString() );
}
function setStatBar()
{
    jq.statBar.show();
	setName();
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
//function loadGarage(){
  // if(Storage.local !== null && '_curCarIndex' in Storage.local){
    //    Garage._curCarIndex = parseInt(JSON.parse(Storage.local._curCarIndex) );
        //alert("current car is at index:" + Garage._curCarIndex.toString() );
    //}
//}

$(document).ready(function()
{	//Declare functions and objects dependant on the html
	//document being loaded within this callback,
	//such as jQuery/ui callback bindings,
	//loading assets and 'core' game logic
	//Storage.local.clear();
	//alert('doc ready!');
<<<<<<< HEAD
	pas.query.loadUser();
=======
	ajax_loadUser();
	getLastAllowanceTime();
>>>>>>> origin/master
	loadUser();
    Garage.load();
    //jq.Game.setHomeImg();
    setHomeImg();   //in Garage.js
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
			
			if((timer >= 300.00) && (timer <= 900.00))
			{
				appState = GAME_MODE.MAIN_MENU;
				mainMenu();
			  
			}  
			timer++;
			ticker++;
		}	
	}
    //Pro tip:Don't bother opening html/xml files in javascript,
    //do it it PHP instead! not data transfer as php opens the file locally on the server,
    //then echo out the code bits you want to access the file's data!
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
//REMOVE THIS, it is outdated and obsolete,
//XMLHTTPResuests are encapsulated under jQuery Ajax call and their objects
//Use that instead of this old and bloated api
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
}*/

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
			setStatBar();
		break;
		        
		case REPAIR:
			Repair.update();
			setStatBar();
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
  garageDoor();
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
	//ajax_loadUser();
	setStatBar();
	//setAdBG();
	//ajax_post();
	
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
	
    assetLoader.sounds.bg.pause();
	assetLoader.sounds.gameOver.currentTime = 0;
	assetLoader.sounds.gameOver.play();
	assetLoader.sounds.bidder.pause();
	assetLoader.sounds.sold.play();
	
	auctionEnded = true;
	auctionOver = true;
	endGame = true;
	 //   $('div#loss label').text(Auction._car.getFullName() );
    
	//disable user from entering an auction for this car again
	//in case of unintended bugs, make sure user doesn't already own car
	if(Auction.playerWon && Auction._car !== null)
	{
 //not the right object!?
		jq.Sold.menu.show();
		$('div#sold label').text('Congratulations!\nYou won the auction for the ' + Auction._car.getFullName() + '\nGo to the garage to view your prize!\n');
//<php
//if(loggedIn){>
        pas.insertCar(Auction._car.id);
//<php
//}
//else{?>
		//var hasCar = false;
		
		//for(var i = 0; i < userGarage.length; i++)
		//{
			//if(Auction._car.name/*id*/ == userGarage[i].name/*id*/)
			//{
				//hasCar = true;
				//break;
			//}
		//}
		//if(!hasCar){
			//userGarage.push(Auction._car);	//creates a copy of car, giving it to user
			//Auction._car = null;	//no more car to sell
		//}
		//userSave();
		//Garage.save();
//<php
//}
//?>
		//ajax_post();    //get user info from server
		setStatBar();
	}
	else
	{
		$('div#sold label').text('Unfortunately you have lost the auction for the ' + Auction._car.getFullName() + '\nBetter luck next time!\n');
        setHomeImg();
	}
	//Auction.close();
	//init();
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
	//setAdBG();
	//userHUD();
	setStatBar();
    setHomeImg();
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
	//Auction.setup();
	jq.carImg.show();
	//$('#menu').addClass('auction');
	//AuctionSelect.init();
});
jq.Game.toAuctionBtn.click(function() 
{
	jq.Game.menu.toggle();
	jq.AuctionSelect.menu.toggle();
    jq.carImg.hide();
	//$('#menu').addClass('auction');
	//auctionStop = false;
	AuctionSelect.init();
});
jq.Auction.homeBtn.click(function()
{
	//Auction.cancel();	//stop the auction, aborting the sale
	Auction.close();
	//$('#Auction').hide();
	jq.Auction.menu.hide();
	jq.Game.menu.show();
    jq.carImg.show();
	//jq.Game.menu.children().toggle();	//hides/showns all child elements
	
	ajax_post();
    
    setStatBar();
	//setAdBG();
    setHomeImg();
    
	//userHUD();
	//var car = Garage.getCurrentCar();
	
	//if(car !== null){
		//jq.Game.homeImg.attr('src', car.getFullPath() );
    
	//}	
});
//Auction State Back Button
jq.Auction.backBtn.click(function()
{
	Auction.close();
	jq.Auction.menu.hide();
	jq.AuctionSelect.menu.show();
    jq.carImg.hide();	
});
jq.Sold.garageBtn.click(function()
{
	//jq.Sold.menu.
    jq.Sold.menu.hide();
	jq.Garage.menu.show();
    Garage.init();
    jq.carImg.hide();
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
    jq.carImg.show();
	//saveUser();	//save user stats after purchasing
});
//RepairMenu Back Button 
jq.RepairShop.backBtn.click(function()
{
	//toggleRepair();
  	jq.RepairShop.menu.hide();
 	//$('#gameMenu')
	setStatBar();
//	setAdBG();
	jq.Game.menu.show();
    jq.carImg.show();
	//resetStates();
	//appState = GAME_MODE.Main_Menu;
});
jq.Funds.backBtn.click(function()
{
	jq.Funds.toggle();
	setStatBar();
//	setAdBG();
	saveUser();
    jq.carImg.show();
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
{	//load a registered user after confirmation from server
}
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
    setHomeImg();
    jq.carImg.show();
	appState = GAME_MODE.MAIN_MENU;
	auctionEnded = false;
	endGame = false;
	restarted = true;	
});

assetLoader.downloadAll();
});