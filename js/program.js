$(document).ready(function ()
{

	function init()
	{
	  if (!stop) 
	  {
	    requestAnimFrame( init);
	  
	  	update();
	  	
	    if(timer >= 400.00)
		{
		  mainMenu();
		  
		}  
		timer ++;
	    ticker++;
	  }
	
	}
	function auctionInit()
	{
	  if (!auctionStop) 
	  {
	    requestAnimFrame( auctionInit);
	  
	  	update();
		timer ++;
	    ticker++;
	  }
	
	}


//
//
//TODO, access from html database, or other markup file
//
/*
var userGarage = [
	Vehicle(car.name, car.price, car.originality, car.condition)
];
var vDoc = document.querySelector('link[rel="import"]');	//document Vehicles.html
var vehicles = document.getElementById('Vehicles');
var cn = vehicles.firstChild;
for(var carNode in vehicles.childNodes){
	var newCar = Vehicle(car)
	//instantiate js object or retain html node 'car' for read only access
}

function loadUsergarage(){
	//serialize user cars from html, to be upgraded
	userDoc = 
	for(var car in garage){
		var dbCarNode = dbCars.getElementById(car.id)
		userCars.append(new Vehicle(dbCarNode) );
	}
}

*/

// set the sound preference
if (canUseLocalStorage) 
{
  playSound = (localStorage.getItem('kandi.playSound') === "true")

  if (playSound) 
  {
    $('.sound').addClass('sound-on').removeClass('sound-off');
  }
  else 
  {
    $('.sound').addClass('sound-off').removeClass('sound-on');
  }
}


//Asset pre-loader object. Loads all images
var assetLoader = (function() 
{
  // images dictionary
  this.images        = 
  {
 	  //player
     'avatar_normal'  : 'images/normal_walk.png',
     
   };

  // sounds dictionary
  this.sounds      = 
  {
    'bg'            : 'sounds/D.mp3',
    'jump'          : 'sounds/jump.mp3',
    'gameOver'      : 'sounds/gameOver.mp3'
  };

  var assetsLoaded = 0;                                // how many assets have been loaded
  var numImages      = Object.keys(this.images).length;    // total number of image assets
  var numSounds    = Object.keys(this.sounds).length;  // total number of sound assets
  this.totalAssest = numImages;                          // total number of assets

   //Ensure all assets are loaded before using them
   // datatype {number} dic  - Dictionary name ('images', 'sounds', 'fonts')
   // datatype {number} name - Asset name in the dictionary
  function assetLoaded(dic, name) 
  {
    // don't count assets that have already loaded
    if (this[dic][name].status !== 'loading') 
    {
      return;
    }

    this[dic][name].status = 'loaded';
    assetsLoaded++;

    // progress callback
    if (typeof this.progress === 'function') 
    {
      this.progress(assetsLoaded, this.totalAssest);
    }

    // finished callback
    if (assetsLoaded === this.totalAssest && typeof this.finished === 'function') 
    {
      this.finished();
    }
  }

  //Check the ready state of an Audio file.
  //datatype {object} sound - Name of the audio asset that was loaded.
   
  function _checkAudioState(sound) 
  {
    if (this.sounds[sound].status === 'loading' && this.sounds[sound].readyState === 4) 
    {
      assetLoaded.call(this, 'sounds', sound);
    }
  }
  
  //Create assets, set callback for asset loading, set asset source
  this.downloadAll = function() 
  {
    var _this = this;
    var src;

    //Load images
    for (var image in this.images) 
    {
      if (this.images.hasOwnProperty(image)) 
      {
        src = this.images[image];

        // create a closure for event binding
        (function(_this, image) {
          _this.images[image] = new Image();
          _this.images[image].status = 'loading';
          _this.images[image].name = image;
          _this.images[image].onload = function() { assetLoaded.call(_this, 'images', image) };
          _this.images[image].src = src;
        })(_this, image);
      }
    }

    //Load sounds
    for (var sound in this.sounds) 
    {
      if (this.sounds.hasOwnProperty(sound)) 
      {
        src = this.sounds[sound];

        // create a closure for event binding
        (function(_this, sound) {
          _this.sounds[sound] = new Audio();
          _this.sounds[sound].status = 'loading';
          _this.sounds[sound].name = sound;
          _this.sounds[sound].addEventListener('canplay', function() 
          {
            _checkAudioState.call(_this, sound);
          });
          _this.sounds[sound].src = src;
          _this.sounds[sound].preload = 'auto';
          _this.sounds[sound].load();
        })(_this, sound);
      }
    }
  }
  
  return {
    images: this.images,
    sounds: this.sounds,
    totalAssest: this.totalAssest,
    downloadAll: this.downloadAll
  };
})();


//Show asset loading progress
//@datatype {integer} progress - Number of assets loaded
//@datatype {integer} total - Total number of assets
assetLoader.progress = function(progress, total) 
{
  var pBar = document.getElementById('progress-bar');
  pBar.value = progress / total;
  document.getElementById('p').innerHTML = Math.round(pBar.value * 100) + "%";
}

//Load the splash screen first
assetLoader.finished = function() 
{
 switchStates();
}

//Garage Doors	
splashImage.onload = function()
{
	context.drawImage(splashImage, 0,0);
	

};
//Main Background of game
backgroundImage.onload = function()
{
	context.drawImage(backgroundImage, 50, -10);
}	
	
function garageDoor()
{
	backgroundY -= speed;
	if(backgroundY == -1 * height)
	{
		backgroundY = -1000;
	}
}	
//States
var appState;
var GameMode = 
{
	Splash   : 1,
	Main_Menu : 2,
	Running : 3,
	Auction : 4,
	Repair : 5,
	AddFunds :6,
	

};
appState = GameMode.Splash;	//app may only exist in one state at a time


function switchStates( GameMode) 
{
	 
	 switch (GameMode) 
	 {
	 	 case Splash:
		        splash();
		        break;
		        
		  case Main_Menu:
		        mainMenu();
		    	break;  
		           
	      case Auction:
		        auctionMode();
		        break;
		        
		  case Repair:
		        repairState();
		        break;
		        
		  case AddFunds:
		    	addFundsMode();
		    	
		    	
		    default:
		         Running; 
	     // etc...
	 }
}

function update(deltaTime)
{
    
    garageDoor();
	//Order of draws matters
    context.drawImage(backgroundImage, 0,-10);
    context.drawImage(splashImage, 0, backgroundY);
    timer ++;
	
	if(appState == GameMode.Auction)
	{
		
		updatePlayer();
		//call bidder ai functions
		bidTimers();
		enemyBidding();
		currentBidder();
		//price();
		if(playerDidBid)
		{
			bidderCooldown ++;
			enemyCanBid = false;
		}
	  
	  	if(	bidderCooldown >= ENEMY_WAIT)
	  	{
	  		enemyCanBid = true;
	  		bidderCooldown = 0;
	  		
	  	}
	  	findEndBidder();
	  	renderAuction();
	}
	else
	{
		
		this.GameMode = Running;
		
	}
	
}



//Creates a Spritesheet
//datatype {string} - Path to the image.
//datatype {number} - Width (in px) of each frame.
//datatype {number} - Height (in px) of each frame.

function SpriteSheet(path, frameWidth, frameHeight) 
{
  this.image = new Image();
  this.frameWidth = frameWidth;
  this.frameHeight = frameHeight;

  // calculate the number of frames in a row after the image loads
  var self = this;
  this.image.onload = function() 
  {
    self.framesPerRow = Math.floor(self.image.width / self.frameWidth);
  };

  this.image.src = path;
}

//Creates an animation from a spritesheet.
//datatype {SpriteSheet} - The spritesheet used to create the animation.
//datatype {number}      - Number of frames to wait for before transitioning the animation.
//datatype {array}       - Range or sequence of frame numbers for the animation.
//datatype{boolean}     - Repeat the animation once completed.
 
function Animation(spritesheet, frameSpeed, startFrame, endFrame) 
{

  var animationSequence = [];  // array holding the order of the animation
  var currentFrame = 0;        // the current frame to draw
  var counter = 0;             // keep track of frame rate

  // start and end range for frames
  for (var frameNumber = startFrame; frameNumber <= endFrame; frameNumber++)
    animationSequence.push(frameNumber);

   // Update the animation
  this.update = function() 
  {
    // update to the next frame if it is time
    if (counter == (frameSpeed - 1))
      currentFrame = (currentFrame + 1) % animationSequence.length;

     // update the counter
     counter = (counter + 1) % frameSpeed;
  };


// Draw the current frame
// datatype {integer} x - X position to draw
// datatype {integer} y - Y position to draw

  this.draw = function(x, y) 
  {
    // get the row and col of the frame
    var row = Math.floor(animationSequence[currentFrame] / spritesheet.framesPerRow);
    var col = Math.floor(animationSequence[currentFrame] % spritesheet.framesPerRow);

    context.drawImage(
      spritesheet.image,
      col * spritesheet.frameWidth, row * spritesheet.frameHeight,
      spritesheet.frameWidth, spritesheet.frameHeight,
      x, y,
      spritesheet.frameWidth, spritesheet.frameHeight);
  };
}

 //A vector for 2d space.
 
// datatype {integer} x - Center x coordinate.
// datatype {integer} y - Center y coordinate.
// @datatype {integer} dx - Change in x.
// datatype {integer} dy - Change in y.
function Vector(x, y, dx, dy) 
{
  // position
  this.x = x || 0;
  this.y = y || 0;
  // direction
  this.dx = dx || 0;
  this.dy = dy || 0;
}


// Move the player advance the vectors position by dx,dy
Vector.prototype.advance = function() 
{
  this.x += this.dx;
  this.y += this.dy;
};

//Vehicles

// The player object
var player = (function(player) 
{
  // add properties directly to the player imported object
  player.width     = 60;
  player.height    = 96;
  player.speed     = 6;
  player.dy        = 0;
 
  // spritesheets
  player.sheet     = new SpriteSheet('images/normal_walk.png', player.width, player.height);
  player.walkAnim  = new Animation(player.sheet, 4, 0, 15);
  player.jumpAnim  = new Animation(player.sheet, 4, 15, 15);
  player.fallAnim  = new Animation(player.sheet, 4, 11, 11);
  player.anim      = player.walkAnim;

  Vector.call(player,  PLAYER_XPOS,  PLAYER_YPOS, 0, player.dy);

  //update
   player.update = function() 
  {
    player.anim = player.walkAnim;
    player.anim.update();
  };

  //Draw the player at it's current position
   
  player.draw = function() 
  {
    player.anim.draw(player.x, player.y);
  };

  // Reset the player's position
  player.reset = function() 
  {
    player.x = PLAYER_XPOS;
    player.y = PLAYER_YPOS;
  };

  return player;
})(Object.create(Vector.prototype));

/**
 * Sprites are anything drawn to the screen (ground, enemies, etc.)*/
function Sprite(x, y, type) 
{
  this.x      = x;
  this.y      = y;
  this.width  = standWidth;
  this.height = standWidth;
  this.type   = type;
  Vector.call(this, x, y, 0, 0);

  //Update the Sprite's position by the player's speed
   
  this.update = function() 
  {
    this.dx = -player.speed;
    this.advance();
  };

  // Draw the sprite at it's current position
  this.draw = function() 
  {
    context.save();
    context.translate(0.5,0.5);
    context.drawImage(assetLoader.images[this.type], this.x, this.y);
    context.restore();
  };
}
Sprite.prototype = Object.create(Vector.prototype);
//Game Loop 

function updatePlayer() 
{
  
  player.update();
  player.draw();

}
//Request Animation Polyfill
var requestAnimFrame = (function()
{
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          window.oRequestAnimationFrame      ||
          window.msRequestAnimationFrame     ||
          function(callback, element){
            window.setTimeout(callback, 1000 / 60);
          };
})();


//Sort Items arrays
function shuffleArray(array) 
{
    var counter = array.length, temp, index;

    // While there are elements in the array
    while (counter > 0) 
    {
        // Pick a random index
        index = Math.floor(Math.random() * counter);

        // Decrease counter by 1
        counter--;

        // And swap the last element with it
        temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
       
    }

    return array;
}
function bidTimers()
{
	if(startEndBid)
	{ 
		endBidTimer ++;
	}
	else
	{
		endBidTimer = 0;
	}
	if(startEndBid2)
	{ 
		endBidTimer2 ++;
	}
	else
	{
		endBidTimer2 = 0;
	}
	if(startEndBid3)
	{ 
		endBidTimer3 ++;
	}
	else
	{
		endBidTimer3 = 0;
	}
	if(startEndBid4)
	{ 
		endBidTimer4 ++;
	}
	else
	{
		endBidTimer4 = 0;
	}
	if(startPlayerEndBid)
	{
		playerEndBidTimer ++;
	}
	else
	{
		playerEndBidTimer = 0;
	}	
}

//Game HUD
function renderAuction()
{
	var player1;
  	var player2;
  	var player3;
  	var player4;
  	
	if(( playerBid == currentBid)&& (playerDidBid))
  	{
  		player.y = 10;
  		context.fillText('Player Bid :  '   +'$'+ playerBid.toFixed(2)  ,ENEMY_X, 90);
  	}
  	else
  	{
  	  player.y = 150;
  	  context.fillText('Player Bid :  '   +'$'+ playerBid.toFixed(2)  ,ENEMY_X, 230);
  	}
  	
  	if((playerBid == enemyBids[0]) || (playerBid == enemyBids[1]) || (playerBid == enemyBids[2]) || (playerBid == enemyBids[3]))
  	{
		playerBid != currentBid;
		
	}
	
	//ENENMY HUD
	
  	//Enemy 1
	//draw them depending on current bid
  	if((enemyBids[0] >= currentBid)|| ( enemyBids[4] >= currentBid))
  	{
  		player1 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[0] + '$'+ enemyBids[0].toFixed(2) ,ENEMY_X , 70);
  		  		
  	}
  	else
  	{
  		player1 = context.drawImage(slimer,10,100) + context.fillText( bidders[0] + '$'+ enemyBids[0].toFixed(2) ,ENEMY_X, 120);
  	  	
  	}
    //Enemy 2
  	if( ( enemyBids[1] >= currentBid) || ( enemyBids[5] >= currentBid))
  	{
  		player2 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[1] + '$'+ enemyBids[1].toFixed(2) ,ENEMY_X , 70);
  		
  	}
  	else
  	{
  		player2 = context.drawImage(slimer,10,130) + context.fillText(bidders[1] + '$'+ enemyBids[1].toFixed(2) ,ENEMY_X, 160);
  		
  	}
  	//Enemy3
  	if(( enemyBids[2] >= currentBid) || ( enemyBids[6] >= currentBid))
  	{
  	    player3 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[2] + '$'+ enemyBids[2].toFixed(2) ,ENEMY_X , 70);
  	 	
  	}
  	else
  	{
  		 player3 = context.drawImage(slimer,10,150) + context.fillText(bidders[2] + '$'+ enemyBids[2].toFixed(2) ,ENEMY_X, 180);
  		 
  	}
  	//Enemy4
  	if(( enemyBids[3] >= currentBid) || ( enemyBids[7] >= currentBid))
  	{
  	    player4 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[3] + '$'+ enemyBids[3].toFixed(2) ,ENEMY_X , 70);
  	 	
  	}
	else
	{
		player4 =  context.drawImage(slimer,10,170) + context.fillText(bidders[3] + '$'+ enemyBids[3].toFixed(2) ,ENEMY_X, 200);
		
	}
	
    //current bid HUD
    var gorguts;
    gorguts = context.drawImage(curBidImage,360,84)+ context.fillText('Current Bid :  ' + '$'+ currentBid.toFixed(2)  ,426, 114);
    
	    //current bid
    context.fillText('Vehicle Price :  ' + '$'+ vehiclePrice.toFixed(2)  ,400, 90);
    
    context.fillText('Game Timer :  ' + timer.toFixed(2)  ,200, 400);
      // draw the money HUD
    context.fillText('Money :  ' + '$'+ money.toFixed(2)  , canvas.width - 240, 66);
    //player bid
    /*
    context.fillText('End Bid Time :  ' + bidders[0] + endBidTimer  ,200, 460);
    context.fillText('End Bid Time2 :  ' + bidders[1] + endBidTimer2  ,200, 480);
    context.fillText('End Bid Time3 :  ' + bidders[2] + endBidTimer3  ,200, 500);
    context.fillText('End Bid Time4 :  ' + bidders[3] + endBidTimer4  ,200, 520);
    context.fillText('End Bid Time Player :  ' + playerEndBidTimer  ,200, 540);
    */
    
}
//Show the splash after loading all assets 
function splash() 
{
  document.getElementById('splash');
  init();
  update();
  appState = GameMode.Splash;
  if(appState == GameMode.Splash)
  {
	 console.log("Splashing");
  }	
  
  $('#progress').hide();
  $('#splash').show();
  $('.sound').show();
  
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
  appState = GameMode.Main_Menu;
  if(appState == GameMode.Main_Menu)
  {
	console.log("Main Menu");
  }
  
  $('#progress').hide();
  $('#splash').hide();
  $('#main').show();
  $('#menu').addClass('main');
  $('.sound').show();
}

