<?php

require_once 'html.php';
require_once 'dbConnect.php';
require_once 'create.php';
require_once 're.php';
//require_once '../users.php';
//
html::doctype();?>
<html lang=en>
<head>
<?php
html::simpleHead('Register');
?>
<link rel='stylesheet' type='text/css' href='includes.css'>
</head>
<body>
<h1>Registration</h1>
<div id='reg-navigation'>
    <a href='index.php'>Cancel</a>
</div>

<div id='nav'><!--The side menu column contains the vertical menu-->
    <a href='tutorial.php' title='Tutorial'>Tutorial</a>
    <a href='credits.php' title='Credits'>Credits</a>
    <a href='index.php' title='Home Page'>Home</a>
</div><!--end of side column and menu -->

<div id='container'>
<?php
// This code inserts a record into the users table
// Has the form been submitted?
if($_SERVER['REQUEST_METHOD'] == 'POST'){    
//$str = '\n|\t|\r|\v|\f';
//echo stripWS($str);
//echo removeWS($str);
//exit();
    $FN = 'fname';
    $LN = 'lname';
    $UN = 'uname';
    $E = 'email';
    
	$errors = array(); // Start an array named errors 

	$stripped = $AO_DB->strip('title');
	// Check stripped string
	if(mb_strlen($stripped, 'utf8') ){
		$title = $stripped;
	}
	else{
        $errors[] = 'You forgot to enter your title.';
	}
    
	$stripped = $AO_DB->strip($FN);

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

	$stripped = $AO_DB->strip($LN);

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
	if(empty($_POST[$E])){
		$errors[] = 'You forgot to enter your email address.';
	}
	//remove spaces from beginning and end of the email address and validate it	
	if(filter_var((trim($_POST[$E])), FILTER_VALIDATE_EMAIL)){	
		//A valid email address is then registered
		$e = mysqli_real_escape_string($AO_DB->con, (trim($_POST[$E])));
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

	$stripped = $AO_DB->strip($UN);

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
        //
        
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
                    echo "registered user with username:$uname<br> Please check your email to activate your account" ;
                    if(pasCreate::userTable($uid) ){    //cars the user owns
                        if(pasCreate::auctionLossTable($uid) ){     //table for maintaining the user's losses
                            if(pasCreate::carSaleTable($uid) ){        //vehicles the user has sold                       
                                
								header("location: register-thanks.php");
                            }
                            //else code succeeded
							header("location: register-thanks.php");
                        }
                        //could not create car sale table
                        
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
/*
function ep($str){
    //safely echos the entry in $_POST
    if(isset($_POST[$str])){
        //trim removes access whitespace around start and end of entry,
        $t = trim($_POST[$str]);
        echo html::escape($t);
    }
}*/
function fl($name, $text){
    //generates an html form label
    //name:string identifier for the tag
    //text:string content of the element?>
<label class='label' for='<?php echo $name;?>'><?php echo $text;?></label><br>
<?php
}
function itb($name, $size, $maxlength){
    //generates an html input text box
    //name:string identifier for the tag
    //size & maxlength, positive integer values
    $n = html::escape($name);?>
<input id='<?php echo $n;?>' type='text' name='<?php echo $n;?>' size='<?php echo strval($size);?>' maxlength='<?php echo strval($maxlength);?>' value='<?php echo $n?>'><br>
<?php
}
function flti($name, $text, $size, $maxlength){
    //form label text input
    fl($name, $text);
    itb($name, $size, $maxlength);
}
?>
    <h3 class='content'>Items marked with an asterisk * are essential</h3>
	<form id='reg' action='registerUser.php' method='post'>
<?php
//there are only so many title options, have the user select from list, instead of add text, which has to be validated
?>
        <!--select id='title' name='title'>
            <option value='Mr'>Mr</option>
            <option value='Ms'>Ms</option>
            <option value='Miss'>Miss</option>
            <option value='Undisclosed'>Undisclosed</option>
        </select-->
		<!--label class='label' for='title'>Title*</label><br-->
        <?php fl('title', 'Title*');?>
        <input id='title' type='text' name='title' size='15' maxlength='12' value='<?php html::ep('title'); ?>'>
		<br>
        <?php
        flti('fname', 'First Name*', 30, 30);
        flti('lname', 'Last Name*', 30, 30);
        flti('email', 'Email Address*', 30, 60);        
        fl('psword1', 'Password*');?>        
        <input id='psword1' type='password' name='psword1' size='12' maxlength='12' value='<?php html::ep('psword1');?>'>&nbsp;8 to 12 characters<br>
        <?php fl('psword2', 'Confirm Password*');?>
        <input id='psword2' type='password' name='psword2' size='12' maxlength='12' value='<?php html::ep('psword2');?>'>
		<br>
        <?php flti('uname', 'User Name', 12, 12);?>
		<input id='submit' type='submit' name='submit' value='Register'>

	</form>
</div><!--container-->
<?php
require 'phtml/legal.php';
html::footer();
?>