<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
//array cast to an object, to encapsulate developer names and those who contributed
//to this project
$OWNER_NAME = 'Adam Glazer';
$AO_NAME = 'Auto Obsessions';
$TD_NAME = 'Tyler Drury';
$AS_NAME = 'Alexander Sanchez';
$AB_NAME = 'Andrew Best';
$ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/';
//$ROOT_URL = 'http://851entertainment.com/Auto_ObsessionsX/';

?>	
<div class='wrapper'>
	<!--root div element of web page!-->	
    <div class='sound sound-off'></div>
	
    <div id='statBar'>  
        <!--this stat bar will be visible across all pages/divs-->
        <label id='money'>Money: </label>
        <label id='tokens'>Tokens:</label>
        <label id='prestige'>Prestige:</label>
        <label id='m_marker'>Mile Markers:</label>
    </div>
	
    <img id='mainCar' src='images\\garageEmpty.png'>
    <!--label id='info'></label-->
    
    <div id='menu'>
        <div id='progress'>
            <div id='percent'>Downloading: <span id='p'></span></div>
            <progress id='progress-bar' value='0'></progress>
        </div>
      
        <div id='splash'>
            <h2><?php echo $OWNER_NAME.' and '.$AO_NAME.' Presents!';?></h2>
        </div>
        <div id='main'>		
            <h1><?php echo $AO_NAME;?></h1>
			 <?php 
		//	session_start();

			if(isset($_SESSION) AND isset($_SESSION['uname']) ){
                $uname = $_SESSION['uname'];
				$loggedIn = true;
			}
			else{
				$loggedIn = false;
				$uname = 'guest';
			}
            echo "Welcome $uname";
            
            if(!$loggedIn)
            { 
				echo
				'
				<ul>
				   <li><a href="javascript:void(0)" class="button play">Play as Guest</a></li>
				   <li><a href="javascript:void(0)" class="button credits">Credits</a></li>
				   
				   <li><a href="javascript:void(0)" class="button Register">Register</a></li> 
				 </ul> 
				 
				 <div id="loginfields">
 				<h2>Login</h2>
 				<form action="login.php" method="post">
 					<p><label class="label" for="email">Email Address:</label>
					<input id="email" type="text" name="email" size="30" maxlength="50" value="email" > </p>
 					<p><label class="label" for="psword">Password:</label>
					<input id="psword" type="password" name="psword" size="12" maxlength="12" value="password" ></p>
 					<p><input id="submit" type="submit" name="submit" value="Login"></p>
 				</form>
 		</div> 
				 
				 ';
			}
			else if($loggedIn)
 			{
				
				 echo '
					<div id="loginfields">
					
					<ul>
				   <li><a href="javascript:void(0)" class="button play">Start Game</a></li>
				   <li><a href="javascript:void(0)" class="button credits">Credits</a></li>
				 
				 </ul> 
					</div> ';
 			}
			?> 
            <?php require 'phtml/legal.php';?>
		</div>
      
        <div id='credits'>
            <!--could just be a link at the bottom of the page-->
            <ul>
                <li class='artwork'>Character design and art: <?php echo $AS_NAME;?></li>
            </ul>
            <ul>
                <li class='artwork'>Programming Crew: <?php echo $AS_NAME.', '.$TD_NAME;?></li>
            </ul>
             
            <ul>
              <li class='developer'>Developer: <?php echo $OWNER_NAME;?></li>
            </ul>
            <a href='javascript:void(0)' class='button back'>Back</a>
        </div> 
    </div><!--end menu-->      

    <canvas id='canvas' width='900' height='600'>
        <p>You're browser does not support the required functionality to play this game.</p>
        <p>Please update to a modern browser such as <a href='www.google.com/chrome/‎'>Google Chrome</a> to play.</p>
    </canvas>    
<?php
//php includes the source html files here
//require_once 'mainMenu.php';
$scripts = array(
    'gameMenu',
	'repair',
    'auction',
    'sold',
    'funds',
    'garage',
    
    'profile',
    //messages
    //ranks
    //search
    //business
    //faq
    //'register'
);
//scripts will be included in the order declared, ORDER MATTERS!
foreach($scripts as $val){
    //require will look in the absolute path, then relative,
    //then finally the local folder which THIS script is located
    require_once($val.'.php');
}
?>
    <!--div id='messages'>
        <button id='backBtn'>Back</button>
    </div>
    <div id='ranks'>
        <button id='backBtn'>Back</button>
        
    </div>
    <div id='search'>
        <button id='backBtn'>Back</button>
        <form action='search.php' method='POST'>
            <input id='filter'>
                <option 'vehicle'>
                <option 'business'>
                <option 'user'>
            <input type='text'
            <input submit>
        </form>
    </div>
    <div id='business'>
        <button id='backBtn'>Back</button>
    </div>
    <div id='faq'>
        <button id='backBtn'>Back</button>
    </div-->
	<!--placing adBar here should allow it to be visable across all pages
</div><!--end wrapper, include javascript at end of body-->
<?php require_once 'js.php';?>