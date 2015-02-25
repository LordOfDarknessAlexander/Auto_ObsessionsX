//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be procedurally generated!
//ao.car.create =
function Vehicle(Name, Make, Year, Price, carID, carInfo, parts, repairs)
{
    if(carID === null || carID === undefined){
        carID = 0x0;
    }
    if(carInfo === null || carInfo === undefined){
        carInfo = '';
    }
    if(parts === null || parts === undefined){
        parts = null;
    }
    if(repairs === null || repairs === undefined){
        repairs = 0x0;
    }
    
	this.fromJSON = function(str)
	{	//'static' method returning a Vehicle serialized from a JSON string
		//data object containing the essential struct of a vehicle
		var d = JSON.parse(str);
		return Vehicle(d.name,d.make,d.year,d._price);
	}
	//var img = new Image()
	//img.src = 'images/vehicle.jpg';	//ret.getFullPath();
	//returns a new vehicle object
	 //tmpParts = [];
	//var bfParts = parseInt(carNode.attr('parts') );
	//var carNode
	
	var dt = (parts !== null && parts.drivetrain)?
            Drivetrain.make(Price, parts.drivetrain, (parts.repairs >> 12) & 0x000F)
            :
            Drivetrain.make(Price),    
        body = (parts !== null && parts.body)?
            Body.make(Price, parts.body, (parts.repairs >> 8) & 0x000F)
            :
            Body.make(Price),
        inter = (parts !== null && parts.interior)?
            Interior.make(Price, parts.interior, (parts.repairs >> 4) & 0x000F)
            :
            Interior.make(Price),    
        docs = (parts !== null && parts.interior)?
            Documents.make(Price, parts.docs)
            :
            Documents.make(Price);
    /*if(parts !== null){
          
        if(parts.drivetrain){
            dt = Drivetrain.make(Price, parts.drivetrain, (parts.repairs >> 12) & 0x000F);
        }
        if(parts.body){
            body = Body.make(Price, parts.body, (parts.repairs >> 8) & 0x000F);
        }
        if(parts.interior){
            inter = Interior.make(Price, parts.interior, (parts.repairs >> 4) & 0x000F);
        }
        if(parts.docs){
            docs = Documents.make(Price, parts.docs);
        }
    }*/

	return {
		//pos:new Vector(VEHICLE_XPOS, VEHICLE_YPOS,0,0)
		_price:Price,	//original sale price on year made, does not change
        _repairs:0, //bitfield representing which upgrades have been repaired
		condition:0,
		originality:0,
		name : Name,	////node.attr('name'),
		make : Make,	//node.attr('make'),
		year : Year,	//parseInt(node.attr('year') ),
		id : carID,	//node.attr('id'),
		//_info: node.text(),
		_parts : [],	//only retain currently upgraded parts, array is copied
        //_parts:{
            //parts with value null, mean user hasn't purchase/installed part
        _dt:dt,
        _body:body,  //null,
        _interior:inter, //null,
        _docs:docs,  //Documents.make(Price), //null
        //}
		//image : img,
		//getters
		getPrice : function()
		{	//calculates sale price based on age, condition and completed upgrades
			//var upgradeCost = 0;
			//for(var i = 0; i < parts.length; i++)
			//{
				//upgradeCost += this._parts[i].getPrice();
			//}
            //price += _dt.getPrie();
            //price += _body.getPrice();
            //price += this._interior.getPrice();
            //price += this._docs.getPrice();
			return this._price; // + upgradeCost;
		},
		getInfo : function()
		{	//var node = xbdCars.getElementById(this._id);
			//return node.text;
			return 'Default Car Info';
		},
		getStats : function()
		{	//returns a constant object representing completion of upgreades,
			//values in range [0.0,1.0]
			return {
				_driveterrain:this._dt !== null ? this._dt.getPercentAvg() : 0.0,
				_body:this._body !== null ? this._body.getPercentAvg() : 0.0,			//this._body.completion()
				_interior:this._interior !== null ? this._interior.getPercentAvg() : 0.0,
				_docs:this._docs !== null ? this._docs.getPercentAvg() : 0.0
			};
		},
		displayInfo : function(){
			//context if from globals
			context.fillText(this.name, VEHICLE_XPOS + 40, 120);
			context.fillText("Value"+ this.price  ,VEHICLE_XPOS + 40, 140);
			context.fillText("Orig" + this.originality  ,VEHICLE_XPOS + 40, 160);
			context.fillText("Condition"+ this.condition  ,VEHICLE_XPOS + 40, 180);
//			Vehicle.draw = function()
//			{
//				context.drawImage(this.image,VEHICLE_XPOS,VEHICLE_YPOS);
//			}
		},
		getOriginality : function(){
			var ret = this.originality;
			/*for(var i = 0; i < MAX_PARTS; i++){
				var val = bfParts & (1 << i);
				if(val != 0){	//user's car has upgrades part
				//ret += parts[i].condition;
				}
			}*/
			return ret;
		},
		getCondition : function(){
            var MAX_PARTS = 16.0;
                INV_MAX_PARTS = 1.0 / MAX_PARTS;
			var ret = this.condition;   //base condition
			/*for(var i = 0; i <= MAX_PARTS; i++){
				var val = this._repairs & (1 << i);
				if(val != 0){	//user's car has upgrades part
                    //ret += parts[i].condition;
				}
			}*/
			return (int)(ret * 100); //drop decimal, conver from [0.0-1.0] to [0-100]
		},
		getFullName : function()
		{	//returns a string representing the 'proper' car name
			return this.make + ' ' + this.year + ' ' + this.name;
		},
        //getLocalPath : function()
		//{	//returns the relative path for the image path of this car on the server
			//return 'images\\cars\\' + this.make + '\\' + this.year + '\\' + this.name + '.jpg';
			//return '';
		//},
		getFullPath : function()
		{	//returns the absolute url for the image path of this car on the server
			return /*baseURL +*/ 'images\\cars\\' + this.make + '\\' + this.year + '\\' + this.name + '.jpg';
			//return '';
		},
		initParts : function()
		{	//loads parts
			//this._parts = [];
			//var thisXML = xmlDoc.ElementById(this.id);
			//if(this.parts.length != 0)
				//this.parts = [];	//reset parts array
			//var bfParts = ;	//bitfield representing which upgrades this car has aquired
			//for(var i = 0; i < MAX_PARTS; i++)
			//{	//var val = bfParts & (1 << i);
				//if(val != 0)
				//{	//user's car has upgrades part
					//var node = parts[val];
					//this.parts.append(carPart(node) );	//add upgrade to list
				//}
			//}
		},
		toJSON : function()
		{	//converts a vehicle to a JSON string, to be saved to local storage,
			//this is called by JSON.stringify and will be serialized
			return {
                id : this.id.toString(),
                make : this.make,
                year : this.year.toString(),
                name : this.name,
				_price : this._price,
				//condition : this.condition.toString(),
				//originality : this.originality.toString(),
                _parts:this._parts,
                _dt:this._dt !== null ? this._dt.getBits() : 0,
                _body:this._body !== null ? this._body.getBits() : 0,
                _interior:this._interior !== null ? this._interior.getBits() : 0,
                _docs:this._docs !== null ? this._docs.getBits() : 0,
                _repairs:this.getRepairBitfield()
				//_info: this.getIno(),
			};
		},
        getRepairBitfield:function(){
            var ret = ( (this._dt !== null ? this._dt.getRepairBits() : 0) << 12) |
            ( (this._body !== null ? this._body.getRepairBits() : 0) << 8) |
            ( (this._interior !== null ? this._interior.getRepairBits() : 0) << 4) |
            ( (this._docs !== null ? this._docs.getRepairBits() : 0) << 0);
            //console.log(ret.toString());
            return ret;
        },
        //OBSOLETE
        hasPart:function(partType){
            //determine if this vehicle has previously recieved an upgrade of type 'partType'
            /*var len = this._parts.length;
            if(len == 0){
                return false;   //no parts at all
            }
            for(var i = 0; i < len; i++){
                if(partType == this._parts[i]._type){
                    return true;
                }
                //else continue with loop
            }*/
            //if function gets here, no parts have matched
            return false;
        },
        getPart:function(partType){
            //determine if this vehicle has previously recieved an upgrade of type 'partType'
            /*var len = this._parts.length;
            if(len == 0){
                console.log('car has no parts bought')
                return null;    //no parts for you
            }
            for(var i = 0; i < len; i++){
                if(partType == this._parts[i]._type){
                    console.log('car returning part of type: ' + stringFromPartType(this._parts[i]._type) );
                    return this._parts[i];
                }
                //else continue with loop
            }
            //if function gets here, no parts have matched
            console.log('car has no part of type: ' + stringFromPartType(partType) );*/
            return null;
        },
        isRepairedAtIndex:function(i){
            /*var MAX_PARTS = 16;
            if(i <= MAX_PARTS){
                var val = this._repairs & (1 << i);
                if(val != 0){
                    return true;
                }
            }*/
            //else index out of bounds!
            return false;
        },
        //END OBSOLETE
        setUpgrades:function(data){
            //sets the upgrade fields from a generic js object
            //when loading from a database, so the value can be set directly
            //instead of having to be repurchased by the user when the car is created
            if(data.drivetrain){    //'drivetrain' in data)
                this._dt = Drivetrain.make(this._price, data.drivetrain);
            }
            //else does not have entry, leave null
            /*if(data.body){
                this._body = Body.make(this._price, data.body);
            }
            if(data.interior){
                this._interior = Interior.make(this._price, data.interior);
            }
            if(data.docs){
                this._docs = Docs.make(this._price, data.docs);
            }*/
        },
        upgradePart:function(type){
            //adds part to vehicle if not already, otherwise upgrade the part
            /*var part = this.getPart(type);
            if(part === null){
                console.log('buying new part of type: ' + stringFromPartType(type) );
                //this._parts.push(carPart(150, type) );  //get price from DB
                
                console.log(JSON.stringify(this._parts) );
            }
            else{
                part.upgrade();
            }*/
        },
        repairPart:function(type){
            /*var len = this._parts.length;
            
            if(len == 0){
                return false; //no parts, no repair
            }
            for(var i = 0; i < len; i++){
                if(this._parts[i]._type == type && !this._parts[i]._repaired){
                    //if(user.money >= this._parts[i].getRepairPrice() ){
                        //this car has upgrade of type, so repair it
                        console.log('car returning part of type: ' + stringFromPartType(this._parts[i]._type) );
                        this._parts[i]._repaired = true;
                        return true;
                        //user.money -= this._parts[i].getRepairPrice();
                    //}
                }
                //else continue with loop
            }
            //else{
                //vehicle does not have this part to upgrade
            //}
            console.log(JSON.stringify(this._parts) );
            return false;*/
        }
	};
}
Vehicle.fromDB = function(dbCar, userCar)
{
    //console.log('creating car from database');
    var ret = Vehicle(dbCar.name,dbCar.make,dbCar.year,dbCar.price, dbCar.id, dbCar.info, userCar);
    //console.log('creating car from database: ' + JSON.stringify(ret) );    
    return ret;
}
//TEMPORARY
//xml data base of cars, loaded from server!
//This should work!!!!
/*
var dbStr =
"<Vehicle id=\'0x00DA86B0\'" +
	"name=\'Camaro RS/Z28 Sport Coupe\'" +
	"year=\'1969\'" +
	"make=\'Chevrolet\'" +
	"_price=\'7000\'>" +
	//"Default Car Info" +
"</Vehicle>" +
"<Vehicle id=\'0x00FA78C6\'" +
	"name=\'E-Type Series II 4.2 Roadster\'" +
	"year=\'1969\'" +
	"make=\'Jaguar\'" +
	"_price=\'25000\'>" +
	//"Vehicle info about important stuff" +
"</Vehicle>" +
"<Vehicle id=\'0x00A7B6C2\'" +
	"name=\'Sierra\'" +
	"year=\'1997\'" +
	"make=\'GMC\'>" +
	"_price=\'12000\'>" +
	//"Mah truck! Not yours!" +
"</Vehicle>";

var xmlDoc = $.parseHTML(dbStr);	//parseXML doesn't work
	carDoc = $(xmlDoc);	//jQuery(), converts html DOM to jQuery nodes
	
var cn = $('#0x00DA86B0', carDoc);
*/
var xdbCars = [
	Vehicle('E-Type Series II 4.2 Roadster', 'Jaguar', '1969', 25000),
	//Vehicle(cn.attr("name"), 'Chevrolet','1969', parseInt(cn.attr('_price') ) ),
	Vehicle('Camaro RS-Z28 Sport Coupe', 'Chevrolet','1969', 18000),
	Vehicle('Sierra', 'GMC', '1997', 12000),
	Vehicle('S5 Coupe', 'Audi', '2013', 57000)
	//...etc
];

