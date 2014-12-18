//
//Repair State interface
//
var Repair = {
	update : function()
	{
		stop = true;
	},
	render : function()
	{
		//additional rendering
	},
	initButtons : function()
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