// Start the game - reset all variables and entities, spawn ground and water.
function startGame() 
{
  context.clearRect(0, 0, canvas.width, canvas.height);
  document.getElementById('game-over').style.display = 'none';
  document.getElementById('gameMenu').style.display = 'true';  
  appState = GameMode.Running;
  player.reset();
  ticker = 0;
  stop = false;
  auctionStop = true;
  money = 50000;
  playerBid = 0;
  
  context.font = '26px arial, sans-serif';
  // Create gradient
  var gradient=context.createLinearGradient(36,40,600,1);
  gradient.addColorStop("0","magenta");
  gradient.addColorStop("0.5","blue");
  gradient.addColorStop("1.0","green");
  // Fill with gradient
  context.fillStyle = gradient;
  appState = GameMode.Running;
  
  switchStates();

  if(appState == GameMode.Running)
  {
	console.log("Run , run squirrel");

  }	

  assetLoader.sounds.gameOver.pause();
  assetLoader.sounds.bg.currentTime = 0;
  assetLoader.sounds.bg.loop = true;
  assetLoader.sounds.bg.play();
      
}
function resetStates()
{
	appState = GameMode.Running;
}

//Repair State
function repairState()
{
  stop = true;
  document.getElementById('RepairShop').style.display = 'true';
  appState = GameMode.Repair;
 // this.stop;
  if(appState == GameMode.Repair)
  {
	console.log("Man im in repairmode");

  }	
}
function addFundsMode()
{
  stop = true;
  appState = GameMode.AddFunds;
	
  document.getElementById('AddFunds').style.display = 'true';
  if(appState == GameMode.AddFunds)
  {
	console.log("save your money u cants save the world");
  }	

}
//Auction State
function auctionMode() 
{
   context.clearRect(0, 0, canvas.width, canvas.height);
   document.getElementById('Auction').style.display = 'true';
   auctionStop = false;
   appState = GameMode.Auction;
   ticker = 0;
   stop = true;
   auctionInit();
   money = 50000;
   playerBid = 0;
 	
   shuffleArray(enemyBids);
   shuffleArray(bidders);
   context.font = '26px arial, sans-serif';
  
      	
	if(appState == GameMode.Auction)
	{
		console.log("Snap, crackle , pop");
	}
	else
	{
		auctionStop = true;
		appState = GameMode.Running;
		//enemyBids.length = 0;
		resetStates();
	}		
  	 
  
   auctionMode.update = function() 
   {
     playerBidding();
     
   }
  
  $('#Auction').show();
  $('#menu').removeClass('gameMenu');
  $('#menu').addClass('Auction');
  $('.sound').show();

  assetLoader.sounds.gameOver.pause();
  assetLoader.sounds.bg.currentTime = 0;
  assetLoader.sounds.bg.loop = true;
  assetLoader.sounds.bg.play();
}

