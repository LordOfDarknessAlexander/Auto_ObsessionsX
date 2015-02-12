/*Repair State interface, mod your ride and upgrade parts
Dependant on state\Garage.js, for userGarage and car index
and Vehicle.js for Cars and Parts*/
var Repair = {
	update : function()
	{
	},
	render : function()
	{
		//additional rendering to 2D context
	},
	init : function()
	{
		//appState = GAME_MODE.Repair;
		if(userGarage.length != 0 && Garage._curCarIndex !== null)
		{
			var car = Garage.getCurrentCar();
            var img = $('div#RepairShop img#userCar');
            img.attr('src', car === null ? 'images\\garageEmpty.png' : car.getFullPath() );
			
			this._initButtons();

			$('div#RepairShop div#upgrades').show();
			$('div#RepairShop div#repairs').show();
		}
		else
		{
			//show empty garage, please purchase a car
			$('div#RepairShop img#userCar').attr('src', 'images/garageEmpty.png');
			$('div#RepairShop div#upgrades').hide();
			$('div#RepairShop div#repairs').hide();
		}
	},
	_initButtons : function()
	{
		var car = Garage.getCurrentCar();
       
        if(car !== null){
            //var parts = car._parts

            //for each upgrade, buttons must be refreshed each time, as the cars or upgrades may change
            //var ul = $('div#RepairShop div#upgrades'),
                //rl = $('div#RepairShop div#repairs');

            //ul.empty().append('<h2>Upgrades</h2>');
            
            //rl.empty().append('<h2>Repairs</h2>');
            //upgrade button
            var btnTag = 'div#RepairShop div#drivetrain button#';
            
            for(var i = Drivetrain.TYPE.engine; i <= Drivetrain.TYPE.exhaust; i++){ 
                var part = car._dt.getPartType(i);
                
                var str = Drivetrain.strFromType(i);
                
                if(!part._stage != carPart.STAGE.pro){
                    $(btnTag + 'ub' + str).off().click(
                        {type:i}, upgradeDT
                    ).text('$' + part.getPrice() );
                }else{
                    //max upgrade already purchased, disable button
                    $(btnTag + 'ub' + str).off();   //.css();
                }
                //repair button
                if(!part._repaired){
                    $(btnTag + 'rb' + str).off().click(
                        {type:i}, repairDT
                    ).text('$' + part.getRepairPrice() );
                }
                else{
                    $(btnTag + 'rb' + str).off();   //.css('opacity':'0.45','cursor':'default'});
                }
                
                $('div#RepairShop div#drivetrain progress#' + 'pb' + str).attr('value', part.getPercent() );
            }
            
            /*for(var i = Interior.TYPE.engine; i <= Interior.TYPE.exhaust; i++){ 
                var part = car._dt.getPartType(i);
                
                var str = Drivetrain.strFromType(i);
                
                if(!part._stage != carPart.STAGE.pro){
                    $(btnTag + 'ub' + str).off().click(
                        {type:i}, upgradeDT
                    ).text('$' + part.getPrice() );
                }else{
                    //max upgrade already purchased, disable button
                    $(btnTag + 'ub' + str).off();   //.css();
                }
                //repair button
                if(!part._repaired){
                    $(btnTag + 'rb' + str).off().click(
                        {type:i}, repairDT
                    ).text('$' + part.getRepairPrice() );
                }
                else{
                    $(btnTag + 'rb' + str).off();   //.css('opacity':'0.45','cursor':'default'});
                }
                
                $('div#RepairShop div#drivetrain progress#' + 'pb' + str).attr('value', part.getPercent() );
            }*/
            /*for(var i = Body.TYPE.engine; i <= Body.TYPE.exhaust; i++){ 
                var part = car._dt.getPartType(i);
                
                var str = Drivetrain.strFromType(i);
                
                if(!part._stage != carPart.STAGE.pro){
                    $(btnTag + 'ub' + str).off().click(
                        {type:i}, upgradeDT
                    ).text('$' + part.getPrice() );
                }else{
                    //max upgrade already purchased, disable button
                    $(btnTag + 'ub' + str).off();   //.css();
                }
                //repair button
                if(!part._repaired){
                    $(btnTag + 'rb' + str).off().click(
                        {type:i}, repairDT
                    ).text('$' + part.getRepairPrice() );
                }
                else{
                    $(btnTag + 'rb' + str).off();   //.css('opacity':'0.45','cursor':'default'});
                }
                
                $('div#RepairShop div#drivetrain progress#' + 'pb' + str).attr('value', part.getPercent() );
            }*/
           /*for(var i = Documents.TYPE.engine; i <= Documents.TYPE.exhaust; i++){ 
                var part = car._docs.getPartType(i);
                
                var str = Documents.strFromType(i);
                
                if(!part._stage != carPart.STAGE.pro){
                    $(btnTag + 'ub' + str).off().click(
                        {type:i}, upgradeDT
                    ).text('$' + part.getPrice() );
                }else{
                    //max upgrade already purchased, disable button
                    $(btnTag + 'ub' + str).off();   //.css();
                }
                //repair button
                if(!part._repaired){
                    $(btnTag + 'rb' + str).off().click(
                        {type:i}, repairDT
                    ).text('$' + part.getRepairPrice() );
                }
                else{
                    $(btnTag + 'rb' + str).off();   //.css('opacity':'0.45','cursor':'default'});
                }
                
                $('div#RepairShop div#drivetrain progress#' + 'pb' + str).attr('value', part.getPercent() );
            }*/
            for(var i = carPart.type.interior; i <= carPart.type.exhaust; i++){
                //var price = //get from database
                /*var btnStr = "<button id ='" + i.toString() + "'>" +
                    "<label id='name'>partName</label><br>" +
                    "<label id='type'>" + stringFromPartType(i) + "</label><br>" +
                    "$<label id='price'>150</label><br>" +
                    //"<img id='icon' src=''>" +
                "</button><br>";
                ul.append(btnStr);*/
                //
                //var btnID = 'div#RepairShop div#upgrades button#' + i.toString(),
                    //btn = $(btnID);
                
                //btn.off().click({type:i}, addUpgrade);
                
               // var part = car.getPart(i);
                
                //if(part !== null){
                    //if(part._stage == carPart.STAGE.pro){
                        //part has been previously upgraded to max, remove all event handlers, effectively disabling the button!
                        //btn.css({'opacity':'0.45', 'cursor':'default'}).off();
                    //}
               // }
                /*
                var rBtnStr = "<button id ='" + i.toString() + "'>" +
                    "<label id='name'>partName</label><br>" +
                    "<label id='type'>" + stringFromPartType(i) + "</label><br>" +
                    "$<label id='price'>150</label><br>" +
                    //"<img id='icon' src=''>" +
                "</button><br>";
                rl.append(rBtnStr);*/
                //add repair buttons
                //var rBtnID = 'div#RepairShop div#repairs button#' + i.toString(),
                    //rBtn = $(rBtnID);    //repair button
                
                //rBtn.click({type:i}, repairPart);
                /*if(part !== null){
                    console.log('car has part: ' + stringFromPartType(i) );
                    if(part._repaired){
                        rBtn.css({'opacity':'0.45', 'cursor':'default'});
                    }
                    else{
                        rBtn.click({type:i}, repairPart);
                    }
                }
                else{
                    console.log('car DOES NOT have part: ' + stringFromPartType(i) );
                    //car does not have part, can not upgrade
                    rBtn.css({'opacity':'0.45', 'cursor':'default'});
                }*/
            }
        }
        else{
            //user has no car, unbind previous bindings, no car no actions
            var btnTag = 'div#RepairShop div#drivetrain button#';
            
            for(var i = Drivetrain.TYPE.engine; i <= Drivetrain.TYPE.exhaust; i++){ 
                var str = Drivetrain.strFromType(i);
                    $(btnTag + 'ub' + str).off();   //.css();
                    $(btnTag + 'rb' + str).off();   //.css('opacity':'0.45','cursor':'default'});
            }
        }
	},
    save:function(){
        //saves each upgrade/repair when the user repairs
        var funcName = 'Repair::save()';
//<php
//if(loggedIn){?>
        //sends the car data to the server
        var car = Garage.getCurrentCar();
        
        $.ajax({
            type:'POST',
            url:getHostPath() + 'vehicles/update.php?op=update',
            dataType:'json',
            data:{
                carID:car.id,
                dt:car._dt !== null ? car._dt.getBits() : 0,
                body:car._body !== null ? car._body.getBits() : 0,
                inter:car._interior !== null ? car._interior.getBits() : 0,
                docs:car._docs !== null ? car._docs.getBits() : 0,
                repairs:car.getRepairBitfield()
            }
        }).done(function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                alert(funcName + ', Error:ajax response returned null!');
                return;
            }
            alert(funcName + ', ajax response success! ' + JSON.stringify(data) );
            //do stuff
            Garage.save();    //save updates to user cars in local storage
        }).fail(function(jqxhr){
            //call will fail if result is not properly formated JSON!
            alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
            console.log('failed to save vehicle upgrades to database!');
        });
