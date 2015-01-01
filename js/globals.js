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
	money:0,
	tokens:2,
	prestige:0,
	markers:0
};

function saveUser()
{	//saves user stats as a JSON string to the browsers local storage
	if(Storage.local !== null){
		Storage.local._stats = JSON.stringify(userStats);
	}
	//else local storage not available
}
function loadUser()
{	//serialize user stats from local storage, if played previously
	if(Storage.local !== null){
		if('_stats' in Storage.local){
			userStats = JSON.parse(Storage.local._stats);
		}
		else{	//no previous save data
			userStats = {
				money:50000,
				tokens:2,
				prestige:1,
				markers:0
			};
		}
	}
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
var BID_THRESHOLD = 3600;
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
var bidders = ["Sparkles ", "hotdog " ,"gangmanstyle ", "shinobi " ,"Noy " ,"Behemoth ", "Quatarian " ,"Ol G ", "Cindy ","Bobby ","Obama ", "OsamaBinBombin ","Ortega Mammon ","LOD Alexander ","Meatwad ","Candela","Oprah ","Jerry Springer ","Sam Jaxon ",
"Moody Blue ","Shitake Shroom ","Macabre ","Sancho Pancho ","Quijote ","Leo ","Centurion ","Omega Pepper ","Osiris Moon ","Sass McFrass ","Smiley ","Budapest Guy ","Larry Queen ","Special Head ","Primitivo Montoya ","The Skywalker ","Sam Squirrel ","Dante ","Sparkles King ","Onion Knight "];

var vehiclePrice = 20000;
//static bidding caps results in obvious behaviour,
//ie. starting an auction with more than 1.25 of vehicle price will always win

//new array for every new auction? preferably in the auction button qjuery callback

var enemyCap = 1.25 * vehiclePrice;
var enemyCap2 = 0.8 * vehiclePrice;
var enemyCap3 = 0.7 * vehiclePrice;
var enemyCap4 = 0.9 * vehiclePrice;
var enemyCap5 = 0.6 * vehiclePrice;
var enemyCap6 = 0.2 * vehiclePrice;
var playerWon = false;


var enemyCaps = [enemyCap,enemyCap2,enemyCap3,enemyCap4,enemyCap5,enemyCap6];
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

//user HUD
var userText = "";
var currentUser;
var userCash;
var userScore;

function resetStates()
{
	appState = GAME_MODE.RUNNING;
	//stop = false;
	//auctionStop = false;
	//endGame = false;
	//playerWon = false;
	//startGame();	

}