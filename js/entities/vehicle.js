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
function carPart(price, partType){   //partType
    //emulating an enum representing the various kinds of upgradable part
    this.type = {
        interior:1,
        engine:2,
        decals:3,
        windows:4,
        tires:5,
        exhaust:6
    };
    this.stage = {
        sport:1,    //0001
        racing:2,         //0010
        pro:4       //0100
    };

	return {
		_iconPath : 'images/defaultPart.png',
        _price:150, //price,   //value added to the owning vehicle
        _type:carPart.interior, //type
		//_cond : condition,
		//_orig : originality,
        _stage : carPart.stage.sport, //1, 2 or 3
		_repaired:false,    //has this been fixed?
		//getFullPath() : function()
		//{	//return file path of image resource for this icon
		//}
		//getCondition:function(){return repaired ? this.condition + 25 : this.condition;
        getSalePrice:function(){
            //price the user pays for this upgrade
            return this._price * 1.25;
        },
        getLocalPath:function(){
            var path = 'images\\upgrades\\';
            switch(this._type){
                case carPart.type.interior:
                    path += 'interior';
                break;
                case carPart.type.engine:
                    path += 'engine';
                break;
                case carPart.type.decals:
                    path += 'decals';
                break;
                case carPart.type.windows:
                    path += 'windows';
                break;
                case carPart.type.tires:
                    path += 'tires';
                break;
                case carPart.type.exhaust:
                    path += 'exhaust';
                break;
            }
            //upgrade stage, 1, 2 or 3
            path += '.png';
            return path;
        },
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
            if(this._stage != carpart.stage.pro){
                this._stage = this._stage << 1;
                //increase other vars
            }
        }
	};
}

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
		condition:0,
		originality:0,
		name : Name,	////node.attr('name'),
		make : Make,	//node.attr('make'),
		year : Year,	//parseInt(node.attr('year') ),
		id : 0x00000000,	//node.attr('id'),
		//_info: node.text(),
		_parts : [],	//only retain currently upgraded parts, array is copied
		//image : img,
		//getters
		getPrice : function()
		{	//calculates sale price based on age, condition and completed upgrades
			//var upgradeCost = 0;
			//for(var i = 0; i < parts.length; i++)
			//{
				//upgradeCost += parts[i].getPrice();
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
				_driveterrain:0.15,	//this._dt.completion()
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
			var ret = this.condition;
			/*for(var i = 0; i < MAX_PARTS; i++){
				var val = bfParts & (1 << i);
				if(val != 0){	//user's car has upgrades part
				//ret += parts[i].condition;
				}
			}*/
			return ret;
		},
		getFullName : function()
		{	//returns a string representing the 'proper' car name
			return this.make + ' ' + this.year + ' ' + this.name;
		},
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
				_price : this._price.toString(),
				condition : this.condition.toString(),
				originality : this.originality.toString(),
                _parts:this._parts
				//'parts : '
				//_info: node.text(),
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
                return null;    //no parts for you
            }
            for(var i = 0; i < len; i++){
                if(partType == this._parts[i]._type){
                    return this._parts[i];
                }
                //else continue with loop
            }
            //if function gets here, no parts have matched
            return null;
        },
        upgradePart:function(){
            var type = carpart.type.interior;
            
            var part = this.getPart(type);
            //if(part === null){
                //this._parts.push(carPart(type) );
            //}
            //else{
                //if(part._stage != 3){
                    //upgrade current part
                    //part.upgrade();
                //}
                //else  part is max level do nothing, button and callback need to be rebound
            //}
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