//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
/*
function Driveterain(e,t,da,e,fs)
{	//return object representing a vehicle's driveterain
	this.MAX = {
	//substruct representing static maximum for vehicle upgrades
	//ENGINE:6,
	//TRANSMISSION:6,
	//DRIVE_AXEL:6,
	//EXHAUST:6,
	//FUEL_SYSTEM:6
	};
	return {
		//substruct representing surrent upgrades done to a car
		//ENGINE:e,
		//TRANSMISSION:t,
		//DRIVE_AXEL:da,
		//EXHAUST:e,
		//FUEL_SYSTEM:fs
	};
}
function carStats()
{
	return {
		drivetrain:Drivetrain(),
		body:carBody(),
		interior:carInterior(),
		carDocs:carDocs(),
	};
}*/
function carPart(price, partType){   //partType
    //emulating an enum representing the various kinds of upgradable part
	return {
		//_iconPath : 'images/defaultPart.png',
        _price:150, //price,   //value added to the owning vehicle
		//_cond : condition,
		//_orig : originality,
        _stage:carPart.stage.stock, //1-4 stages
        _type:partType, //type
		_repaired:false,    //has this been fixed?, moved to Vehicle.js as bitfield
		//getFullPath() : function()
		//{	//return file path of image resource for this icon
		//}
		//getCondition:function(){return repaired ? this.condition + 25 : this.condition;
        getSalePrice:function(){
            //price the user pays for this upgrade
            return this._price * 1.25;
        },
        getRepairPrice:function(){
            //price the user pays for repairs
            return this._price * 0.75;
        },
        getLocalPath:function(){
            return 'images\\upgrades\\' + stringFromPartType(this._type) + '.png'
            //upgrade stage, 1, 2 or 3
        },
        //getFullPath:function(){
            //return ROOT_DIR + this.getLocalPath();
        //},
        getPrice:function(){
            //returns the price of this part, based on repairs and the tier
            return this._price * (this._repaired ? 1.75 : 1) * this._stage;
        },
        //getInstallPrice:function(){
            //price the first time 
        //}
        repair:function(){
            if(!this._repaired){
                this._repaired = true;
            }
        },
        upgrade:function(){
            if(this._stage != carPart.stage.pro){
                this._stage = this._stage << 1;
                console.log('upgrading part with type: ' + this._type.toString() + ' to stage: ' + this._stage.toString() );
                //increase other vars
            }
            //else part is max level do nothing,
            //button in repair needs to be rebound
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
carPart.type = {
    interior:1,
    engine:2,
    decals:3,
    windows:4,
    tires:5,
    exhaust:6
};
carPart.stage = {
    stock:0x1,      //0001
    sport:0x2,    //0010
    racing:0x4,         //0100
    pro:0x8       //1000
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
var Drivetrain = {
    //default ctor
    TYPE:{
        engine:0,
        trans:1,
        axel:2,
        exhaust:3,
        //fuel:
    },
    make:function(carPrice){
        return {
            _engine:carPart(carPrice * 0.32, this.TYPE.engine),
            _trans:carPart(carPrice * 0.23, this.TYPE.trans),
            _axel:carPart(carPrice * 0.29, this.TYPE.axel),
            _exhaust:carPart(carPrice * 0.12, this.TYPE.exhaust),
            //_fuel:carPart(carPrice * 0.12, dt.fuel),
            //
            asBitfield:function(){
                //stores this vehicles upgrades as a 4 byte int
                //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
                var ret = (this._engine.stage << 12) |
                (this._trans.stage << 8) |
                (this._axel.stage << 4) |
                (this._exhaust.stage << 0);
                //this._fuel.stage << 0
                console.log(ret);
                return ret;
            },
            //fromBitfield(int){
            //},
            getPercentAvg:function(){
                //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
                //4 stages of upgrades and 1 repair
                function perc(part){
                    //returns a percent in range 0.0-1.0
                    var INV_MAX = 1.0 / 5.0;
                    var stage = part._stage;
                    var val = (stage == carPart.stage.stock)?
                        1:
                        (stage == carPart.stage.sport)?
                        2:
                        (stage == carPart.stage.racing)?
                        3:
                        (stage == carPart.stage.pro)?
                        4:0;
                        if(part._repaired){
                            val += 1;
                        }
                        return val * INV_MAX;
                }
                return (
                    perc(this._engine) +
                    perc(this._trans) +
                    perc(this._axel) +
                    perc(this._exhaust)
                ) * 0.25;   //average of all parts
            }
        };
    },
    strFromType:function(type){
        if(type == Drivetrain.TYPE.engine)
            return 'Engine';
        else if(type == Drivetrain.TYPE.trans)
            return 'Transmission';
        else if(type == Drivetrain.TYPE.axel)
            return 'Axel';
        else if(type == Drivetrain.TYPE.exhaust)
            return 'Exhaust';
        //fuel:
        else{
            console.log('unknown value: ' + type);
            return '';
        }
    }
}
function Body(carPrice){
    //default ctor
    var type = {
        chasis:0x1,
        panels:0x2,
        paint:0x3,
        ph0:0x4,
        //ph1:
    };
    return {
        _chasis:carPart(carPrice * 0.32, type.chasis),
        _panels:carPart(carPrice * 0.23, type.panels),
        _paint:carPart(carPrice * 0.29, type.paint),
        _ph0:carPart(carPrice * 0.12, type.ph0),
        //_ph1:carPart(carPrice * 0.12, bd.ph1),
        //
        asBits:function(){
            //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
        },
        getCompletePercent:function(){
            //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
        }
    };
}
function Interior(carPrice){
    //default ctor
    var carPrice = 25000;
    var type = {
        seats:1,
        carpet:2,
        dash:3,
        panels:4,
        //ph1:
    };
    return {
        _seats:carPart(carPrice * 0.32, type.seats),
        _carpet:carPart(carPrice * 0.23,type.carpets),
        _dash:carPart(carPrice * 0.29, type.panels),
        _panels:carPart(carPrice * 0.12, bd.ph0),
        //_ph0:carPart(carPrice * 0.12, bd.ph1),
        //
        asBits:function(){
            //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
        },
        getCompletePercent:function(){
            //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
        }
    };
}
function Docs(carPrice){
    //default ctor
    var type = {
        ownership:1,
        build:2,
        history:3,
        ph0:4,
        //ph1:
    };
    return {
        _owner:carPart(carPrice * 0.32, type.ownership),
        _build:carPart(carPrice * 0.23, type.build),
        _history:carPart(carPrice * 0.29, type.history),
        _ph0:carPart(carPrice * 0.12, type.ph0),
        //_ph1:carPart(carPrice * 0.12, bd.ph1),
        //
        asBits:function(){
            //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
        },
        getCompletePercent:function(){
            //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
        }
    };
}