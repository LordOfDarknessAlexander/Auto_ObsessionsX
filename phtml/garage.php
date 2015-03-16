<?php
require_once 'AO_UI.php';
//
function selectBtn(){?>
    <button id='select'>Select</button>
<?php
}

function cvStatBar($id){
    echo $id . ':';
    br(); pb("pb$id"); br(); hr();
}
?>
<div id='Garage'>
    <h1>Garage</h1>
<?php
    backBtn();
    selectBtn();
	
?>
    <button id='viewCar'>View</button>
    <button id='sales'>Sales</button>
    <button id='shop'>Upgrades</button>
  
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
        <button id='con'>0</button>
        <div id='progressBars'>
            <!--progress bar 'value' attribute is between 0.0 and 1.0-->
<?php
//cvStatBar('Drivetrain');
//cvStatBar('Body');
//cvStatBar('Interior');
//cvStatBar('Documents');
?>
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
        <button id='con'>0</button>
        <div id='progressBars'>
<?php
//cvStatBar('Drivetrain');
//cvStatBar('Body');
//cvStatBar('Interior');
//cvStatBar('Documents');
?>
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
    <label id='carName'>--Name--</label>
    <button id='selectCarBtn'>Select</button>
    <button id='sellBtn'>Sell</button>
	
    <!--img id='car'> <src='images\\vehicle.jpg'-->
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
<?php
cvStatBar('Engine');
cvStatBar('Transmission');
?>
Drive Axel:<br>
<progress id='pbAxel' value='0.0'></progress>
<br><?php cvStatBar('Exhaust');?>
    </div>
    <h2 id='body'>Body</h2>
    <div id='body'>
<?php
cvStatBar('Chasis');
?>
Body Panels:<br>
<progress id='pbPanels' value='0.0'></progress>
<br><?php cvStatBar('Paint');?>
Chrome:<br>
<progress id='pbPH0' value='0.0'></progress>
<br>
    </div>
    <h2 id='interior'>Interior</h2>
    <div id='interior'>
<?php
cvStatBar('Seats');
cvStatBar('Carpet');
cvStatBar('Dash');
?>
Door Panels:<br>
<progress id='pbPanels' value='0.0'></progress>
<br>
    </div>
    <h2 id='docs'>Documentation</h2>
    <div id='docs'>
<?php
cvStatBar('Ownership');
?>
Build Sheet:<br>
<progress id='pbBuildSheet' value='0.0'></progress>
<?php cvStatBar('History');?>
Restoration:<br>
<progress id='pbPH0' value='0.0'></progress>
<br>
    </div>
</div>