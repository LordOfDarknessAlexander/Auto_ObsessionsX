//
//Garage State interface
//
//test, user ca select between 3 cars
//var currentCar = null;
//<php
//function loggedIn(){
    //return true;
//}
//?>
var userGarage = [
	//Vehicle('E-Type Series II 4.2 Roadster', 'Jaguar', '1969'),
	//Vehicle('Camaro RS/Z28 Sport Coupe', 'Chevrolet','1969'),
	//Vehicle('Sierra', 'GMC', '1997')
];
function hasCar(carID){
    //quick client side way to see if the user owns a car,
    //use PAS to get the most to date data
    var len = userGarage.length;
        
    if(len == 0){
        return false;
    }
    
    for(var i = 0; i < len; i++){
        if(userGarage[i].id == carID){
            return true;
        }
    }
    return false;
}
function getCar(carID){
    //quick client side way to get a user's car(with upgrades applied),
    //that isn't the user's current vehicle
    //returns null if user does not have car with carID in garage,
    //else returns an ao.car object
    var len = userGarage.length;
        
    if(len == 0){
        return null;
    }
    
    for(var i = 0; i < len; i++){
        if(userGarage[i].id == carID){
            return userGarage[i];
        }
    }
    return null;
}

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
//<php
    var funcName = 'Garage.js pas::VehicleFromDB()';
//?>
    return jq.post(
        'pas/query.php',
        function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                alert(funcName + ', Error:ajax response returned null!');
                //finished = true;
                return;
            }
//<php
    //if(DEBUG){?>
            //log vars for debugging
            //alert('VehicleFromDB():ajax response recieved: ' + JSON.stringify(obj) + ' ' + JSON.stringify(data) );
            var car = Vehicle.fromDB(data, obj);
            //console.log('creating car from database: ' + JSON.stringify(car) );
//<php
//}
//else{?>
            userGarage.push(car);   //Vehicle.fromDB(data, obj);
//<php
//}
//>
        },
        function(jqxhr){
            //call will fail if result is not properly formated JSON!
            jq.Err(funcName, 'ajax call failed! Reason: ' + jqxhr.responseText);
        },
        {carID:obj.carID}
    );
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
        var funcName = 'Garage.js Garage::initUI()';
//<php if(loggedIn()){
        //$.when(pas.query.userCar() ).done(
        //function(data){
