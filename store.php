<?php 
require_once 'ao.php';
require_once 're.php';
require_once 'html.php';
require_once 'user.php';
//require_once 'dbConnect.php';
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
	$s = html::escape($str);    //escapeURL
	?><input type='image' name='submit' src="images/store/<?php
        echo $s;
    ?>.png" alt='PayPal - The safer, easier way to pay online!'>
<?php
}

$URL = rootURL();
$LI = loggedIn();
//function ppf($id){
    //paypal form
    //>
//}
//
function ppSrc(){
    //returns the paypal source URL if logged in and able
    //to make transactions, else returns nothing,
    //effectively liking user back to this page
    global $URL;
    
    if(loggedIn() ){
        ?>https://www.paypal.com/cgi-bin/webscr<?php
    }
    else{
        echo $URL . 'store.php';
    }
}

$completed = false;
$msg = '';
    
if(isSetG() ){
	$op = getOpFromGET();
	$val = '';
	
	if($op == 'cash'){
		$funds = 0.0;
		
		if($val == 'c50'){
			$funds = 50000.0;
			user::incFunds($funds);
			$completed = true;
		}
		else if($val == 'c200'){
			$funds = 200000.0;
			user::incFunds($funds);
			$completed = true;
		}
		else if($val == 'c500'){
			$funds = 500000.0;
			user::incFunds($funds);
			$completed = true;
		}
		else if($val == 'c1000'){
			$funds = 1000000.0;
			user::incFunds($funds);
			$completed = true;
		}
		
		if($completed){
			$msg = "Your purchase of \$$funds completed successfully.";
		}
		else{
			$msg = "Your purchase of \$$funds was unsuccessful.";
		}
	}
	else if($op == 'tokens'){
		$amount = 0;
		
		if($val == 't3'){
			$amount = 3;
			purchase::tokens($amount);
			$completed = true;
		}
		else if($val == 't5'){
			$amount = 5;
			purchase::tokens($amount);
			$completed = true;
		}
		else if($val == 't10'){
			$amount = 10;
			purchase::tokens($amount);
			$completed = true;
		}
		else if($val == 't20'){
			$amount = 20;
			purchase::tokens($amount);
			$completed = true;
		}

		if($completed){
			$msg = "Your purchase of $amount tokens completed successfully.";
		}
		else{
			$msg = "Your purchase of $amount tokens was unsuccessful.";
		}
	}
	else{
		$msg = "Invalid operation, unrecognized argument passed to get.";
	}		
}
//
//if a purcahse has been made, get user stats will get the new values
//$us = user::getStats();
?>
<html>
<head>
<?php
html::charset();
html::title('AO Store');
//css
$css = array(
    'auto',
    'store'
);

foreach($css as $p){
    html::incPHPCSS($p);
}

$js = array(
    'jquery.2.1.1.min',
    'GameMode'
);

foreach($js as $p){
    html::incJS($p);
}
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
        <label id='markers'>Mile Markers:</label>
    </div>
<?php
$path = $LI ? user::getCurCarImgPath() : "images\garageEmpty.png";//user.get.curCarPath();
?>
    <img id='mainCar' src='<?php echo $path;?>'>
    <pre id='info'><?php
