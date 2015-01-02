<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
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
            <h2>Adam Glazer and Auto Obsessions Presents !</h2>
        </div>
     
        <div id="main">
	        <!--?php isset($PageTitle) ? $PageTitle : Default page Title!?-->
            <h1>Auto Obsessions</h1>
            
             <div id="login">
                <form name = "login">
                    <p>ENTER USER NAME <input type="text" name="username">
                    <br>
                    <br>
                     ENTER PASSWORD <input type="password" name="pword">
                     <br>
                     <br>
                    <input type="button" value="Check In" name="Submit" onclick= "userLogin()">
                    </p>
                </form>
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
                <li class="artwork">Character design and art: Alexander Sanchez</li>
            </ul>
            <ul>
                <li class="artwork">Programming Crew :Alexander Sanchez, Tyler Drury</li>
            </ul>
             
            <ul>
              <li class="developer">Developer: Adam Glazer</li>
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
	//function roScript(str){
	    //require_once($ROOT_DIR.str.".php");	//main menu
	//}
	//$scripts = array(
	    //"phtml/gameMenu",
    	//"phtml/auction",
    	//"phtml/funds",
    	//"phtml/garage",
		//"phtml/repair",
		//"phtml/register",
	//);
	//for($str in $scripts){
		//ro($str);
	//}
    require_once($ROOT_DIR."phtml/gameMenu.php");	//main menu
    require_once($ROOT_DIR."phtml/auction.php");
    require_once($ROOT_DIR."phtml/funds.php");
    require_once($ROOT_DIR."phtml/garage.php");
    require_once($ROOT_DIR."phtml/repair.php");
    require_once($ROOT_DIR."phtml/register.php");
    //include all javascript containing app functionality,
    //to be parsed after all other content-->
    require_once($ROOT_DIR."phtml/js.php");
    ?>
</div><!--end wrapper-->