//Player Bidding Function
function playerBidding() 
{ 
	//player Cooldown button
	if(	bidderCooldown >= PLAYER_WAIT)
	{
  		playerBid = currentBid + playerNextBid;
  		playerCanBid = true;
  		bidderCooldown = 0;
  		startEndBid = false;
		startEndBid2 = false;
		startEndBid3 = false;
		startEndBid4 = false;
		startPlayerEndBid = true;
	  		
	}
	
	if(playerBid <= money)
	{
		playerDidBid = true;
	
	}
	else
	{
	//cant bid above your cash 
	//call a new function to alert player hes &$#k up
	 gameOver();
	 
	 startPlayerEndBid = false;
	}
	//Wins BId	
	if((enemyBids[0] == 0) && (enemyBids[1] == 0) && (enemyBid[2] == 0) && (enemyBid[3] == 0) && (money >= currentBid))
	{
	  money = money - currentBid;
	}
	
	if(money <= 0)
	{
		money = 0;
		gameOver();	
	}
}
//Player Bidding Function
function currentBidder()
{
	//Player has the current bid
	if((playerBid > enemyBids[0])&&(playerBid > enemyBids[1])&&(playerBid > enemyBids[2])&&(playerBid > enemyBids[3]))
	{
	   currentBid = playerBid;
	   
	}
	//Find the player who has the highest bid dirty way enemy bidder 1 if it is not players bid then call func to find thru enemies
	else if((playerBid < enemyBids[0])||(playerBid < enemyBids[1])||(playerBid < enemyBids[2])||(playerBid < enemyBids[3]))
	{
	  bidFinder();
	  
	}
	
}

