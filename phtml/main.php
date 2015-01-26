<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
//array cast to an object, to encapsulate developer names and those who contributed
//to this project
//class Names{
    //public const  owner = 'Adam Glazer',
    //'TD'=>
    //'AS'=>
//};
$OWNER_NAME = "Adam Glazer";
$AO_NAME = "Auto Obsessions";
$TD_NAME = "Tyler Drury";
$AS_NAME = "Alexander Sanchez";
$ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/';
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
                      <p> USER NAME <input type="text" name="username"></p>
                      <p> PASSWORD <input type="password" name="pword"></p>
                      <p><input type="submit"  name="submit" value="Log In"></p>
                    </form>
                </fieldset>
            </div>
            <ul>
               <li><a href="javascript:void(0)" class="button play">Play as Guest</a></li>
               <li><a href="javascript:void(0)" class="button credits">Credits</a></li>
               <li><a href="javascript:void(0)" class="button Register">Register</a></li>
            </ul>
            <p id='legal'>Auto-Obsession &copy; 2015, All Right Reserved.
                <a href='<?php echo $ROOT_URL.'legal.php?page=terms';?>'>Terms</a>
                <a href='<?php echo $ROOT_URL.'legal.php?page=privacy';?>'>Privacy</a>
                <a href='<?php echo $ROOT_URL.'legal.php?page=security';?>'>Security</a>
                <a href='<?php echo $ROOT_URL.'legal.php?page=contact';?>'>Contact</a>
                <a href=''>Credits</a>
            </p>
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
    'gameMenu',
    'auction',
    'sold',
    'funds',
    'garage',
    'repair',
    //profile
    //messages
    //ranks
    //search
    //business
    //faq
    'register'
);
//scripts will be included in the order declared, ORDER MATTERS!
foreach($scripts as $val){
    //require will look in the absolute path, then relative,
    //then finally the local folder which THIS script is located
    require_once($val.'.php');
}
//require_once('AOUsers_include.php');
?>
    <div id='profile'>
        <button id='backBtn'>Back</button>
    </div>
    <div id='messages'>
        <button id='backBtn'>Back</button>
    </div>
    <div id='ranks'>
        <button id='backBtn'>Back</button>
        <!--filter-->
            <!--option money-->
            <!--option prestige-->
            <!--option mile Markers-->
    </div>
    <div id='search'>
        <button id='backBtn'>Back</button>
        <!--form action='search.php' method='POST'>
            <input id='filter'>
                <option 'vehicle'>
                <option 'business'>
                <option 'user'>
            <input type='text'
            <input submit>
        </form>-->
    </div>
    <div id='business'>
        <button id='backBtn'>Back</button>
    </div>
    <div id='faq'>
        <button id='backBtn'>Back</button>
    </div>
</div><!--end wrapper, include javascript at end of body-->
<?php require_once 'js.php';?>