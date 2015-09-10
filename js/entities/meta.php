<?php
//
//entities\meta.php
//Created by Tyler R. Drury, 9-09-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
header('Content-type: application/javascript; charset: UTF-8');
//
$scripts = array(
    'player',
    'enemy',
    //'parts/part',
    //'parts/drivetrain',
    //'parts/body',
    //'parts/interior',
    //'parts/docs',
    //'vehicle'
);
//combine each javascript file, in order declared
foreach($scripts as $s){
    //include local files ine this and subfolders
    require_once "$s.php";
}
?>
