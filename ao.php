<?php
class ao{
    /*public static CONST NAMES = array(
        'OWNER'=>'Adam Glazer',
        'SITE'=>'Auto-Obsessions',
        'AS'=>'Alexander Sanchez',
        'TD'=>'Tyler Drury',
        'AB'=>'Andrew Best'
    );*/
    //constant database names
    const
        USERS = 'users',  //table containing all registered users
        CARS = 'aoCars',  
		MEMBERS = 'aoMembers',
		//database containing all core vehicle data
        //sql column names
        CID = 'car_id',
        UID = 'user_id';
		
        //vehicle parts
        //PRICE = 'price',
        //
    
    //static mysql database connections
    //public static
        //db = dbConnect('aoUsersDB'),
        //usersDB = dbConnect('aoUsersDB'),
        //carSalesDB = dbConnect('aoCarSalesDB');
}
function rootURL(){
    //returns the root url for the executing application
    //change to false for execution on server
    static $localExecution = true;
    return $localExecution?
        'http://localhost/Auto_ObsessionsX/'    //clone your loccal copy from Git into C:/xampp/htdocs/
        :
        'http://851entertainment.com/Auto_ObsessionsX/';
        //'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'
}
?>	