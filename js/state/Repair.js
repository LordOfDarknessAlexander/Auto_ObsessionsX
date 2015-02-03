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
            var i = 1;
            /*for(child in ul.children() ){
                //ul.clear();
               // var btnStr = "<button id =''>" +
                    ///"<lable id='name'>partName</label>" +
                    //"<lable id='type'>partType</label>" +
                    //"<lable id='price'>$150</label>" +
                    //"<img id='icon' src=''>" +
                //"</button><br>";
               // $("#Repair#parts").append(btnStr);
               //
                //$("#Repair#parts label#name").text(node.getElementById('name').text() );
                //$("#Repair#parts label#type").text(node.getElementById('type').text() );
                $('button#" + name).off().click({index:i}, addUpgrade);
            }*/
            //repairs
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
        //car.upgradePart(obj.data.index);
        
        //if(part._stage != 3){     //is not upgraded to max)
            //increment upgraded part and rebind id
        //else{
            //var li = $('#' + liID);
            //li.css('opacity', '0.45');
            //btn.off();  //remove all event handlers, effectively disabling the button!
        //}
    }
}
function repairPart(index)
{	//repairs a component of the vehicle, increasing condition and value
	//var car = userGarage[curCarIndex];
	//car.repairPart(index.data.index);
}