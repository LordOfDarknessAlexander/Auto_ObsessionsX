//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
//
//ao.car.part = 
function carPart(carPrice, partType){   //partType
    //emulating an enum representing the various kinds of upgradable part
    //console.log(carPrice);
	return {
		//_iconPath : 'images/defaultPart.png',
        _price:carPrice,   //value added to the owning vehicle
		//_cond : condition,
		//_orig : originality,
        _stage:carPart.STAGE.stock, //1-4 stages
        _type:partType, //type
		_repaired:false,    //has this been fixed?, moved to Vehicle.js as bitfield
		//getFullPath() : function()
		//{	//return file path of image resource for this icon
		//}
		//getCondition:function(){return repaired ? this.condition + 25 : this.condition;
        getPrice:function(){
            //returns the price of this part, based on repairs and the tier
            var ret = this._price * (this._repaired ? 1.75 : 1) * (this._stage + 1);
            //console.log(ret);
            return ret;
        },
        getPriceStr:function(){
            //returns a human readable, formated currency value as a string
            var p = this.getPrice();    //floating point value
            return '$' + p.toFixed(2);  //round to 2 decimal places
        },
        //getInstallPrice:function(){
            //price the first time 
        //}
        getSalePrice:function(){
            //price the user pays for this upgrade
            return this._price * 1.25;
        },
        getSalePriceStr:function(){
            //returns a human readable, formated currency value as a string
            var p = this.getSalePrice();    //floating point value
            return '$' + p.toFixed(2);  //round to 2 decimal places
        },
        getRepairPrice:function(){
            //price the user pays for repairs
            var ret = this._price * 0.75;
            //console.log(ret);
            return ret;
        },
        getRepairPriceStr:function(){
            //returns a human readable, formated currency value as a string
            var p = this.getRepairPrice();    //floating point value
            return '$' + p.toFixed(2);  //round to 2 decimal places
        },
        getLocalPath:function(){
            return '';//'images\\upgrades\\' + stringFromPartType(this._type) + '.png';
            //upgrade stage, 1, 2 or 3
        },
        //getFullPath:function(){
            //return ROOT_DIR + this.getLocalPath();
        //},
        repair:function(){
            //returns true if this part has not been upgraded
            //console.log('repair part!');
            if(!this._repaired){
                var p = this.getRepairPrice();

                if(userStats.money >= p){
                    userStats.money -= p;   //take money first
                    //setMoney();
                    this._repaired = true;  //then repair, 'cause we're like that
                    //console.log('purchasing repairs for part of type: ' + this._type.toString() + ', for: $' + p.toString() );
                }
                else{
                    console.log('Insufficent funds! Can not purchase repair for part of type: ' + this._type.toString() );
                }
//<php if(loggedIn()){>
                //jq.post('pas/update.php?op=cump',
                    //function(){
                        
                    //},
                    //function(){
                        
                    //},
                    //{price:p}
                //);
//<php
//}
//>
            }
            //else already repaired, do nothing
            return this._repaired;
        },
        setStage:function(stage){
            stage &= 0x0000000F; //filter all but last 4 bits of 32-bit int
            if(stage <= carPart.STAGE.pro && this._stage != carPart.STAGE.pro){
                if(stage > this._stage){
                    this._stage = stage;
                    //console.log('upgrading part with type: ' + this._type.toString() + ' to stage: ' + this._stage.toString() );
                }
            }
        },
        upgrade:function(){
            var p = this.getPrice()
            
            if(userStats.money >= p){
                if(this._stage != carPart.STAGE.pro){
                    userStats.money -= p;
                    //setMoney();
                    
                    if(this._stage == carPart.STAGE.stock){
                        this._stage = carPart.STAGE.amateur;
                    }
                    else{
                        this._stage = this._stage << 1;
                    }
                    //console.log('purchasing upgrade for part of type: ' + this._type.toString() + ' to stage: ' + this._stage.toString() + ', for: $' + p.toString() );
                    //increase other vars
                    return true;
                }
                //else part is max level do nothing
            }
            else{
                console.log('Insufficent funds! Can not purchase upgrade for part of type: ' + this._type.toString() + ' to stage: ' + this._stage.toString() );
            }
            return false;
        },
        getPercent:function(){
            var INV_MAX = 0.2;  //1.0 / 5.0,
                ret = 0.0;
            
            if(this._stage == carPart.STAGE.stock){
                ret = 0.0;
            }else if(this._stage == carPart.STAGE.amateur){
                ret = 1.0;
            }else if(this._stage == carPart.STAGE.sport){
                ret = 2.0;
            }else if(this._stage == carPart.STAGE.racing){
                ret = 3.0;
            }else if(this._stage == carPart.STAGE.pro){
                ret = 4.0;
            }
            
            if(this._repaired){
                ret += 1.0;
            }
            ret *= INV_MAX; //pro tip: dividing is slower than multiplying by the value's inverse!
            //console.log(ret);
            return ret;
        }
        /*toJSON:function(){
            return {
                _type:this._type, //type
                _price:this._price, //price,   //value added to the owning vehicle
                //_cond : condition,
                //_orig : originality,
                _stage : this._stage, //1, 2 or 3
                _repaired:this._repaired,    //has this been fixed?  
            };
        }*/
	};
}
function ri(){
    var r = Math.random(),
        i = Math.floor(r * 4);
        
    return i == 0 ? 0 : 0x1 << (i);
}
carPart.getRandStage = function(){
    //(0000 | 0000 | 0000 | 0000), [0, ]
    var r0 = ri(),
        r1 = ri() << (4 * 1),
        r2 = ri() << (4 * 2),
        r3 = ri() << (4 * 3),
        ret = (r3 | r2 | r1 | r0);
    //console.log(ret);
    return $ret;
};
carPart.getRandRepairs = function(){
    //(XXXX 0000 | 0000 | 0000), [0,]
    var r0 = ri(),
        r1 = ri() << (4 * 1),
        r2 = ri() << (4 * 2),
        ret = (r2 | r1 | r0);
    //console.log(ret);
    return ret;
};
carPart.type = {
    interior:1,
    engine:2,
    decals:3,
    windows:4,
    tires:5,
    exhaust:6
};
carPart.STAGE = {
    stock:0x0,      //0000
    amateur:0x1,  //0001
    sport:0x2,      //0010
    racing:0x4,     //0100
    pro:0x8         //1000
};

function stringFromPartType(type){
    //returns a string identifier from a carPart's type
    var ret = '';
    switch(type){
        case carPart.type.interior:
            ret = 'interior';
        break;
        case carPart.type.engine:
            ret = 'engine';
        break;
        case carPart.type.decals:
            ret = 'decals';
        break;
        case carPart.type.windows:
            ret = 'windows';
        break;
        case carPart.type.tires:
            ret = 'tires';
        break;
        case carPart.type.exhaust:
            ret = 'exhaust';
        break;
        default:
            console.log('calling stringFromPartType, unexpected type passed:' + type.toString() );
        break;
    }
    return ret;
}