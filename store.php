<?php 
require_once 'ao.php';
require_once 're.php';
require_once 'html.php';
    //function paypalBtn($id, $val){
    //inserts a button into a form implementing the 'PayPal' api
    //<input type='image' id='<echo $id>' value='<echo $val>'><br>
    //}
    // function paypalPath(){>'https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay'<php
    // }
// class pp{
    // //encapsulates variables and functions related to the paypal store API
    // const SANDBOX = true; 
    
    // function storePath(){
        // //FALSE on server AND when live,
        // //TRUE when site's under developement or testing locally(with xampp)
        // >https://www.<php
        // //if(pp::SANDBOX){
            // ><!--sandbox.--><php
        // }>paypal.com/cgi-bin/webscr<php
    // }
// }
function ic(){
    ?><input type="hidden" name="cmd" value="_s-xclick">
<?php
}
function hb(){
    //hidden button
    ?><input type="hidden" name="cmd" value="_s-xclick">
    <?php
}
function hostBtn($id){
    //hosted button
    //$id is retrived using the paypal web api
    //escape id
    $str = isUINT($id) ? $id : '';
    ?><input type='hidden' name='hosted_button_id' value='<?php echo $str;?>'>
    <?php
}
function ppAttr(){
    //paypal form attributes
}
function ppImg($src){
    //escape source
    ?><input type="image" src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' name="submit" alt="PayPal - The safer, easier way to pay online!">
    <?php
}
//function ppf($id){
    //paypal form
    //>
//}
//
//if(!loggedIn() ){
    //exit('You are not a registered user and do not have permission to view this page');
//}

//$us = user::getStats();
//
html::docType();
?>
<html>
<head>
<?php
    html::charset();
    html::title('AO Store');
    html::incPHPCSS('auto');
    html::incPHPCSS('store');
?>
</head>
<body>
<div id='AddFunds'>
    <div id='statBar'>  
        <div id ='aAmerica'> PHOTOS COURTESY OF AUCTIONS AMERICA</div>
        <!--this stat bar will be visible across all pages/divs-->
        <label id='money'>Money: </label>
        <label id='tokens'>Tokens:</label>
        <label id='prestige'>Prestige:</label>
        <label id='m_marker'>Mile Markers:</label>
    </div>
    
    <img id='mainCar' src='images\\garageEmpty.png'>
    <pre id='info'></pre>
    <img id='adBar'>
<?php
    //backBtn();
	//homeBtn();
?>
    <!--button id='addFundsBackButton'>Back</button-->
	<!--a href='<php //pp::minorFundsPath();>'><input type='image' id='addMinorFundsBtn' value='chump change'></a-->
    <div id='cash'>
        <!--user purchases funds-->
        <form id='c50' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('FL8LXKLA32L7L');
            ppImg("https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif");
?>
        </form>
        <form id='c200' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('67Y652AAYHX2N');
            ppImg("https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif");
?>
        </form>
        <form id='c500' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('KMZPZHDR3RVYQ');
            ppImg("https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif");
?>
        </form>
        <form id='c1000' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('KC3TWE84J7S42');
            ppImg("https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif");
?>
        </form>
    </div>
    
    <div id='tokens'>
        <!--user purchases tokens-->
        <form id='t3' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <?php hb();?>
            <input type="hidden" name="hosted_button_id" value="XZCKNKNJHAA2S">
            <input type="image" src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        <form id='t5' action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
            <?php hb();?>
            <input type="hidden" name="hosted_button_id" value="NCPWY2FWXBD9L">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
        
        <form id='t10' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <?php hb();?>
            <input type="hidden" name="hosted_button_id" value="FM7WWV76Q54YG">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>

        <form id='t20' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <?php hb();?>
            <input type="hidden" name="hosted_button_id" value="KTV2Q8T8MMY5U">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
        </form>
    </div>
</div>
<?php html::footer();?>