function bidFinder()
{

	if((enemyBids[0] > enemyBids[1]) && (enemyBids[0] > enemyBids[2]) && (enemyBids[0] > enemyBids[3]))
	{
		currentBid = enemyBids[0];
		startEndBid = true;
		startEndBid2 = false;
		startEndBid3 = false;
		startEndBid4 = false;
		startPlayerEndBid = false;
		 
	}
	else if((enemyBids[1] > enemyBids[0]) && (enemyBids[1] > enemyBids[2]) && (enemyBids[1] > enemyBids[3]))
	{
		currentBid = enemyBids[1];
		startEndBid = false;
		startEndBid2 = true;
		startEndBid3 = false;
		startEndBid4 = false;
		startPlayerEndBid = false;

	}
	else if((enemyBids[2] > enemyBids[0]) && (enemyBids[2] > enemyBids[1]) && (enemyBids[2] > enemyBids[3]))
	{
		currentBid = enemyBids[2];
		startEndBid = false;
		startEndBid2 = false;
		startEndBid3 = true;
		startEndBid4 = false;
		startPlayerEndBid = false;

	}
	else if((enemyBids[3] > enemyBids[0]) && (enemyBids[3] > enemyBids[1]) && (enemyBids[3] > enemyBids[2]))	
	{
		currentBid = enemyBids[3];
		startEndBid = false;
		startEndBid2 = false;
		startEndBid3 = false;
		startEndBid4 = true;
		startPlayerEndBid = false;
	}
	
	
}

