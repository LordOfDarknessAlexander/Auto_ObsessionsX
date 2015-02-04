// define variables
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
}