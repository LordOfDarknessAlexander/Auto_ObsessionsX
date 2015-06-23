<?php
session_start();  //the inclusion of this page starts the session if not started, else resume current session
require_once 'dbConnect.php';
function isLoggedIn(){
    return (isset($_SESSION) AND isset($_SESSION['user_level']) ) ? true : false;
}
class secure
{   //static api for the secure login of user/admins/devs/etc, across pages
    public static function memberLogin(){
        //if not already logged in as a registered user, redirect to login page
        if(!isset($_SESSION['user_level']) ){
            header("Location: login.php");  //redirect to user login.php
            exit(); //exit the executing script, not the function, after dispalying secure login page
        }
        //else, display the page contents following calls to this function
    }
    public static function adminLogin(){
        //if not logged in as an admin, redirect to login page
        $accessDenied = -1;
        $admin = 1;
        $accessLevel = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : $accessDenied;
        
        if($accessLevel != $admin){
            echo 'You are not logged in and do not have access to this page!';
            header("Location: login.php");  //redirect to user login.php
            exit(); //exit the executing script, not the function, after dispalying secure login page
        }
        //else, display the page contents following calls to this function
    }
	
	public static function validate( $e = '', $p = '')
	{
	  // Start an array to hold the error messages 
	  $errors = array() ; 
	  // Has the email address been entered?
	  if ( empty( $e ) ) 
	  { $errors[] = 'You forgot to enter your email address' ; 
	  } 
	  else  { $uname = mysqli_real_escape_string( $AO_DB->con, trim( $e ) ) ; 
	  }
	  // Has the password been entered
	  if ( empty( $p ) ) 
	  { $errors[] = 'Enter your password.' ; 
	  } 
	  else { $p = mysqli_real_escape_string( $AO_DB->con, trim( $p ) ) ; 
	  }
	  // If everything is OK select the buyerer_id and the buyer name from the buyers' table
	  if ( empty( $errors ) ) 
	  {
		$q = "SELECT user_id, fname, uname, user_level FROM users WHERE email='$e' AND psword=SHA1('$p')" ;  
		$result = mysqli_query ( $AO_DB->con, $q ) ;
		if ( @mysqli_num_rows( $result ) == 1 ) 
		{
		  $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ;
		  return array( true, $row ) ; 
		  	$url = ($_SESSION['user_level'] === 1) ? 'admin.php' : 'members-page.php'; // Ternary operation to set the URL
			//$url = ($_SESSION['user_level'] === 1) ? 'index.php' : 'index.php'; // Ternary operation to set the URL
			$loggedIn = true;
			$uname = $_SESSION['uname'];
			//echo 'Scks';
			mysqli_free_result($result);
			header('Location: ' . $url); 
		  
		}
		// If the user name and password do not match the database record, create an error message
		else { $errors[] = 'The email and password do not match our records.' ; 
		}
	  }
	  // Retrieve the error messages
	  return array( false, $errors ) ; 
	}
	
}
?>