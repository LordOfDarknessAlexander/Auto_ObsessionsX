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
    //echo "$id:";
    br();?>
    <img src=''><?php
    ub("ub");
    rb("rb"); br();
    pb("pb"); br(); //hr();
}
?>
<div id='RepairShop'>
   <!-- <h1>Repair Shop</h1> -->
    <p id='error'></p>
<?php
    backBtn();
?>
	<button id='addFunds'>Store</button>
    <div id='switch'>
        <button id='dt'>DT</button><br>
        <button id='body'>B</button><br>
        <button id='inter'>I</button><br>
        <button id='docs'>D</button><br>
    </div>
    <!--a id='addFunds' href='<php echo rootURL() . 'state/funds.php';?>'>Add Funds</a-->
    <!--cid for car info div-->
    <div id='cid0'>
        <h2 id='dt'>Drivetrain</h2><?php 
        statBar('');
        //statBar('Engine');
        //statBar('Transmission');
        //statBar('Axel');
        //statBar('Exhaust');?>
<!--Fuel System:-->
    </div>
    
    <div id='cid1'>
        <h2 id='body'></h2><?php
        statBar('');
        //statBar('Chasis');
        //statBar('Panels');
        //statBar('Paint');?><!--
Chrome:
<button id='ubPH0' class='ub'></button>
<button id='rbPH0' class='rb'></button>
<br>
<progress id='pbPH0' value='0.0'></progress>
<br>
<!--PLACEHOLDER:-->
    </div>
    <div id='cid2'>
        <h2 id='interior'><!--Interior--></h2><?php
        statBar('');
        //statBar('Seats');
        //statBar('Carpet');
        //statBar('Dash');
        //statBar('Panels');?>
<!--PLACEHOLDER:-->
    </div>
    <!---->

    <div id='cid3'>
        <h2 id='docs'><!--Documentation--></h2><?php
        statBar('');
?>
        
<!--Ownership:<button id='ubOwnership' class='ub'></button><br>
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