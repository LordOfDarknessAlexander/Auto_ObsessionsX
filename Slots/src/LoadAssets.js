var canUseLocalStorage = 'localStorage' in window && window.localStorage !== null;

// set the sound preference
if(canUseLocalStorage) 
{
  playSound = (localStorage.getItem('kandi.playSound') === "true")

  if(playSound) 
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
 	 //background
     'background_normal'  : 'images/slotbody.png',
     
     //Reel images
     'car1' : 'images/ReelImages/38coupe.png',
     'car2'	: 'images/ReelImages/baracuda.png',
     'car3'	: 'images/ReelImages/charger.png',
     'car4'	: 'images/ReelImages/cobra.png',
     'car5'	: 'images/ReelImages/judgeGTO.png',
     'car6'	: 'images/ReelImages/lilredexpress.png',
     'car7'	: 'images/ReelImages/mustang.png',
     'car8'	: 'images/ReelImages/shelby500.png',
     'car9'	: 'images/ReelImages/superbee.png',
     'car0'	: 'images/ReelImages/torino.png',     
     
     //Buttons
	'slotStop': 'images/Buttons/stopButton.png',
	'spinButton': 'images/Buttons/SpinButton.png',
	'raiseBetButton': 'images/Buttons/up_Arrow.png',
	'lowerBetButton': 'images/Buttons/down_Arrow.png',
	'maxBetButton': 'images/Buttons/MaxBetButton.png',
	'minBetButton': 'images/Buttons/minBetButton.png',
	
	//Lights
			
	//Left
	'lowerLeftHead' : 'images/Lights/leftLowerHeadon.png',
	'lowerLeftRunning' : 'images/Lights/leftLowerRunningon.png',
	'upperLeftHead' : 'images/Lights/leftUpperHeadon.png',
	'upperLeftRunning' : 'images/Lights/leftUpperRunningon.png',
	'leftSignal' : 'images/Lights/leftsignalon.png',
	
	//Right
	'rightSignal' : 'images/Lights/RightSignalOn.png',
	'lowerRightHead' : 'images/Lights/lowerRightHeadON.png',
	'lowerRightRunning' : 'images/Lights/upperRightRunningOn.png',
	'upperRightHead' : 'images/Lights/lowerRightHeadON.png',
	'upperRightRunning' : 'images/Lights/upperRightRunningOn.png',


   };

  // sounds dictionary
  this.sounds      = 
  {
    /*'engine'		: 'sounds/engine.wav',*/
    'youLose' : 'sounds/car_skid_and_crash.mp3',
	'reelSpinning' : 'sounds/single_race_car_passing_by_1.mp3',
	'startSpin' : 'sounds/auto_car_pull_away_squealing_tyres.mp3',
	'betSound'	: 'sounds/coin_drop.mp3',
	'winSound' : 'sounds/gold_coins.mp3'

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
  //$('.progress-bar')
  var pBar = document.getElementById('progress-bar');
  pBar.value = progress / total;
  //$('.p')
  document.getElementById('p').innerHTML = Math.round(pBar.value * 100) + "%";
}

	
	

