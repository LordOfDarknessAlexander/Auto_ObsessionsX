<?php
require_once 'AO_UI.php';

function rb($str){
    //outputs a repair button?>
<button id='<?php echo $str;?>' class='rb'></button>
<?php
}
function ub($str){
    //outputs an upgrade button?>
<button id='<?php echo $str;?>' class='ub'></button>
<?php
}
function statBar($id){
    br(); ub("ub$id"); rb("rb$id");
    br(); pb("pb$id"); br(); hr();
}
?>
<div id='RepairShop'>
   <!-- <h1>Repair Shop</h1> -->
    <p id='error'></p>
<?php
    backBtn();
?>
	<button id='addFunds'>Add Funds</button>
    <!--a id='addFunds' href='<php echo rootURL() . 'state/funds.php';?>'>Add Funds</a-->
    <h2 id='dt'>Drivetrain</h2>	
    <div id='drivetrain'>
Engine:<?php statBar('Engine');?>
Transmission:<?php statBar('Transmission');?>
Drive Axel:<?php statBar('Axel');?>
Exhaust:<?php statBar('Exhaust');?>
<!--Fuel System:-->
    </div>
    <h2 id='body'>Body</h2>
    <div id='body'>
Chasis:<?php statBar('Chasis');?>
Body Panels:<?php statBar('Panels');?>
Paint:<?php statBar('Paint');?>
Chrome:
<button id='ubPH0' class='ub'></button>
<button id='rbPH0' class='rb'></button>
<br>
<progress id='pbPH0' value='0.0'></progress>
<br>
<!--PLACEHOLDER:-->
    </div>
    <h2 id='interior'>Interior</h2>
    <div id='interior'>
Seats:<?php statBar('Seats');?>
Carpet:<?php statBar('Carpet');?>
Dash:<?php statBar('Dash');?>
Door Panels:<?php statBar('Panels');?>
<!--PLACEHOLDER:-->
    </div>
    <!---->
    <h2 id='docs'>Documentation</h2>
    <div id='docs'>
Ownership:<button id='ubOwnership' class='ub'></button><br>
<progress id='pbOwnership' value='0.0'></progress>
<br>Build Sheet:
<button id='ubBuildSheet' class='ub'></button><br>
<?php //ub(''); br(); pb('pb'); br();?>
<progress id='pbBuildSheet' value='0.0'></progress>
<br>History:
<button id='ubHistory' class='ub'></button><br>
<?php //ub(''); br(); pb('pb'); br();?>
<progress id='pbHistory' value='0.0'></progress>
<br>Restoration:<button id='ubPH0' class='ub'></button><br>
<?php //ub(''); br(); pb('pb'); br();?>
<progress id='pbPH0' value='0.0'></progress>
<br>
<!--PLACEHOLDER:-->
    </div>
</div>