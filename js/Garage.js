//
//Repair State interface
//
//test, user ca select between 3 cars
//var currentCar = null;
var userGarage = [
	Vehicle('E-Type Series II 4.2 Roadster', 'Jaguar', '1969'),
	Vehicle('Camaro RS/Z28 Sport Coupe', 'Chevrolet','1969'),
	Vehicle('Sierra', 'GMC', '1997')
];
var curCarIndex = 0;	//null;	//copy constructed car, altering currentCar doesn't change usergarage[0]
//
var Garage = {
	init : function()
	{	//called to load assests and initialize private vars
		//delete userGarage;
		//init cars from local storage
		//add buttons for each car avaiable in garage
		//var carList = $('#Garage'.children('ul#carBtns');
		//carList.clear();	//remove previous values, otherwise cars will be repeated
		
		//if(curCarIndex === null && userGarage.length != 0){
			//curCarIndex = 0;
		//}
		for(var i = 0; i < userGarage.length; i++){
			//add button to list
			$('#carSelBtn' + i).click({index:i}, this.setCurrentCar);
			this.setCarBtnText(i);
		}
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
	},
	setCurrentCar : function(index)
	{
		var i = index.data.index;
		var btn = $('#userCar');
		var src = $('#carSelBtn' + i);
	
		curCarIndex = i;	//maintain index, instead of copying a car
		//}
		btn.children('label#make').text(src.children('label#make').text() );
		btn.children('label#year').text(src.children('label#year').text() );
		btn.children('label#name').text(src.children('label#name').text() );
	},
	setCarBtnText : function(index)
	{
		var car = userGarage[index];
		var btn = $('#carSelBtn' + index);
		//var car = userGarage[i];
		btn.children('label#make').text(car.make);
		btn.children('label#year').text(car.year);
		btn.children('label#name').text(car.name);
	}
};

$('#myCars').click(function()
{
	jqToggleGarage();
	Garage.init();
});
$('#garageBackBtn').click(function(){
	jqToggleGarage();
	//Garage.exit();
});