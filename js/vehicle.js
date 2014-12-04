//vehicle 'class' and any other api
//the vehicle ID property is a string representation of a bitfield with the sturcture:
//	0x{DA, 0086, 0A}:{make, year, model}
//values are between 00 and FF, allowing for 255x255x255 unique vehicles
//ID's can be prceedurally generated!

function carPart(condition, originality){
	return {
		cond : condition,
		orig : originality
	};
}
function Vehicle(Name, Make, Year)
{
	var img = new Image()
	img.src = 'images/vehicle.jpg';	//getFullPath
	//returns a new vehicle object
	return {
		//pos:new Vector(VEHICLE_XPOS, VEHICLE_YPOS,0,0)
		price:0,
		condition:0,
		originality:0,
		name : Name,
		make : Make,
		year : Year,
		id : 0,
		//parts : [],	//only retain currently upgraded parts
		image : img,
		//
		displayInfo : function(){
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
		getFullPath : function()
		{	//returns the absolute url for the image path of this car on the server
			//return baseURL + 'images/vehicles/' + this.make + '/' + year + '/' + this.name + '.jpg';
			return '';
		},
		initParts : functon()
		{	//loads parts
			//if(this.parts.length !=
		}
	};
}
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