if(!$LI){?>  You do not have full access to this page,
Please <a href='<?php
    echo $URL . 'registerUser.php';
?>'>register</a> and <a href='<?php
    echo $URL .'login.php';
?>'>log in</a> to access the full store<?php
}
else {
	echo $msg;
}
?></pre>
    <button id='allowance'></button>
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
if($LI){?>
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
	<canvas id='canvas' width='900' height='600'>
        <p>You're browser does not support the required functionality to play this game.</p>
        <p>Please update to a modern browser such as <a href='www.google.com/chrome/‎'>Google Chrome</a> to play.</p>
    </canvas> 
    
    <div id='cash'>
        <!--user purchases funds-->
        <form id='c50' action="<?php ppSrc();?>" method="post" target="_top">
<?php
if($LI){
            hb();
            hostBtn('FL8LXKLA32L7L');
}
            ppImg("cash/fifty");
?>
        </form>
        <form id='c200' action="<?php ppSrc();?>" method="post" target="_top">
<?php
if($LI){
            hb();
            hostBtn('67Y652AAYHX2N');
}
            ppImg("cash/twoHundred");
?>
        </form>
        <form id='c500' action="<?php ppSrc();?>" method="post" target="_top">
<?php
if($LI){
            hb();
            hostBtn('KMZPZHDR3RVYQ');
}
            ppImg("cash/fiveHundred");
?>
        </form>
        <form id='c1000' action="<?php ppSrc();?>" method="post" target="_top">
<?php
if($LI){
            hb();
            hostBtn('KC3TWE84J7S42');
}
            ppImg("cash/oneMil");
?>
        </form>
    </div>
    
    <div id='tokens'>
        <!--user purchases tokens-->
        <form id='t3' action="<?php ppSrc();?>" method="post" target="_top">
            <!--
            <input type="hidden" name="hosted_button_id" value="XZCKNKNJHAA2S">
            <input type="image" src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<?php
if($LI){
            hb();
            hostBtn('XZCKNKNJHAA2S');
}
            ppImg("tokens/three");
?>
        </form>
        <form id='t5' action="<?php ppSrc();?>" method='post' target='_top'>
           
            <!--<input type="hidden" name="hosted_button_id" value="NCPWY2FWXBD9L">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<?php
if($LI){
            hb();
            hostBtn('NCPWY2FWXBD9L');
}
            ppImg("tokens/five");
?>
        </form>
        
        <form id='t10' action="<?php ppSrc();?>" method="post" target="_top">
<?php
if($LI){
            hb();
            hostBtn('FM7WWV76Q54YG');
}
            ppImg("tokens/ten");
?>
          
           <!-- <input type="hidden" name="hosted_button_id" value="FM7WWV76Q54YG">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
        </form>

        <form id='t20' action="<?php ppSrc();?>" method="post" target="_top">
<?php
if($LI){
            hb();
            hostBtn('KTV2Q8T8MMY5U');
}
            ppImg("tokens/twenty");
?>
           
            <!--<input type="hidden" name="hosted_button_id" value="KTV2Q8T8MMY5U">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
        </form>
    </div>
</div>
<?php
function addPHPJS($str){
    //TODO:$str needs to be escaped, as its being used as
    //a component of an html href URL?>
<script type='text/javascript' src='<?php echo "js/$str.php";?>'></script>
<?php
}
addPHPJS('globals');
$js = array(
    'entities/parts/part',
    'entities/parts/drivetrain',
    'entities/parts/body',
    'entities/parts/interior',
    'entities/parts/docs',
    'entities/vehicle',
);
html::incJS('allowance');
html::incJS('jqueryLib');
html::incJS('jqStatBar');
foreach($js as $p){
    html::incJS($p);
}
html::incJS('state/Garage');
?>
<script>
// var user = {
    // //interface for accessing values in local storage
    // //money
    // //tokens
    // //etc...
    // get:{
        // //stats
        // curCarID:function(){
            // if(Storage.local !== null){
                // if('_curCarID' in Storage.local){
                    // var ret = JSON.parse(Storage.local._curCarID);
                    // //console.log(ret);
                    // return ret;
                // }
            // }
        // },
        // //stage:function(){},
        // //teir:function(){}
    // }
// };
var userGarage = [];

if(Storage.local !== null && 'userGarage' in Storage.local){
    var data = JSON.parse(Storage.local.userGarage),
        l = data.length;
    
    for(var i = 0; i < l; i++){
        var e = data[i],
            car = Vehicle(
                e.name, e.make, e.year, e._price,
                e.id
                //{drivetrain:e._dt,
                //body:e._body,
                //interior:e._interior,
                //docs:e._docs,
                //repairs:e._repairs}
            );
            
        userGarage.push(car);
    }
}

$(function(){
    //script to be executed after page loads
    var cashDiv = $('div#cash'),
        tokenDiv = $('div#tokens'),
        dci = $('div#cash input'),  //div cash input
        dti = $('div#tokens input');
<?php
if($LI){?>
    var o = {opacity:'1.0'},
        c = {cursor:'pointer'},
		info = $('pre#info');
    
	if(info.text() == ''){
		info.hide();
	}
	else{
		info.show();
	}
    cashDiv.css(o);
    tokenDiv.css(o);
    dci.css(c);
    dti.css(c);
<?php
}
else{?>
    var o = {opacity:'0.5'},
        c = {cursor:'default'};
        
    cashDiv.css(o);
    tokenDiv.css(o);
    dci.css(c);
    dti.css(c);
<?php
}?>
	var btn = $('div#AddFunds button#allowance');
	
    btn.off().click(function(){
		//allowance accumulates every few seconds
		var delta = Allowance.getDelta();

		if(delta >= Allowance.CAP){
			var val = 50000;    //1;	//(base + carValue) * delta;
<?php
if($LI){?>
				Allowance.addFundsLoggedIn(val);
<?php
}
else{?>
				Allowance.addFundsLocal(val);
<?php
}?>
			Allowance.setLastTime();
		}
	});
loadUser();
<?php
if(!$LI){
    //user not logged in, set image using user's garage?>
    setHomeImg();
<?php
}?>
jq.statBar.set.stats();
});
</script>
<?php html::footer();?>