/*
var Vehicle = function(imgSrc)	//xmlNode)
{
	Vector.call(Vehicle, VEHICLE_XPOS,  VEHICLE_YPOS, Vehicle.dx, Vehicle.dy);
	this.price = 0;
	this.condition = 0;
	this.originality = 0;
	this.name = '';
	this.make = '';
	this.year = '';
	this.id = 0;
	//parts = []	//only retain currently upgraded parts
	this.image = new Image();
	image.src = imgSrc;	//getFullPath();'images/vehicle.jpg';	//getFullPath
	//
	this.displayInfo = function(){
		context.fillText(this.name, VEHICLE_XPOS + 40, 120);
		context.fillText("Value"+ this.price  ,VEHICLE_XPOS + 40, 140);
		context.fillText("Orig" + this.originality  ,VEHICLE_XPOS + 40, 160);
		context.fillText("Condition"+ this.condition  ,VEHICLE_XPOS + 40, 180);
		Vehicle.draw = function() 
		{
			context.drawImage(this.image,VEHICLE_XPOS,VEHICLE_YPOS);
		}
	}
	this.getOriginality = function(){
		var ret = this.originality;
		/*for(var i = 0; i < MAX_PARTS; i++){
			var val = bfParts & (1 << i);
			if(val != 0){	//user's car has upgrades part
			//ret += parts[i].condition;
			}
		}
		return ret;
	}
	this.getCondition = function(){
		var ret = this.condition;
		/*for(var i = 0; i < MAX_PARTS; i++){
			var val = bfParts & (1 << i);
			if(val != 0){	//user's car has upgrades part
			//ret += parts[i].condition;
			}
		}
		return ret;
	}
	this.getFullPath = function(){
		//returns the absolute url for the image path of this car on the server
		//return baseURL + 'images/vehicles/' + this.make + '/' + year + '/' + this.name + '.jpg';
		return '';
	}
};
*/