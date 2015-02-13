//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
var Body = {
    //default ctor
    TYPE:{
        chasis:0x1,
        panels:0x2,
        paint:0x3,
        ph0:0x4,
        //ph1:
    },
    strFromType:function(type){
        if(type == Body.TYPE.chasis)
            return 'Chasis';
        else if(type == Body.TYPE.panels)
            return 'Panels';
        else if(type == Body.TYPE.paint)
            return 'Paint';
        else if(type == Body.TYPE.ph0)
            return 'PH0';
        //fuel:
        else{
            console.log('unknown value: ' + type);
            return '';
        }
    },
    make:function(carPrice){
        return {
            _chasis:carPart(carPrice * 0.32, Body.TYPE.chasis),
            _panels:carPart(carPrice * 0.23, Body.TYPE.panels),
            _paint:carPart(carPrice * 0.29, Body.TYPE.paint),
            _ph0:carPart(carPrice * 0.12, Body.TYPE.ph0),
            //_ph1:carPart(carPrice * 0.12, bd.ph1),
            //
            getBits:function(){
                //stores this vehicles upgrades as a 4 byte int
                //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
                var ret = (this._chasis._stage << 12) |
                (this._panels._stage << 8) |
                (this._paint._stage << 4) |
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
                    this._chasis.getPercent() +
                    this._panels.getPercent() +
                    this._paint.getPercent() +
                    this._ph0.getPercent()
                ) * 0.25;   //average of all parts
            },
            getPartType:function(type){
                //returns a copy of the object
                switch(type){
                    case(Body.TYPE.chasis):
                        return this._chasis;
                    break;
                    case(Body.TYPE.panels):
                        return this._panels;
                    break;
                    case(Body.TYPE.paint):
                        return this._paint;
                    break;
                    case(Body.TYPE.ph0):
                        return this._ph0;
                    break;
                    //fuel:
                    default:
                        console.log('unknow type: ' + type.toString() );
                        return null;
                    break;
                }
            },
            upgradePart:function(type){
                //returns the stage of the part being upgraded
                //console.log('upgradeing part of type:');
                switch(type){
                    case(Body.TYPE.chasis):
                        this._chasis.upgrade();
                    break;
                    case(Body.TYPE.panels):
                        this._panels.upgrade();
                    break;
                    case(Body.TYPE.paint):
                        this._paint.upgrade();
                    break;
                    case(Body.TYPE.ph0):
                        this._ph0.upgrade();
                    break;
                    //fuel:
                    default:
                        console.log('attempting to upgrade unknown type: ' + type.toString() );
                    break;
                }
                return false;
            },
            repairPart:function(type){
                switch(type){
                    case(Body.TYPE.chasis):
                        return this._chasis.repair();
                    break;
                    case(Body.TYPE.panels):
                        return this._panels.repair();
                    break;
                    case(Body.TYPE.paint):
                        return this._paint.repair();
                    break;
                    case(Body.TYPE.ph0):
                        return this._ph0.repair();
                    break;
                    //fuel:
                    default:
                        console.log('unknown type: ' + type.toString() );
                    break;
                }
            },
            getCondition:function(){
                //returns the condition as a value between 0.0-1.0
                var ret = 0;
                ret += this._chasis._repaired ? 1 : 0;
                ret += this._panels._repaired ? 1 : 0;
                ret += this._paint._repaired ? 1 : 0;
                ret += this._ph0._repaired ? 1 : 0;
                //console.log('val: ' + ret.tooString() );
                return ret * 0.25;
            },
            getRepairBits:function(){
                //returns the state of each part as a bitfield,
                //used for save vehicles data
                var ret = 0;
                ret = (this._chasis._repaired ? 0x8 : 0) |
                    (this._panels._repaired ? 0x4 : 0) |
                    (this._paint._repaired ? 0x2 : 0) |
                    (this._ph0._repaired ? 0x1 : 0);
                //console.log('val: ' + ret.tooString() );
                return ret;
            }
        };
    }
};