//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
//
var Interior = {
    //
    TYPE:{
        seats:1,
        carpet:2,
        dash:3,
        panels:4,
        //ph1:
    },
    strFromType:function(type){
        if(type == Interior.TYPE.seats)
            return 'Seats';
        else if(type == Interior.TYPE.carpet)
            return 'Carpet';
        else if(type == Interior.TYPE.dash)
            return 'Dash';
        else if(type == Interior.TYPE.panels)
            return 'Panels';
        else{
            console.log('unknown value: ' + type);
            return '';
        }
    },
    make:function(carPrice){
        //default ctor
        return {
            _seats:carPart(carPrice * 0.32, Interior.TYPE.seats),
            _carpet:carPart(carPrice * 0.23,Interior.TYPE.carpet),
            _dash:carPart(carPrice * 0.29, Interior.TYPE.dash),
            _panels:carPart(carPrice * 0.12, Interior.TYPE.panels),
            //_ph0:carPart(carPrice * 0.12, bd.ph1),
            //
            getBits:function(){
                //stores this vehicles upgrades as a 4 byte int
                //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
                var ret = (this._seats._stage << 12) |
                (this._carpet._stage << 8) |
                (this._dash._stage << 4) |
                (this._panels._stage << 0);
                //this._fuel.stage << 0
                console.log(ret);
                return ret;
            },
            //fromBitfield(int){
            //},
            getPercentAvg:function(){
                //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
                return (
                    this._seats.getPercent() +
                    this._carpet.getPercent() +
                    this._dash.getPercent() +
                    this._panels.getPercent()
                ) * 0.25;   //average of all parts
            },
            getPartType:function(type){
                //returns a copy of the object
                switch(type){
                    case(Interior.TYPE.seats):
                        return this._seats;
                    break;
                    case(Interior.TYPE.carpet):
                        return this._carpet;
                    break;
                    case(Interior.TYPE.dash):
                        return this._dash;
                    break;
                    case(Interior.TYPE.panels):
                        return this._panels;
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
                    case(Interior.TYPE.seats):
                        this._seats.upgrade();
                    break;
                    case(Interior.TYPE.carpet):
                        this._carpet.upgrade();
                    break;
                    case(Interior.TYPE.dash):
                        this._dash.upgrade();
                    break;
                    case(Interior.TYPE.panels):
                        this._panels.upgrade();
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
                    case(Interior.TYPE.seats):
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
            },
            getCondition:function(){
                //returns the condition as a value between 0.0-1.0
                var ret = 0;
                ret += this._seats._repaired ? 1 : 0;
                ret += this._carpet._repaired ? 1 : 0;
                ret += this._dash._repaired ? 1 : 0;
                ret += this._panels._repaired ? 1 : 0;
                //console.log('val: ' + ret.tooString() );
                return ret * 0.25;
            },
            getRepairBits:function(){
                //returns the state of each part as a bitfield,
                //used for save vehicles data
                var ret = 0;
                ret = (this._seats._repaired ? 0x8 : 0) |
                    (this._carpet._repaired ? 0x4 : 0) |
                    (this._dash._repaired ? 0x2 : 0) |
                    (this._panels._repaired ? 0x1 : 0);
                //console.log('val: ' + ret.tooString() );
                return ret;
            }
        };
    }
};