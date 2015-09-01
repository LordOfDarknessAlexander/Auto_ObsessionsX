var Allowance = {
    CAP:( (1000 * 60) * 60) * 24,  //86400000,  //3000,
    //INV_CAP:1.0 / CAP,    //inverse cap, multiply by this instead of dividing by CAP!
    getDelta:function(){
        //get diffrence between last time and now        
        return Date.now() - Allowance.getLastTime();
    },
	toJSON:function(){
		_lastAllowanceTime: 0;
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
    }
};

