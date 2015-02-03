<?php
//interface and html page for adding, deleting or modifying entries in the vehicle database on the server
require_once '../include/html.php';
require_once '../include/dbConnect.php';
require_once 'vehicle.php';

html::simpleHead('Vehicle Registration');
?>
<h2>Vehicle Registration</h2>
<?php
function strip($str){
    return $_POST[$str];
}
$errors = array(); // Start an array named errors

if($_SERVER['REQUEST_METHOD'] == 'POST') //&& isset($_POST) )
{    //form submitted, add entries to server and display results
/*
    //$e = VehicleEntry();
    $stripped = strip('make');
    // Check stripped string
    if(!mb_strlen($stripped, 'utf8')){
        $errors[] = 'No manufacturer entered.';
    }
    else{
        $manu = $stripped;
    }
    $stripped = strip('year');
    //
    if(!mb_strlen($stripped, 'utf8')){
        $errors[] = 'No year of production entered.';
    }
    else{
        $year = $stripped;
    }
    $stripped = strip('model');
    //
    if(!mb_strlen($stripped, 'utf8')){
        $errors[] = 'No model entered.';
    }
    else{
        $model = $stripped;
    }
    $stripped = strip('price');
    $strlen = mb_strlen($stripped, 'utf8');
    //
    if(!$strlen){
        $errors[] = 'No price entered.';
    }
    else{
        $price = $stripped;
    }
    $stripped = strip('info');
    $strlen = mb_strlen($stripped, 'utf8');
    //
    if(!$strlen){
        $errors[] = 'No car info.';
    }
    else{
        $info = $stripped;
    }*/
}// End of the main Submit conditionals

if(empty($errors)){
    //sqlSelectAll('aoCars', 'carOut');
    
    $q = 'SELECT * FROM aoCars WHERE car_id = 167793153';   //select an individual element
    
    $result = $AO_DB->query($q);
    
    if($result)
    {
        if(mysqli_num_rows($result) != 0)
        {
            $data = $result->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
            $car = Vehicle::fromArray($data);
            echo $car->getPrice();
        } 
        else{ 
            echo "<h2>System Error</h2>
            <p class='error'>Vehicle could not be registered due to a system error. Please try again later</p>";
            //echo '<p>'.mysqli_error($CARS.$con).'<br><br>Query: '.$q.'</p>';

            //the data base will be closed when when the script exits and the server session terminates
            mysqli_free_result($result);
            html::footer();
            exit();
        } 
        mysqli_free_result($result);
    }
    else{   //The vehicle is already registered
        echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        html::footer();
        exit();
    }
}
else{
    echo "<h2>Error!</h2>
    <p class='error'>The following error(s) occurred:<br>";
    foreach ($errors as $msg){
        echo " - $msg<br>\n";
    }
    echo '</p><h3>Please try again.</h3><p><br></p>';
    
    html::footer();
    exit();
}
?>
<form action='register.php' method='post'>
    <!--link to self, refreshes page-->
    Manufacturer:<br>
    <select id='make' name='make'>
        <!--Select from an AO registered manufacturer-->
		<option value=''>-Select-</option>
        <option value='Audi'>Audi</option>
        <option value='Bentley'>Bentley</option>
        <option value='BMW'>BMW</option>
		<option value='Chevrolet'>Chevrolet</option>
        <option value='Dodge'>Dodge</option>
        <option value='Ford'>Ford</option>
        <option value='Ferrari'>Ferrari</option>
        <option value='Jaguar'>Jaguar</option>
        <option value='Lamborghini'>Lamborghini</option>
        <option value='Porsche'>Porsche</option>
        <option value='Shelby'>Shelby</option>
    </select><br>
    Year:<br>
    <select id='year' name='year'>
        <option value=''>-Select-</option>
<?php
//generation of the selection options for all possible production years
//for cars between The current Year and the first ever
//production car, the Model T.(code updates itself, no upkeep!)
$year = 1908;  //year of first Model T, by Ford!
$thisYear = (int)date('Y');

for(; $year <= $thisYear; $year++){ ?>  //; year++, i++){
    <option value='<?php echo $year;?>'>
        <?php echo $year;?>
    </option>
<?php
}
?>
    </select><br>
    Model:<br><input id='model' name='model' type='text' size='25' maxlength='25'><br>
    Price:<br><input id='price' name='price' type='text' size='20' maxlength='20'><br>
    Information:<br><input id='info' name='info' type='text' size='40' maxlength='40'><br>
    <input id='submit' name='submit' type='submit' value='Submit'>
</form>
<?php
//$car = new Vehicle('Jaguar');
//echo $car->$make;
//<div id='dbCarView'>
    //iterate over all contents of the vehicle database,
    //outputting an image, which when selected, displays info for an admin to edit
    //$q = 
    //$res = $CARS.query($q);
    //foreach($res as $e){
        //echo "<button id='$e.id'><img src='".$IMG_DIR.$e.getLocalPath()."'></button>";
    //}
//</div>
?>
<?php html::footer();?>