function enemyBidding() 
{
	//upPercentage of vehicle for next bid
	var upPerc =  0.18 * currentBid;
	var startBid = vehiclePrice * 0.02;
	//var upPerc = startBid ;
	if( currentBid >= 0 )
	{
		if((enemyBids[0] < currentBid) && (enemyBids[0] < enemyCap)&&(enemyCanBid))
		{
		  enemyBids[0]  = currentBid + upPerc;
		  
		}
		else if((enemyBids[1] < currentBid) && (enemyBids[1] < enemyCap2)&&(enemyCanBid))
		{
		    enemyBids[1] = currentBid + upPerc;
		    
		}
		else if((enemyBids[2] < currentBid) && (enemyBids[2] < enemyCap3)&&(enemyCanBid))
		{
		    enemyBids[2] = currentBid + upPerc;
		    
		}
		else if((enemyBids[3] < currentBid) && (enemyBids[3] < enemyCap4)&&(enemyCanBid))
		{
		    enemyBids[3] = currentBid + upPerc;
		    
		}

					
	}
	else if((playerBid >enemyBids[0]) && (playerBid >enemyBids[1]) && (playerBid >enemyBids[2]) &&(playerBid >enemyBids[3]))
	{
		sold();
		money = money - currentBid;
	}
	

}

