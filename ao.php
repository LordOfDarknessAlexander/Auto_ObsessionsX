<?php
function eCompanyName(){
    //echos out the name of the company wherever the function is called
    ?>8.5:1 Entertainment Inc<?php
}

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
    //public static
        //db = dbConnect('aoUsersDB'),
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