<?php
require_once 'secure.php';
//
//define('ROOT_DIR', dirname(__FILE__) . '/');
//
function eCompanyName(){
    //echos out the name of the company wherever the function is called
    ?>8.5:1 Entertainment Inc<?php
}
//require 'dbConnect.php';
//$AO_DB = dbConnect('aoMembersDB');
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
        //mySQL database names
        USERS = 'users',  //table containing all registered users
        CARS = 'aoCars',  
		MEMBERS = 'aoMembersDB',
		ACHIEVEMENTS = 'achievements',
		//database containing all core vehicle data
        //sql column names
        CID = 'car_id',
		AID = 'achievement_id',
        UID = 'user_id';
		
		//$AO_DB = dbConnect(MEMBERS);
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
    return isset($_GET) && !empty($_GET);
}
function isSetS(){
    //is sessesion vars sets
    return isset($_SESSION);    //&& !empty();
}
function isSetC(){
    //is sessesion vars sets
    return isset($_COOKIE);    //&& !empty($_COOKIE);
}
function loggedIn(){
    //session started and the user has provided
    //a valid email/username and pasword	 
    return isSetS() && isset($_SESSION['uname']) ? true : false;
}
function eG(){
    //echo's variables submitted to a script via _GET
    echo (isSetG() ?
        json_encode($_GET)
    :
        '_GET not set!') . PHP_EOL;
}
function eP(){
    //echo's variables submitted to a script via _POST
    echo (isSetP()?
        json_encode($_POST)
    :
        '_POST not set!') . PHP_EOL;
}
function eC(){
    //echo's user's $_COOKIEs
    //For secuirty purposes, DO NOT use this in the live version,
    //as cookies contain secure user data, which should only be displayed while developing
    echo (isSetC() ?
        json_encode($_COOKIE)
    :
        '_COOKIE array not set!') . PHP_EOL;
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
function getServerInfo(){
    //This should only be used for developer and/or debug purposes,
    //the end user should never have access to viewing the server config
    return array(
        'gatewayInterface'=>$_SERVER['GATEWAY_INTERFACE'],
        'addr'=>$_SERVER['SERVER_ADDR'],
        'name'=>$_SERVER['SERVER_NAME'],
        'software'=>$_SERVER['SERVER_SOFTWARE'],
        'protocol'=>$_SERVER['SERVER_PROTOCOL']
    );
}
function getVistitorInfo(){
    //$S = $_SERVER;    //allias server, because screw having to type
    return array(
        //visitor's ip
        'ip'=>$_SERVER['REMOTE_ADDR'],
        //The query string, if any, via which the page was accessed.
        'query'=>$_SERVER['QUERY_STRING'],
        //the page address(if any) which referred
        //the user agent to this current page
        'referer'=>$_SERVER['HTTP_REFERER'],
        //'user'=>$_SERVER['REMOTE_USER'],  //authenticated user
        //string denoting the header from current request, 
        //if there is one., can be used with 'get_browser()'
        //to get info on browser version, settings, etc
        'userAgent'=>$_SERVER['HTTP_USER_AGENT']
    );
}
function eVisitorInfo(){
    echo json_encode(getVisitorInfo() );
}
function eServerInfo(){
    echo json_encode(getServerInfo() );
}

function loadUser() {
	
	global $AO_DB;
	$uid = getUID();
    //Quick edit to squish some bugs, Cheers and good luck with the rest!
    //user ID's are unique, making a select query will only returns
    //the fields for a single match, where as user names are not unique and my return multiple sets of fields
    //TODO: make user names unique(only 1 user should match a signle user name in the sql)
    $U = 'users';
    $UID = 'user_id';
    $M = 'money';
    $T = 'tokens';
    $P = 'prestige';
    $MM = 'm_marker';
    $q = "SELECT * FROM $U WHERE $UID = $uid";	
   // $q = "SELECT * FROM users WHERE uname = 'Dante'";	
    $result = $AO_DB->query($q);
    //Count the returned rows
    if($result){
        $rows = $result->fetch_assoc();
        //json_encode will implicitly convert the array to an object
        //NOTE:sql retrives data as strings, so must conver to numeric type before sending(strings are bulky)
        echo json_encode(array(
            $M=>round(floatval($rows[$M]), 2),
            $T=>intval($rows[$T]),
            $P=>intval($rows[$P]),
            $MM=>intval($rows[$MM]),
            'cid'=>intval($rows['car_id'])
        ));
    }
    else{
        //echo "No Results";
        // If there was a problem.
            echo "<p class='error'>Query failed, Please try again.</p>";
        //exit();
    }
}
function eSG(){
    //echo super global vars, get post and session
    eG();
    eP();
    eS();
    //eC();
}
function getOpFromGET(){
    //if 
    //paramaters passed to GET and POST are always string values
    $OP = 'op';
    $v = (isSetG() && isset($_GET[$OP]) ) ? $_GET[$OP] : exit("invalid paramater supplied for _GET at argument ($OP)");
    //echo$ v;
    //filter string before returning,
    //if value contain only letters return, else return harmless empty string
    return isAlphaSmall($v) ? $v : '';
}
//ROOT_URL = '<php dirname(__FILE__);>';
function rootURL(){
    //returns the root url for the executing application
    //change to false for execution on server
    //return '<php dirname(__FILE__);>';
    static $localExecution = true;
    return $localExecution?
        'http://localhost/Auto_ObsessionsX/'    //clone your local copy from Git into C:/xampp/htdocs/
        :
        'http://851entertainment.com/Auto_ObsessionsX/';
        //'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'
}
?>	