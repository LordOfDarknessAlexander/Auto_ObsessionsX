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
    make:function(carPrice, parts, repairs){
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
        
        var chasis = carPart(carPrice * 0.32, Body.TYPE.chasis),
            panels = carPart(carPrice * 0.23, Body.TYPE.panels),
            paint = carPart(carPrice * 0.29, Body.TYPE.paint),
            ph0 = carPart(carPrice * 0.12, Body.TYPE.ph0);
            
        if(bits){
            var chasBF = (bits & 0xF000) >> 12,
                panelsBF = (bits & 0x0F00) >> 8,
                paintBF = (bits & 0x00F0) >>  4,
                ph0BF = (bits & 0x000F) >> 0;
            
            
            if(chasBF){
                //field is not zero, so upgrade
                chasis.setStage(chasBF);
            }
            if(panelsBF){
                panels.setStage(panelsBF);
            }
            if(paintBF){
                paint.setStage(paintBF);
            }
            if(ph0BF){
                ph0.setStage(ph0BF);
            }
        }
        //else bits === 0, no upgrades so skip
        if(repairs){
            var chb = (repairs & 0x8) ? true : false;
                pnlb = (repairs & 0x4) ? true : false;
                pntb = (repairs & 0x2) ? true : false;
                ph0b = (repairs & 0x1) ? true : false;
            
            if(chb){
                chasis._repaired = true;
            }
            if(pnlb){
                panels._repaired = true;
            }
            if(pntb){
                paint._repaired = true;
            }
            if(ph0b){
                ph0._repaired = true;
            }
        }
        return {
            _chasis:chasis, //carPart(carPrice * 0.32, Body.TYPE.chasis),
            _panels:panels, //carPart(carPrice * 0.23, Body.TYPE.panels),
            _paint:paint,   //carPart(carPrice * 0.29, Body.TYPE.paint),
            _ph0:ph0,    //carPart(carPrice * 0.12, Body.TYPE.ph0),
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
                if(type == Body.TYPE.chasis){
                    return this._chasis;
                }
                else if(type == Body.TYPE.panels){
                    return this._panels;
                }
                else if(type == Body.TYPE.paint){
                    return this._paint;
                }
                else if(type == Body.TYPE.ph0){
                    return this._ph0;
                }
                //else
                console.log('unknow type: ' + type.toString() );
                return null;
            },
            upgradePart:function(type){
                //returns the stage of the part being upgraded
                //console.log('upgradeing part of type:');
                if(type == Body.TYPE.chasis){
                    return this._chasis.upgrade();
                }
                else if(type == Body.TYPE.panels){
                    return this._panels.upgrade();
                }
                else if(type == Body.TYPE.paint){
                    return this._paint.upgrade();
                }
                else if(type == Body.TYPE.ph0){
                    return this._ph0.upgrade();
                }
                console.log('attempting to upgrade unknown type: ' + type.toString() );
                return false;
            },
            repairPart:function(type){
                if(type == Body.TYPE.chasis){
                    return this._chasis.repair();
                }
                else if(type == Body.TYPE.panels){
                    return this._panels.repair();
                }
                else if(type == Body.TYPE.paint){
                    return this._paint.repair();
                }
                else if(type == Body.TYPE.ph0){
                    return this._ph0.repair();
                }
                console.log('unknown type: ' + type.toString() );
                return false;
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