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
		if(curCarIndex !== null && userGarage.length != 0)
		{
			var car = userGarage[curCarIndex];
			var img = $('div#RepairShop img#userCar');
			img.attr('src', car.getFullPath() );
			
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
		//var car = userGarage[curCarIndex];
		//var upgradeNode = xmlDB.getElementById(car.id).getElementById('upgrades');

		//for each node in upgradeNode
		/*{
			$("#Repair#upgrades").clear();
			var btnStr = "<button>" +
				"<lable id=\'name\'></label>" +
				"<lable id=\'type\'></label>" +
				"</button>";
			$("#Repair#parts").append(btnStr);
			$("#Repair#parts label#name").text(node.getElementById('name').text() );
			$("#Repair#parts label#type").text(node.getElementById('type').text() );
			$("label#" + name).click({index:i}, addUpgrade);
		}*/
		//repairs
	}
};

function addUpgrade(index)
{	//adds part to user's current car, increasing originality and value
	//var car = userGarage[curCarIndex];
	//car.addPart(index.data.index);
}
function repairPart(index)
{	//repairs a component of the vehicle, increasing condition and value
	//var car = userGarage[curCarIndex];
	//car.repairPart(index.data.index);
}