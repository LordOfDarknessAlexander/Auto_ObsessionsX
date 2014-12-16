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
 	  //player
     'avatar_normal'  : 'images/normal_walk.png',
     
   };

  // sounds dictionary
  this.sounds      = 
  {
    'bg'            : 'sounds/D.mp3',
    'jump'          : 'sounds/jump.mp3',
    'gameOver'      : 'sounds/gameOver.mp3',
    'bidder'		: 'sounds/bidders.mp3',
    'going'			: 'sounds/jump.mp3',
    'sold'			: 'sounds/sold.mp3',
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
	

