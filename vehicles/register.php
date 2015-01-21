<?php
//interface and html page for adding, deleting or modifying entries in the vehicle database on the server
require_once '../include/html.php';
//require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//allow execution of this script ONLY for registered admins! else nothing
//secureAdmin();
//$CARS = dbConnect();  //global
function strip($str){
    //global $CARS;
    return $_POST[$str];    //$CARS.strip($str);
}
html::simpleHead('Vehicle Registration');
?>
<h2>Vehicle Registration</h2>
<?php
//class VehicleEntry{
    //public var
        //$manu,
        //$year,
        //$model,
        //$info;
//}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //form submitted, add entries to server
    $errors = array(); // Start an array named errors
    //
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
    }

    if(empty($errors)){ 
        //$q = "SELECT user_id FROM users WHERE email = '$e' ";
        $result = 0;    //mysqli_query($CARS.$con, $q); //$CARS.query($q);
        
        if($result == 0){//mysqli_num_rows($result) == 0){
            //The mail address was not already registered therefore register the user in the users table
            // Make the query:
            //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
            //$result = @mysqli_query($CARS.$con, $q); // Run the query
            //If the query ran OK
            if($result){
                //header('location: register-thanks.php');
                //exit();
            } 
            else{ 
                echo "<h2>System Error</h2>
                <p class='error'>Vehicle could not be registered due to a system error. Please try again later</p>";
                //echo '<p>'.mysqli_error($CARS.$con).'<br><br>Query: '.$q.'</p>';
            }
            //the data base will be closed when when the script exits and the server session terminates
            html::footer();
            exit();
        }
        else{   //The vehicle is already registered
            echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        }
    }
    else{
        echo "<h2>Error!</h2>
        <p class='error'>The following error(s) occurred:<br>";
        foreach ($errors as $msg){
            echo " - $msg<br>\n";
        }
        echo '</p><h3>Please try again.</h3><p><br></p>';
    }
    else{?>
No form posted accessing page directly
<?php
    }
}// End of the main Submit conditionals
?>
<form action='register.php' method='post'>
    <!--link to self, refreshes page-->
    Manufacturer:<br><input id='make' type='text' size='20' maxlength='20'>
    <!--select name="make">
        <!--Select from an AO registered manufacturer>
		<option value=''>-Select-</option>
        <option value='Audi'>Audi</option>
        <option value='Bentley'>Bentley</option>
        <option value='BMW'>BMW</option>
		<option value='Chevrolet'>Chevrolet</option>
        <option value='Dodge'>Dodge</option>
        <option value='Ford'>Ford</option>
        <option value=''>Ferrari</option>
        <option value=''>Jaguar</option>
        <option value=''>Lamborghini</option>
        <option value=''>Porsche</option>
        <option value=''>Shelby</option>
    </select--><br>
    Model:<br><input id='model' type='text' size='20' maxlength='20'><br>
    Year:<br><input id='year' type='text' size='10' maxlength='10'><br>
    Price:<br><input id='price' type='text' size='20' maxlength='20'><br>
    Information:<br><input id='info' type='text' size='40' maxlength='40'><br>
    <input id='submit' type='submit' value='Submit'>
</form>
<?php
//<div id='dbCarView'>
    //iterate over all contents of the vehicle database,
    //outputting an image, which when selected, displays info for an admin to edit
    //$q = 
    //$res = $CARS.query($q);
    //foreach($res as $e){
        //echo "<button id='$e.id'><img src='".$IMG_DIR.$e.getLocalPath()."'></button>";
    //}
//</div-->
html::footer();?>