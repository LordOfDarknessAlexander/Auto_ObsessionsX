<?php
function eCompanyName(){
    //echos out the name of the company wherever the function is called
    ?>8.5:1 Entertainment Inc<?php
}
//require 'dbConnect.php';
class ao{
    /*public static CONST NAMES = array(
        'OWNER'=>'Adam Glazer',
        'SITE'=>'Auto-Obsessions',
        'AS'=>'Alexander Sanchez',
        'TD'=>'Tyler Drury',
        'AB'=>'Andrew Best'
    );*/
    //constant database names
	
    const   
        NAME = 'Auto-Obsessions&#153;',
        SITE_NAME = 'Auto_ObsessionsX',
        EMAIL = 'auto_obsessions@851entertainment.com',
        USERS = 'users',  //table containing all registered users
        CARS = 'aoCars',  
		//MEMBERS = 'aoMembersDB',
		//database containing all core vehicle data
        //sql column names
        CID = 'car_id',
        UID = 'user_id';
		
        //vehicle parts
        //PRICE = 'price',
        //
    
    //static mysql database connections
   // public static
       // db = dbConnect('aoUsersDB'),
        //usersDB = dbConnect('aoUsersDB'),
        //carSalesDB = dbConnect('aoCarSalesDB');
    public static function eName(){
        echo ao::NAME;
    }
    public static function eSiteName(){
        echo ao::SITE_NAME;
    }
}
function isSetP(){
    //are post vars set
    return isset($_POST);    //&& !empty();
}
function isSetG(){
    //are get vars set
    return isset($_GET);    //&& !empty();
}
function isSetS(){
    //is sessesion vars sets
    return isset($_SESSION);    //&& !empty();
}
function loggedIn(){
    //session started and the user has provided
    //a valid email/username and pasword	 
    return isSetS() && isset($_SESSION['uname']) ? true : false;
}
function eP(){
    //echo's variables submitted to a script via _POST
    echo (isSetP()?
        json_encode($_POST)
    :
        '_POST not set!') . PHP_EOL;
}
function eG(){
    //echo's variables submitted to a script via _GET
    echo (isSetG() ?
        json_encode($_GET)
    :
        '_GET not set!') . PHP_EOL;
}
function eS(){
    //echo's _SESSION variables(when user logged in)    
    echo json_encode(
        array(
            'set'=>isSetS(),
            'id'=>session_id(),
            'status'=>session_status(),
			'logged In '=>loggedIn(),
            'sessionVars'=>isSetS() ? $_SESSION : array()
        )
    ) . PHP_EOL;
}

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
		
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start(); 
	echo '$session_name';
	// Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function login() {
	
    // This section processes submissions from the login form.
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		// checking the user
		$email = mysqli_real_escape_string($AO_DB->con,$_POST['email']);
		$pass = mysqli_real_escape_string($AO_DB->con,$_POST['psword']);

		 echo "email:$email";?><br><?php
		 echo "password:$pass";?><br><?php

		if($email && $pass)
		{
			$sel_user = "SELECT user_id, fname,uname,confirm,user_level FROM users WHERE (email='$email' AND psword=SHA1('$pass') AND confirm = '1')";
			$run_user = $AO_DB->query($sel_user);
			$check_user = mysqli_num_rows($run_user);

			if($check_user == 1){
				echo "uname";?><br><?php
				$_SESSION['email']=$email;
				session_start();
				echo '<script>succes</script>';
				$_SESSION = mysqli_fetch_array($run_user, MYSQLI_ASSOC);
				$_SESSION['user_level'] = (int) $_SESSION['user_level']; 
				$url = ($_SESSION['user_level'] === 1) ? 'members-page.php' : 'members-page.php'; // Ternary operation to set the URL
				header('Location: ' . $url); 
			
			}
		}
		
		else {

			echo '<script>alert(‘Email or password is not correct, try again!’)</script>';

		}

	}
}






function eSG(){
    //echo super global vars, get post and session
    eG();
    eP();
    eS();
}
function rootURL(){
    //returns the root url for the executing application
    //change to false for execution on server
    static $localExecution = true;
    return $localExecution?
        'http://localhost/Auto_ObsessionsX/'    //clone your local copy from Git into C:/xampp/htdocs/
        :
        'http://851entertainment.com/Auto_ObsessionsX/';
        //'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'
}
?>	