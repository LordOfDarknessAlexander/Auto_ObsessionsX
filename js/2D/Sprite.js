//
function Sprite(x, y, type){
    //Sprites are anything drawn to the screen (ground, enemies, etc.)
    //
	//this.position = new Vector2(x,y);
	//this.size = new Vector2(standWidth,standWidth);
	this.x      = x;
	this.y      = y;
	this.width  = standWidth;
	this.height = standWidth;
	this.type   = type;
	
    Vector.call(this, x, y, 0, 0);
	
	this.update = function(){
        //Update the Sprite's position by the player's speed
		this.dx = -player.speed;
		this.advance();
	};	
	
	this.draw = function(){
        //Draw the sprite at it's current position
		context.save();
		context.translate(0.5,0.5);
		context.drawImage(assetLoader.images[this.type], this.x, this.y);
		context.restore();
	};
}
Sprite.prototype = Object.create(Vector.prototype);
//UPDATE
/*function Sprite(x, y, type) 
{	//create and return a new object({};)
	return {
		position : Vector2(x,y),
		size : Vector2(standWidth,standWidth),
		type : type,	
		//Update the Sprite's position by the player's speed
		update : function(){
			this.dx = -player.speed;
			this.advance();
		},	
		//Draw the sprite at it's current position
		draw : function(){
			context.save();
			context.translate(0.5,0.5);
			context.drawImage(assetLoader.images[this.type], this.x, this.y);
			context.restore();
		}
	};
}*/