function findEndBidder()
{
	if((currentBid == enemyBids[0]) && (endBidTimer >= BID_THRESHOLD))
	{
		gameOver();
	    alert("Sold to " + bidders[0]);
		
	}
	else if((currentBid == enemyBids[1]) && (endBidTimer2 >= BID_THRESHOLD))
	{
		gameOver();
		 alert("Sold to " + bidders[1]);
	}
	else if ((currentBid == enemyBids[2]) && (endBidTimer3 >= BID_THRESHOLD))
	{
		gameOver();
		 alert("Sold to " + bidders[2]);
	}
	else if((currentBid == enemyBids[3]) && (endBidTimer4 >= BID_THRESHOLD))
	{
		gameOver();
		 alert("Sold to " + bidders[3]);
	}
	
}
//End the game and restart
function gameOver() 
{
  document.getElementById('game-over').style.display = 'true';
  resetStates();
  stop = true;
  auctionStop = true;
  //Show a message that player has insufficient funds
  $('#money').html(money);
  $('#game-over').show();
 // assetLoader.sounds.bg.pause();
  assetLoader.sounds.gameOver.currentTime = 0;
  assetLoader.sounds.gameOver.play();
}

//push vehicle in to inventory and tell player he won bidding
function sold() 
{
  document.getElementById('sold').style.display = 'true';
  stop = true;
  auctionStop = true;
  $('#enemyBid').html(enemyBid);
  $('#sold').show();
  assetLoader.sounds.bg.pause();
  assetLoader.sounds.gameOver.currentTime = 0;
  assetLoader.sounds.gameOver.play();
}

