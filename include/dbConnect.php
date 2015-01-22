<?php
//This creates a connection to the logindb database and to MySQL, 
//It also sets the encoding.
//
class dbConnect
{ 
	//class constants don't need to be prefixed with '$' but vars do
    private $_user
    private $_pw;
    private $_host;
    private $_name;
        
    public $con;   //database connection;
    public function __construct($user = 'root', $password = 'Dante777', $host = 'localhost', $dbName = 'finalPost')
    { //unsuccessful creation of this object suppresses any exception thrown and kills the executing program
        $this->$_user = $user;
        $this->$_pw = $password;
        $this->$_host = $host;
        $this->$_name = $name;
        $this->$con = @mysqli_connect($this->$_host, $this->$_user, $this->$_pw, $this->$_name) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
        mysqli_set_charset($this->$con, 'utf8');
    }
    public function __destruct()
	{   //disconnect from database when this is 'unset()'
        mysqli_close($this->$con);
    }
    public function strip($postKey)
	{   //strip HTML and apply escaping from var passed to page as POST arg
        $res = trim($_POST[$postKey]);
        return mysqli_real_escape_string($this->$con, strip_tags($res));
    }
}
