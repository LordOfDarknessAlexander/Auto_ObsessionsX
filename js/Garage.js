//
//Repair State interface
//
//
//TODO, access from html database, or other markup file
//
//test, user ca select between 3 cars
//var currentCar = null;
var userGarage = [
	Vehicle('images/vehicle.jpg'),
	Vehicle('images/vehicle.jpg'),
	Vehicle('images/vehicle.jpg')
];
var currentCar = userGarage[0];	//copy constructed car, altering currentCar doesn't change usergarage[0]

var Garage = {
	init : function()
	{	//called to load assests and initialize private vars
	},
	update : function()
	{
		stop = true;
	},
	render : function()
	{
		//additional rendering
	}
};