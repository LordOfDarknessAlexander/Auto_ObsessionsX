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
function Vehicle(Name, Make, Year, Price)
{
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
	
	//for(var i = 0; i < MAX_PARTS; i++)
	//{
		//var index = bfParts & (1 << i);
		//if(index){
			//tmpParts.append(carPart(
		//}
	//}

	return {
		//pos:new Vector(VEHICLE_XPOS, VEHICLE_YPOS,0,0)
		_price:Price,	//original sale price on year made, does not change
        _repairs:0, //bitfield representing which upgrades have been repaired
		condition:0,
		originality:0,
		name : Name,	////node.attr('name'),
		make : Make,	//node.attr('make'),
		year : Year,	//parseInt(node.attr('year') ),
		id : 0x00000000,	//node.attr('id'),
		//_info: node.text(),
		_parts : [],	//only retain currently upgraded parts, array is copied
        //_parts:{
        _dt:null,   //Drivetrain.make(Price)
        _body:null,
        _interior:null,
        _docs:null,        
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
				_driveterrain:0.15,	//this._dt.getPercentAvg(),
				_body:0.23,			//this._body.completion()
				_interior:0.62,
				_docs:0.73
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
                _parts:this._parts
				//_info: this.getIno(),
			};
		},
        hasPart:function(partType){
            //determine if this vehicle has previously recieved an upgrade of type 'partType'
            var len = this._parts.length;
            if(len == 0){
                return false;   //no parts at all
            }
            for(var i = 0; i < len; i++){
                if(partType == this._parts[i]._type){
                    return true;
                }
                //else continue with loop
            }
            //if function gets here, no parts have matched
            return false;
        },
        getPart:function(partType){
            //determine if this vehicle has previously recieved an upgrade of type 'partType'
            var len = this._parts.length;
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
            console.log('car has no part of type: ' + stringFromPartType(partType) );
            return null;
        },
        isRepairedAtIndex:function(i){
            var MAX_PARTS = 16;
            if(i <= MAX_PARTS){
                var val = this._repairs & (1 << i);
                if(val != 0){
                    return true;
                }
            }
            //else index out of bounds!
            return false;
        },
        upgradePart:function(type){
            //adds part to vehicle if not already, otherwise upgrade the part
            var part = this.getPart(type);
            if(part === null){
                console.log('buying new part of type: ' + stringFromPartType(type) );
                this._parts.push(carPart(150, type) );  //get price from DB
                console.log(JSON.stringify(this._parts) );
            }
            else{
                part.upgrade();
            }
        },
        repairPart:function(type){
            var len = this._parts.length;
            
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
            return false;
        }
	};
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