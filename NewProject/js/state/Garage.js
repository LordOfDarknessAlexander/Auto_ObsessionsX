﻿//
//Repair State interface
//
//test, user ca select between 3 cars
//var currentCar = null;

var userGarage = [
	//Vehicle('E-Type Series II 4.2 Roadster', 'Jaguar', '1969'),
	//Vehicle('Camaro RS/Z28 Sport Coupe', 'Chevrolet','1969'),
	//Vehicle('Sierra', 'GMC', '1997')
];
userGarage.push(xdbCars[0]);
userGarage.push(xdbCars[1]);
userGarage.push(xdbCars[3]);
//userGarage.push(xdbCars[1]);
//userGarage.push(xdbCars[0]);
//userGarage.push(xdbCars[1]);
//userGarage.push(xdbCars[3]);
//userGarage.push(xdbCars[1]);
//copy constructed car, altering currentCar doesn't change usergarage[0],
//retain the index instead and access directly to mdoify.
//value of null means no selection
var //Garage._curCarIndex = null,	//user's currect car index
	selCarIndex = null;
//
var Garage = {
	_curCarIndex : null,
	//_selCarIndex : null,	//user's selected car index
	//toJSON:function(){//serialize Garage._curCarIndex},
	//fromJSON:function(){this._curCarIndex = index;},
	init : function()
	{	//called to load assests and initialize private vars
		//delete userGarage;
		selCarIndex = null;
		//init cars from local storage, or parsed from database on server
		//add buttons for each car avaiable in garage
		//var carList = $('#Garage'.children('ul#carBtns');
		//carList.clear();	//remove previous values, otherwise cars will be repeated
		//this._selCarIndex = null;
		//if(Garage._curCarIndex === null && userGarage.length != 0){
			//Garage._curCarIndex = 0;
		//}
		//var btnStr = "<li><button id=\'carSelBtn1\'><label id=\'make\'></label><label id=\'year\'></label><label id=\'name\'></label><img src=\'images/vehicle.jpg\'></button></li>";
        
        //if(Storage.local !== null && '_curCarIndex' in Storage.local){
            //Garage._curCarIndex = parseInt(JSON.parse(Storage.local._curCarIndex) );
            //alert("current car is at index:" + Garage._curCarIndex.toString() );
        //}
//<?php
    //if(loggedIn){
        //make server calls(using ajax) to serialize
        //user vehicles saved to database, so that vehicles
        //need only be created once, instead of making server calls all the time to update cars
    //}
    //else{  //playing locally as guest, make calls in JavaScript
        //
    //}
//?>
		if(Storage.local !== null && 'userGarage' in Storage.local)
		{
			//var jsonArray = JSON.parse(Storage.local.userGarage);	//returns an array
			
			//for(var i = 0; i < jsonArray.length; i++)
			//{
				//userGarage.push(JSON.parse(jsonArray[i]) );
                //userGarage.push(Vehicle.fromJSON(jsonArray[i]) );
			//}
		}
		var list = $('div#carListView ul#carBtns');
		list.empty();	//remove any buttons if there were any previously
		
		if(Garage._curCarIndex === null){
			$('div#Garage #userCar').hide();
        }
		else{
			Garage.setCurrentCar();
        }
		if(selCarIndex === null){
			$('div#selectedCar').hide();
        }
		else{
			this.setSelectCar({index:selCarIndex});
        }
		if(userGarage.length == 0)
		{	//empty grage so display img instead of buttons
			src = "<li><img id=\'GarageEmpty\' src =\'images\\garageEmpty.png\'></li>";
			list.append(src);
	
			$('div#Garage #select').hide();
			$('div#Garage #viewCar').hide();
		}
		else
		{
			//$('div#Garage #userCar').show();
			//$('div#selectedCar').show();
			$('div#Garage #select').show();
			$('div#Garage #viewCar').show();
						
			for(var i = 0; i < userGarage.length; i++)
			{	//add buttons to list
				var car = userGarage[i];
				src = car.getFullPath();	//"\'images/vehicle.jpg\'";
				list.append("<li>" +	//id = \'" + i "\'>"
				"<button id=\'carSelBtn" + i + "\'>" +
				//"<label id=\'carName\'>" + car.getFullName() + "</label>" +
				//"<label id=\'year\'></label>" +
				//"<label id=\'name\'></label>" +
//				"<label id=\'carInfo\'>" + car.getInfo() + "</label>" +
				//progress bar max default is 1.0
				//
				//"<div id=\'pbLabels'>" +
					//"<label id=\'dt\'>drivetrain</label>" +
					//"<label id=\'body\'>body</label>" +
					//"<label id=\'interior\'>interior</label>" +
					//"<label id=\'docs\'>documentation</label>" +
				//"</div>" +			
				//
				"<img src=\'" + src + "\'></button>" +
				"</li>"); //+ (i > 0 && i % 4 == 0) ? "<br>" : "");
				
				$('#carSelBtn' + i).click({index:i}, this.setSelectCar);	//this.setSelectedCar);
				//this.setCarBtnText(i);
			}
		}
		//load interface
		//appState = GAME_MODE.GARAGE;
	},
	getCurrentCar : function()
	{	//returns a vehicle, if one is selected or null
		return (Garage._curCarIndex !== null && userGarage.length != 0) ? userGarage[Garage._curCarIndex] : null;
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
//<?php
//if(loggedIn){
    //post user garage to php page to save user cars to sql database
//}
//else{?> //playing locally as guest
		if(Storage.local !== null)
		{
            if(Garage._curCarIndex !== null){
                Storage.local['_curCarIndex'] = JSON.stringify(Garage._curCarIndex);
            }
			//var array = [];
			//for(var i = 0; i < userGarage.length; i++)
			//{
				//array.push(JSON.stringify(userGarage[i]) );
			//}
			//Storage.local['userGarage'] = JSON.stringify(array);
		}
//}
//?>
	},
	//setSelectedCar : function(obj)
	//{	//sets and displays 
		//set jq values
		//if(obj !== null && !== 'undefined')
			//selCarIndex = obj.data.index;
	//},
	setCurrentCar : function()
	{
		if(selCarIndex === null)
			return;	//no selected car, do nothing
	
		if(selCarIndex < userGarage.length)
		{
			var i = selCarIndex;
			var btn = $('#userCar');
			var src = $('#carSelBtn' + i);
		
			//show user car stats div
			Garage._curCarIndex = i;	//maintain index, instead of copying a car
            //save index
            if(Storage.local !== null){
                Storage.local['_curCarIndex'] = JSON.stringify(Garage._curCarIndex);
                //alert("current car is at index:" + Garage._curCarIndex.toString() );
            }
			//
			btn.children('label#carName').text(src.children('label#carName').text() );
			btn.children('label#carInfo').text(src.children('label#carInfo').text() );
			//btn.children('label#name').text(src.children('label#name').text() );
			
			var car = userGarage[i],
				stats = car.getStats();
			
			$('div#userCar img#carImg').attr('src', car.getFullPath() );
			$('div#userCar label#carName').text(car.getFullName() );;
			$('div#userCar label#carInfo').text(car.getInfo() );
			
			function set(jqo, value)
			{
				if(value <= 0.3){
					jqo.css('background', '#ff0000');
				}
				else if(value > 0.3 && value <= 0.6){
					jqo.css('background', '#ffff00');
				}
				else if(value > 0.6 && value <= 1.0){
					jqo.css('background', '#00ff00');
				}
					
				jqo.attr('value', value.toString());
			}
			//set progress bar
			set($('progress#drivetrainPB'), stats._driveterrain);
			set($('progress#bodyPB'), stats._body);
			set($('progress#interiorPB'), stats._interior);
			set($('progress#docsPB'), stats._docs);
			
			$('div#Garage #userCar').show();
		}
	},
	setSelectCar : function(index)
	{
		var i = index.data.index;
	
		if(i < userGarage.length)
		{
			var btn = $('div#selectedCar');
			var src = $('#carSelBtn' + i);
		
			//show user car stats div
			selCarIndex = i;	//maintain index, instead of copying a car
			//
			btn.children('label#carName').text(src.children('label#carName').text() );
			btn.children('label#carInfo').text(src.children('label#carInfo').text() );
			//btn.children('label#name').text(src.children('label#name').text() );
			
			var car = userGarage[i],
				stats = car.getStats();
			
			//$('div#userCar img#carImg').attr('src', car.getFullPath() );
			//$('div#userCar label#carName').text(car.getFullName() );;
			//$('div#userCar label#carInfo').text(car.getInfo() );
			$('div#selectedCar img#carImg').attr('src', car.getFullPath() );
			$('div#selectedCar label#carName').text(car.getFullName() );
			$('div#selectedCar label#carInfo').text(car.getInfo() );
			
			function set(jqo, value)
			{
				/*if(value <= 0.3){
					jqo.css('background', '#ff0000');
				}
				else if(value > 0.3 && value <= 0.6){
					jqo.css('background', '#ffff00');
				}
				else if(value > 0.6 && value <= 1.0){
					jqo.css('background', '#00ff00');
				}*/
					
				jqo.attr('value', value.toString());
			}
			set($('div#selectedCar progress#drivetrainPB'), stats._driveterrain);
			set($('div#selectedCar progress#bodyPB'), stats._body);
			set($('div#selectedCar progress#interiorPB'), stats._interior);
			set($('div#selectedCar progress#docsPB'), stats._docs);
			
			$('div#selectedCar').show();
		}
	},
	setCarBtnText : function(index)
	{
		var car = userGarage[index];
		var btn = $('#carSelBtn' + index);
		//var car = userGarage[i];
		btn.children('label#carName').text(car.getFullName() );
		btn.children('label#carInfo').text(car.getInfo() );
		//btn.children('label#make').text(car.make);
		//btn.children('label#year').text(car.year);
		//btn.children('label#name').text(car.name);
	}
};

