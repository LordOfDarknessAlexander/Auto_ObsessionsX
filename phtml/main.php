<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
$OWNER_NAME = "Adam Glazer";
$AO_NAME = "Auto Obsessions";
$TD_NAME = "Tyler Drury";
$AS_NAME = "Alexander Sanchez";
$GLOBALS["backBtn"] = "<button id='backBtn'>Back</button>";
//$HOME_BTN = "<button id='home'>Home</button>";
//$HOME_CAR_IMG = "<img id="userCar>";
?>
<div class="wrapper">

	<!--root div element of web page!-->
	
    <div class="sound sound-off"></div>

    <div id="menu">
        <div id="progress">
            <div id="percent">Downloading: <span id="p"></span></div>
            <progress id="progress-bar" value="0"></progress>
        </div>
      
        <div id="splash">
            <h2><?php echo $OWNER_NAME." and ".$AO_NAME." Presents!";?></h2>
        </div>
     
        <div id="main">
            <h1><?php echo $AO_NAME;?></h1>
            
             <div id="login">
            	<fieldset>
                    <form method="post" action="Users/login.php">
                      <p>ENTER USER NAME <input type="text" name="username"></p>
                      <p> ENTER PASSWORD <input type="password" name="pword"></p>
                      <p><input type="submit"  name="submit" value="Log In"></p>
                    </form>
                </fieldset>
            </div>
            <ul>
               <li><a href="javascript:void(0)" class="button play">Start Game</a></li>
               <!--li><a href="javascript:void(0)" class="playGuest">Play as Guest</a></li-->
               <li><a href="javascript:void(0)" class="button credits">Credits</a></li>
               <li><a href="javascript:void(0)" class="button Register">Sign Up</a></li>
            </ul>
            <!--
            <form id='login'>
                User ID:	<input id='userID' type='text'><br>
                <button id='forgotID'>Forgot ID?</button><br>
                Password:	<input id='userPW' type='text'><br>
                <button id='forgotPW'>Forgot Password?</button><br>
            </form>
            -->
       
		</div>
      
        <div id="credits">
            <!--could just be a link at the bottom of the page-->
            <ul>
                <li class="artwork">Character design and art: <?php echo $AS_NAME;?></li>
            </ul>
            <ul>
                <li class="artwork">Programming Crew: <?php echo $AS_NAME.", ".$TD_NAME;?></li>
            </ul>
             
            <ul>
              <li class="developer">Developer: <?php echo $OWNER_NAME;?></li>
            </ul>
            <a href="javascript:void(0)" class="button back">Back</a>
        </div> 
    </div><!--end menu-->
      
   
    <canvas id="canvas" width="900" height="600">
        <p>You're browser does not support the required functionality to play this game.</p>
        <p>Please update to a modern browser such as <a href="www.google.com/chrome/‎">Google Chrome</a> to play.</p>
    </canvas>
    
<?php
//php includes the source html files here
/*function ro(src){
    require_once(src.".php");
}

$scripts = array(
    "gameMenu",
    "auction",
    "funds",
    "garage",
    "repair",
    "register",
    "js"
);
//scripts will be included in the order declared, ORDER MATTERS!
foreach($scripts as $val){
    ro($val);
}*/
//require_once("Users/bookmark_fns.php");
require_once("gameMenu.php");	//main menu
require_once("auction.php");
require_once("funds.php");
require_once("garage.php");
require_once("repair.php");
require_once("register.php");
require_once("sold.php");
//include all javascript containing app functionality,
//to be parsed after all other content-->
require_once("js.php");
?>
</div><!--end wrapper-->