<?php
//This creates a connection to the logindb database and to MySQL, 
//It also sets the encoding.
//
class dbConnect
{ 
	//class constants don't need to be prefixed with '$' but vars do
    private var
        $_user,
        $_pw,
        $_host,
        $_name;
        
    public $con;   //database connection;
    public function __construct($user = 'root', $password = 'Dante777', $host = 'localhost', $dbName = 'finalPost')
    { //unsuccessful creation of this object suppresses any exception thrown and kills the executing program
        self::$_user = $user;
        self::$_pw = $password;
        self::$_host = $host;
        self::$_name = $name;
        self::$con = @mysqli_connect(self::$_host, self::$_user, self::$_pw, self::$_name) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
        mysqli_set_charset(self::$con, 'utf8');
    }
    public function __destruct()
	{   //disconnect from database when this is 'unset()'
        mysqli_close(self::$con);
    }
    public function strip($postKey)
	{   //strip HTML and apply escaping from var passed to page as POST arg
        $res = trim($_POST[$postKey]);
        return mysqli_real_escape_string($self::$con, strip_tags($res));
    }
}
