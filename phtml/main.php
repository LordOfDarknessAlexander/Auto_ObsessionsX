<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
//array cast to an object, to encapsulate developer names and those who contributed
//to this project
require_once 'ao.php';
require_once 'html.php';
//require_once './secure.php';
//
$OWNER_NAME = 'Adam Glazer';
$AO_NAME = 'Auto Obsessions';
$TD_NAME = 'Tyler Drury';
$AS_NAME = 'Alexander Sanchez';
$AB_NAME = 'Andrew Best';
$BM_NAME = 'Brendan McCracken';
$JM_NAME = 'Johnathan McLaughlin';
//$NAMES = array(
    //'OWNER'=>'Adam Glazer',
    //'AO'=>'Auto Obsessions',
    //'TD'=>'Tyler Drury',
    //'AS'=>'Alexander Sanchez',
    //'AB'=>'Andrew Best',
    //'BM'=>'Brendan McCracken',
    //'JM'=>'Johnathan McLaughlin',
//);

//this is not working on site without a new session
//session_start();
//isLoggedIn();
//session set, has the session be started and initialized
//if $_SESSION is an empty array,
//user is using guest account and not currenlty logged in
//eS();
//$_SESSION = array('dur'=>0);    //must log in to set session vars!
//userLoggin!
$ss = isset($_SESSION) && !empty($_SESSION) ? true : false;

function hrefVoid(){
    //standard javascript for linking a document to itself,
    //causing a page refresh
    ?>href='javascript:void(0)'<?php
}
function getUserName(){   
    $UN = 'uname';
    
    return loggedIn()?
        $_SESSION[$UN] : 'guest';
}

//
//eS();
//exit();
$URL = rootURL();   //absolute url of executing site/folder
?>	
<div class='wrapper'>
	<!--root div element of web page!-->
    <div class='sound sound-off'></div>
	
    <div id='statBar'>  
        <div id ='aAmerica'> PHOTOS COURTESY OF AUCTIONS AMERICA</div>
        <!--this stat bar will be visible across all pages/divs-->
        <label id='money'>Money: </label>
        <label id='tokens'>Tokens:</label>
        <label id='prestige'>Prestige:</label>
        <label id='markers'>Mile Markers:</label>
    </div>
	
    <img id='mainCar' src='images\\garageEmpty.png'>
    <pre id='info'></pre>
    <img id='adBar'>
   
    <div id='reg-navigation'>
        <a id='home' class='tooltip' href='<?php
            echo $URL . 'index.php';
        ?>'>Home</a><br>
        <a id='addFunds' title='Store'>Store</a><br>		
<?php
if(loggedIn() ){?>
        <a id='mem'  title='Members Page' href='<?php
            echo $URL .'members-page.php';
        ?>'>Members</a><br>
        <a id='logout'  title='Logout' href='<?php
            echo $URL .'logout.php';
        ?>'>Logout</a><br>		
<?php
}
else{?>
        <a id='reg' title='Register an account with us' href='<?php
            echo $URL . 'registerUser.php';
        ?>'>Register</a><br>
        <a id='login' href='<?php
            echo $URL .'login.php';
        ?>'>Login</a><br>
<?php
}
?>
    </div>
    <!--sub-menus/screens/states-->
    <div id='menu'>
        <!--splash/loggin-->
        <div id='progress'>
            <div id='percent'>Downloading: <span id='p'></span></div>
            <progress id='progress-bar' value='0'></progress>
        </div>
      
        <div id='splash'>
          <!--  <h2><php /*echo $AO_NAME.' Presents!';*/></h2>-->
        </div>
        
        <div id='main'>		
			<h1><?php echo 'Beta Version ' ;?></h1>
			<h1><?php echo 'Welcome ' . getUserName();?></h1>
			<img id='aoLogo' src='images/aoLogo.png'>
            <img id='drapes' src='images/drapes.png'>
            <ul>
<?php
if(!loggedIn() ){?>
                <li><a id='reg' class='button Register' href='<?php
                    echo rootURL() . 'registerUser.php';
                ?>'>Register</a></li>
<?php

}?>
                <li><a class='button credits' <?php hrefVoid();?>>Credits</a></li>				
				<li><a class='button play' <?php hrefVoid();?>>Play <?php
                    echo loggedIn()? 'Game' : 'as Guest';
                ?></a></li>
            </ul>
<?php
if(!loggedIn() ){?>   
			<div id='loginfields'>
				<h2>Login</h2>
				<form action="login.php" method='post'>
					<p><label class='label' for='email'>Email Address:</label><br>
					<input id='email' type='text' name='email' size='30' maxlength='60' value='<?php if (isset($_POST['email'])) echo $_POST['email']; ?>' > </p>
					<p><label class='label' for='psword'>Password:</label><br>
					<input id='psword' type='password' name='psword' size='12' maxlength='12' value='<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>' ></p>
					<p><input id='submit' type='submit' name='submit' value='Login'></p>
				</form>
			</div>
<?php
}?>			
            <?php require 'phtml/legal.php';?>
		</div>
	
        <div id='credits'>
            <h1>Auto-Obsessions Credits</h1>
            <!--could just be a link at the bottom of the page-->
            <ul>
                <li class='artwork'>Character design and art: <?php
                echo $AS_NAME;
                ?></li>
            </ul>
            <ul>
                <li class='artwork'>Programming Crew: <?php
                echo "$AS_NAME, $TD_NAME, $AB_NAME , $BM_NAME , $JM_NAME";
                ?></li>
            </ul>
             
            <ul>
                <li class='developer'>Developer: <?php
                echo $OWNER_NAME;
                ?></li>
            </ul>
			<br>
			<br>
           <!-- <a href='javascript:void(0)' class='button back'>Back</a> -->
		   <a href='index.php' class='button back' title='Home Page'>Back</a><br>
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
    'slots',
    'profile',
	
	//'miniSlots'
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
    require_once($val . '.php');
}
//include all javascript html tags at end of document
require_once 'js.php';
?>