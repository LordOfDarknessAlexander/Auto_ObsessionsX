// define variables
var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;
var canvas = document.getElementById('canvas');	//$("canvas")?
var context = canvas.getContext('2d');
//aspect ratio
var width = canvas.getAttribute('width');
var height = canvas.getAttribute('height');
var player, money, stop, ticker;
//random comment

//States
var Repair;
var AddFunds;
var Running;
var Splash;
var Main_Menu;

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

//AI
//Create an empty array of Bidders
var bidders = ["Sparkles ", "hotdog " ,"gangmanstyle ", "shinobi " ,"Noy " ,"Behemoth ", "Quatarian " ,"Ol G ", "Cindy ","Bobby ","Obama ", "OsamaBinBombin ","Ortega Mammon ","LOD Alexander ","Meatwad ","Candela","Oprah ","Jerry Springer ","Sam Jaxon ",
"Moody Blue ","Shitake Shroom ","Macabre ","Sancho Pancho ","Quijote ","Leo ","Centurion ","Omega Pepper ","Osiris Moon ","Sass McFrass ","Smiley ","Budapest Guy ","Larry Queen ","Special Head ","Primitivo Montoya ","The Skywalker ","Sam Squirrel ","Dante ","Sparkles King ","Onion Knight "];
var enemyBids = [1,2,3,4]; 

var PLAYER_WAIT = 300;
var ENEMY_WAIT = 500;
var playerBid = 0;
//temp
var bidAmount = 200;
var currentBid = 0;
//var asking = upPerc + currentBid;
var vehiclePrice = 20000;
//static bidding caps results in obvious behaviour,
//ie. starting an auction with more than 1.25 of vehicle price will always win
//function price(bias){return (lerp(Math.random(0.2, 1.25), bias, Math.random(0.0,1.0) ) * vehiclePrice;}	//result can also be weighted, prefering higher or lower bids
/*
function Enemy(bidCap)
{	//enemy class
	this.bidCap = bidCap;
	this.endBidTimer = 0;
	this.startEndBid = false;
	
	//this.reset = function((){
		//endBidTimer = 0;
		//startEndBid = false;
	}
}
//have a single array encapsulating all AI players,
//oppossed to seperate arrays for each property
//as names don't matter they can still be random
var enemies = [
	new Enemy(price()),
	new Enemey(price()),
	new Enemy(price()),
	new Enemy(price())
];	//new array for every new auction? preferably in the auction button qjuery callback
*/
var enemyCap = 1.25 * vehiclePrice;
var enemyCap2 = 0.8 * vehiclePrice;
var enemyCap3 = 0.7 * vehiclePrice;
var enemyCap4 = 0.9 * vehiclePrice;

//AI cooldown timer
var bidderCooldown = 0;
var playerCanBid = false;
var currentBid = vehiclePrice * 0.1;

var endBidTimers = [0,0,0,0];

var endBidTimer = 0;
var endBidTimer2 = 0;
var endBidTimer3 = 0;
var endBidTimer4 = 0;

var playerDidBid = false;
var enemyCanBid = false;
var playerNextBid = currentBid + (currentBid * 0.1);

//BidTImers Booleans
var startEndBids = [false,false,false,false];

var startEndBid = false;
var startEndBid2 = false;
var startEndBid3 = false;
var startEndBid4 = false;
var startPlayerEndBid = false;
var playerEndBidTimer = 0;

//DT
var timer = 0;
var previousTime = Date.now();

var deltaTime = (Date.now() - previousTime) / 1000;
previousTime = Date.now();
timer += deltaTime;
