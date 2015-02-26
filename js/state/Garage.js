//
//Garage State interface
//
//test, user ca select between 3 cars
//var currentCar = null;

var userGarage = [
	//Vehicle('E-Type Series II 4.2 Roadster', 'Jaguar', '1969'),
	//Vehicle('Camaro RS/Z28 Sport Coupe', 'Chevrolet','1969'),
	//Vehicle('Sierra', 'GMC', '1997')
];
//userGarage.push(xdbCars[0]);
//userGarage.push(xdbCars[1]);
//userGarage.push(xdbCars[3]);
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
function VehicleFromDB(obj){
    //creates an unupgraded/repaired car from the database  
    //var jqxhr = 
    return $.ajax({
        type:'POST',
        //async:false,
        url:getHostPath() + 'pas/query.php',
        dataType:'json',
        data:{carID:obj.carID}
    }).done(function(data){
        //the response string is converted by jquery into a Javascript object!
        if(data === null){
            alert('Error:ajax response returned null!');
            //finished = true;
            return;
        }
//<php
    //if(DEBUG){?>
        //log vars for debugging
        //alert('VehicleFromDB():ajax response recieved: ' + JSON.stringify(obj) + ' ' + JSON.stringify(data) );
        //var car = Vehicle.fromDB(data.name,data.make,data.year,data.price, data.id, data.info);
        var car = Vehicle.fromDB(data, obj);
        //console.log('creating car from database: ' + JSON.stringify(car) );
        //car.upgrade(obj.parts);
        //car.repair(obj.repairs);
        //alert('VehicleFromDB():ajax response recieved, adding vehicle to garage: ' + JSON.stringify(car) );
//<php
//}
//else{
        userGarage.push(car);//Vehicle.fromDB(data, obj);
//}
//>
    }).fail(function(jqxhr){
        //call will fail if result is not properly formated JSON!
        alert('ajax call failed! Reason: ' + jqxhr.responseText);
        console.log('loading game resources failed, abort!');
        //finished = true;
    });
    
    //while(!finished){
        //wait for ajax call to complete
    //}
    //alert(JSON.stringify(ret) );
    //return ret;
}
//ao.state.Garage =
var Garage = {
	_curCarIndex : null,
    _carViewList: $('div#carListView ul#carBtns'),
	//_selCarIndex : null,	//user's selected car index
	//toJSON:function(){//serialize Garage._curCarIndex},
	//fromJSON:function(){this._curCarIndex = index;},
	init : function()
	{	//called to load assests and initialize private vars
		//delete userGarage;
		selCarIndex = null;
        
        //var list = $('div#carListView ul#carBtns');
		Garage._carViewList.empty();	//remove any buttons if there were any previously
		
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
		this.load();
        
		//this.initUI();
		//appState = GAME_MODE.GARAGE;
	},
    initUI:function(){
        //init user interface elements, current and selected cars and the car buttons
        console.log('calling initUI()');
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
        this.initCarView();
    },
	getCurrentCar : function()
	{	//returns a vehicle, if one is selected or null
		return (Garage._curCarIndex !== null && userGarage.length != 0) ? userGarage[Garage._curCarIndex] : null;
	},
	exit : function()
	{	//remove resources, effectivly 'closing' the state
		//appState = GAME_MODE.MAIN;
	},
	update : function(){
		stop = true;
	},
	render : function(){
		//additional rendering
	},
    clear:function(){
        //NOTE:for development only!
        //clears the users garage and any save data associated with it
        //if(Storage.local !== null){
            //if('userGarage' in Storage.local){
                //Storage.local.removeItem('userGarage');
            //}
       
            //if('curCarIndex' in Storage.local){
                //Storage.local.removeItem('curCarIndex');
            //}
        //}
    },
    load:function(){
        //loads user's car data, from database onserver, or local storage if playing locally
//<?php
    //if(loggedIn){
        //make server calls(using ajax) to serialize
        //user vehicles saved to database, so that vehicles
        //need only be created once, instead of making server calls all the time to update cars
        //var dataStr = JSON.stringify({carID:24577});
        //alert('calling ajax');
        
        userGarage = [];    //clear previous entries
        
        var jqxhr = $.ajax({
            type:'POST',
            url:getHostPath() + 'pas/query.php',
            dataType:'json',
            data:'' //{carID:24577}
        }).done(function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                alert('Error:ajax response returned null!');
                return;
            }
            //alert('ajax response recieved:' + JSON.stringify(data) );
            
            if(data.length == 0){
                //exit early is user has no cars
                console.log('user has no cars!, Buy some, right now!');
                return;
            }
            var args = [];
            
            for(var i = 0; i < data.length; i++){
                var obj = data[i];
                args.push(VehicleFromDB(obj) ); //adds ajax request object to array
            }
            $.when.apply($, args).done(function(){
                //the UI is dependant on the users garage being loaded,
                //so init ui after all ajax calls have completed
                Garage.initUI();
            }).fail(function(){
                console.log('loading game resources failed, abort!');
            });
        }).fail(function(jqxhr){
            //call will fail if result is not properly formated JSON!
            alert('ajax call failed! Reason: ' + jqxhr.responseText);
            console.log('loading game resources failed, abort!');
        });
