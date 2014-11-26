//
//Sprites are anything drawn to the screen (ground, enemies, etc.)
//
function Sprite(x, y, type) 
{
	//this.position = new Vector2(x,y);
	//this.size = new Vector2(standWidth,standWidth);
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