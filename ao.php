<?php
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
        USERS = 'users',  //table containing all registered users
        CARS = 'aoCars',  
		MEMBERS = 'aoMembersDB',
		//database containing all core vehicle data
        //sql column names
        CID = 'car_id',
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
/*
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
}*/

function login() {
	
	global $AO_DB;

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{	// Validate the email address:
		if(!empty($_POST['email'])){
			//isEmail()
			$e = mysqli_real_escape_string($AO_DB->con, $_POST['email']);
		} 
		else{
			$e = FALSE;
			echo "<p class='error'>You forgot to enter your email address.</p>";
		}
		// Validate the password:
		if(!empty($_POST['psword'])){
			//isPassword
			$p = mysqli_real_escape_string($AO_DB->con, $_POST['psword']);
		}
		
		else{		
			$p = FALSE;
			echo "<p class='error'>You forgot to enter your password.</p>";
		}
		if($e && $p){
			//if no problems
			echo "email:$e";?><br><?php
			echo "password:$p";?><br><?php
			
			// Retrieve the user_id, first_name and user_level for that email/password combination:
			$q = "SELECT user_id, fname,uname,confirm,user_level FROM users WHERE (email='$e' AND psword=SHA1('$p') AND confirm = '1')";	
			$result = $AO_DB->query($q);
			// Check the result:
		
			if (@mysqli_num_rows($result) == 1) 
			{	
				
				 //The user input matched the database record
				// Start the session, fetch the record and insert the three values in an array
				$_SESSION['uname']=$uname; 
				echo "uname";?><br><?php
				session_start();
				//sec_session_start();
	
				$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$_SESSION['user_level'] = (int) $_SESSION['user_level']; // Changes the 1 or 2 user level to an integer.
				eS();
				//$url = ($_SESSION['user_level'] === 1) ? 'admin.php' : 'members-page.php'; // Ternary operation to set the URL
				$url = ($_SESSION['user_level'] === 1) ? 'index.php' : 'index.php'; // Ternary operation to set the URL
				mysqli_free_result($result);
				header('Location: ' . $url); // Makes the actual page jump. Keep in mind that $url is a relative path.
				ob_end_clean(); // Delete the buffer.
				exit(); //Cancels the rest of the script, NOTE: the execution ends here, the cleanup code will never be called and cause memory issues;       
			} 
			else 
			{ // No match was made.
				//echo 'error: ' . mysqli_error($AO_DB->con);
				echo "<p class='error'>The email address and password do not match our records.If you need to register, click the Register button on the header menu</p>";
			}
			//secure::validate();
		} 
		else 
		{ // If there was a problem.
			echo "<p class='error'>Please try again.</p>";
		}  
	} // End of SUBMIT conditional.
}
function loadUser() {
	
	global $AO_DB;
	$uid = getUID();
    //Quick edit to squish some bugs, Cheers and good luck with the rest!
    //user ID's are unique, making a select query will only returns
    //the fields for a single match, where as user names are not unique and my return multiple sets of fields
    //TODO: make user names unique(only 1 user should match a signle user name in the sql)
    $q = "SELECT * FROM users WHERE user_id = $uid";	
   // $q = "SELECT * FROM users WHERE uname = 'Dante'";	
    $result = $AO_DB->query($q);
    //Count the returned rows
    if($result) //mysqli_num_rows($result) != 0)
    {
        $rows = $result->fetch_assoc();
        //json_encode will implicitly convert the array to an object
        //NOTE:sql retrives data as strings, so must conver to numeric type before sending(strings are bulky)
        echo json_encode(array(
            'money' => floatval($rows['money']),
            'tokens' => intval($rows['tokens']),
            'prestige' => intval($rows['prestige']),
            'm_marker' => intval($rows['m_marker']),
            'cid' =>intval($rows['car_id'])
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