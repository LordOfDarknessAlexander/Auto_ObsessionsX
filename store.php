<?php 
require_once 'ao.php';
require_once 're.php';
require_once 'html.php';
//
html::docType();
//
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

function ppImg($str){
    //form input button
	$s = html::escape($str);
	?><input type='image' name='submit' src="images/store/<?php
        echo $s;
    ?>.png" alt='PayPal - The safer, easier way to pay online!'>
<?php
}

$URL = rootURL();
//function ppf($id){
    //paypal form
    //>
//}
//

//$us = user::getStats();

//if(isSetP() ){
    //$op = getOpFromGET();
    
//}
//
?>
<html>
<head>
<?php
    html::charset();
    html::title('AO Store');
    //css
    html::incPHPCSS('auto');
    html::incPHPCSS('store');
    //js
    html::incJS('jquery.2.1.1.min');
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
    <pre id='info'><?php
if(!loggedIn() ){?>  You do not have full access to this page,
Please <a href='<?php
    echo $URL . 'registerUser.php';
?>'>register</a> and <a href='<?php
    echo $URL .'login.php';
?>'>log in</a> to access the store<?php
}
    ?></pre>
    <img id='adBar'>
<?php
    //backBtn();
	//homeBtn();
?>
    <div id='reg-navigation'>
        <a id='home' class='tooltip' href='<?php
            echo $URL . 'index.php';
        ?>'>Home<!--span><img src=''>Tooltip!</span--></a><br>		
<?php
if(loggedIn() ){?>
        <a id='mem' href='<?php
            echo $URL .'members-page.php';?>'>Members</a><br>
        <a id='logout' href='<?php
            echo $URL .'logout.php';?>'>Logout</a><br>
<?php
}
else{?>
        <a id='reg' href='<?php
            echo $URL . 'registerUser.php';?>'>Register</a><br>
        <a id='login' href='<?php
            echo $URL .'login.php';?>'>Login</a><br>
<?php
}
?>
    </div>
    
    <div id='cash'>
        <!--user purchases funds-->
        <form id='c50' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('FL8LXKLA32L7L');
            ppImg("cash/fifty");
?>
        </form>
        <form id='c200' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('67Y652AAYHX2N');
            ppImg("cash/twoHundred");
?>
        </form>
        <form id='c500' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('KMZPZHDR3RVYQ');
            ppImg("cash/fiveHundred");
?>
        </form>
        <form id='c1000' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('KC3TWE84J7S42');
            ppImg("cash/oneMil");
?>
        </form>
    </div>
    
    <div id='tokens'>
        <!--user purchases tokens-->
        <form id='t3' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <!--
            <input type="hidden" name="hosted_button_id" value="XZCKNKNJHAA2S">
            <input type="image" src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<?php
            hb();
            hostBtn('XZCKNKNJHAA2S');
            ppImg("tokens/three");
?>
        </form>
        <form id='t5' action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
           
            <!--<input type="hidden" name="hosted_button_id" value="NCPWY2FWXBD9L">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<?php
            hb();
            hostBtn('NCPWY2FWXBD9L');
            ppImg("tokens/five");
?>
        </form>
        
        <form id='t10' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('FM7WWV76Q54YG');
            ppImg("tokens/ten");
?>
          
           <!-- <input type="hidden" name="hosted_button_id" value="FM7WWV76Q54YG">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
        </form>

        <form id='t20' action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<?php
            hb();
            hostBtn('KTV2Q8T8MMY5U');
            ppImg("tokens/twenty");
?>
           
            <!--<input type="hidden" name="hosted_button_id" value="KTV2Q8T8MMY5U">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
        </form>
    </div>
</div>
<script>
$(function(){
    //script to be executed after page loads
<?php
if(loggedIn() ){?>
    $('pre#info').hide();
<?php
}?>
});
</script>
<?php html::footer();?>