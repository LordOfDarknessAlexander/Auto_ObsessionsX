<?php
//This creates a connection to the logindb database and to MySQL, 
//It also sets the encoding.
//
/*class sqlError
{
    public
        $num,   //mysqli error number
        $info;  //mysqli error information
        
    public function __construct($dbCon){
        //dbCon shoulw be of type dbConnect
        $this->num = $dbCon->con->errno;
        $this->info = $dbCon->con->error;
    }
}*/
class dbConnect
{ 
	//class constants and vars don't need to be prefixed with '$' when accessed!
    private
        $_user,
        $_pw,
        $_host,
        $_name;
        
    public $con;   //database connection;
    public function __construct($dbName = 'finalPost', $user = 'root', $password = 'Dante777', $host = 'localhost')
    { //unsuccessful creation of this object suppresses any exception thrown and kills the executing program
        $this->_user = $user;
        $this->_pw = $password;
        $this->_host = $host;
        $this->_name = $dbName;
        
        //echo $this->_user;
        //echo $this->_pw;
        //echo $this->_host;
        //echo $this->_name;
        
        $this->con = @mysqli_connect($this->_host, $this->_user, $this->_pw, $this->_name) OR die ('dbConnect::__construct(), Could not connect to MySQL: ' . mysqli_connect_error() );
        mysqli_set_charset($this->con, 'utf8');
    }
    public function __destruct()
	{   //disconnect from database when this is 'unset()'
        mysqli_close($this->con);
    }
    public function query($q){
        return mysqli_query($this->con, $q);
    }
    public function strip($postKey)
	{   //strip HTML and apply escaping from var passed to page as POST arg
        if(isset($_POST[$postKey])){
            $res = trim($_POST[$postKey]);
            return mysqli_real_escape_string($this->con, strip_tags($res));
        }
        //echo value not set at key
        return '';
    }
}
$AO_DB = new dbConnect();    //main database connection
$aoUsersDB = new dbConnect('aoUsersDB');    //main database connection
$aoCarSalesDB = new dbConnect('aoCarSalesDB');
?>
