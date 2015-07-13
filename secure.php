<?php
session_start();  //the inclusion of this page starts the session if not started, else resume current session
require_once 'dbConnect.php';
require_once 'ao.php';
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
	public static function userLogin(){
     
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
}
?>