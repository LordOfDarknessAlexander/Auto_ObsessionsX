<?php
//this script queries the vehicle database returning the results, used by javascript ajax requests
require_once 'vehicle.php';
//require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//$CARS = dbConnect();  //global
//temporary until vehicle DB is setup!
$car = new Vehicle('Jaguar', '1969', 'E-Type Series II 4.2 Roadster', 'defaultInfo', '25000');

$cars = array(
	new Vehicle('Jaguar', '1969', 'E-Type Series II 4.2 Roadster', 'defaultInfo', '25000'),
	new Vehicle('Chevrolet', '1969','Camaro RS-Z28 Sport Coupe', 'info', '18000'),
	new Vehicle('GMC', '1997', 'Sierra', 'more info', '12000'),
	new Vehicle('Audi', '2013', 'S5 Coupe', 'additional info', '57000')
	//...etc
);
//if($_SERVER['REQUEST_METHOD'] == 'POST'){   //&& isset($_POST) && !empty($_POST)
    //form submitted, add entries to server
    //$errors = array(); // Start an array named errors
    //
    //$e = VehicleEntry();
    //$make = $_POST['make'];
    //$year = $_POST['year'];
    //$name = $_POST['name'];
    
    //$stripped = strip('info');
    //$strlen = mb_strlen($stripped, 'utf8');
    //
    //if(!$strlen){
        //$errors[] = 'No car info.';
    //}
    //else{
        //$info = $stripped;
    //}
echo $cars[0]->toJSON(); //serialize to JSON to send over internet
//}
?>