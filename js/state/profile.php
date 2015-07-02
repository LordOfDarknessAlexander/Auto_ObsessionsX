
//
//User Profile jQuery interface bindings
//
jq.Profile = {
    //dynamically bind this object to the jq namespace
    div:$('div#profile'),
    backBtn:$('div#profile button#backBtn'),
    //
    stats:{
        div:$('div#profile div#userStats'),
        //
        ownedCars:$('label#cco', this.div),
        purchCars:$('label#tcp', this.div),
        purchUR:$('label#tup', this.div),
        soldCars:$('label#tcs', this.div),
        aWins:$('label#aWins', this.div),
        aLoss:$('label#aLosses', this.div),
        remain:$('label#remain', this.div),
        //
        set:function(data){
            //
            this.ownedCars.text(data.carsOwned.toString());
            this.purchCars.text(data.carsPurch.toString());
            this.purchUR.text(data.urPurch.toString());
            this.soldCars.text(data.carsSold.toString());
            this.aWins.text(data.wins.toString());
            this.aLoss.text(data.losses.toString());
            this.remain.text(data.remain.toString());
        },
    },
    sales:{        
        div:$('div#profile div#salesInfo'),
        //
        totalFunds:$('label#tfp', this.div),
        totalTokens:$('label#ttp', this.div),
        aph:$('label#aph', this.div),
        totalAllowance:$('label#tae', this.div),
        carsInvst:$('label#tic', this.div),
        urInvst:$('label#tiu', this.div),
        fundsSpent:$('label#tfs', this.div),
        tokensSpent:$('label#tts', this.div),
        paidAH:$('label#tpAH', this.div),
        netSales:$('label#nsp', this.div),
        grossSales:$('label#gsp', this.div),
        dif:$('label#ngd', this.div),
        avgGL:$('label#aGL', this.div),
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
<?php if(loggedIn() ){?>
        pas.set.userProfileData();
<?php
}
else{?>
        //get stats from vars saved to local vars and storage!
        //var data = getUserProfileData();
        //jq.Profile.stats.set(data.stats);
        //jq.Profile.sales.set(data.income)
        //
        jq.Profile.toggle();
<?php
}
?>
    },
	update:function(){
	},
	render:function(){
		//draw user's money, etc...
	}
};
//
//jQuery Interface
//
jq.Profile.backBtn.click(
    jq.Profile.toggle
);