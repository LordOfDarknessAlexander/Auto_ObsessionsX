// define variables
var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
//aspect ratio
var width = canvas.getAttribute('width');
var height = canvas.getAttribute('height');
var player, money, stop, ticker;
//random comment

var playSound;
var splashTimer = 600.00;
//InMenu UI Constansts

var buttonsPlaceY = 200;
//Enemy Bid Timer check
var BID_THRESHOLD = 4000;
//Player Pos
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

//AuctionMode Game HUD bool 
//the app can not exit in a superposition of states,
//having multiple booleans means being inAuctionMode and inRepairMode and/or inAddFundmode,
//at the same time is possible, which is no possible and could lead to bugs!
var inAuctionMode = false;
var inRepairMode = false;
var inAddFundsMode = false;

//AI Variables
var playerBid = 0;
//temp
var bidAmount = 200;
var currentBid = 0;
//var asking = upPerc + currentBid;
var vehiclePrice = 20000;
//static bidding caps results in obvious behaviour,
//ie. starting an auction with more than 1.25 of vehicle price will always win
function price(){return Math.random(0.2, 1.25) * vehiclePrice;}
//var enemyCap = [price(), price(), price(), price()];	//new array for every new auction?
var enemyCap = 1.25 * vehiclePrice;
var enemyCap2 = 0.8 * vehiclePrice;
var enemyCap3 = 0.7 * vehiclePrice;
var enemyCap4 = 0.9 * vehiclePrice;

//AI cooldown timer
var bidderCooldown = 0;
var playerCanBid = false;
var currentBid = vehiclePrice * 0.1;
var endBidTimer = 0;
var endBidTimer2 = 0;
var endBidTimer3 = 0;
var endBidTimer4 = 0;
var playerDidBid = false;

var playerNextBid = currentBid + (currentBid * 0.1);

//BidTImers Booleans
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
