﻿// define variables
var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;
//var canUseSessionStorage = 'sessionStorage' in code && code.sessionStorage !== null;
//
var canvas = document.getElementById('canvas');	//$("#canvas")?
var context = canvas.getContext('2d');
//aspect ratio
var width = canvas.getAttribute('width'),
	height = canvas.getAttribute('height');

var player, stop, ticker;

var Storage = {
	//canUseLocal:,
	//canUseSession:,
	local:('localStorage' in window && window.localStorage !== null) ? window.localStorage : null
	//session:code.sessionStorage
};
//names of files in folder imgaes\\logos to be used as ads
var logos = [
	'AutoZone',
	'shelby',
	'jegs',
	'napa'
];
var userStats = {
	fn:'Larry',
	money:0 ,
	tokens:2,
	prestige:0,
	m_marker:0
};

function saveUser()
{	//saves user stats as a JSON string to the browsers local storage
	if(Storage.local !== null){
		Storage.local._stats = JSON.stringify(userStats);
		ajax_post();
	}
	//else local storage not available
}

var amoney;
var atokens;
var aprestige;
var amarkers;
var fn = "Jerry";
function ajax_post()
{
    // Create our XMLHttpRequest object
    //var dataStr = ''; //args to pass to script

	
	/*
     var amoney = getElementById("money").value;
     var atokens = getElementById("tokens").value;
	 var aprestige = getElementById("prestige").value;
	 var amarkers = getElementById("m_marker").value;
	*/
	
	fn = "Jim";
	amoney = userStats.money;
	atokens = userStats.tokens;
	aprestige = userStats.prestige;
	amarkers = userStats.m_markers;

    var jqxhr = $.ajax({
        type:'POST',
        url:getHostPath() + 'Users/my_parse_file.php',
        dataType:'json',
        //data:{money:amoney,tokens:atokens}
		 data:{fname:fn,money:amoney,tokens:atokens,prestige:aprestige,m_marker:amarkers}
    }).done(function(data){
        //the response string is converted by jquery into a Javascript object!
        if(data === null){
            alert('Error:ajax response returned null!');
            return;
        }
        alert('ajax response received:' + JSON.stringify(data) );
        //access and set values in the document's html page
	/*	
        $('div#statBar label#money').text(data.money);
        $('div#statBar label#tokens').text(data.tokens);
        $('div#statBar label#prestige').text(data.prestige);
        $('div#statBar label#m_marker').text(data.m_marker);*/
    }).fail(function(jqxhr){
        //call will fail if result is not properly formatted JSON!
        alert('ajax call failed! Reason: ' + jqxhr.responseText);
        //throw exception, game can't work without user stats
    });
    
}


function loadUser()
{	//serialize user stats from local storage, if played previously
//<php if(loggedIn){>
    //make ajax call to server
//}
//else{
	if(Storage.local !== null){
		if('_stats' in Storage.local){
			//userStats = JSON.parse(Storage.local._stats);
			
		}
		else{	//no previous save data
			userStats = {
				fn:'Gary',
				money:50000,
				tokens:2,
				prestige:1,
				m_marker:0
			};
		}
	}
//}
}

//States
var REPAIR;
var ADD_FUNDS;
var RUNNING;
var SPLASH;
var MAIN_MENU;
var TUTORIAL;
var NEW_USER;
var LOGIN_USER;



var playSound;
var splashTimer = 600.00;
//InMenu UI Constansts

var buttonsPlaceY = 200;
//Enemy Bid Timer check
var BID_THRESHOLD = 200;
//Player Pos, should be local in Player class
//Bidder Pos
var BIDDER_XPOS = 650;
var BIDDER_YPOS = 250;
var ENEMY_X = 80;
var VEHICLE_XPOS = 660;
var VEHICLE_YPOS = 850;
 
//background images
//garage doors
var splashImage = new Image();
splashImage.src = "images/MBackground.png";
//Menu Background Image
var backgroundImage = new Image();
backgroundImage.src = "images/inventoryMenu.png";

//Menu velocity 
var backgroundY = 0;
var speed = 0.7;
//Enemy Avatars
//Sad enemy avatars
var slimer = new Image();
slimer.src = 'images/slime.png';
//Happy Enemies
var curBidImage = new Image();
curBidImage.src = 'images/slime2.png';
//
//AI
//Create an empty array of Bidders
var bidders = ["Bidder_990 ", "Bidder_1090 " ,"Bidder_3490 ", "Bidder_320 " ,"Bidder_465 " ,"Bidder_2490 ", "Bidder_2190 " ,"Bidder_7890 ", "Bidder_90 ","Bidder_66990 ","Bidder_1090 ", "Bidder_2332 ","Bidder_4390 ","Bidder_890 ","Bidder_8720 ","Bidder_8976 ","Bidder_220 ","Bidder_1196 ","Bidder_8976 ",
"Bidder_6690 ","Bidder_4490 ","Bidder_6790 ","Bidder_8790 ","Bidder_10 ","Bidder_40 ","Bidder_430 ","Bidder_3390 ","Bidder_9 ","Bidder_621 ","Bidder_21430 ","Bidder_23450 ","Bidder_32345 ","Bidder_46574 ","Bidder_4597 ","Bidder_78765 ","Bidder_8765 ","Bidder_608 ","Sparkles King ","Bidder_7890 "];

var vehiclePrice = 20000;
//static bidding caps results in obvious behaviour,
//ie. starting an auction with more than 1.25 of vehicle price will always win

//new array for every new auction? preferably in the auction button qjuery callback

var playerWon = false;

//Global frame timer
var timer = 0;
var previousTime = Date.now();

var deltaTime = (Date.now() - previousTime) / 1000;
previousTime = Date.now();
timer += deltaTime;

var endGame = false;
var auctionEnded = false;
var restarted = false;
var auctionOver = false;
var restartTimer = 0;
var appState = GAME_MODE.SPLASH;	
//Users login counts

var userLogged = false;


function resetStates()
{
	appState = GAME_MODE.RUNNING;
}
function getHostPath(){
    //gloablly accessable function, the local path maybe diffrent,
    //DON'T CHANGE THE PATH, instead rename/relocate your project folder,
    //so devs don't have a commit war, having to change this function
    //for each of their projects each time they commit!
    var localExecution = true;
    return localExecution == true ? 'http://localhost/Auto_ObsessionsX/'
            : 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/';
}