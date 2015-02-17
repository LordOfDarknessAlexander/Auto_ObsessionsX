﻿//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
//
var Documents = {
    //default ctor
    TYPE:{
        ownership:1,
        build:2,
        history:3,
        ph0:4,
        //ph1:
    },
    strFromType:function(type){
        if(type == Documents.TYPE.ownership)
            return 'Ownership';
        else if(type == Documents.TYPE.build)
            return 'BuildSheet';
        else if(type == Documents.TYPE.history)
            return 'History';
        else if(type == Documents.TYPE.ph0)
            return 'PH0';
        //fuel:
        else{
            console.log('unknown value: ' + type);
            return '';
        }
    },
    make:function(carPrice){
        return {
            _owner:carPart(carPrice * 0.32, Documents.TYPE.ownership),
            _build:carPart(carPrice * 0.23, Documents.TYPE.build),
            _history:carPart(carPrice * 0.29, Documents.TYPE.history),
            _ph0:carPart(carPrice * 0.12, Documents.TYPE.ph0),
            //_ph1:carPart(carPrice * 0.12, bd.ph1),
            //
            getBits:function(){
                //stores this vehicles upgrades as a 4 byte int
                //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
                var ret = (this._owner._stage << 12) |
                (this._build._stage << 8) |
                (this._history._stage << 4) |
                (this._ph0._stage << 0);
                //this._fuel.stage << 0
                console.log(ret);
                return ret;
            },
            //fromBitfield(int){
            //},
            getPercentAvg:function(){
                //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
                return (
                    this._owner.getPercent() +
                    this._build.getPercent() +
                    this._history.getPercent() +
                    this._ph0.getPercent()
                ) * 0.25;   //average of all parts
            },
            getPartType:function(type){
                //returns a copy of the object
                switch(type){
                    case(Documents.TYPE.ownership):
                        return this._owner;

                    case(Documents.TYPE.build):
                        return this._build;
                        
                    case(Documents.TYPE.history):
                        return this._history;

                    case(Documents.TYPE.ph0):
                        return this._ph0;

                    default:
                        console.log('unknow type: ' + type.toString() );
                        return null;
                }
            },
            upgradePart:function(type){
                //returns the stage of the part being upgraded
                //console.log('upgradeing part of type:');
                switch(type){
                    case(Documents.TYPE.ownership):
                        this._owner.upgrade();

                    case(Documents.TYPE.build):
                        this._build.upgrade();

                    case(Documents.TYPE.history):
                        this._history.upgrade();

                    case(Documents.TYPE.ph0):
                        this._ph0.upgrade();

                    //fuel:
                    default:
                        console.log('attempting to upgrade unknown type: ' + type.toString() );
                        return;
                }
                return false;
            },
            /*repairPart:function(type){
                switch(type){
                    case(Interior.TYPE.ownership):
                        return this._seats.repair();
                    break;
                    case(Interior.TYPE.carpet):
                        return this._carpet.repair();
                    break;
                    case(Interior.TYPE.dash):
                        return this._dash.repair();
                    break;
                    case(Interior.TYPE.panels):
                        return this._panels.repair();
                    break;
                    //fuel:
                    default:
                        console.log('unknown type: ' + type.toString() );
                    break;
                }
            },*/
            getCondition:function(){
                //returns the condition as a value between 0.0-1.0
                var ret = 0;
                //ret += this._seats._repaired ? 1 : 0;
                //ret += this._carpet._repaired ? 1 : 0;
                //ret += this._dash._repaired ? 1 : 0;
                //ret += this._panels._repaired ? 1 : 0;
                //console.log('val: ' + ret.tooString() );
                return ret * 0.25;
            },
            getRepairBits:function(){
                //returns the state of each part as a bitfield,
                //used for save vehicles data
                var ret = 0;
                //ret = (this._seats._repaired ? 0x8 : 0) |
                    //(this._carpet._repaired ? 0x4 : 0) |
                    //(this._dash._repaired ? 0x2 : 0) |
                    //(this._panels._repaired ? 0x1 : 0);
                //console.log('val: ' + ret.tooString() );
                return ret;
            }
        };
    }
};