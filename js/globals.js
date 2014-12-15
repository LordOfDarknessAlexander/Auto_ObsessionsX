﻿// define variables
var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;
//var canUseSessionStorage = 'sessionStorage' in code && code.sessionStorage !== null;
//
var canvas = document.getElementById('canvas');	//$("#canvas")?
var context = canvas.getContext('2d');
//aspect ratio
var width = canvas.getAttribute('width'),
	height = canvas.getAttribute('height');

var player, money, stop, ticker;
/*
var Storage = {
	canUseLocal:'localStorage' in window && window.localStorage !== null,
	canUseSession,
	local: canUseLocal ? window.localStorage : null,
	//session:canUseSession ? code.sessionStorage : null,
};
*/
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
var PLAYER_XPOS = 50;
var PLAYER_YPOS = 50;
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
/*
//Buttons functions
var auctionButton = {};
var auctionBackButton = {};
var repairButton = {};
var bidButton = {};
var inventoryButton = {};
//Repair Shop Buttons
var purchaseButton = {};
var repairBackButton = {};
var addFundsButton = {};
var addFundsBackButoon = {};
*/
//AI
//Create an empty array of Bidders
var bidders = ["Sparkles ", "hotdog " ,"gangmanstyle ", "shinobi " ,"Noy " ,"Behemoth ", "Quatarian " ,"Ol G ", "Cindy ","Bobby ","Obama ", "OsamaBinBombin ","Ortega Mammon ","LOD Alexander ","Meatwad ","Candela","Oprah ","Jerry Springer ","Sam Jaxon ",
"Moody Blue ","Shitake Shroom ","Macabre ","Sancho Pancho ","Quijote ","Leo ","Centurion ","Omega Pepper ","Osiris Moon ","Sass McFrass ","Smiley ","Budapest Guy ","Larry Queen ","Special Head ","Primitivo Montoya ","The Skywalker ","Sam Squirrel ","Dante ","Sparkles King ","Onion Knight "];
//
//Global frame timer
//
var timer = 0;
var previousTime = Date.now();

var deltaTime = (Date.now() - previousTime) / 1000;
previousTime = Date.now();
timer += deltaTime;
var endGame = false;
//
//
//
var appState = GAME_MODE.SPLASH;	//appState is an integer

function resetStates()
{
	appState = GAME_MODE.RUNNING;
}