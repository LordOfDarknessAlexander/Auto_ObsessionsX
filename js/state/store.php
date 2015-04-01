<?php
//header('Content-type: application/javascript; charset: UTF-8');
?>
//
//Funds State interface
//
var Store = {
	update : function(){
		stop = true;
		appState = GAME_MODE.ADD_FUNDS;
		
        if(appState == GAME_MODE.ADD_FUNDS){
			console.log("save your money u cants save the world");
		}
	},
	render : function(){
		//draw user's money, etc...
	}
};

function addFunds(funds){
<?php $funcName = 'js/pas.js pas::update::funds(funds)';?>
	//var MAX_MONEY = 50000000;
	//var newTotal = userStats.money + val;
	//userStats.money = newTotal > MAX_MONEY ? MAX_MONEY : newTotal;
	//jq.setCash(userStats.money);
    jq.post('pas/update.php?op=puf',
        function(data){
            //data is the user's new funds after the purchase has been completed
            //clicked = false;
            //console.log(JSON.stringify(data) );
            
            if(data !== null && data != userStats.money && typeof data === 'number'){
                //jq.setCash(data);
                setMoney(data);
            }
            else{
                //alert(<?php echo "$funcName, ajax call failed! Reason: invalid return from server: ";?>' + JSON.stringify(data) );
            }
        },
        function(jqxhr){
            alert('<?php echo "$funcName, ajax call failed! Reason: ";?>' + jqxhr.responseText);
            //jq.setMsg();
        },
        {udv:funds}
    );
}
function addTokens(tokens){
    //uses PAS to update a loggedin users funds, else fall back to local storage
<?php $funcName = 'js//state/store.js addTokens(tokens)';?>

    jq.post('pas/update.php?op=put',
        function(data){
            //data is the user's new funds after the purchase has been completed
            //clicked = false;            
            if(data !== null && data != userStats.tokens && typeof data === 'number'){
                setTokens(data);
            }
            else{
                alert('<?php echo "$funcName, ajax call failed! Reason: invalid return from server: ";?>' + JSON.stringify(data) );
            }
        },
        function(jqxhr){
            alert('<?php echo "$funcName, ajax call failed! Reason: ";?>' + jqxhr.responseText);
            //jq.setMsg();
        },
        {udv:tokens}
    );
}
function addPrestige(prest){
    //uses PAS to update a loggedin users funds, else fall back to local storage
    //if(tokens is int && val > 0.0){
        //var MAX_PREST = 50000000;
        //var newTotal = userStats.prestige + prest;
        //userStats.prestige = newTotal > MAX_PREST ? MAX_PREST : newTotal;
        /*jq.post('pas/update.php?op=aup',
            function(data){
                //data is the user's new funds after the purchase has been completed
                //clicked = false;
                //if(isInt(data) && data >= 0.0){
                    jq.setTokens(data);
                }
                else{
                    alert(funcName + ', ajax call failed! Reason: invalid return from server: ' JSON.stringify(data) );
                }
            },
            function(jqxhr){
                alert(funcName + ', ajax call failed! Reason:' + );
            },
            {udv:tokens}
        );*/
    //}
}
function addMarkers(markers){
    //uses PAS to update a loggedin users funds, else fall back to local storage
    //if(tokens is int && val > 0.0){
        //var MAX_MARKERS = 50000000;
        //var newTotal = userStats.markers + markers;
        //userStats.markers = newTotal > MAX_MARKERS ? MAX_MARKERS : newTotal;
        /*jq.post('pas/update.php?op=aum',
            function(data){
                //data is the user's new funds after the purchase has been completed
                //clicked = false;
                //if(isInt(data) && data >= 0.0){
                    jq.setTokens(data);
                }
                else{
                    alert(funcName + ', ajax call failed! Reason: invalid return from server: ' JSON.stringify(data) );
                }
            },
            function(jqxhr){
                alert(funcName + ', ajax call failed! Reason:' + );
            },
            {udv:tokens}
        );*/
    //}
}
//jQuery Interface
$('#addAllowanceBtn').click(
function()
{	//allowance accumulates every few seconds
	//var
		//last = getLastAllowanceTime(),
		//now = Date.now(),
		//delta = now - last;
		//carValue = getCollectionValue();
	
	var val = 1;	//(base + carvalue) * delta;
	addFunds(val);
});
$('#addMinorFundsBtn').click(
function()
{	//open paypal form
	//transfering game currency to user's account
	addFunds(10000);
});
$('#addMediumFundsBtn').click(
function()
{	//open paypal form
	//transfering game currency to user's account
	addFunds(50000);
});
$('#addMajorFundsBtn').click(
function()
{	//open paypal form
	//transfer game currency to user's account
	addFunds(250000);
});

$('#add3TokensBtn').click(
function(){
	addTokens(3);
});
$('#add5TokensBtn').click(
function(){
    //open paypal form
	//transfering game currency to user's account
	addTokens(5);
});
$('#add10TokensBtn').click(
function(){
    //open paypal form
	//transfering game currency to user's account
	addTokens(10);
});
$('#add20TokensBtn').click(
function(){
	addTokens(20);
});

jq.Funds.backBtn.click(
function(){
	jq.Funds.toggle();
	setStatBar();
//	setAdBG();
	saveUser();
    jq.carImg.show();
    jq.setErr();    //clear error when changing pages
});
jq.Funds.homeBtn.click(
function(){
	jq.Funds.menu.hide();
    jq.Game.menu.show();
	setStatBar();
	setAdBG();
	//saveUser();
    jq.carImg.show();
    jq.setErr();    //clear error when changing pages
});
