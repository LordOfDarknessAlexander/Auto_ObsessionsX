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
		//delete userGarage;
		//init cars from local storage
		//add buttons for each car avaiable in garage
		//var carList = $('#Garage'.children('ul#carBtns');
		//carList.clear();	//remove previous values, otherwise cars will be repeated
		//for(var i =0; i < userGarage.length;i++){
			//carList.add(carBtnStr);
		//}
		//load interface
		//appState = GAME_MODE.GARAGE;
	},
	exit : function()
	{	//remove resources, effectivly 'closing' the state
		//appState = GAME_MODE.MAIN;
	},
	update : function()
	{
		stop = true;
	},
	render : function()
	{
		//additional rendering
	},
	save : function()
	{	//saves garage and current car to local storage
		//
		//for(var i = 0; i < userGarage.length; i++){
			//JSON.stringify(userGarage[i]);
		//}
	}
};
$('#myCars').click(function()
{
	jqToggleGarage();
	//Garage.init();
});
$('#garageBackBtn').click(function(){
	jqToggleGarage();
	//Garage.exit();
});