//<php}>
        //pas.query.userCar();
            if(_curCarID == 0){
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
            //setHomeImg();
//<php if(loggedIn()){
        //}).fail(function(jqxhr){
            //alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
        //});
//<php}>
    },
	getCurrentCar : function()
	{	//returns a vehicle, if one is selected or null
		//return (Garage._curCarIndex !== null && userGarage.length != 0) ? userGarage[Garage._curCarIndex] : null;
        return _curCarID != 0 ? Garage.getCarByID(_curCarID) : null;
	},
    getCarByIndex:function(index)
	{	//returns a vehicle at a specific index, or null or failure
        //this can potetially be a diffrent car when called,
        //as when using $.ajax to initialize the car list, they may be out of order
		var len = userGarage.length;
        
        if(len == 0 || index > len){
            console.log('invalid index (' + index.toString() + ') into array of length (' + len.toString() + ')');
            return null;
        }
        
        for(var i = 0; i < len; i++){
            if(index == i){
                return userGarage[i];
            }
        }
        
        return null;
	},
    getCarByID:function(id)
	{   //id is an int > 0
        //returns a vehicle with matching id or null
		var len = userGarage.length;
        
        if(len == 0){
            return null;
        }
        
        for(var i = 0; i < len; i++){
            var car = userGarage[i];
            
            if(id == car.id){
                return car;
            }
        }
        
        return null;
	},
	removeCarByID:function(id)
	{   //id is an int > 0
        //returns a vehicle with matching id or null
		var len = userGarage.length;
        
        if(len == 0){
            return null;
        }
        
        for(var i = 0; i < len; i++){
            var car = userGarage[i];
            
            if(id == car.id){
				userGarage.splice(i, 1);
                return car;
            }
        }
        
        return null;
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
        
        var funcName = 'Garage.js Garage::load()';
        
        jq.get('pas/query.php?op=gug',
            function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
                    return;
                }
                //alert('ajax response recieved:' + JSON.stringify(data) );
                
                if(data.length == 0){
                    //exit early is user has no cars
                    console.log(funcName + ', user has no cars!, Buy some, right now!');
                    return;
                }
                var args = [];
                
                for(var i = 0; i < data.length; i++){
                    var obj = data[i];
                    args.push(VehicleFromDB(obj) ); //adds ajax request object to array
                }
                $.when.apply($, args).done(
                    function(){
                        //the UI is dependant on the users garage being loaded,
                        //so init ui after all ajax calls have completed
                        Garage.initUI();
                    }
                ).fail(
                    function(){
                        console.log(funcName + ', loading game resources failed, abort!');
                    }
                );
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
                console.log(funcName + ', loading game resources failed, abort!');
            }
        );
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
    //toJSON:function(){
        //{Garage:"_curCarID":0, "cars":[]}
    //}
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
                //var car = Garage.getCurrentCar();
                //Storage.local['_carID'] = JSON.stringify(car === null ? 0 : car.id);
            }
            //var car = Garage.getCurrentCar();
            //Storage.local['_carID'] = JSON.stringify(car === null ? 0 : car.id);
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
        if(_curCarID !== 0){
            var div = $('div#Garage div#userCar'),
                car = Garage.getCurrentCar(); //userGarage[this._curCarIndex],
                stats = car.getStats();
            
            $('img#carImg', div).attr('src', car.getFullPath() );
            $('label#carName', div).text(car.getFullName() );
            $('label#carInfo', div).text(car.getInfo() );
//<php
//function pbSetColor($str){
    //sets the color of an html progress bar (using jQuery) named pb$str based on the property stats._$str;?>
    //pbSetColor($('progress#pb<?php echo $str;?>', div), stats.<php echo $str;?>);
//<?php
//}
//pbSetColor('Drivetrain');
//pbSetColor('Body');
//pbSetColor('Interior');
//pbSetColor('Docs');
//?>
            //set progress bar
            pbSetColor($('progress#pbDrivetrain', div), stats._driveterrain);
            pbSetColor($('progress#pbBody', div), stats._body);
            pbSetColor($('progress#pbInterior', div), stats._interior);
            pbSetColor($('progress#pbDocuments', div), stats._docs);
            
            $('button#con', div).text(car.getCondition().toString() );
			 //$('button#con', div).text(car.getRandCondition().toString() );
			
        }
    },
    setCurrentIndex:function(){
        if(selCarIndex === null){
			return;	//no selected car, do nothing
        }
		if(selCarIndex < userGarage.length){
            Garage._curCarIndex = selCarIndex;	//maintain index, instead of copying a car
            var car = Garage.getCarByIndex(selCarIndex);
            _curCarID = (car === null) ? 0 : car.id;
//<php if(loggedIn() ){>
            pas.set.userCar(_curCarID);
//<?php
//}
//else{
            //local storage
//<?php  
//}
//?>
        }
    },
	setCurrentCar : function(){
        var div = $('div#Garage div#userCar');
        
        this.setCurrentIndex();
        
		if(this._curCarIndex !== null){
            var i = this._curCarIndex,
                //btn = $('#userCar'),
                src = $('#carSelBtn' + i);

            //playing as guest, save to local storage
            if(Storage.local !== null){
                Storage.local['_curCarIndex'] = JSON.stringify(Garage._curCarIndex);
                //alert("current car is at index:" + Garage._curCarIndex.toString() 
                //var car = Garage.getCurrentCar();
                
                //Storage.local['_carID'] = JSON.stringify(car !== null car.id : 0););
            }
			//
			div.children('label#carName').text(src.children('label#carName').text() );
			div.children('label#carInfo').text(src.children('label#carInfo').text() );
			//div.children('label#name').text(src.children('label#name').text() );
			
			this.setCurrentCarStats();
			
			div.show();
		}
        else{
            //no current car
            div.hide();
        }
	},
	setSelectCar : function(index){
        //
		var i = index.data.index;
	
		if(i < userGarage.length){
            //
			var div = $('div#Garage div#selectedCar');
			var src = $('#carSelBtn' + i);
		
			//show user car stats div
			selCarIndex = i;	//maintain index, instead of copying a car
			//
			div.children('label#carName').text(src.children('label#carName').text() );
			div.children('label#carInfo').text(src.children('label#carInfo').text() );
			//div.children('label#name').text(src.children('label#name').text() );
			
			var car = Garage.getCarByIndex(i); //userGarage[i],
				stats = car.getStats();
			
			//$('div#userCar img#carImg').attr('src', car.getFullPath() );
			//$('div#userCar label#carName').text(car.getFullName() );;
			//$('div#userCar label#carInfo').text(car.getInfo() );
			$('img#carImg', div).attr('src', car.getFullPath() );
			$('label#carName', div).text(car.getFullName() );
			$('label#carInfo', div).text(car.getInfo() );
//<php
//pbSetColor('Drivetrain');
//pbSetColor('Body');
//pbSetColor('Interior');
//pbSetColor('Docs');
//?>
			pbSetColor($('progress#pbDrivetrain', div), stats._driveterrain);
			pbSetColor($('progress#pbBody', div), stats._body);
			pbSetColor($('progress#pbInterior', div), stats._interior);
			pbSetColor($('progress#pbDocuments', div), stats._docs);
			
            $('button#con', div).text(car.getCondition().toString() );
            
			div.show();
		}
	},
	setCarBtnText : function(index){
        //
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
			Garage._carViewList.empty();
	
			$('div#Garage #select').hide();
			$('div#Garage #viewCar').hide();
		}
		else{
        	//$('div#Garage #userCar').show();
			//$('div#selectedCar').show();
            //if(Garge.getUserCar() )
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
    },
    getCollectionValue:function(){
        //returns the total value of the user's garage,
        //including upgrades and repairs
        var ret = 0.0,
            len = userGarage.length;
            
        for(var i = 0; i < len; i++){
            ret += userGarage[i].getPrice();
        }
        
        return ret;
    }
};
//Garage.save();
var CarView = {
	//carView state object
	init : function(index){
        
		if(selCarIndex !== null && userGarage.length != 0){
            //
			var car = Garage.getCarByIndex(selCarIndex);   //userGarage[selCarIndex];
            
            if(car !== null && car !== undefined){
                setHomeImg(car.getFullPath() );
                jq.carImg.show();
                //jq.CarView.carImg.attr('src', car.getFullPath() );	//'images\\vehicle.jpg');
                jq.CarView.carName.text(car.getFullName() );
                jq.CarView.carInfo.text(car.getInfo() ) ;
                jq.CarView.sellBtn.off().click( 
                    function(){		
                        jq.post(
                            "pas/update.php?op=pucs", 
                            function(data){
                                
                                console.log(JSON.stringify(data));
                            }, 
                            function(jqxhr){ 
                                jq.setErr("carView.Init", "error happened: " + jqxhr.responseText);
                            }, 
                            {carID:car.id}
                        );
                    }
                    //{i:selCarIndex}, AuctionSell.init
                );
                //function(data){
                    //AuctionSell.init(selCarIndex);
                //});
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
	}
	//update, ender, exit?
};
//
//jQuery bindings
//
function setHomeImg(path){
    var car = Garage.getCurrentCar();
    var homeImg = jq.carImg;
    
    if(path === null || path === undefined){
        //no param 'path' passed to function, empty args
        if(car !== null){
            homeImg.attr('src', car.getFullPath() );
        }
        else{   //set to empty garage!
            homeImg.attr('src', getHostPath() + "images/garageEmpty.png");
        }
    }
    else{
        //for use by carView and Auction, etc to set custom image,
        //that isn't the current vehicle
        //TODO;regex match to check string is valid filepath!
        //
        homeImg.attr('src', path);
    }
}
jq.Garage.shopBtn.click(
function(){
    if(_curCarID != 0){
        //rebind repair back button to return us to this page
        jq.RepairShop.backBtn.off().click(
            function(){
                jq.RepairShop.menu.hide();
                setStatBar();
                jq.Garage.menu.show();
                Garage.init();
                jq.carImg.hide();
                jq.adBar.hide();
                jq.setErr();
            }
        );
        jq.Garage.menu.hide();
        Repair.init();
        
        jq.carImg.show();
        setAdBG();
        jq.setErr();    //clear error when changing pages
    }
});
$('div#Garage button#sales').click(
function(){
	jq.Garage.menu.hide();
    //AuctionSell.init();
    AuctionSell.init();
    jq.setErr();    //clear error when changing pages
    
    jq.AuctionSell.backBtn.off().click(
        function(){
            jq.Garage.menu.show();
            jq.AuctionSell.menu.hide();
            jq.setErr();    //clear error when changing pages
        }
    );
});
jq.Garage.backBtn.click(
function(){
	jq.Garage.toggle();
	Garage.save();
    jq.carImg.show();
    setHomeImg();
    setAdBG();
    jq.setErr();    //clear error when changing pages
});
/*jq.Garage.selectBtn.click(function()
{
	if(selCarIndex !== null)
		Garage.setCurrentCar(selCarIndex);
});*/
jq.Garage.viewBtn.click(
function(){
    //
	if(selCarIndex !== null){
        jq.AuctionSell.backBtn.off().click(
        function(){
            jq.AuctionSell.menu.hide();
            jq.CarView.menu.show();
            jq.carImg.show();
            jq.setErr();    //clear error when changing pages
            //appState = GAME_MODE.CAR_VIEW;
        });
		jq.CarView.menu.toggle();
        jq.Garage.menu.hide();
		CarView.init(); 
        jq.setErr();    //clear error when changing pages        
	}
	//else, do nothing, user has not clicked on a car
});
jq.Garage.selectBtn.click(
function(){
    //selects the vehicle the user is currently viewing
	if(selCarIndex !== null){
		Garage.setCurrentCar();

        setHomeImg();	//set home car image
	}
});
//
//Car view jq bindings
//
jq.CarView.selectBtn.click(
function(){
    if(selCarIndex !== null){
		Garage.setCurrentCar();
        setHomeImg();	//set home car image
	}
});
jq.CarView.backBtn.click(
function () {
//    Garage.load();

    jq.CarView.menu.hide();//toggle();
    jq.Garage.menu.show();
    jq.carImg.hide();
    jq.setErr();    //clear error when changing pages
});
jq.CarView.homeBtn.click(
function(){
	jq.Game.menu.show();
	jq.CarView.menu.hide();
    setHomeImg();
    setAdBG();
	//appState = GAME_STATE.MAIN;
    jq.setErr();    //clear error when changing pages
});