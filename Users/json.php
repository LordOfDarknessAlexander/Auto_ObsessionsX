<?php

//$json =;

//$obj = jsonString2Obj($_POST['json']);
$person = jsonString2Obj($_POST['json']);

//echo $obj->name;
echo $person->name;

//loop through array
/*
foreach($array as $obj)
{
	echo "car: ".obj->car. "  animal: ".$obj->animal .  "\n";
}
*/
function jsonSring2Obj($str){
	
	return json_decode(stripslashes($str));
};
/*
function jsonSring2Obj($str)
{
	
*/

?>