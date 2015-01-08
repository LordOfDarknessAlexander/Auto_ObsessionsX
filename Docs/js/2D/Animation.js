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
/*
function Animation(spritesheet, frameSpeed, startFrame, endFrame) 
{
	return {
		animationSequence : [],  // array holding the order of the animation
		_curFrame : 0,        // the current frame to draw
		_counter : 0,             // keep track of frame rate
		
		// start and end range for frames
		for (var frameNumber = startFrame; frameNumber <= endFrame; frameNumber++)
		animationSequence.push(frameNumber);
		
		// Update the animation
		update : function() 
		{
		// update to the next frame if it is time
		if (counter == (frameSpeed - 1))
		  currentFrame = (currentFrame + 1) % animationSequence.length;
		
		 // update the counter
		 counter = (counter + 1) % frameSpeed;
		},
		// datatype {integer} x - X position to draw
		// datatype {integer} y - Y position to draw
		draw : function(x, y) 
		{	// Draw the current frame
			// get the row and col of the frame
			var row = Math.floor(animationSequence[currentFrame] / spritesheet.framesPerRow);
			var col = Math.floor(animationSequence[currentFrame] % spritesheet.framesPerRow);
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
