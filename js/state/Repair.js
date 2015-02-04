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
            var ul = $('div#RepairShop div#upgrades'),
                rl = $('div#RepairShop div#repairs');

            ul.empty();
            ul.append('<h2>Upgrades</h2>');
            for(var i = carPart.type.interior; i <= carPart.type.exhaust; i++){
                var btnStr = "<button id ='" + i.toString() + "'>" +
                    "<lable id='name'>partName</label><br>" +
                    "<lable id='type'>" + stringFromPartType(i) + "</label><br>" +
                    "$<lable id='price'>150</label><br>" +
                    //"<img id='icon' src=''>" +
                "</button><br>";
                ul.append(btnStr);
                //
                var btnID = 'div#RepairShop div#upgrades button#' + i.toString(),
                    btn = $(btnID);
                
                btn.off().click({type:i}, addUpgrade);
                
                var part = car.getPart(i);
                
                if(part !== null){
                    if(part._stage == carPart.stage.pro){
                        //part has been previously upgraded to max, remove all event handlers, effectively disabling the button!
                        btn.css({'opacity':'0.45', 'cursor':'default'}).off();
                    }
                }
            }
            //repairs
            //for(var child in rl.children() )
            if(car._parts.length != 0){
                for(var i = 0; i < car._parts.length; i++){
                    //car already repaired, disable btn
                    var part = car._parts[i];
                    if(part._repaired){
                        //btn.off().css('opacity:0.45');
                    }
                    else{
                        //btn.off().click(part.repair);
                    }
                }
            }
        }
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
        if(part._stage == carPart.stage.pro){
            var btnID = 'div#RepairShop div#upgrades button#' + part._type.toString();
            var btn = $(btnID);
            btn.css({'opacity':'0.45', 'cursor':'default'}).off();//.css();
            //btn.off();  //remove all event handlers, effectively disabling the button!
        }
    }
}
function repairPart(index)
{	//repairs a component of the vehicle, increasing condition and value
	//var car = Garage.getCurrentCar();
    //if(car !== null){
        //car.repairPart(index.data.index);
    //}
}