var CarView = {
	//carView state object
	init : function(index)
	{
		if(selCarIndex !== null && userGarage.length != 0)
		{
			var car = userGarage[selCarIndex];
			jq.CarView.carImg.attr('src', car.getFullPath() );	//'images\\vehicle.jpg');
			jq.CarView.carInfo.text(car.getFullName() + '-\n    ' + car.getInfo()) ;//xmlCarinfo.getElemById(car.id) );
		}
	}
	//update, ender, exit?
};
jq.Garage.backBtn.click(function()
{
	jq.Garage.toggle();
	//Garage.exit();
});
$('#myCars').click(function()
{
	jq.Garage.toggle();
	Garage.init();
});

jq.CarView.homeBtn.click(function()
{
	jq.Game.menu.show();
	jq.CarView.menu.hide();
	//appState = GAME_STATE.MAIN;
});
jq.CarView.sellBtn.click(function()
{
	//send car to auction!
});
jq.Garage.selectBtn.click(function()
{
	if(selCarIndex !== null)
		Garage.setCurrentCar(selCarIndex);
});
jq.Garage.viewBtn.click(function()
{
	if(selCarIndex !== null)
	{
		jq.CarView.toggle();
		CarView.init();
	}
	//else, do nothing, user has not clicked on a car
});
$('div#Garage button#select').click(function()
{
	if(selCarIndex !== null)
	{
		Garage.setCurrentCar();

        jq.Game.setHomeImg();	//set home car image

	}
});