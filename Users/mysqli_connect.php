<?php 
// This creates a connection to the logindb database and to MySQL, 
// It also sets the encoding.
// Set the access details as constants:
//TODO:implement reusable sql connection interface
//
//class dbConnect
//{ //class constants don't need to be prefixed with '$'!
    //private $_user,
        //$_pw,
        //$_host,
        //$_name;
        
    //public $con;   //database connection;
    //public function __construct($user = 'root', $password = 'Dante777', $host = 'localhost', $dbName = 'finalPost')
    //{ //unsuccessful creation of this object suppresses any exception thrown and kills the executing program
        //self::$con = @mysqli_connect(HOST, USER,PW, NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
        //mysqli_set_charset(self::$con, 'utf8');
    //}
    ////public function __destruct(){
        //disconnect from database when this is 'unset()'
        //mysqli_close(self::$con);
    //}
    //public function strip($postKey){
        //strip HTML and apply escaping from var passed to page as POST arg
        //$res = trim($_POST[$postKey]);
        //return mysqli_real_escape_string($self::$con, strip_tags($res));
    //}
    }
//}
//$db = dbConnect();
//
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'Dante777');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'finalpost');

// Make the connection:
$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbcon, 'utf8');