//<php
//}
//else{  //playing locally as guest, make calls in JavaScript
        /*if(Storage.local !== null){
            if('userGarage' in Storage.local){
                cars = JSON.parse(Storage.local['userGarage']);
                //load each saved car
                if(cars.length != 0){
                    userGarage = [];    //clear any previous entries from garage
                    
                    for(var i = 0; i < cars.length; i++){
                        var car = cars[i];  //returns a javascript object!
                        userGarage.push(Vehicle(car.name, car.make, car.year, car._price) );
                    }
                }
            }
            if('_curCarIndex' in Storage.local){
                Garage._curCarIndex = parseInt(JSON.parse(Storage.local._curCarIndex) );
                console.log('current car is at index:' + Garage._curCarIndex.toString() );
            }
        }*/
//}
//>
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
            if(userGarage.length != 0){
                Storage.local['userGarage'] = JSON.stringify(userGarage); //array);
            }
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
    setCurrentCarStats:function(){
        if(this._curCarIndex !== null){
            var car = userGarage[this._curCarIndex],
                stats = car.getStats();
            
            $('div#userCar img#carImg').attr('src', car.getFullPath() );
            $('div#userCar label#carName').text(car.getFullName() );;
            $('div#userCar label#carInfo').text(car.getInfo() );
            
            //set progress bar
            pbSetColor($('progress#drivetrainPB'), stats._driveterrain);
            pbSetColor($('progress#bodyPB'), stats._body);
            pbSetColor($('progress#interiorPB'), stats._interior);
            pbSetColor($('progress#docsPB'), stats._docs);
        }
    },
    setCurrentIndex:function(){
        if(selCarIndex === null){
			return;	//no selected car, do nothing
        }
		if(selCarIndex < userGarage.length){
            Garage._curCarIndex = selCarIndex;	//maintain index, instead of copying a car
        }
    },
	setCurrentCar : function()
	{
        this.setCurrentIndex();
        
		if(this._curCarIndex !== null){
            var i = this._curCarIndex,
                btn = $('#userCar'),
                src = $('#carSelBtn' + i);
//<php
//if(loggedIn){>
            //save to car ID to final post using ajax
//<php
//}
//else{>
            //playing as guest, save to local storage
            if(Storage.local !== null){
                Storage.local['_curCarIndex'] = JSON.stringify(Garage._curCarIndex);
                //alert("current car is at index:" + Garage._curCarIndex.toString() );
            }
//<php
//}
//>
			//
			btn.children('label#carName').text(src.children('label#carName').text() );
			btn.children('label#carInfo').text(src.children('label#carInfo').text() );
			//btn.children('label#name').text(src.children('label#name').text() );
			
			this.setCurrentCarStats();
			
			$('div#Garage #userCar').show();
		}
        else{
            //no current car
            $('div#Garage #userCar').hide();
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
			
			pbSetColor($('div#selectedCar progress#drivetrainPB'), stats._driveterrain);
			pbSetColor($('div#selectedCar progress#bodyPB'), stats._body);
			pbSetColor($('div#selectedCar progress#interiorPB'), stats._interior);
			pbSetColor($('div#selectedCar progress#docsPB'), stats._docs);
			
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
	},
    initCarView:function(){
        //displays cars in the users garage 
        if(userGarage.length == 0)
		{	//empty grage so display img instead of buttons
			src = "<li><img id=\'GarageEmpty\' src =\'images\\garageEmpty.png\'></li>";
			list.append(src);
	
			$('div#Garage #select').hide();
			$('div#Garage #viewCar').hide();
		}
		else
        {	//$('div#Garage #userCar').show();
			//$('div#selectedCar').show();
			$('div#Garage #select').show();
			$('div#Garage #viewCar').show();
						
			for(var i = 0; i < userGarage.length; i++)
			{	//add buttons to list
				var car = userGarage[i];
				src = car.getFullPath();	//"\'images/vehicle.jpg\'";
				this._carViewList.append("<li>" +	//id = \'" + i "\'>"
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
				
                //$(Garrage._carViewList, 'li#' + i.toString() + ' button').click({index:i}, this.setSelectCar);	//this.setSelectedCar);
				$('#carSelBtn' + i).click({index:i}, this.setSelectCar);	//this.setSelectedCar);
			}
		}
    }
};
//Garage.save();
var CarView = {
	//carView state object
	init : function(index)
	{
		if(selCarIndex !== null && userGarage.length != 0)
		{
			var car = userGarage[selCarIndex];
			jq.CarView.carImg.attr('src', car.getFullPath() );	//'images\\vehicle.jpg');
			jq.CarView.carInfo.text(car.getFullName() + '-\n    ' + car.getInfo()) ;//xmlCarinfo.getElemById(car.id) );
			jq.CarView.sellBtn.off().click({i:selCarIndex}, AuctionSell.init);
            //set dt progress bars
            for(var i = Drivetrain.TYPE.engine; i <= Drivetrain.TYPE.exhaust; i++){ 
                var part = car._dt.getPartType(i),
                    str = 'div#CarView div#drivetrain progress#pb' + Drivetrain.strFromType(i),
                    p = part.getPercent(),
                    pb = $(str);    //progress bar
                
                pbSetColor(pb, p);
            }
            //set interior progress bars
            for(var i = Interior.TYPE.seats; i <= Interior.TYPE.panels; i++){ 
                var part = car._interior.getPartType(i),
                    str = 'div#CarView div#interior progress#pb' + Interior.strFromType(i),
                    p = part.getPercent(),
                    pb = $(str);
                
                pbSetColor(pb, p);
            }
            //set body progress bars
            for(var i = Body.TYPE.chasis; i <= Body.TYPE.ph0; i++){ 
                var part = car._body.getPartType(i),
                    str = 'div#CarView div#body progress#pb' + Body.strFromType(i),
                    p = part.getPercent(),
                    pb = $(str);

                pbSetColor(pb, p);
            }
            //set docs progress bars
            for(var i = Documents.TYPE.ownership; i <= Documents.TYPE.ph0; i++){ 
                var part = car._docs.getPartType(i),                    
                    str = 'div#CarView div#docs progress#pb' + Documents.strFromType(i),
                    p = part.getPercent(),
                    pb = $(str);    //progress bar
                    
                pbSetColor(pb, p);
            }
		}
	}
	//update, ender, exit?
};
function setHomeImg(){
    var car = Garage.getCurrentCar();
    if(car !== null){
        var homeImg = $('div#gameMenu img#homeImg');
        homeImg.attr('src', car.getFullPath() );
    }
}
jq.Garage.backBtn.click(function()
{
	jq.Garage.toggle();
	Garage.save();
    setHomeImg();
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