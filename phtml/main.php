<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
//array cast to an object, to encapsulate developer names and those who contributed
//to this project
//$names = (object)array(
    //'owner'=>'Adam Glazer',
    //'TD'=>
    //'AS'=>
//);
$OWNER_NAME = "Adam Glazer";
$AO_NAME = "Auto Obsessions";
$TD_NAME = "Tyler Drury";
$AS_NAME = "Alexander Sanchez";
//function backBtn(){< button id='backBtn'>Back</button> }
//function homeBtn(){ <button id='home'>Home</button> }
//function homeCarImg(){ <img id="userCar'> }
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
$scripts = array(
    //'gameMenu',
    //'auction',
    //'sold',
    //'funds',
    //'garage',
    //'repair',
    //'register'
);
//scripts will be included in the order declared, ORDER MATTERS!
foreach($scripts as $val){
    //require will look in the absolute path, then relative,
    //then finally the local folder which THIS script is located
    require_once($val.'.php');
}
//require_once('AOUsers_include.php');
?>
</div><!--end wrapper, include javascript at end of bpdy-->
<?php require_once('js.php');?>