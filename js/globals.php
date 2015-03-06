<?php
header('Content-type: application/javascript; charset: UTF-8');
require_once '../ao.php';
?>
// define variables
var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;
//var canUseSessionStorage = 'sessionStorage' in code && code.sessionStorage !== null;
//
var canvas = document.getElementById('canvas');	//$("#canvas")?
var context = canvas.getContext('2d');
//aspect ratio
var width = canvas.getAttribute('width'),
	height = canvas.getAttribute('height');
/*var canvas = {
    jqo : document.getElementById('canvas'),	//$("#canvas")?
    context:this.jqo.getContext('2d'),
    //aspect ratio
    width:canvas.getAttribute('width'),
	height:canvas.getAttribute('height')
};*/

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
	fn:'',
	money:0 ,
	tokens:2,
	prestige:0,
	marker:0
};

function saveUser()
{	//saves user stats as a JSON string to the browsers local storage
//<php if(loggedIn){?>
    var funcName = 'gloabals.js pas::saveUser()';
    /*jq.post('pas/update.php',
        function(data){
            if(data === null){
                alert(funcName + ', Error:ajax response returned null!');
                return;
            }
            alert(funcName + ', ajax response received:' + JSON.stringify(data) );
            //data saved to database!
        },
        function(jqxhr){
            //call will fail if result is not properly formatted JSON!
            alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
            //throw exception, game can't work without user stats
        },
        userStats
    );*/
//<php else{?>
	if(Storage.local !== null){
		Storage.local._stats = JSON.stringify(userStats);
	}
	//else local storage not available
//<php
//}
}
function loadUser()
{	//serialize user stats from local storage, if played previously
//<php if(loggedIn){?>
    pas.query.loadUser();
//<php
//}
//else{?>
	/*if(Storage.local !== null){
		if('_stats' in Storage.local){
			userStats = JSON.parse(Storage.local._stats);
			
		}
		else{	//no previous save data
			userStats = {
				//fn:(data.uname),
				money:50000,
				tokens:2,
				prestige:1,
				marker:0
			};
		}
	}*/
//<php
//}
//?>
}

var amoney;
var atokens;
var aprestige;
var amarkers;
//var fn;
function ajax_post()
{
    // Create our XMLHttpRequest object
    //var dataStr = ''; //args to pass to script
	//afn = userStats.fn;
	amoney = userStats.money;
	atokens = userStats.tokens;
	aprestige = userStats.prestige;
	amarkers = userStats.marker;

    var jqxhr = $.ajax({
        type:'POST',
        url:getHostPath() + 'my_parse_file.php',
        dataType:'json',
        //data:userStats
		 data:{money:amoney,tokens:atokens,prestige:aprestige,m_marker:amarkers}
    }).done(function(data){
        //the response string is converted by jquery into a Javascript object!
        if(data === null){
            alert('Error:ajax response returned null!');
            return;
        }
     //   alert('ajax response received:' + JSON.stringify(data) );
        //access and set values in the document's html page
		//$('div#statBar label#fname').text(data.uname);
        $('div#statBar label#money').text(data.money);
        $('div#statBar label#tokens').text(data.tokens);
        $('div#statBar label#prestige').text(data.prestige);
        $('div#statBar label#m_marker').text(data.m_marker);
		
		$('div#auctionStatBar label#money').text(data.money);
        $('div#auctionStatBar label#tokens').text(data.tokens);
        $('div#auctionStatBar label#prestige').text(data.prestige);
        $('div#auctionStatBar label#m_marker').text(data.m_marker);
    }).fail(function(jqxhr){
        //call will fail if result is not properly formatted JSON!
        alert('ajax call failed! Reason: ' + jqxhr.responseText);
        //throw exception, game can't work without user stats
    });
    
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
var ENEMY_X = 10;
var VEHICLE_XPOS = 690;
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
//php funtions/generators can be used create user names
var bidders = ["Bidder_990 ", "Bidder_1090 " ,"Bidder_3490 ", "Bidder_320 " ,"Bidder_465 " ,"Bidder_2490 ", "Bidder_2190 " ,"Bidder_7890 ", "Bidder_90 ","Bidder_66990 ","Bidder_1090 ", "Bidder_2332 ","Bidder_4390 ","Bidder_890 ","Bidder_8720 ","Bidder_8976 ","Bidder_220 ","Bidder_1196 ","Bidder_8976 ",
"Bidder_6690 ","Bidder_4490 ","Bidder_6790 ","Bidder_8790 ","Bidder_10 ","Bidder_40 ","Bidder_430 ","Bidder_3390 ","Bidder_9 ","Bidder_621 ","Bidder_21430 ","Bidder_23450 ","Bidder_32345 ","Bidder_46574 ","Bidder_4597 ","Bidder_78765 ","Bidder_8765 ","Bidder_608 ","Sparkles King ","Bidder_7890 "];

var vehiclePrice = 20000;

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
    //javascript function for returning path of project/site,
    //created from php
    return '<?php echo rootURL();?>';
}
function pbSetColor(jqPB, value){
    //sets the value and color of an html progress bar, using jQuery
    if(value >= 0.66 && value <= 1.0){
        jqPB.attr('class', 'high');
    }
    else if(value >= 0.33 && value < 0.66){
        jqPB.attr('class', 'med');
    }
    else{
        jqPB.attr('class', '');
    }
    jqPB.attr('value', value);
}