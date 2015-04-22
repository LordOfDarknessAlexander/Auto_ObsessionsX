/*Repair State interface, mod your ride and upgrade parts
Dependant on state\Garage.js, for userGarage and car index
and Vehicle.js for Cars and Parts*/
jq.RepairShop = {
    //jquery html bindings
    menu : $('div#RepairShop'),
    backBtn : $('div#RepairShop button#backBtn'),
    upgrades : $('div#RepairShop div#upgrades'),
    repairs : $('div#RepairShop div#repairs'),
    dt:$('div#RepairShop div#drivetrain')
    //body:$('div#RepairShop div#body'),
    //interior:$('div#RepairShop div#interior'),
    //docs:$('div#RepairShop div#docs'),
    /*toggle : function()
    {	//from game menu to funds or vice versa
        jq.Funds.menu.toggle();
        this.menu.toggle();
        jq.setErr();    //clear error when changing pages
    }*/
};
//
function disable(jqo){
    //disables the jquery object passed
    jqo.css(
        {'opacity':'0.45','cursor':'default'}
    ).text('$0.00').off();
}
function bindUpgradeBtn(jqo, part, carType, onClickCB){
    cssEnable = {
        'opacity':'1.0',
        'cursor':'pointer'
    };
    
    if(part._stage != carPart.STAGE.pro){
        jqo.off().click(
            {type:carType}, onClickCB
        ).text(
            part.getPriceStr()
        ).css(cssEnable);
    }
    else{
        //max upgrade already purchased, disable button
       disable(jqo);
    }
}
function bindRepairBtn(jqo, part, carType, onClickCB){
    //sets the onclick handler, text and CSS of a jq button ui element
    cssEnable = {
        'opacity':'1.0',
        'cursor':'pointer'
    };
    
    if(!part._repaired){
        jqo.off().click(
            {type:carType}, onClickCB
        ).css(
            cssEnable
        ).text(
            part.getRepairPriceStr()
        );
    }
    else{
        disable(jqo);
    }
}
//
var Repair = {
	init : function()
	{   //initializes the state, enabling ui and core logic of this screen
		//appState = GAME_MODE.Repair;
        jq.RepairShop.menu.show();
        
        var div = $('div#RepairShop');
        
		if(_curCarID !== 0)
		{
			var car = Garage.getCurrentCar();
                img = $('img#userCar', div),
            img.attr('src', car === null ? 'images\\garageEmpty.png' : car.getFullPath() );
			
			this._initButtons();

			//$('div#RepairShop div#upgrades').show();
			//$('div#RepairShop div#repairs').show();
            
            jq.RepairShop.dt.show();
			$('div#body', div).show();
            $('div#interior', div).show();
            $('div#docs', div).show();
            
            $('h2#dt', div).show();
			$('h2#body', div).show();
            $('h2#interior', div).show();
            $('h2#docs', div).show();
            
            //$('label#info').text('');
            //$('div#RepairShop p#error').hide();
		}
		else{
			//show empty garage, please purchase a car
			$('img#userCar', div).attr('src', 'images/garageEmpty.png');
            //TODO:display message in browser saying user must select a vehicle
			//$('div#RepairShop div#upgrades').hide();
			//$('div#RepairShop div#repairs').hide();
            
            jq.RepairShop.dt.hide();
			$('div#body', div).hide();
            $('div#interior', div).hide();
            $('div#docs', div).hide();
            
            $('h2#dt', div).hide();
			$('h2#body', div).hide();
            $('h2#interior', div).hide();
            $('h2#docs', div).hide();
            
            //$('label#info').text('No vehicle currently selected, visit the Garage to select one!');
            //$('label#info').show();
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
            
            var cssEnable = {
                'opacity':'1.0',
                'cursor':'pointer'
            };

            if(car._dt !== null){
                var type = Drivetrain.TYPE,
                    btnTag = 'button#',
                    div = jq.RepairShop.dt;
                
                for(var key in type){   //i = type.engine; i <= type.exhaust; i++){ 
                    //using hasOwnProperty ensures on iteration only over fields present in the object,
                    //not those found in its prototype(if one exists)
                    if(type.hasOwnProperty(key) ){
                        var i = type[key],
                            part = car._dt.getPartType(i),
                            str = Drivetrain.strFromType(i),
                            ub = $(btnTag + 'ub' + str, div),    //upgrade button
                            rb = $(btnTag + 'rb' + str, div),
                            pb = $('progress#pb' + str, div); //repair button
       
                        bindUpgradeBtn(ub, part, i, upgradeDT);
                        bindRepairBtn(rb, part, i, repairDT);
                        pbSetColor(pb, part.getPercent() );
                    }
                }
            }
            //else{
                //hide view and display purchase button
                //$('dt').hide();
                //for(var i = type.engine; i <= type.exhaust; i++){ 
                    //var str = Drivetrain.strFromType(i);
                    
                    //$(btnTag + 'ub' + str, div).off();   //.css();
                    //$(btnTag + 'rb' + str, div).off();   //.css('opacity':'0.45','cursor':'default'});
                //}
                //$('instal').show();
            //}
            if(car._body !== null){
                var type = Body.TYPE,
                    btnTag = 'button#',
                    div = $('div#RepairShop div#body');
                
                for(var key in type){   //var i = type.chasis; i <= type.ph0; i++){ 
                    if(type.hasOwnProperty(key) ){
                        var i = type[key],
                            part = car._body.getPartType(i),
                            str = Body.strFromType(i),
                            ub = $(btnTag + 'ub' + str, div),
                            rb = $(btnTag + 'rb' + str, div),
                            pb = $('progress#pb' + str, div);
                        
                        bindUpgradeBtn(ub, part, i, upgradeBody);
                        bindRepairBtn(rb, part, i, repairBody);                    
                        pbSetColor(pb, part.getPercent() );
                    }
                }
            }
            //else{
                //hide view and display purchase button
            //}
            //            
            if(car._interior !== null){
                var type = Interior.TYPE,
                    btnTag = 'button#',
                    div = $('div#RepairShop div#interior');
                
                for(var i = type.seats; i <= type.panels; i++){ 
                    var part = car._interior.getPartType(i),
                        str = Interior.strFromType(i),
                        ub = $(btnTag + 'ub' + str, div),
                        rb = $(btnTag + 'rb' + str, div),
                        pb = $('progress#pb' + str, div);

                    bindUpgradeBtn(ub, part, i, upgradeInterior);
                    bindRepairBtn(rb, part, i , repairInterior);
                    pbSetColor(pb, part.getPercent() );
                }
            }
            else{
                //hide view and display purchase button
            }
            //
            if(car._docs !== null){
                var type = Documents.TYPE,
                    btnTag = 'button#',
                    div = $('div#RepairShop div#docs');
                
                for(var i = type.ownership; i <= type.ph0; i++){ 
                    var part = car._docs.getPartType(i),                    
                        str = Documents.strFromType(i),
                        ub = $(btnTag + 'ub' + str, div),
                        pb = $('progress#pb' + str, div);
                    
                    bindRepairBtn(ub, part, i, upgradeDocs);
                    //docs don't have repair buttons
                    pbSetColor(pb, part.getPercent() );
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
        var car = Garage.getCurrentCar();
//<php
        var funcName = 'js/Repair.js Repair::save()';
//if(loggedIn() ){?>
        //sends the car data to the server        
        jq.post('pas/update.php?op=update',
            function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
                    return;
                }
                //alert(funcName + ', ajax response success! ' + JSON.stringify(data) );
                //do stuff
                Garage.save();    //save updates to user cars in local storage
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
                console.log('failed to save vehicle upgrades to database!');
            },
            {
                carID:car.id,
                dt:car._dt !== null ? car._dt.getBits() : 0,
                body:car._body !== null ? car._body.getBits() : 0,
                interior:car._interior !== null ? car._interior.getBits() : 0,
                docs:car._docs !== null ? car._docs.getBits() : 0,
                repairs:car.getRepairBitfield()
            }
        );
//<php//
//}
//else{?>
        //save to userGarage in local storage
        //temporary, vehicles are loaded from database when navigating to it
        //Garage.save();    //save updates to user vehicles
//<php
//}
    },
    update : function(){
	},
	render : function(){
		//additional rendering to 2D context
	},
};
function upgradePartUpdate(part, jqBtn, jqPB){
    if(part !== null){         
        
        if(part._stage == carPart.STAGE.pro){
            disable(jqBtn);
        }
        else{
            jqBtn.text(part.getPriceStr() );
        }
        
        if(!part._repaired){
            //added part so enable upgrade button 
            //var rBtnID = 'div#RepairShop div#repairs button#' + type.toString(),
                //rBtn = $(rBtnID);    //repair button
            
            //rBtn.off().click({type:type}, repairPart);
        }
        pbSetColor(jqPB, part.getPercent() );
    }
}
function repairPartUpdate(part, jqBtn, jqPB){
    //
    if(part !== null){
        disable(jqBtn);
        pbSetColor(jqPB, part.getPercent() );
    }
}
function upgradeDT(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Drivetrain.strFromType(type);
        //console.log('upgrading part of type: ' + str);
        
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
                    var div = $('div#RepairShop div#drivetrain');
                    
                    upgradePartUpdate(
                        part,
                        $('button#ub' + str, div),
                        $('progress#pb' + str, div)
                    );
                }
            }
        }
        Repair.save();
    }
    //else no car, do nothing
}
function repairDT(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            str = Drivetrain.strFromType(type);
        
        if(car._dt.repairPart(type) ){
            //console.log('repaired part!');
            //part has been repaired, disable button
            var part = car._dt.getPartType(type);
            
            if(part !== null){
                var div = $('div#RepairShop div#drivetrain');
                
                repairPartUpdate(
                    part,
                    $('button#rb' + str, div),
                    $('progress#pb' + str, div)
                );
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
        
        //console.log('upgrading part of type: ' + str);
        
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
                var div = $('div#RepairShop div#body');
                
                upgradePartUpdate(
                    part,
                    $('button#ub' + str, div),
                    $('progress#pb' + str, div)
                );
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
                //console.log('repaired part!');
                //part has been repaired, disable button
                var part = car._body.getPartType(type);
                
                if(part !== null){
                    var div = $('div#RepairShop div#body');
                    
                    repairPartUpdate(
                        part,
                        $('button#rb' + str, div),
                        $('progress#pb' + str, div)
                    );
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
        //console.log('upgrading part of type: ' + str);
        
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
                var div = $('div#RepairShop div#interior');
                
                upgradePartUpdate(
                    part,
                    $('button#ub' + str, div),
                    $('progress#pb' + str, div)
                );
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
                //console.log('repaired part!');
                //part has been repaired, disable button
                var part = car._interior.getPartType(type);
                
                if(part !== null){
                    var div = $('div#RepairShop div#interior');
                    
                    repairPartUpdate(
                        part,
                        $('button#rb' + str, div),
                        $('progress#pb' + str, div)
                    );
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
            str = Documents.strFromType(type);
        //console.log('upgrading part of type: ' + str);
        
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
                var str = Documents.strFromType(type),
                    div = $('div#RepairShop div#docs');
                
                upgradePartUpdate(
                    part,
                    $('button#ub' + str, div),
                    $('progress#pb' + str, div)
                );
            }
            Repair.save();
        }
    }
    //else no car, do nothing
}
jq.RepairShop.backBtn.click(
function(){
	//toggleRepair();
  	jq.RepairShop.menu.hide();
 	//$('#gameMenu')
	setStatBar();
//	setAdBG();
	jq.Game.menu.show();
    jq.carImg.show();
    jq.setErr();    //clear error when changing pages
	//resetStates();
	//appState = GAME_MODE.Main_Menu;
});