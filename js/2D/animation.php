<?php
//
//entities\meta.php
//Created by Tyler R. Drury, 10-09-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
if(!headers_sent() ){
    header('Content-type: application/javascript; charset: UTF-8');
}
?>
function Animation(spritesheet, frameSpeed, startFrame, endFrame){
    //
    var animationSequence = [];  // array holding the order of the animation
    var currentFrame = 0;        // the current frame to draw
    var counter = 0;             // keep track of frame rate

    //start and end range for frames
    for(var frameNumber = startFrame; frameNumber <= endFrame; frameNumber++){
        animationSequence.push(frameNumber);
    }
    // Update the animation
    this.update = function(){
        // update to the next frame if it is time
        if(counter == (frameSpeed - 1) ){
            currentFrame = (currentFrame + 1) % animationSequence.length;
        }
        // update the counter
        counter = (counter + 1) % frameSpeed;
    };

    this.draw = function(x, y){
        //Draw the current frame
        //datatype {integer} x - X position to draw
        //datatype {integer} y - Y position to draw
        //get the row and col of the frame
        var fpr = spritesheet.framesPerRow,
            row = Math.floor(
                animationSequence[currentFrame] / fpr
            ),
            col = Math.floor(
                animationSequence[currentFrame] % fpr
            ),
            fw = spritesheet.frameWidth,
            fh = spritesheet.frameHeight;

        context.drawImage(
            spritesheet.image,
            col * fw,
            row * fh,
            fw, fh,
            x, y,
            fw, fh
        );
    };
}
/*
function Animation(spritesheet, frameSpeed, startFrame, endFrame){
    //
    //start and end range for frames
    var anim = [];
    for(var frameNumber = startFrame; frameNumber <= endFrame; frameNumber++){
        anim.push(frameNumber);
    }
	return {
		animSeq:anim,  //animation sequence, array holding the order of the animation
		_curFrame:0,        // the current frame to draw
		_counter:0,             // keep track of frame rate		
        //
		update:function(){
            //Update the animation
            //update to the next frame if it is time
            if(this._counter == (frameSpeed - 1))
                this._curFrame = (currentFrame + 1) % animationSequence.length;
            
            //update the counter
            counter = (counter + 1) % frameSpeed;
		},
		draw:function(x, y){
            //Draw the current frame
            //datatype {integer} x - X position to draw
            //datatype {integer} y - Y position to draw
			//get the row and col of the frame
			var row = Math.floor(animationSequence[currentFrame] / spritesheet.framesPerRow),
			    col = Math.floor(animationSequence[currentFrame] % spritesheet.framesPerRow);
			
            context.drawImage(
			  spritesheet.image,
			  col * spritesheet.frameWidth, row * spritesheet.frameHeight,
			  spritesheet.frameWidth, spritesheet.frameHeight,
			  x, y,
			  spritesheet.frameWidth, spritesheet.frameHeight);
		}
	};
}
*/