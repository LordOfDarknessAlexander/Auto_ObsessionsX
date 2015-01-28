<?php
//session_start();  //the inclusion of this page starts the session if not started, else resume current session
class secure
{   //static api for the secure login of user/admins/devs/etc, across pages
    public static function memberLogin(){
        //if not already logged in as a registered user, display login page
        if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1) )
        {
            header("Location: login.php");  //redirect to user login.php
            exit(); //exit the executing script, not the function, after dispalying secure login page
        }
        //else, display the page contents following calls to this function
    }
    public static function adminLogin(){
        //if not logged in as an admin, display login page
        $accessDenied = -1;
        $admin = 1;
        $accessLevel = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : $accessDenied;
        
        if($accessLevel != $admin){
            echo 'You are not logged in and do not have access to this page!';
            //header("Location: http://triosdevelopers.com/a.sanchez/Assets/AutoObsessionsGame/Users/login.php");  //redirect to user login.php
            exit(); //exit the executing script, not the function, after dispalying secure login page
        }
        //else, display the page contents following calls to this function
    }
}
?>