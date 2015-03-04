<?php
require_once 'AO_UI.php';

//function rb($str){<button id='rbTransmission' class='rb'></button>}
//function ub($str){<button id='ubEngine' class='ub'></button>}
?>
<div id='RepairShop'>
    <h1>Repair Shop</h1>
    <p id='error'></p>
<?php
    backBtn();
?>
	<button id='addFunds'>Add Funds</button>
    <!--a id='addFunds' href='<php echo rootURL() . 'state/funds.php';?>'>Add Funds</a-->
    <h2 id='dt'>Drivetrain</h2>	
    <div id='drivetrain'>
Engine:
<button id='ubEngine' class='ub'></button>
<button id='rbEngine' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbEngine' value='0.0'></progress>
<br>Transmission:
<button id='ubTransmission' class='ub'></button>
<button id='rbTransmission' class='rb'></button>
<br><?php //br(); pb('pbTransmission'); br();?>
<progress id='pbTransmission' value='0.0'></progress>
<br>Drive Axel:
<button id='ubAxel' class='ub'></button>
<button id='rbAxel' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbAxel' value='0.0'></progress>
<br>Exhaust:
<button id='ubExhaust' class='ub'></button>
<button id='rbExhaust' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbExhaust' value='0.0'></progress>
<br>
        <!--Fuel System:
        <button id='ubFuel' class='ub'></button>
        <button id='rbFuel' class='rb'></button>
        <br>
        <progress id='pbFuel' value='0.0'></progress>
        <br-->
    </div>
    <h2 id='body'>Body</h2>
    <div id='body'>
Chasis:
<button id='ubChasis' class='ub'></button>
<button id='rbChasis' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbChasis' value='0.0'></progress>
<br>Body Panels:
<button id='ubPanels' class='ub'></button>
<button id='rbPanels' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbPanels' value='0.0'></progress>
<br>Paint:
<button id='ubPaint' class='ub'></button>
<button id='rbPaint' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbPaint' value='0.0'></progress>
<br>Chrome:
<button id='ubPH0' class='ub'></button>
<button id='rbPH0' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbPH0' value='0.0'></progress>
<br>
        <!--PLACEHOLDER:
        <button id='ubBtn4' class='ub'></button>
        <button id='rb4' class='rb'></button>
        <br>
        <progress id='pb4' value='0.0'></progress>
        <br-->
    </div>
    <h2 id='interior'>Interior</h2>
    <div id='interior'>
Seats:
<button id='ubSeats' class='ub'></button>
<button id='rbSeats' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbSeats' value='0.0'></progress>
<br>Carpet:
<button id='ubCarpet' class='ub'></button>
<button id='rbCarpet' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbCarpet' value='0.0'></progress>
<br>Dash:
<button id='ubDash' class='ub'></button>
<button id='rbDash' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbDash' value='0.0'></progress>
<br>Door Panels:
<button id='ubPanels' class='ub'></button>
<button id='rbPanels' class='rb'></button>
<br><?php //pb('pb'); br();?>
<progress id='pbPanels' value='0.0'></progress>
<br>
        <!--PLACEHOLDER:
        <button id='ubBtn4' class='ub'></button>
        <button id='rb' class='rb'></button>
        <br>
        <progress id='pb4' value='0.0'></progress>
        <br-->
    </div>
    <!---->
    <h2 id='docs'>Documentation</h2>
    <div id='docs'>
Ownership:<button id='ubOwnership' class='ub'></button><br>
<progress id='pbOwnership' value='0.0'></progress>
<br>Build Sheet:
<button id='ubBuildSheet' class='ub'></button><br>
<?php //pb('pb'); br();?>
<progress id='pbBuildSheet' value='0.0'></progress>
<br>History:
<button id='ubHistory' class='ub'></button><br>
<?php //pb('pb'); br();?>
<progress id='pbHistory' value='0.0'></progress>
<br>Restoration:<button id='ubPH0' class='ub'></button><br>
<?php //pb('pb'); br();?>
<progress id='pbPH0' value='0.0'></progress>
<br>
        <!--PLACEHOLDER:<button id='ubBtn4' class='ub'></button><br>
        <progress id='pb4' value='0.0'></progress>
        <br-->
    </div>
    <!--img id='userCar'-->
    <!--div id='upgrades'>
        <h2>Upgrades</h2>
        <button id='ugBtn0'></button><br>
        <button id='ugBtn1'></button><br>
        <button id='ugBtn2'></button><br>
        <button id='ugBtn3'></button><br>
        <button id='ugBtn4'></button><br>
        <button id='ugBtn5'></button>
    </div>nn

    <div id='repairs'>
        <h2>Repairs</h2>
        <!--button id='fixBtn0'></button><br>
        <button id='fixBtn1'></button><br>
        <button id='fixBtn2'></button><br>
        <button id='fixBtn3'></button><br>
        <button id='fixBtn4'></button><br>
        <button id='fixBtn5'></button>
    </div-->	
</div>