<?php
require_once 'AO_UI.php';
//
function selectBtn(){?>
    <button id='select'>Select</button>
<?php
}
?>

<div id='Garage'>
<?php include("include/statBar.php"); ?>
    <h1>Garage</h1>
    <?php selectBtn();?>
    <button id='viewCar'>View</button>
    <!--button id='sellCar'>Sell</button-->
    <?php backBtn();?>
    
    <div id='carListView'>
        <ul id='carBtns'>
        <!--list contents added dynamically at run time by JS
        TODO:generate content using PHP instead-->
        </ul>
    </div>
    
    <div id='userCar'>
        <!--display for currently selected vehicle-->
        <img id='carImg'> <!--src='images/vehicle.jpg'-->
        <br>
        <!--label id='curCarName'>m:</label>
        <label id='curCarInfo'>current car info</label-->
        <label id='carName'>name</label>
        <br>
        <label id='carInfo'>info</label>
        <br>
        <div id='progressBars'>
            <!--progress bar 'value' attribute is between 0.0 and 1.0-->
drivetrain:<br><progress id='drivetrainPB' value='0.0'></progress>
<br>body:<br><progress id='bodyPB' value='0.0'></progress>
<br>interior:<br><progress id='interiorPB' value='0.0'></progress>
<br>documents:<br><progress id='docsPB' value='0.0'></progress>
        </div>
    </div>
    <div id='selectedCar'>
        <!--display vehicle picked by user-->
        <img id='carImg'> <!--src='images/vehicle.jpg'-->
        <br>
        <label id='carName'></label>
        <br>
        <label id='carInfo'></label>
        <br>
        <div id='progressBars'>
drivetrain:<br><progress id='drivetrainPB' value='0.0'></progress>
<br>body:<br><progress id='bodyPB' value='0.0'></progress>
<br>interior:<br><progress id='interiorPB' value='0.0'></progress>
<br>documents:<br><progress id='docsPB' value='0.0'></progress>
        </div>
    </div>

    <!--ul id='carBtns'>
    <!--list is populated in '../program.js' from '../user.xml'
    the list items dont have to exist but the root tag must>
    </ul-->
</div>

<div id='CarView'>
    <!--<selectBtn();>display vehicle stats and actions-->
    <button id='selectCarBtn'>Select</button>
    <button id='sellBtn'>Sell</button>
    <img id='car'> <!--src='images\\vehicle.jpg'-->
    <!--div id='statLabels'>
        <lable>Drivetrain</label>
        <lable>Body</label>
        <lable>Interior</label>
        <lable>Documents</label>
    </div-->
    <!--div id='carInfoBoxes'></div-->
<?php
    carInfoLabel();
    backBtn();
    homeBtn();
?>
    <h2 id='dt'>Drivetrain</h2>
    <div id='drivetrain'>
        Engine:<br>
        <progress id='pbEngine' value='0.0'></progress>
        <br>Transmission:<br>
        <progress id='pbTransmission' value='0.0'></progress>
        <br>Drive Axel:<br>
        <progress id='pbAxel' value='0.0'></progress>
        <br>Exhaust:<br>
        <progress id='pbExhaust' value='0.0'></progress>
        <br>
    </div>
    <h2 id='body'>Body</h2>
    <div id='body'>
        Chasis:<br>
        <progress id='pbChasis' value='0.0'></progress>
        <br>Body Panels:<br>
        <progress id='pbPanels' value='0.0'></progress>
        <br>Paint:<br>
        <progress id='pbPaint' value='0.0'></progress>
        <br>PLACEHOLDER:<br>
        <progress id='pbPH0' value='0.0'></progress>
        <br>
    </div>
    <h2 id='interior'>Interior</h2>
    <div id='interior'>
        Seats:<br>
        <progress id='pbSeats' value='0.0'></progress>
        <br>Carpet:<br>
        <progress id='pbCarpet' value='0.0'></progress>
        <br>Dash:<br>
        <progress id='pbDash' value='0.0'></progress>
        <br>Door Panels:<br>
        <progress id='pbPanels' value='0.0'></progress>
        <br>
    </div>
    <h2 id='docs'>Documentation</h2>
    <div id='docs'>
        Ownership:<br>
        <progress id='pbOwnership' value='0.0'></progress>
        <br>Build Sheet:<br>
        <progress id='pbBuildSheet' value='0.0'></progress>
        <br>History:<br>
        <progress id='pbHistory' value='0.0'></progress>
        <br>PLACEHOLDER:<br>
        <progress id='pbPH0' value='0.0'></progress>
        <br>
    </div>
</div>