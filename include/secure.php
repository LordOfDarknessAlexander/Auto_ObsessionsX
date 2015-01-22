<?php
//session_start();  //the inclusion of this page starts the session if not started, else resume current session
function secureMemberLogin(){
    //if not already logged in as a registered user, display login page
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1) )
    {
        header("Location: login.php");  //redirect to user login.php
        exit(); //exit the executing script, not the function, after dispalying secure login page
    }
    //else, display the page contents following calls to this function
}
function secureAdminLogin(){
    //if not logged in as an admin, display login page
    $accessDenied = 0;
    $admin = 1;
    $accessLevel = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : $accessDenied;
    
    if($accessLevel != $admin) ){
        //header("Location: adminLogin.php");  //redirect to user login.php
        exit(); //exit the executing script, not the function, after dispalying secure login page
    }
    //else, display the page contents following calls to this function
}
?>