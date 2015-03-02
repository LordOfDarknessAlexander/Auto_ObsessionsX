<?php
class ao{
    /*public static CONST NAMES = array(
        'OWNER'=>'Adam Glazer',
        'SITE'=>'Auto Obsessions',
        'TD'=>'Tyler Drury',
        'AS'=>'Alexander Sanchez',
        'AB'=>'Andrew Best'
    );*/
}
function rootURL(){
    //change to false for execution on server
    static $localExecution = true;
    return $localExecution?
        'http://localhost/Auto_ObsessionsX/'
        :
        'http://851entertainment.com/Auto_ObsessionsX/';
        //'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'
}
?>	