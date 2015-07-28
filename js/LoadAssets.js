// set the sound preference
//if(canUseLocalStorage){
//var playSound = audioEnabled();//(localStorage.getItem('kandi.playSound') === "true")

if(audioEnabled()) {
    var on = 'sound-on',
        off = 'sound-off';
        
    $('div.sound').addClass(on).removeClass(off);
}
else{
    var on = 'sound-on',
        off = 'sound-off';
        
    $('div.sound').addClass(off).removeClass(on);
}
//}

//Asset pre-loader object. Loads all images
var assetLoader = (function(){
    //
    this.images = {
        //images dictionary
        'avatar_normal' : 'images/normal_walk.png'     //player
    };

    this.sounds = {
        //sounds dictionary
        'bg'        : 'sounds/D.mp3',
        'jump'      : 'sounds/jump.mp3',
        'gameOver'  : 'sounds/gameOver.mp3',//this needs to change
        'bidder'    : 'sounds/bidders.mp3',
        'going'		: 'sounds/cheer.mp3',
        'sold'		: 'sounds/sold.mp3',
        //'engine': 'sounds/engine.wav',
        'engine': 'sounds/ferrari_engine_roar.mp3', //replace with a mustang engine
        'repair': 'sounds/car_fix.mp3'
    };

    var assetsLoaded = 0,                               // how many assets have been loaded
        numImages = Object.keys(this.images).length,    // total number of image assets
        numSounds = Object.keys(this.sounds).length;  // total number of sound assets
    
    this.totalAssest = numImages;                          // total number of assets

    //Ensure all assets are loaded before using them
    // datatype {number} dic  - Dictionary name ('images', 'sounds', 'fonts')
    // datatype {number} name - Asset name in the dictionary
    function assetLoaded(dic, name){
        // don't count assets that have already loaded
        var res = this[dic][name];  //resource
        
        if(res.status !== 'loading'){
            return;
        }

        res.status = 'loaded';
        assetsLoaded++;

        // progress callback
        if(typeof this.progress === 'function'){
            this.progress(assetsLoaded, this.totalAssest);
        }
        // finished callback
        if(assetsLoaded === this.totalAssest && typeof this.finished === 'function'){
            this.finished();
        }
    }
    //Check the ready state of an Audio file.
    //datatype {object} sound - Name of the audio asset that was loaded.
    function _checkAudioState(sound){
        var s = this.sounds[sound];
        
        if(s.status === 'loading' && s.readyState === 4){
            assetLoaded.call(this, 'sounds', sound);
        }
    }
    //Create assets, set callback for asset loading, set asset source
    this.downloadAll = function(){
        var _this = this,
            imgs = this.images,
            audio = this.sounds;
            
        var src = '';

        //Load images
        function _loadImg(image){
            _this.images[image] = new Image();
            
            var img = _this.images[image];
            
            img.status = 'loading';
            img.name = image;
            img.onload = function(){
                assetLoaded.call(_this, 'images', image)
            };
            img.src = src;
        };
        
        for(var k in imgs){
            //
            if(imgs.hasOwnProperty(k)){
                //
                src = imgs[k];
                // create a closure for event binding
                _loadImg(k);
            }
        }
        //Load sounds
        function _loadAudio(key){
            _this.sounds[key] = new Audio();
            
            var s = _this.sounds[key];
            
            s.status = 'loading';
            s.name = key;
            s.addEventListener(
                'canplay',
                function(){
                    _checkAudioState.call(_this, key);
                }
            );
            s.src = src;
            s.preload = 'auto';
            s.load();
        };
        
        for(var k in audio){
            //
            if(audio.hasOwnProperty(k) ){
                //
                src = audio[k];

                _loadAudio(k);
            }
        }
    }  
    return {
        images:this.images,
        sounds:this.sounds,
        totalAssest:this.totalAssest,
        downloadAll: this.downloadAll,
        toggleAudioMuted: function () {
            var s = assetLoader.sounds;

            for(var sound in s){
                if(s.hasOwnProperty(sound)){
                    s[sound].muted = !audioEnabled();
                }
            }
        },
        pauseAll:function(){
            if(audioEnabled() ){
                var s = assetLoader.sounds;

                for(var key in s){
                    if(s.hasOwnProperty(key)){
                        s[key].pause();
                    }
                }
            }
        },
        togglePauseAll:function(){
            //if audio is playing, pause, if paused, play
            if(audioEnabled() ){
                var s = assetLoader.sounds;

                for(var key in s){
                    if(s.hasOwnProperty(key)){
                        var p = s[key].paused;
                        s[key].paused = !p;
                    }
                }
            }
        },
        resetAll:function(){
            if(audioEnabled() ){
                var s = assetLoader.sounds;

                for(var key in s){
                    if(s.hasOwnProperty(key)){
                        s[key].pause();
                        s[key].currentTime = 0;
                    }
                }
            }
        }
    };
})();
//Show asset loading progress
//@datatype {integer} progress - Number of assets loaded
//@datatype {integer} total - Total number of assets
assetLoader.progress = function(progress, total){
    //
    //$('.progress-bar')
    var pBar = document.getElementById('progress-bar');
    pBar.value = progress / total;
    //$('.p')
    document.getElementById('p').innerHTML = Math.round(pBar.value * 100) + "%";
}
//Garage Doors	
splashImage.onload = function(){
	//context.drawImage(splashImage, 0,0);
};