// Click handlers for the different menu screens
//Credits 
$('.credits').click(function() 
{
  $('#main').hide();
  $('#menu').addClass('credits');
  $('#credits').show();
});
//Credits Back button
$('.back').click(function() 
{
  $('#credits').hide();
  $('#menu').removeClass('credits');
});
//Menu state start game button
$('.play').click(function() 
{
  $('#menu').hide();
  $('#gameMenu').show();
  startGame();
});
//GameOver screen restart button
$('.restart').click(function() 
{
  $('#game-over').hide();
  $('#gameMenu').hide();

  resetStates();
  startGame();
});

//InMenuButtons
//auction Button
$('#auction').click(function() 
{
	$('#auction').show();
	$('#gameMenu').hide();
	$('#menu').addClass('auction'); 	
	auctionMode();
});
//Auction State Back Button
$('#auctionBackButton').click(function()
{
	resetStates();
	startGame();
  
  $('#menu').removeClass('Auction');
  $('#Auction').hide();
  $('#menu').addClass('gameMenu');
  $('#gameMenu').show();
  
});
//Inside Auction Bid Button
$('#bid').click(function()
{
  playerBidding();
  playerDidBid = true;
});

//Repair to menu Repair
$('#repair').click(function()
{
  $('#gameMenu').hide();
  $('#RepairShop').show();
  repairState();

});
//RepairMenu Back Button 
$('#repairBackButton').click(function()
{
  $('#RepairShop').hide();
  $('#gameMenu').show();
  resetStates();

});
//Game Menu Add funds portal button
$('#addFunds').click(function() 
{
	$('#gameMenu').hide();
    $('#AddFunds').show();
    $('#menu').addClass('AddFunds');
	addFundsMode();
	
});
//Inside AddFunds State Bacjbutton 
$('#addFundsBackButton').click(function()
{
  $('#AddFunds').hide();
  $('#gameMenu').show();
  
});

//Sound Button
$('.sound').click(function() 
{
  var $this = $(this);
  // sound off
  if ($this.hasClass('sound-on')) 
  {
    $this.removeClass('sound-on').addClass('sound-off');
    playSound = false;
  }
  // sound on
  else 
  {
    $this.removeClass('sound-off').addClass('sound-on');
    playSound = true;
  }
  if (canUseLocalStorage) 
  {
    localStorage.setItem('kandi.playSound', playSound);
  }
  // mute or unmute all sounds
  for (var sound in assetLoader.sounds) 
  {
    if (assetLoader.sounds.hasOwnProperty(sound)) 
    {
      assetLoader.sounds[sound].muted = !playSound;
    }
  }
});

assetLoader.downloadAll();
});