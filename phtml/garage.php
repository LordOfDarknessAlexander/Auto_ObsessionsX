<?php
require_once 'AO_UI.php';
//
function selectBtn(){?>
    <button id='select'>Select</button>
<?php
}

function cvStatBar($id){
    echo $id . ':';
    br(); pb("pb$id"); br(); //hr();
}
function carView(){
    //display vehicle data?>
    <img id='carImg'><br>
    <label id='carName'></label>
    <label id='carInfo'></label>
    <button id='con'>0</button>
    <div id='progressBars'>
<?php
cvStatBar('Drivetrain');
cvStatBar('Body');
cvStatBar('Interior');
cvStatBar('Documents');
?>
    </div>
<?php
}
?>

<div id='Garage'>
   <!-- <h1>Garage</h1>  -->
<?php
    backBtn();
    selectBtn();
    carFilter();
?>
    <!--div id='filter'>Filters<hr>
        <div id='stage'>stage<br>
            <button id='slctAllF'>All</button><br>
            <button id='slctClassic'>Classic</button><br>
            <button id='slctCustom'>Custom</button><br>
            <button id='slctMuscleF'>Muscle</button><br>
            <button id='slctUnique'>Unique</button><br>
            <button id='slctForeign'>Foreign</button><br>
        </div>

        <div id='tier'>tier<br>
            <button id='slctAll'>All</button><br>
            <button id='slctLow'>Low</button><br>
            <button id='slctMid'>Mid</button><br>
            <button id='slctHigh'>High</button><br>
            <button id='slctElite'>Elite</button><br>
        </div>
    </div-->
    <button id='viewCar'>View</button>
    <button id='shop'>Upgrades</button>
    <button id='sales'>Sales</button>
  
    <div id='carListView'>
        <ul id='carBtns'>
        <!--list contents added dynamically at run time by JS
        TODO:generate content using PHP instead-->
        </ul>
    </div>
    <div id='userCar'>
<?php carView();?>
    </div>
    <div id='selectedCar'>
<?php carView();?>
    </div>
</div>

<div id='CarView'>
    <!--<selectBtn();>display vehicle stats and actions-->
    <label id='carName'>--Name--</label>
    <button id='select'>Select</button>
    <button id='sell'>Sell</button>
	
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
    <img id='dt' title='Drivetrain' src='images/parts/drivetrain/icon.png'>Drivetrain</h2>	
    <div id='drivetrain'>	
<?php
cvStatBar('Engine');
cvStatBar('Transmission');
?>
Drive Axel:<br>
<progress id='pbAxel' value='0.0'></progress>
<br><?php cvStatBar('Exhaust');?>
    </div>
    <img id='body' title='Body' src='images/parts/body/icon.png'>Body</h2>
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
    <img id='interior' title='Interior' src='images/parts/interior/icon.png'>Interior</h2>
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
    <img id='docs' title='Documentation' src='images/parts/documents/icon.png'>Documentation</h2>
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