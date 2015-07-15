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
					//session_start();
					//sec_session_start();
					
					$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$_SESSION['user_level'] = (int) $_SESSION['user_level']; // Changes the 1 or 2 user level to an integer.
					eS();
					isLoggedIn();
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
			} 
			else 
			{ // If there was a problem.
				echo "<p class='error'>Please try again.</p>";
			}  
		} // End of SUBMIT conditional.
	}//End of User Login Function
	
	public static function registerUser(){
		
		global $AO_DB;
		
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			//$str = '\n|\t|\r|\v|\f';
			//echo stripWS($str);
			//echo removeWS($str);
			//exit();
			$errors = array(); // Start an array named errors 

			$stripped = $AO_DB->strip('title');
			// Check stripped string
			if(mb_strlen($stripped, 'utf8') ){
				$title = $stripped;
			}
			else{
				$errors[] = 'You forgot to enter your title.';
			}
			
			$stripped = $AO_DB->strip('fname');

			if(isAlpha($stripped) ){
				if(mb_strlen($stripped, 'utf8') ){
					$fn = $stripped;
				}
				else{
					$errors[] = 'You forgot to enter your first name.';
				}
			}
			else{
				$errors[] = 'First Name must not contain numbers, whitespace or special characters.';
			}

			$stripped = $AO_DB->strip('lname');

			if(isAlpha($stripped) ){
				if(mb_strlen($stripped, 'utf8') ){
					$ln = $stripped;
				}
				else{
					$errors[] = 'You forgot to enter your last name.';
				}
			}
			else{
				$errors[] = 'Last Name must not contain numbers, whitespace or special characters.';
			}
			//Set the email variable to FALSE
			$e = FALSE;									
			// Check that an email address has been entered				
			if(empty($_POST['email'])){
				$errors[] = 'You forgot to enter your email address.';
			}
			//remove spaces from beginning and end of the email address and validate it	
			if(filter_var((trim($_POST['email'])), FILTER_VALIDATE_EMAIL)){	
				//A valid email address is then registered
				$e = mysqli_real_escape_string($AO_DB->con, (trim($_POST['email'])));
			}
			else{									
				$errors[] = 'Your  email address is invalid or you forgot to enter your email address';
			}
			// Check that a password has been entered, if so, does it match the confirmed password
			if(empty($_POST['psword1'])){
				$errors[] ='Please enter a valid password';
			}
			//passwords must be 8-12 characters long, containing only numbers or letters, no special symbols
			if(!preg_match('/^\w{8,12}$/', $_POST['psword1'])){
				$errors[] = 'Invalid password, use 8 to 12 characters and no spaces.';
			}
			else{
				$psword1 = $_POST['psword1'];
				$pw2 = $_POST['psword2'];
				
				if(!preg_match('/^\w{8,12}$/', $pw2) ){
					$errors[] = 'Confirmation password invalid, must be 8-12 characters and no spaces.';
				}

				if($psword1 == $pw2){
					$p = mysqli_real_escape_string($AO_DB->con, trim($psword1));
				}
				else{
					$errors[] = 'Your two passwords do not match.';
				}
			}

			$stripped = $AO_DB->strip('uname');

			if(isAlpha($stripped) ){
				if(mb_strlen($stripped, 'utf8') ){
					$uname = $stripped;
				}
				else{
					$errors[] = 'Invalid username.';
				}
			}
			else{
				$errors[] = 'User Name must not contain numbers, whitespace or special characters.';
			}

			if(empty($errors)){ 
				// If there were no errors
				//Determine whether the email address has already been registered	
				$users = ao::USERS;
				$UID = ao::UID;
				$CID = ao::CID;
				$E = 'email';
				//
				$UN = 'uname';
				$FN = 'fname';
				$LN = 'lname';
				
				$result = $AO_DB->query(
					"SELECT $UID FROM $users WHERE $E = '$e' "
				); 	
				
				if(mysqli_num_rows($result) == 0){
					//The mail address was not already registered therefore register the user in the users table
					//pasCreate::userAccount($userInfo);
					$M = 'money';
					$T = 'tokens';
					$P = 'prestige';
					$MM = 'm_marker';
					
					$email_code = md5($_POST[$UN] + microtime());
					//$addNewUser = $AO_DB->con->prepare();
					$result = $AO_DB->query(
						"INSERT INTO $users(
							$UID, $UN, title, $FN, $LN,
							$CID, $M, $T, $P, $MM,
							user_level, $E, psword,
							registration_date, confirm
						)VALUES(
							'', '$uname', '$title', '$fn', '$ln',
							0, 50000, 0,0,0,
							0, '$e', SHA1('$p'),
							NOW(), 0
						)"
					);	
					
					$register_email = '$e';
					//echo json_encode($result);
					if($result) 
					{ // If the query ran OK
						//user successfully registered, create other database tables
					   // register_User($register_email,$uname,$email_code);
					   $sender = ao::EMAIL;    //'From: auto_obsessions@851entertainment.com';
					   $subject = 'Auto-Obsessions Registration';
					   $body = "thanks for registering $uname \n\n click the link below to activate your account :\n\n http://851entertainment.com/Auto_ObsessionsX/activate.php?email=$e&email_code=$email_code \n\n - auto-obsessions;";
					   mail($e, $subject, $body, "From: $sender");
						//res = pasGet::userLogin($e, $uname);
						
						$res = $AO_DB->query(
							"SELECT $UID FROM $users WHERE ($E ='$e' AND $UN = '$uname')"
						);
						
						if($res){
							$uid = $res->fetch_assoc()[$UID];    //return type is string
							//echo "registered user with id:$uid<br> type:" . gettype($uid);
							if(pasCreate::userTable($uid) ){    //cars the user owns
								if(pasCreate::auctionLossTable($uid) ){     //table for maintaining the user's losses
									if(pasCreate::carSaleTable($uid) ){        //vehicles the user has sold                       
										//header("location: reg-confirm.php");
									}
									//else code succeeded
								}
								//could not create car sale table
								header("location: register-thanks.php");
							}
							else{
								echo "could not create additional tables for user with id:$uid<br>";
							}
							$res->close();
						}
						else{
							echo "query failed for user name ($uname)," . PHP_EOL . mysqli_error($AO_DB->con) . PHP_EOL;
						}
						//$result->close();
						//sucess! send email from no-reply@851entertainment.com for user to confirm
						//header("location: register-thanks.php"); 
						exit();
					} 
					else{
						// If the query did not run OK
						// Message
						echo "<h2>System Error</h2>
						<p class='error'>You could not be registered due to a system error. We apologize for the inconvenience.</p>";
						// Debugging message:
						$AO_DB->eErr();
					} // End of if ($result)
					// Include the footer and stop the script
					require 'phtml/legal.php';
					html::footer();
					exit();
				} 
				else{
					//The email address is already registered 
					echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
				}
			}
			else{
				// Display the errors
				echo "<h2>Error!</h2>
				<p class='error'>The following error(s) occurred:<br>";
				// Display each error
				foreach($errors as $msg){
					echo " - $msg<br>\n";
				}
				echo '</p><h3>Please try again.</h3><p><br></p>';
			}// End of if (empty($errors))
		} // End of the main Submit conditionals
	}
}
?>