//<php//
//}
//else{?>
        //save to userGarage in local storage
        //temporary, vehicles are loaded from database when navigating to it
        //Garage.save();    //save updates to user vehicles
//<php
//}
    }
};

function addUpgrade(obj)
{	//adds part to user's current car, increasing originality and value
	var car = Garage.getCurrentCar();
    if(car !== null){
        var type = obj.data.type;
        console.log('upgrading part of type: ' + stringFromPartType(type) );
        car.upgradePart(type);
        
        var part = car.getPart(type);
        //if part is upgraded to max, unbind and make unclickable
        if(part !== null){
            if(part._stage == carPart.STAGE.pro){
                var btnID = 'div#RepairShop div#upgrades button#' + part._type.toString();
                var btn = $(btnID);
                btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
                //btn.off();  //remove all event handlers, effectively disabling the button!
            }
            if(!part._repaired){
                //added part so enable upgrade button 
                var rBtnID = 'div#RepairShop div#repairs button#' + type.toString(),
                    rBtn = $(rBtnID);    //repair button
                
                //rBtn.off().click({type:type}, repairPart);
            }
        }
    }
}
function repairPart(obj)
{	//repairs a component of the vehicle, increasing condition and value
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        console.log('repairing part!');
        var type = obj.data.type;
        
        if(car.repairPart(type) ){
            //part has been repaired, disable button
            var part = car.getPart(type),
                btnID = 'div#RepairShop div#repairs button#' + part._type.toString(),
                btn = $(btnID);
                //remove all event handlers, effectively disabling the button!
                btn.css({'opacity':'0.45', 'cursor':'default'}).off();
        }
    }
    //else no car selected
}
function upgradeDT(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;
        console.log('upgrading part of type: ' + Drivetrain.strFromType(type) );
        //if(car._dt == null){
            //var bp = Drivetrain.getInstallPrice(car.getBasePrice();
            //if(usreStats.moeny >= bp) ){
                //install part
                //car._dt = Drivetrain.make(bp)
                //userStats.money -= bp;
                //return;
            //}
            //else{
                //play purchase denied sound
                //return;
            //}
        //}
        //else{    //upgrade existing part
        car._dt.upgradePart(type);
        
        var part = car._dt.getPartType(type);
        //if part is upgraded to max, unbind and make unclickable
        if(part !== null){
            var str = Drivetrain.strFromType(type);
            
            if(part._stage == carPart.STAGE.pro){
                var btnID = 'div#RepairShop div#drivetrain button#ub' + str;
                var btn = $(btnID);
                btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
                //btn.off();  //remove all event handlers, effectively disabling the button!
            }
            if(!part._repaired){
                //added part so enable upgrade button 
                //var rBtnID = 'div#RepairShop div#repairs button#' + type.toString(),
                    //rBtn = $(rBtnID);    //repair button
                
                //rBtn.off().click({type:type}, repairPart);
            }
            $('div#RepairShop div#drivetrain progress#' + 'pb' + str).attr('value', part.getPercent() );
        }
        Repair.save();
    }
}
function repairDT(obj){
//    console.log('repair part!');
    var type = obj.data.type;
    
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        if(car._dt.repairPart(type) ){
            console.log('repaired part!');
            //part has been repaired, disable button
            var part = car._dt.getPartType(type);
            
            if(part !== null){
                var str = Drivetrain.strFromType(type);
                var btnID = 'div#RepairShop div#drivetrain button#rb' + str;
                
                $(btnID).css({'opacity':'0.45', 'cursor':'default'}).off();                
                $('div#RepairShop div#drivetrain progress#pb' + str).attr('value', part.getPercent() );
            }
        }
        Repair.save();
    }
}