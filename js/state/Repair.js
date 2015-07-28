//Repair State interface, mod your ride and upgrade parts
//Dependant on state\Garage.js, for userGarage and car index
//and js/entities/ for Vehicle and Parts
jq.RepairShop = {
    //jquery html bindings
    menu : $('div#RepairShop'),
    backBtn : $('div#RepairShop button#backBtn'),
    //upgrades : $('div#RepairShop div#upgrades'),
    //repairs : $('div#RepairShop div#repairs'),
    pSwitch:$('div#RepairShop div#switch'),
    sDT:$('div#RepairShop div#switch button#dt'),
    sBody:$('div#RepairShop div#switch button#body'),
    sInter:$('div#RepairShop div#switch button#inter'),
    sDocs:$('div#RepairShop div#switch button#docs'),
    //cid, car info div
    dt:$('div#RepairShop div#cid0'),
    cid1:$('div#RepairShop div#cid1'),
    cid2:$('div#RepairShop div#cid2'),
    cid3:$('div#RepairShop div#cid3'),
    /*toggle : function()
    {	//from game menu to funds or vice versa
        jq.Funds.menu.toggle();
        this.menu.toggle();
        jq.setErr();    //clear error when changing pages
    }*/
};
//
function playRepairAudio(){
    if (audioEnabled()) {
        assetLoader.sounds.repair.pause();
        console.log('Repair Audio Play');
        assetLoader.sounds.repair.play();
    }
}
function disable(jqo){
    //disables the jquery object passed
    jqo.css(
        {'opacity':'0.45','cursor':'default'}
    ).text('$0.00').off().show();
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
        jqo.show().off().click(
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
    _partPage:Vehicle.PART_TYPE.DT,
	init : function()
	{   //initializes the state, enabling ui and core logic of this screen
		//appState = GAME_MODE.Repair;
        
	    jq.RepairShop.menu.show();

	    var car = Garage.getCurrentCar();

        if (car !== null && car !== undefined) {
            var div = $('div#RepairShop');
            //if(carID == null || carID == undefined){
            //if (_curCarID !== 0) {
                //var car = Garage.getCurrentCar(),
                  var img = $('img#userCar', div);

                img.attr('src', car === null ? 'images\\garageEmpty.png' : car.getFullPath());

                this._initButtons();

                //$('div#RepairShop div#upgrades').show();
                //$('div#RepairShop div#repairs').show();

                jq.RepairShop.dt.show();
                jq.RepairShop.cid1.show();
                jq.RepairShop.cid2.show();
                jq.RepairShop.cid3.show();

                jq.RepairShop.pSwitch.show();

                //$('h2#dt', div).show();
                //$('h2#body', div).show();
                //$('h2#interior', div).show();
                //$('h2#docs', div).show();

                //$('label#info').text('');
                //$('div#RepairShop p#error').hide();
            //}
		}
		else{
			//show empty garage, please purchase a car
			$('img#userCar', div).attr('src', 'images/garageEmpty.png');
            //TODO:display message in browser saying user must select a vehicle
			//$('div#RepairShop div#upgrades').hide();
            //$('div#RepairShop div#repairs').hide();
            
            jq.RepairShop.dt.hide();
			jq.RepairShop.cid1.hide();
            jq.RepairShop.cid2.hide();
            jq.RepairShop.cid3.hide();
            
            jq.RepairShop.pSwitch.hide();
            //jq.RepairShop.sDT.hide();
            //jq.RepairShop.sBody.hide();
            //jq.RepairShop.sInter.hide();
            //jq.RepairShop.sDocs.hide();

            //$('h2#dt', div).hide();
			//$('h2#body', div).hide();
            //$('h2#interior', div).hide();
            //$('h2#docs', div).hide();
            
            //$('label#info').text('No vehicle currently selected, visit the Garage to select one!');
            //$('label#info').show();
		}
	},
	_initButtons : function(){
        //
		var car = Garage.getCurrentCar();
       
        if(car !== null && car !== undefined){
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
                
                this.setPageDT();
                /*for(var key in type){   //i = type.engine; i <= type.exhaust; i++){ 
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
                }*/
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
                
                /*for(var key in type){   //var i = type.chasis; i <= type.ph0; i++){ 
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
                }*/
            }
            //else{
                //hide view and display purchase button
            //}
            //            
            if(car._interior !== null){
                var type = Interior.TYPE,
                    btnTag = 'button#',
                    div = $('div#RepairShop div#interior');
                
                /*for(var i = type.seats; i <= type.panels; i++){ 
                    var part = car._interior.getPartType(i),
                        str = Interior.strFromType(i),
                        ub = $(btnTag + 'ub' + str, div),
                        rb = $(btnTag + 'rb' + str, div),
                        pb = $('progress#pb' + str, div);

                    bindUpgradeBtn(ub, part, i, upgradeInterior);
                    bindRepairBtn(rb, part, i , repairInterior);
                    pbSetColor(pb, part.getPercent() );
                }*/
            }
            else{
                //hide view and display purchase button
            }
            //
            if(car._docs !== null){
                var type = Documents.TYPE,
                    btnTag = 'button#',
                    div = $('div#RepairShop div#docs');
                
                /*for(var i = type.ownership; i <= type.ph0; i++){ 
                    var part = car._docs.getPartType(i),                    
                        str = Documents.strFromType(i),
                        ub = $(btnTag + 'ub', div),
                        rb = $(btnTag + 'rb', div),
                        pb = $('progress#pb', div);
                    
                    bindUpgradeBtn(ub, part, i, upgradeDocs);
                    rb.off().hide();
                    //docs don't have repair buttons
                    pbSetColor(pb, part.getPercent() );
                }*/
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
                //setMoney(data.funds);
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
                console.log('failed to save vehicle upgrades to database!');
            },
            {
                //newFunds:userStats.money
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
        //setMoney();
        //Garage.save();    //save updates to user vehicles
//<php
//}
    },
    update : function(){
	},
	render : function(){
		//additional rendering to 2D context
	},
    setPageDT:function(){
        this._partPage = Vehicle.PART_TYPE.DT;
        
        var type = Drivetrain.TYPE,     //types of parts conposing the drivetrain
            btnTag = 'button#';
            //div = jq.RepairShop.dt;
        //rebind headers
        $('h2', jq.RepairShop.dt).text('Engine');
        $('h2', jq.RepairShop.cid1).text('Transmission');
        $('h2', jq.RepairShop.cid2).text('Axle');
        $('h2', jq.RepairShop.cid3).text('Exhaust');
        //rebind img paths
        var root = /*getHostPath() + */'images/parts/drivetrain/';
        
        $('img', jq.RepairShop.dt).attr('src', root + 'engine.png');
        $('img', jq.RepairShop.cid1).attr('src', root + 'transmission.png');
        $('img', jq.RepairShop.cid2).attr('src', root + 'axel.png');
        $('img', jq.RepairShop.cid3).attr('src', root + 'exhaust.png');
        //rebind jq callbacks
        var car = Garage.getCurrentCar();
    
        if(car !== null){
            //var i = 0;
            
            for(var key in type){
                //using hasOwnProperty ensures on iteration only over fields present in the object,
                //not those found in its prototype(if one exists)
                if(type.hasOwnProperty(key) ){
                    var t = type[key],
                        div = Drivetrain.getDivURSlot(t),
                        part = car._dt.getPartType(t),  //part to upgrade
                        str = //Drivetrain.strFromType(t),
                        ub = $(btnTag + 'ub', div),    //upgrade button
                        rb = $(btnTag + 'rb', div),   //repair button
                        pb = $('progress#pb', div);   //progres bar

                    bindUpgradeBtn(ub, part, t, Drivetrain.upgrade);
                    bindRepairBtn(rb, part, t, Drivetrain.repair);
                    pbSetColor(pb, part.getPercent() );
                }
            }
        }
        //else user has no car, do have to set
    },
    setPageBody:function(){
        var type = Body.TYPE,
            btnTag = 'button#';
        
        this._partPage = Vehicle.PART_TYPE.BODY;
        //rebind headers
        $('h2', jq.RepairShop.dt).text('Chassis');
        $('h2', jq.RepairShop.cid1).text('Panels');
        $('h2', jq.RepairShop.cid2).text('Paint');
        $('h2', jq.RepairShop.cid3).text('Chrome');
        //rebind img paths
        var root = getHostPath() + 'images/parts/body/';
        
        $('img', jq.RepairShop.dt).attr('src', root + 'chasis.png');
        $('img', jq.RepairShop.cid1).attr('src', root + 'panels.png');
        $('img', jq.RepairShop.cid2).attr('src', root + 'paint.png');
        $('img', jq.RepairShop.cid3).attr('src', root + 'chrome.png');
        //rebind jq callbacks
        var car = Garage.getCurrentCar();
    
        if(car !== null){
           
            for(var key in type){
                //using hasOwnProperty ensures on iteration only over fields present in the object,
                //not those found in its prototype(if one exists)
                if(type.hasOwnProperty(key) ){
                    var t = type[key],
                        div = Body.getDivURSlot(t),
                        part = car._body.getPartType(t),  //part to upgrade
                        ub = $(btnTag + 'ub', div),    //upgrade button
                        rb = $(btnTag + 'rb', div),   //repair button
                        pb = $('progress#pb', div);   //progres bar

                    bindUpgradeBtn(ub, part, t, Body.upgrade);
                    bindRepairBtn(rb, part, t, Body.repair);
                    pbSetColor(pb, part.getPercent() );
                }
            }
        }
        //else user has no car, do have to set
        
    },
    setPageInterior:function(){
        var type = Interior.TYPE,
            btnTag = 'button#';
        
        this._partPage = Vehicle.PART_TYPE.INTER;
        //rebind headers
        $('h2', jq.RepairShop.dt).text('Seats');
        $('h2', jq.RepairShop.cid1).text('Carpet');
        $('h2', jq.RepairShop.cid2).text('Dash');
        $('h2', jq.RepairShop.cid3).text('Panels');
        //rebind img paths
        var root = getHostPath() + 'images/parts/interior/';
        
        $('img', jq.RepairShop.dt).attr('src', root + 'seats.png');
        $('img', jq.RepairShop.cid1).attr('src', root + 'carpet.png');
        $('img', jq.RepairShop.cid2).attr('src', root + 'dash.png');
        $('img', jq.RepairShop.cid3).attr('src', root + 'panels.png');
        //rebind jq callbacks
        var car = Garage.getCurrentCar();
    
        if(car !== null){
            //
            for(var key in type){
                //using hasOwnProperty ensures on iteration only over fields present in the object,
                //not those found in its prototype(if one exists)
                if(type.hasOwnProperty(key) ){
                    var t = type[key],
                        div = Interior.getDivURSlot(t),
                        part = car._interior.getPartType(t),  //part to upgrade
                        ub = $(btnTag + 'ub', div),    //upgrade button
                        rb = $(btnTag + 'rb', div),   //repair button
                        pb = $('progress#pb', div);   //progres bar

                    bindUpgradeBtn(ub, part, t, Interior.upgrade);
                    bindRepairBtn(rb, part, t, Interior.repair);
                    pbSetColor(pb, part.getPercent() );
                }
            }
        }
    },
    setPageDocs:function(){
        var type = Documents.TYPE;
        
        this._partPage = Vehicle.PART_TYPE.DOCS;
        //rebind headers
        $('h2', jq.RepairShop.dt).text('Ownership');
        $('h2', jq.RepairShop.cid1).text('Build');
        $('h2', jq.RepairShop.cid2).text('History');
        $('h2', jq.RepairShop.cid3).text('Restoration');
        //rebind img paths
        var root = getHostPath() + 'images/parts/documents/';
        
        $('img', jq.RepairShop.dt).attr('src', root + 'ownership.png');
        $('img', jq.RepairShop.cid1).attr('src', root + 'build.png');
        $('img', jq.RepairShop.cid2).attr('src', root + 'history.png');
        $('img', jq.RepairShop.cid3).attr('src', root + 'restoration.png');
        //rebind jq callbacks
        var car = Garage.getCurrentCar();
    
        if(car !== null){
            for(var key in type){
                if(type.hasOwnProperty(key) ){
                    var t = type[key],
                        btnTag = 'button#',
                        div = Documents.getDivURSlot(t),
                        part = car._docs.getPartType(t),  //part to upgrade
                        ub = $(btnTag + 'ub', div),    //upgrade button
                        rb = $(btnTag + 'rb', div),   //repair button
                        pb = $('progress#pb', div);   //progres bar

                    bindUpgradeBtn(ub, part, t, Documents.upgrade);
                    //bindRepairBtn(rb, part, t, Drivetrain.repair);
                    rb.off().hide();
                    pbSetColor(pb, part.getPercent() );
                }
            }
        }
    }
};
function upgradePartUpdate(part, jqBtn, jqPB){
    if(part !== null){         
        //
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
        pbSetColor(jqPB, part.getPercent());
        playRepairAudio();
    }
}
Drivetrain.getDivURSlot = function(carType){
    var T = Drivetrain.TYPE,
        str = 'div#RepairShop div#';
    
    switch(carType){
        case T.engine:
            str += 'cid0';
        break;
        
        case T.trans:
            str += 'cid1';
        break;
        
        case T.axel:
            str += 'cid2';
        break;
        
        case T.exhaust:
            str += 'cid3';
        break;
        
        default:
            return null;
    }
    var div = $(str);
    return div;
};
Drivetrain.upgrade = function(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type,
            dt = car._dt;
            //str = Drivetrain.strFromType(type);
        //console.log('upgrading part of type: ' + str);
        
        if(dt === null || typeof dt == 'undefined'){
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
            var part = dt.getPartType(type);
//<php if(loggedIn() ){>
            //jq.post("pas/updateDT.php",
                // function(obj){
                    
                    // if(part !== null){
                        // var div = Drivetrain.getDivURSlot(type);   //$('div#RepairShop div#drivetrain');
                        
                        // upgradePartUpdate(
                            // part,
                            // $('button#ub', div),
                            // $('progress#pb', div)
                        // );
                        // //jq.user.setStats();
                    // }
                // }.
                // function(jqxhr){
                    // jq.setErr('Drivetrain.upgrade Repair.js', 'purchase upgrade failed, reason: ' + jqxhr.responseText);
                // },
                //{cid:car.id,
                //price:p,
                //type:type}
            //);
//<php
//}
//else{>
            if(dt.upgradePart(type) ){
                //if part is upgraded to max, unbind and make unclickable
                if(part !== null){
                    var div = Drivetrain.getDivURSlot(type);   //$('div#RepairShop div#drivetrain');
                    
                    upgradePartUpdate(
                        part,
                        $('button#ub', div),
                        $('progress#pb', div)
                    );
                }
            }
//<php } >
        }
        Repair.save();
    }
    //else no car, do nothing
    //jq.setErr('Drivetrain::upgrade Repair.js', 'purchase upgrade failed, reason: user does not have a valid vehicle, please select one');
};

Drivetrain.repair = function(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;
            //str = Drivetrain.strFromType(type);
        
        if(car._dt.repairPart(type) ){
            //console.log('repaired part!');
            //part has been repaired, disable button
            var part = car._dt.getPartType(type);
            
            if(part !== null){
                var div = Drivetrain.getDivURSlot(type);   //$('div#RepairShop div#drivetrain');
                
                repairPartUpdate(
                    part,
                    $('button#rb', div),
                    $('progress#pb', div)
                );
            }
        }
        Repair.save();
    }
    //else no car, do nothing
};
//
Body.getDivURSlot = function(carType){
    var T = Body.TYPE,
        str = 'div#RepairShop div#';
    
    switch(carType){
        case T.chasis:
            str += 'cid0';
        break;
        
        case T.panels:
            str += 'cid1';
        break;
        
        case T.paint:
            str += 'cid2';
        break;
        
        case T.ph0:
            str += 'cid3';
        break;
        
        default:
            return null;
    }
    var div = $(str);
    return div;
};
Body.upgrade = function(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;
            //str = Body.strFromType(type);
        
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
                var div = Body.getDivURSlot(type);  //$('div#RepairShop div#body');
                
                upgradePartUpdate(
                    part,
                    $('button#ub', div),
                    $('progress#pb', div)
                );
            }
        }
        Repair.save();
    }
    //else no car, do nothing
};
Body.repair = function(obj){
    //console.log('repair part!');
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;
            //str = Body.strFromType(type);
            
        if(car._body === null){
            //add part
        }
        else{
            if(car._body.repairPart(type) ){
                //console.log('repaired part!');
                //part has been repaired, disable button
                var part = car._body.getPartType(type);
                
                if(part !== null){
                    var div = Body.getDivURSlot(type);  //$('div#RepairShop div#body');
                    
                    repairPartUpdate(
                        part,
                        $('button#rb', div),
                        $('progress#pb', div)
                    );
                }
            }
        }
        Repair.save();
    }
    //else no car, do nothing
};
Interior.getDivURSlot = function(carType){

    var T = Interior.TYPE,
        str = 'div#RepairShop div#';
    
    switch(carType){
        case T.seats:
            str += 'cid0';
        break;
        
        case T.carpet:
            str += 'cid1';
        break;
        
        case T.dash:
            str += 'cid2';
        break;
        
        case T.panels:
            str += 'cid3';
        break;
        
        default:
            return null;
    }
    var div = $(str);
    return div;
};
Interior.upgrade = function(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;
            //str = Interior.strFromType(type);
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
                var div = Interior.getDivURSlot(type);  //$('div#RepairShop div#interior');
                
                upgradePartUpdate(
                    part,
                    $('button#ub', div),
                    $('progress#pb', div)
                );
            }
        }
        Repair.save();
    }
    //else no car, do nothing
};
Interior.repair = function(obj){
//    console.log('repair part!');
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;  
            //str = Interior.strFromType(type);
            
        if(car._interior === null){
            //add part
        }
        else{
            if(car._interior.repairPart(type) ){
                //console.log('repaired part!');
                //part has been repaired, disable button
                var part = car._interior.getPartType(type);
                
                if(part !== null){
                    var div = Interior.getDivURSlot(type);  //$('div#RepairShop div#interior');
                    
                    repairPartUpdate(
                        part,
                        $('button#rb', div),
                        $('progress#pb', div)
                    );
                }
            }
        }
        Repair.save();
    }
    //else no car, do nothing
};
Documents.getDivURSlot = function(carType){

    var T = Documents.TYPE,
        str = 'div#RepairShop div#';

    switch(carType){
        case T.ownership:
            str += 'cid0';
        break;
        
        case T.build:
            str += 'cid1';
        break;
        
        case T.history:
            str += 'cid2';
        break;
        
        case T.ph0:
            str += 'cid3';
        break;
        
        default:
            return null;
    }
    var div = $(str);
    return div;
};
Documents.upgrade = function(obj){
    //
    var car = Garage.getCurrentCar();
    
    if(car !== null){
        var type = obj.data.type;
            //str = Documents.strFromType(type);
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
                var div = Documents.getDivURSlot(type);//$('div#RepairShop div#docs');
                    //str = Documents.strFromType(type),
                
                upgradePartUpdate(
                    part,
                    $('button#ub', div),
                    $('progress#pb', div)
                );
            }
            Repair.save();
        }
    }
    //else no car, do nothing
};
//
//jq bindings
//
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

jq.RepairShop.sDT.click(Repair.setPageDT);
jq.RepairShop.sBody.click(Repair.setPageBody);
jq.RepairShop.sInter.click(Repair.setPageInterior);
jq.RepairShop.sDocs.click(Repair.setPageDocs);