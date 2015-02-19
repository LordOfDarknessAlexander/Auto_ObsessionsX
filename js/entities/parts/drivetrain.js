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
    make:function(carPrice, parts, repairs){
        //creates a new car part of type Drivetrain
        var bits = 0x0000,  //upgrade/parts bits, as a 16 bit short int
            rb = 0x00;   //repair bits, as an 8 bit byte
        
        if(parts === null || parts === undefined){
            bits = 0x0000;
        }
        else{
            bits = parts;
        }
        
        if(repairs === null || repairs === undefined){
            rb = 0x0;
        }
        else{
            rb = repairs;
        }
        
        var eng = carPart(carPrice * 0.18, this.TYPE.engine),
            trans = carPart(carPrice * 0.21, this.TYPE.trans),
            axel = carPart(carPrice * 0.13, this.TYPE.axel),
            exhaust = carPart(carPrice * 0.11, this.TYPE.exhaust);
            
        if(bits){
            var engBF = (bits & 0xF000) >> 12,
                transBF = (bits & 0x0F00) >> 8,
                axelBF = (bits & 0x00F0) >>  4,
                exhaustBF = (bits & 0x000F) >> 0;
            
            
            if(engBF){
                //field is not zero, so upgrade
                eng.setStage(engBF);
            }
            if(transBF){
                trans.setStage(transBF);
            }
            if(axelBF){
                axel.setStage(axelBF);
            }
            if(exhaustBF){
                exhaust.setStage(exhaustBF);
            }
        }
        //else bits === 0, no upgrades so skip
        if(repairs){
            var enb = (repairs & 0x8) ? true : false;
                tb = (repairs & 0x4) ? true : false;
                ab = (repairs & 0x2) ? true : false;
                exb = (repairs & 0x1) ? true : false;
            
            if(enb){
                eng._repaired = true;
            }
            if(tb){
                trans._repaired = true;
            }
            if(ab){
                axel._repaired = true;
            }
            if(exb){
                exhaust._repaired = true;
            }
        }
        
        return {
            _engine:eng,
            _trans:trans,
            _axel:axel,
            _exhaust:exhaust,
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
                var ret = (
                    this._engine.getPercent() +
                    this._trans.getPercent() +
                    this._axel.getPercent() +
                    this._exhaust.getPercent()
                ) * 0.25;
                
                return ret;
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
                if(type == Drivetrain.TYPE.engine){
                    return this._engine.upgrade();
                }
                else if(type == Drivetrain.TYPE.trans){
                    return this._trans.upgrade();
                }
                else if(type == Drivetrain.TYPE.axel){
                    return this._axel.upgrade();
                }
                else if(type == Drivetrain.TYPE.exhaust){
                    return this._exhaust.upgrade();
                }
                else{
                    console.log('attempting to upgrade unknown type: ' + type.toString() );
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
            //setRepairs(repairs)
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