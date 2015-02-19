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
	{   //initializes the state, enabling ui and core logic of this screen
		//appState = GAME_MODE.Repair;
		if(userGarage.length != 0 && Garage._curCarIndex !== null)
		{
			var car = Garage.getCurrentCar();
            var img = $('div#RepairShop img#userCar');
            img.attr('src', car === null ? 'images\\garageEmpty.png' : car.getFullPath() );
			
			this._initButtons();

			//$('div#RepairShop div#upgrades').show();
			//$('div#RepairShop div#repairs').show();
            
            $('div#RepairShop div#drivetrain').show();
			$('div#RepairShop div#body').show();
            $('div#RepairShop div#interior').show();
            $('div#RepairShop div#docs').show();
		}
		else
		{
			//show empty garage, please purchase a car
			$('div#RepairShop img#userCar').attr('src', 'images/garageEmpty.png');
            //TODO:display message in browser saying user must select a vehicle
			//$('div#RepairShop div#upgrades').hide();
			//$('div#RepairShop div#repairs').hide();
            
            $('div#RepairShop div#drivetrain').hide();
			$('div#RepairShop div#body').hide();
            $('div#RepairShop div#interior').hide();
            $('div#RepairShop div#docs').hide();
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
            if(car._dt !== null){
                var btnTag = 'div#RepairShop div#drivetrain button#';
                
                for(var i = Drivetrain.TYPE.engine; i <= Drivetrain.TYPE.exhaust; i++){ 
                    var part = car._dt.getPartType(i),
                        str = Drivetrain.strFromType(i);
   
                    if(part._stage != carPart.STAGE.pro){
                        $(btnTag + 'ub' + str).off().click(
                            {type:i}, upgradeDT
                        ).text('$' + part.getPrice() );
                    }
                    else{
                        //max upgrade already purchased, disable button
                        $(btnTag + 'ub' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    //repair button
                    if(!part._repaired){
                        $(btnTag + 'rb' + str).off().click(
                            {type:i}, repairDT
                        ).text('$' + part.getRepairPrice() );
                    }
                    else{
                        $(btnTag + 'rb' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    
                    $('div#RepairShop div#drivetrain progress#pb' + str).attr('value', part.getPercent() );
                }
            }
            else{
                //hide view and display purchase button
                //$('dt').hide();
                for(var i = Drivetrain.TYPE.engine; i <= Drivetrain.TYPE.exhaust; i++){ 
                    var str = Drivetrain.strFromType(i);
                    $(btnTag + 'ub' + str).off();   //.css();
                    $(btnTag + 'rb' + str).off();   //.css('opacity':'0.45','cursor':'default'});
                }
                //$('instal').show();
            }
            
            if(car._interior !== null){
                var btnTag = 'div#RepairShop div#interior button#';
                
                for(var i = Interior.TYPE.seats; i <= Interior.TYPE.panels; i++){ 
                    var part = car._interior.getPartType(i),
                        str = Interior.strFromType(i);
                    
                    if(part._stage != carPart.STAGE.pro){
                        $(btnTag + 'ub' + str).off().click(
                            {type:i}, upgradeInterior
                        ).text('$' + part.getPrice() );
                    }
                    else{
                        //max upgrade already purchased, disable button
                        $(btnTag + 'ub' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    //repair button
                    if(!part._repaired){
                        $(btnTag + 'rb' + str).off().click(
                            {type:i}, repairInterior
                        ).text('$' + part.getRepairPrice() );
                    }
                    else{
                        $(btnTag + 'rb' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    
                    $('div#RepairShop div#interior progress#pb' + str).attr('value', part.getPercent() );
                }
            }
            else{
                //hide view and display purchase button
            }
            
            if(car._body !== null){
                var btnTag = 'div#RepairShop div#body button#';
                
                for(var i = Body.TYPE.chasis; i <= Body.TYPE.ph0; i++){ 
                    var part = car._body.getPartType(i),
                        str = Body.strFromType(i);
                    
                    if(part._stage != carPart.STAGE.pro){
                        $(btnTag + 'ub' + str).off().click(
                            {type:i}, upgradeBody
                        ).text('$' + part.getPrice() );
                    }else{
                        //max upgrade already purchased, disable button
                        $(btnTag + 'ub' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    //repair button
                    if(!part._repaired){
                        $(btnTag + 'rb' + str).off().click(
                            {type:i}, repairBody
                        ).text('$' + part.getRepairPrice() );
                    }
                    else{
                        $(btnTag + 'rb' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    
                    $('div#RepairShop div#body progress#pb' + str).attr('value', part.getPercent() );
                }
            }
            else{
                //hide view and display purchase button
            }
            
            if(car._docs !== null){
                var btnTag = 'div#RepairShop div#docs button#';
                
                for(var i = Documents.TYPE.ownership; i <= Documents.TYPE.ph0; i++){ 
                    var part = car._docs.getPartType(i),                    
                        str = Documents.strFromType(i);
                    
                    if(part._stage != carPart.STAGE.pro){
                        $(btnTag + 'ub' + str).off().click(
                            {type:i}, upgradeDocs
                        ).text('$' + part.getPrice() );
                    }else{
                        //max upgrade already purchased, disable button
                        $(btnTag + 'ub' + str).off().css({'opacity':'0.45','cursor':'default'});
                    }
                    //docs don't have repair buttons
                    $('div#RepairShop div#docs progress#pb' + str).attr('value', part.getPercent() );
                }
            }
            else{
                //hide view and display purchase button
            }
            
            //for(var i = carPart.type.interior; i <= carPart.type.exhaust; i++){
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
            //}
        }
        else{
            //no car, hide/disable UI
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
            url:getHostPath() + 'pas/update.php?op=update',
            dataType:'json',
            data:{
                carID:car.id,
                dt:car._dt !== null ? car._dt.getBits() : 0,
                body:car._body !== null ? car._body.getBits() : 0,
                interior:car._interior !== null ? car._interior.getBits() : 0,
                docs:car._docs !== null ? car._docs.getBits() : 0,
                repairs:car.getRepairBitfield()
            }
        }).done(function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                alert(funcName + ', Error:ajax response returned null!');
                return;
            }
            //alert(funcName + ', ajax response success! ' + JSON.stringify(data) );
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

function upgradeDT(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Drivetrain.strFromType(type);
        console.log('upgrading part of type: ' + str);
        
        if(car._dt === null){
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
        }
        else{    //upgrade existing part
            if(car._dt.upgradePart(type) ){
                var part = car._dt.getPartType(type);
                //if part is upgraded to max, unbind and make unclickable
                if(part !== null){    
                        var btnID = 'div#RepairShop div#drivetrain button#ub' + str,
                            btn = $(btnID);         
                            
                    if(part._stage == carPart.STAGE.pro){
                        btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
                        //change background image?
                        btn.text('');
                    }
                    else{
                        btn.text('$' + part.getPrice().toString() );
                    }
                    
                    if(!part._repaired){
                        //added part so enable upgrade button 
                        //var rBtnID = 'div#RepairShop div#repairs button#' + type.toString(),
                            //rBtn = $(rBtnID);    //repair button
                        
                        //rBtn.off().click({type:type}, repairPart);
                    }
                    $('div#RepairShop div#drivetrain progress#' + 'pb' + str).attr('value', part.getPercent() );
                }
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function repairDT(obj){
//    console.log('repair part!');    
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Drivetrain.strFromType(type);
        
        if(car._dt.repairPart(type) ){
            console.log('repaired part!');
            //part has been repaired, disable button
            var part = car._dt.getPartType(type);
            
            if(part !== null){
                var btnID = 'div#RepairShop div#drivetrain button#rb' + str;
                
                $(btnID).css({'opacity':'0.45', 'cursor':'default'}).off().text(' ');                
                $('div#RepairShop div#drivetrain progress#pb' + str).attr('value', part.getPercent() );
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function upgradeBody(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Body.strFromType(type);
        
        console.log('upgrading part of type: ' + str);
        
        if(car._body === null){
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
        }
        else{    //upgrade existing part
            car._body.upgradePart(type);
            
            var part = car._body.getPartType(type);
            //if part is upgraded to max, unbind and make unclickable
            if(part !== null){            
                var btnID = 'div#RepairShop div#body button#ub' + str,
                    btn = $(btnID);
                    
                if(part._stage == carPart.STAGE.pro){
                    btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
                    //btn.off();  //remove all event handlers, effectively disabling the button!
                }
                else{
                    btn.text('$' + part.getPrice().toString() );
                }
                
                if(!part._repaired){
                    //added part so enable upgrade button 
                    //var rBtnID = 'div#RepairShop div#repairs button#' + type.toString(),
                        //rBtn = $(rBtnID);    //repair button
                    
                    //rBtn.off().click({type:type}, repairPart);
                }
                $('div#RepairShop div#body progress#' + 'pb' + str).attr('value', part.getPercent() );
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function repairBody(obj){
//    console.log('repair part!');
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Body.strFromType(type);
            
        if(car._body === null){
            //add part
        }
        else{
            if(car._body.repairPart(type) ){
                console.log('repaired part!');
                //part has been repaired, disable button
                var part = car._body.getPartType(type);
                
                if(part !== null){
                    var btnID = 'div#RepairShop div#body button#rb' + str;
                    
                    $(btnID).css({'opacity':'0.45', 'cursor':'default'}).off();                
                    $('div#RepairShop div#body progress#pb' + str).attr('value', part.getPercent() );
                }
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function upgradeInterior(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Interior.strFromType(type);
        console.log('upgrading part of type: ' + str);
        
        if(car._interior === null){
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
        }
        else{
            //upgrade existing part
            car._interior.upgradePart(type);
            
            var part = car._interior.getPartType(type);
            //if part is upgraded to max, unbind and make unclickable
            if(part !== null){         
                    var btnID = 'div#RepairShop div#interior button#ub' + str,
                        btn = $(btnID);    
                        
                if(part._stage == carPart.STAGE.pro){
                    btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
                    //btn.off();  //remove all event handlers, effectively disabling the button!
                }
                else{
                    btn.text('$' + part.getPrice().toString() );
                }
                
                if(!part._repaired){
                    //added part so enable upgrade button 
                    //var rBtnID = 'div#RepairShop div#repairs button#' + type.toString(),
                        //rBtn = $(rBtnID);    //repair button
                    
                    //rBtn.off().click({type:type}, repairPart);
                }
                $('div#RepairShop div#interior progress#' + 'pb' + str).attr('value', part.getPercent() );
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function repairInterior(obj){
//    console.log('repair part!');
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,    
            str = Interior.strFromType(type);
            
        if(car._interior === null){
            //add part
        }
        else{
            if(car._interior.repairPart(type) ){
                console.log('repaired part!');
                //part has been repaired, disable button
                var part = car._interior.getPartType(type);
                
                if(part !== null){
                    var btnID = 'div#RepairShop div#interior button#rb' + str;
                    
                    $(btnID).css({'opacity':'0.45', 'cursor':'default'}).off();                
                    $('div#RepairShop div#interior progress#pb' + str).attr('value', part.getPercent() );
                }
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function upgradeDocs(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Documents.strFromType(type)
        console.log('upgrading part of type: ' + str);
        
        if(car._docs === null){
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
        }
        else{    //upgrade existing part
            car._docs.upgradePart(type);
            
            var part = car._docs.getPartType(type);
            //if part is upgraded to max, unbind and make unclickable
            if(part !== null){
                var str = Documents.strFromType(type);
                var btnID = 'div#RepairShop div#docs button#ub' + str,
                    btn = $(btnID);
                    
                if(part._stage == carPart.STAGE.pro){
                    btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
                    //btn.off();  //remove all event handlers, effectively disabling the button!
                }
                else{
                    btn.text('$' + part.getPrice().toString() );
                }
                $('div#RepairShop div#docs progress#' + 'pb' + str).attr('value', part.getPercent() );
            }
            Repair.save();
        }
    }
    //else no car, do nothing
}