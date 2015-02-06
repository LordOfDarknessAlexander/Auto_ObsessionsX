﻿//vehicle 'class' and any other api
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
        _stage:carPart.stage.stock, //1, 2 or 3
        _type:partType, //type
		_repaired:false,    //has this been fixed?
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