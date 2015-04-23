// The player object
var PLAYER_XPOS = 10;
var PLAYER_YPOS = 20;

var player = (function(player) 
{
  // add properties directly to the player imported object
  player.width     = 160;
  player.height    = 30;
  player.speed     = 6;
  player.dy        = 0;
 
  // spritesheets
  player.sheet     = new SpriteSheet('images/normal_walk.png', player.width, player.height);
  player.walkAnim  = new Animation(player.sheet, 4, 0, 6);
  player.jumpAnim  = new Animation(player.sheet, 4, 7, 10);
  player.fallAnim  = new Animation(player.sheet, 4, 11, 11);
  player.anim      = player.walkAnim;

  Vector.call(player,  PLAYER_XPOS,  PLAYER_YPOS, 0, player.dy);

  //update
   player.update = function() 
  {
    player.anim = player.walkAnim;
    player.anim.update();
    if(Auction.playerWinning)
	{
		player.anim = player.jumpAnim;
		player.anim.update();
	}
    
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
//UPDATE
/*
function player()
{
	return {
		position : Vector(PLAYER_XPOS, PLAYER_YPOS, 0, player.dy);
		size : Vector(PLAYER_XPOS, PLAYER_YPOS, 0, player.dy);
		speed     = 6;
		// spritesheets
		sheet : new SpriteSheet('images/normal_walk.png', player.width, player.height);
		walkAnim  : new Animation(player.sheet, 4, 0, 15);
		jumpAnim  : new Animation(player.sheet, 4, 15, 15);
		fallAnim  : new Animation(player.sheet, 4, 11, 11);
		anim      : player.walkAnim;
		//update
		update : function() 
		{
			this.anim = player.walkAnim;
			this.anim.update();
		},	
		draw : function() 
		{
			this.anim.draw(player.x, player.y);
		},		
		reset : function() 
		{
			this.position.x = PLAYER_XPOS;
			this.position.y = PLAYER_YPOS;
		}
	};
}*/

