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
/*
userGarage[0].make = 'Camaro RS/Z28 Sport Coupe';
userGarage[0].year = '1969';
userGarage[0].name = 'Chevrolet';

userGarage[1].make = 'Jaguar';
userGarage[1].year = '1969';
userGarage[1].name = 'E-Type Series II 4.2 Roadster';
	
userGarage[2].make = 'GMC';
userGarage[2].year = '1997';
userGarage[2].name = 'Sierra';
*/
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