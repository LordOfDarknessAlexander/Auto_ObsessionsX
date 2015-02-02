<?php
//this script queries the vehicle database returning the results, used by javascript ajax requests
require_once 'vehicle.php';
require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
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
//echo $cars->toJSON(); //serialize to JSON to send over internet
//}
$q = 'SELECT * FROM aoCars WHERE car_id = 1';   //select an individual element
//$q = 'SELECT * FROM aoCars';   //select all elements
$result = $AO_DB->query($q);

if($result)
{
    if(mysqli_num_rows($result) != 0)
    {
        //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
        $data = $result->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
        //$car = Vehicle::fromArray($data);
        echo '{"data":"this is data!"}';    //"$car->toJSON();
    } 
    else{ 
        echo "<h2>System Error</h2>
        <p class='error'>Vehicle could not be registered due to a system error. Please try again later</p>";
        //echo '<p>'.mysqli_error($CARS.$con).'<br><br>Query: '.$q.'</p>';
    } 
    mysqli_free_result($result);
}
else{   //The vehicle is already registered
    echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
}
?>