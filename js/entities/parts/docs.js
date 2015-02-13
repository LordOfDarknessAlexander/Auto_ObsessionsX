//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!
//namespace AO
//
var Docs = {
    //default ctor
    TYPE:{
        ownership:1,
        build:2,
        history:3,
        ph0:4,
        //ph1:
    },
    strFromType:function(type){
        if(type == Docs.TYPE.ownership)
            return 'Ownership';
        else if(type == Docs.TYPE.build)
            return 'BuildSheet';
        else if(type == Docs.TYPE.history)
            return 'History';
        else if(type == Docs.TYPE.ph0)
            return 'PH0';
        //fuel:
        else{
            console.log('unknown value: ' + type);
            return '';
        }
    },
    make:function(carPrice){
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
};