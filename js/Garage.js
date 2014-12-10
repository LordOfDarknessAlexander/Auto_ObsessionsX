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
//copy constructed car, altering currentCar doesn't change usergarage[0],
//retain the index instead and access directly to mdoify.
//value of null means no selection
var curCarIndex = null,	//user's currect car index
	selCarIndex = null;	//user's selected car index
//
var Garage = {
	init : function()
	{	//called to load assests and initialize private vars
		//delete userGarage;
		//selCarIndex = null;
		//init cars from local storage
		//add buttons for each car avaiable in garage
		//var carList = $('#Garage'.children('ul#carBtns');
		//carList.clear();	//remove previous values, otherwise cars will be repeated
		
		//if(curCarIndex === null && userGarage.length != 0){
			//curCarIndex = 0;
		//}
		//var btnStr = "<li><button id=\'carSelBtn1\'><label id=\'make\'></label><label id=\'year\'></label><label id=\'name\'></label><img src=\'images/vehicle.jpg\'></button></li>";
		var list = $('#carBtns')
		list.empty();	//remove any buttons if there were any previously
		
		for(var i = 0; i < userGarage.length; i++){
			//add buttons to list
			src = "\'images/vehicle.jpg\'";	//userGarage[i].getFullPath();
			list.append("<li>" +
			"<button id=\'carSelBtn" + i + "\'>" +
			"<label id=\'carName\'>Car Name</label>" +
			//"<label id=\'year\'></label>" +
			//"<label id=\'name\'></label>" +
			"<label id=\'carInfo\'></label>" +
			//progress bar max default is 1.0
			//
			//"<div id=\'pbLabels'>" +
				//"<label id=\'dt\'>drivetrain</label>" +
				//"<label id=\'body\'>body</label>" +
				//"<label id=\'interior\'>interior</label>" +
				//"<label id=\'docs\'>documentation</label>" +
			//"</div>" +			
			//
			"<img src=" + src + "></button>" +
			"</li>");
			
			$('#carSelBtn' + i).click({index:i}, this.setCurrentCar);	//this.setSelectedCar);
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
	//setSelectedCar : function(obj)
	//{	//sets and displays 
		//set jq values
		//if(obj !== null && !== 'undefined')
			//selCarIndex = obj.data.index;
	//},
	setCurrentCar : function(index)
	{
		var i = index.data.index;
		var btn = $('#userCar');
		var src = $('#carSelBtn' + i);	//$('#selectedCar');
	
		curCarIndex = i;	//maintain index, instead of copying a car
		//}
		btn.children('label#carName').text(src.children('label#carName').text() );
		btn.children('label#carInfo').text(src.children('label#carInfo').text() );
		//btn.children('label#name').text(src.children('label#name').text() );
		
		var pb = $('progress#drivetrainPB');
		pb.attr('value', '0.5');
	},
	setCarBtnText : function(index)
	{
		var car = userGarage[index];
		var btn = $('#carSelBtn' + index);
		//var car = userGarage[i];
		btn.children('label#carName').text(car.getFullName() );
		btn.children('label#carInfo').text('Default car info');
		//btn.children('label#make').text(car.make);
		//btn.children('label#year').text(car.year);
		//btn.children('label#name').text(car.name);
	}
};

var CarView = {
	//carView state object
	init : function(index)
	{
		var car = userGarage[selCarIndex];
		jq.CarView.carImg.attr('src', 'images\\vehicle.jpg');	//car.getFullPath() );
		//jq.CarView.carInfo.text(xmlCarinfo.getElemById(car.id) );
	}
	//update, ender, exit?
};

$('#myCars').click(function()
{
	jq.Garage.toggle();
	Garage.init();
});
jq.Garage.backBtn.click(function(){
	jq.Garage.toggle();
	//Garage.exit();
});
$('button#viewCar').click(function()
{
	if(curCarIndex !== null)
	{
		jq.CarView.toggle();
		//CarView.init(selCarIndex);
	}
	//else, do nothing, user has not clicked on a car
});
$('button#selectCarBtn').click(function()
{
	if(selCarIndex !== null)
	{
		this.setCurrentCar({index:selCarIndex});
		jq.Game.homeImg.attr('src', 'images\\vehicle.jpg');	//set home car image
	}
});