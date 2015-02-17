//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
//
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
        //creates a new car part of type Drivetrain
        return {
            _engine:carPart(carPrice * 0.32, this.TYPE.engine),
            _trans:carPart(carPrice * 0.23, this.TYPE.trans),
            _axel:carPart(carPrice * 0.29, this.TYPE.axel),
            _exhaust:carPart(carPrice * 0.12, this.TYPE.exhaust),
            //_fuel:carPart(carPrice * 0.12, dt.fuel),
            //
            getBits:function(){
                //stores this vehicles upgrades as a 4 byte int
                //0x0000 0000 {r,r,r,F}{Ex,DA,T,E}
                var ret = (this._engine._stage << 12) |
                (this._trans._stage << 8) |
                (this._axel._stage << 4) |
                (this._exhaust._stage << 0);
                //this._fuel.stage << 0
                console.log(ret);
                return ret;
            },
            //fromBitfield(int){
            //},
            getPercentAvg:function(){
                //returns precent this part has been upgraded/repaired, as a float [0.0-1.0](for progress bar)
                return (
                    this._engine.getPercent() +
                    this._trans.getPercent() +
                    this._axel.getPercent() +
                    this._exhaust.getPercent()
                ) * 0.25;   //average of all parts
            },
            getPartType:function(type){
                //returns a copy of the object,
                //returning from a switch does not require break statements
                switch(type){
                    case(Drivetrain.TYPE.engine):
                        return this._engine;
                    break;
                    case(Drivetrain.TYPE.trans):
                        return this._trans;
                    break;
                    case(Drivetrain.TYPE.axel):
                        return this._axel;
                    
                    case(Drivetrain.TYPE.exhaust):
                        return this._exhaust;
                    
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
                    case(Drivetrain.TYPE.engine):
                        this._engine.upgrade();
                    break;
                    case(Drivetrain.TYPE.trans):
                        this._trans.upgrade();
                    break;
                    case(Drivetrain.TYPE.axel):
                        this._axel.upgrade();
                    break;
                    case(Drivetrain.TYPE.exhaust):
                        this._exhaust.upgrade();
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
                    case(Drivetrain.TYPE.engine):
                        return this._engine.repair();
                    break;
                    case(Drivetrain.TYPE.trans):
                        return this._trans.repair();
                    break;
                    case(Drivetrain.TYPE.axel):
                        return this._axel.repair();
                    break;
                    case(Drivetrain.TYPE.exhaust):
                        return this._exhaust.repair();
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
                ret += this._engine._repaired ? 1 : 0;
                ret += this._trans._repaired ? 1 : 0;
                ret += this._axel._repaired ? 1 : 0;
                ret += this._exhaust._repaired ? 1 : 0;
                //console.log('val: ' + ret.tooString() );
                return ret * 0.25;
            },
            getRepairBits:function(){
                //returns the state of each part as a bitfield,
                //used for save vehicles data
                var ret = 0;
                ret = (this._engine._repaired ? 0x8 : 0) |
                    (this._trans._repaired ? 0x4 : 0) |
                    (this._axel._repaired ? 0x2 : 0) |
                    (this._exhaust._repaired ? 0x1 : 0);
                //console.log('val: ' + ret.tooString() );
                return ret;
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
};