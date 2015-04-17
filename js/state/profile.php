<?php
//
?>
//
//User Profile jQuery interface bindings
//
jq.Profile = {
    //dynamically bind this object to the jq namespace
    div:$('div#profile'),
    backBtn:$('button#backBtn', this.div),
    //
    stats:{
        div:$('div#userStats', this.div),
        //
        ownedCars:$('p#cco', this.statsDiv),
        purchCars:$('label#tcp', this.statsDiv),
        purchUR:$('label#tup', this.statsDiv),
        soldCars:$('label#tcs', this.statsDiv),
        aWins:$('label#aWins', this.statsDiv),
        aLoss:$('label#aLosses', this.statsDiv),
        aAvg:$('label#aAvg', this.statsDiv),
        //
        set:function(data){
            //
            this.ownedCars.text(data.carsOwned.toString());
            this.purchCars.text(data.carsPurch.toString());
            this.purchUR.text(data.urPurch.toString());
            this.soldCars.text(data.carsSold.toString());
            this.aWins.text(data.wins.toString());
            this.aLoss.text(data.losses.toString());
            this.aAvg.text(data.avg.toFixed(2));
        },
    },
    sales:{        
        div:$('div#salesInfo', this.div),
        //
        totalFunds:$('label#tfp', this.salesDiv),
        totalTokens:$('label#ttp', this.salesDiv),
        aph:$('label#aph', this.salesDiv),
        totalAllowance:$('label#tae', this.salesDiv),
        carsInvst:$('label#tic', this.salesDiv),
        urInvst:$('label#tiu', this.salesDiv),
        fundsSpent:$('label#tfs', this.salesDiv),
        tokensSpent:$('label#tts', this.salesDiv),
        paidAH:$('label#tpAH', this.salesDiv),
        netSales:$('label#nsp', this.salesDiv),
        grossSales:$('label#gsp', this.salesDiv),
        dif:$('label#ngd', this.salesDiv),
        avgGL:$('label#aGL', this.salesDiv),
        //
        set:function(data){
            this.totalFunds.text(data.fundsPurch.toFixed(2));
            this.totalTokens.text(data.tokensPurch.toString());
            this.aph.text(data.aph.toFixed(2));
            this.totalAllowance.text(data.tae.toFixed(2));
            //
            this.carsInvst.text(data.tic.toFixed(2));
            this.urInvst.text(data.tiru.toFixed(2));
            //
            this.fundsSpent.text(data.tfs.toFixed(2));
            this.tokensSpent.text(data.tts.toFixed(2));
            this.paidAH.text(data.tpAH.toFixed(2));
            //
            this.netSales.text(data.nsp.toFixed(2));
            this.grossSales.text(data.gsp.toFixed(2));
            this.dif.text(data.ngd.toFixed(2));
            this.avgGL.text(data.aGL.toFixed(2));
        }
    },
    //
    toggle : function()
    {
        jq.Game.menu.toggle();
        jq.Profile.div.toggle();
        jq.setErr();    //clear error when changing pages
    }
};
//
var Profile = {
    //
    //User Profile State interface
    //
    init:function(){
<?php $funcName = 'js/state/profile.php Profile::init()';?>
        jq.post('pas/profile.php',
            function(data){
                if(data === null || data == undefined){
                    return;
                }
                //alert(JSON.stringify(data));
                //
                //set contents on page, then transition,
                //as it is much cleaner and ensures the user does not
                //witness the page updates
                //
                jq.Profile.stats.set(data.stats);
                jq.Profile.sales.set(data.income)
                //
                jq.Profile.toggle();
            },
            function(jqxhr){
                //do not show screen transition,
                //play failure sound
                jq.setErr("<?php echo $funcName;?>", jqxhr.responseText);
            }
        );
    },
	update:function(){
	},
	render:function(){
		//draw user's money, etc...
	}
};
/*
function addFunds(funds){

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
                //alert(<php echo "$funcName, ajax call failed! Reason: invalid return from server: ";>' + JSON.stringify(data) );
            }
        },
        function(jqxhr){
            alert('<php echo "$funcName, ajax call failed! Reason: ";>' + jqxhr.responseText);
            //jq.setMsg();
        },
        {udv:funds}
    );
}
function addTokens(tokens){
    //uses PAS to update a loggedin users funds, else fall back to local storage
<php $funcName = 'js//state/store.js addTokens(tokens)';>

    jq.post('pas/update.php?op=put',
        function(data){
            //data is the user's new funds after the purchase has been completed
            //clicked = false;            
            if(data !== null && data != userStats.tokens && typeof data === 'number'){
                setTokens(data);
            }
            else{
                alert('<php echo "$funcName, ajax call failed! Reason: invalid return from server: ";>' + JSON.stringify(data) );
            }
        },
        function(jqxhr){
            alert('<php echo "$funcName, ajax call failed! Reason: ">' + jqxhr.responseText);
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
        jq.post('pas/update.php?op=aup',
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
        );
    //}
}
function addMarkers(markers){
    //uses PAS to update a loggedin users funds, else fall back to local storage
    //if(tokens is int && val > 0.0){
        //var MAX_MARKERS = 50000000;
        //var newTotal = userStats.markers + markers;
        //userStats.markers = newTotal > MAX_MARKERS ? MAX_MARKERS : newTotal;
        jq.post('pas/update.php?op=aum',
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
        );
    //}
}*/
//
//jQuery Interface
//
jq.Profile.backBtn.click(
    jq.Profile.toggle
);