<?php
if(!headers_sent() ){
    header('Content-type: application/javascript; charset: UTF-8');
}
require_once '../ao.php';
//require_once '../secure.php';
?>
// define variables
var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;
var frameID = 0;
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
    getAspect:function(){
        return (height == 0) ? 0 : width / height;
    }
};*/
function getTimestamp(){
    //gets the current system time(in milliseconds)
    return (window.performance && window.performance.now) ? window.performance.now() : new Date().getTime();
}

var aoTimer = {
    _prevTime:getTimestamp(), //time since last
	_dt:0.0,
	getDT:function(){
		//console.log(this._dt.toString() + ' miliseconds');
		return this._dt;	
	},
	init:function(){
		this._prevTime = getTimestamp(); //time since last
		this._dt = 0.0;
	},
    update:function(){
        //get delta time between frames
        var now = getTimestamp();   //in milliseconds
		
        this._dt = (now - this._prevTime);  
		//console.log('Now: ' + now.toString());   
        this._prevTime = now;
        //console.log('deltaTime: ' + this._dt.toString());
       // console.log('prevTime: ' + this._prevTime.toString());   
    }
};
var _curCarID = 0;
    
var player, stop;	//, ticker;

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
	money:50000,
	tokens:2,
	prestige:0,
	marker:0
};

function saveUser()
{	//saves user stats as a JSON string to the browsers local storage
<?php if(loggedIn() ){?>
    //pas.saveUser();
<?php
}
//else{
?>
	if(Storage.local !== null){
		Storage.local._stats = JSON.stringify(userStats);
        //Storage.local._carID = JSON.stringify(_curCarID);
	}
	//else local storage not available
<?php
//}
?>
}
function loadUser()
{	//serialize user stats from local storage, if played previously
<?php if(loggedIn() ){?>
    pas.query.loadUser();
<?php
}
else{?>
	if(Storage.local !== null){
        if('_curCarID' in Storage.local){
			_curCarID = JSON.parse(Storage.local._curCarID);
		}
		else{	//no previous save data
			_curCarID = 0;
		}
        
		if('_stats' in Storage.local){
			userStats = JSON.parse(Storage.local._stats);
		}
		else{
            //no previous save data in local storage,
            //set to default values
			userStats = {
				//fn:(data.uname),
				money:50000,
				tokens:0,
				prestige:0,
				marker:0
			};
		}
	}
<?php
}
?>
}

//States
var REPAIR;
var ADD_FUNDS;
var RUNNING;
var SPLASH;
var MAIN_MENU;

//var playSound;
var splashTimer = 600.00;
//InMenu UI Constants

var buttonsPlaceY = 200;
//Player Pos, should be local in Player class
//Bidder Pos
//var BIDDER_XPOS = 650;
//var BIDDER_YPOS = 250;
 
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
//
//AI
//Create an empty array of Bidders
//php funtions/generators can be used create user names
var bidders = ["Bidder_990 ", "Bidder_1090 " ,"Bidder_3490 ", "Bidder_320 " ,"Bidder_465 " ,"Bidder_2490 ", "Bidder_2190 " ,"Bidder_7890 ", "Bidder_90 ","Bidder_66990 ","Bidder_1090 ", "Bidder_2332 ","Bidder_4390 ","Bidder_890 ","Bidder_8720 ","Bidder_8976 ","Bidder_220 ","Bidder_1196 ","Bidder_8976 ",
"Bidder_6690 ","Bidder_4490 ","Bidder_6790 ","Bidder_8790 ","Bidder_10 ","Bidder_40 ","Bidder_430 ","Bidder_3390 ","Bidder_9 ","Bidder_621 ","Bidder_21430 ","Bidder_23450 ","Bidder_32345 ","Bidder_46574 ","Bidder_4597 ","Bidder_78765 ","Bidder_8765 ","Bidder_608 ","Sparkles King ","Bidder_7890 "];

var playerWon = false;

//Global frame timer
//var timer = 0;
var previousTime = Date.now();

var deltaTime = (Date.now() - previousTime) / 1000;
previousTime = Date.now();
//timer += deltaTime;

var endGame = false;
var auctionEnded = false;
var restartTimer = 0;

var appState = GAME_MODE.SPLASH;	
//Users login counts

var userLogged = false;


function resetStates(){
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
function strToDate(str){
    //convert a string of the format [Y-M-D H:M:S]
    //into a javascript date object
    //TODO:check, with re, that str is of proper format!
    //mySQL date month range is [1-12]
    //while javascript range is [0-11]
    var a = str.split(/[- :]/);
//<php if(debug()){
//>
    //console.log(JSON.stringify(a));
    //var d = new Date(a[0], a[1] - 1, a[2], a[3], a[4], a[5]);
    //console.log(JSON.stringify(d));
    //return d;
//<php
//}
//else{>
    return new Date(a[0], a[1] - 1, a[2], a[3], a[4], a[5]);
//<php
}
function strFromCurrentDate(){
	var d = new Date,
		dformat = [
			d.getFullYear(),
		    d.getMonth()+1,
		    d.getDate()
		].join('-') + ' ' +
		[
			d.getHours(),
			d.getMinutes(),
			d.getSeconds()
		].join(':');
		
	console.log(dformat);
	return dformat;
}		

function setAudio(enabled){
    var b = Boolean(enabled);
    
    if(Storage.local !== null ){
        Storage.local._audioEnabled = JSON.stringify(b);
    }
}
function audioEnabled(){
    var b = (Storage.local !== null && '_audioEnabled' in Storage.local)?
        Boolean(JSON.parse(Storage.local._audioEnabled) ) : true;
        
    //console.log("audio " + b);
        
    return b;
}
function toggleAudio(){
    setAudio(!audioEnabled());
}
var html = {
    _entityMap : {
        '&' : '&amp;',
        '<' : '&lt;',
        '>' : '&gt;',
        '"' : '&quot;',
        //
        "'" : '&#39;',
        "/" : '&#x2F;'
        //"\\" : '&#92;'      //start of an escape character
        //'\n' : '<br>'   //new line with line break(might cause issues in a <pre> tag)
    },
    escapeStr:function(str) {
        function rpl(s){
            //returns a char matched by str.replace
            //as an escaped html entity
            return html._entityMap[s];
        }
        var ret = String(str).replace(
            /[&<>"'\/]/g, rpl
        );
        return ret;
    }
};