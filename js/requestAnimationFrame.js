//Request Animation Polyfill
var requestAnimFrame = (function()
{
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          window.oRequestAnimationFrame      ||
          window.msRequestAnimationFrame     ||
          function(callback, element){
            window.setTimeout(callback, aoTimer.getDT());
          };
})();

function cancelAnimFrame(){		
	if(frameID)	{	
		(window.cancelAnimationFrame ||
		window.webkitCancelAnimationFrame ||
		window.webkitCancelRequestAnimationFrame ||
		window.mozCancelAnimationFrame)(frameID);
		frameID = 0;
	}
}