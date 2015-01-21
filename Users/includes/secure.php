<?php
//session_start();
function secureLogin(){
    //if not already logged in as a registered user, display login page
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1) )
    {
        header("Location: login.php");  //redirect to login.php
        exit(); //exit the executing script, not the function, after dispalying secure login page
    }
    //else, display the page contents following calls to this function
}
?>