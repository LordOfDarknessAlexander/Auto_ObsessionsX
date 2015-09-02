var Allowance = {
    CAP:( (1000 * 60) * 60) * 24,  //86400000,  //3000,
    //INV_CAP:1.0 / CAP,    //inverse cap, multiply by this instead of dividing by CAP!
    getDelta:function(){
        //get diffrence between last time and now        
        return Date.now() - Allowance.getLastTime();
    },
    getLastTime:function(){
        //the last time the user collected their allowance
        if(Storage.local !== null){
            if('_lastAllowanceTime' in Storage.local){
                return parseInt(Storage.local._lastAllowanceTime);
                //userStats.money = 225000;
            }
        }
        return 0;
    },
    setLastTime:function(){
        if(Storage.local !== null){
            var time = Date.now()	//a time of 0
            Storage.local._lastAllowanceTime = JSON.stringify(time);
        }
    },
    getRefreshMS:function(){
        //return time left until button can be clicked
        return Allowance.CAP - Allowance.getDelta();
    },
    getRefreshPerc:function(){
        return Allowance.getDelta() / Allowance.CAP;
    },
	addFundsLoggedIn:function(funds){
		var funcName = 'allowance.js addFunds(funds)';
		jq.post('pas/update.php?op=puf',
			function(data){
				//data is the user's new funds after the purchase has been completed
				if(data === null || data === undefined){
					jq.setErr(funcName, 'Error:ajax response returned null!');
					return;
				}	
				console.log('addFunds logged in');
				jq.statBar.set.money(data);
				// if(data != userStats.money && typeof data === 'number'){
				  
				// }
			},
			function(jqxhr){
				jq.setErr(funcName, 'error happened: ' + jqxhr.responseText);
			},
			{udv:funds}
		);	
	},
	addFundsLocal:function(funds){	
		var s = '_stats';
		
		if(Storage.local !== null && s in Storage.local){
			
			var userStats = JSON.parse(Storage.local._stats);
			console.log(userStats.money);
			
			if(userStats.money < 1000000000){
				userStats.money += funds;
			}
			
			Storage.local._stats = JSON.stringify(userStats);
			jq.statBar.set.money(userStats.money);
			console.log('Allowance added total ' + userStats.money);	
		}	
	}
};

