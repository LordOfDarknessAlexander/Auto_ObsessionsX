//
//Funds State interface
//
var Store = {
	update : function()
	{
		stop = true;
		appState = GAME_MODE.ADD_FUNDS;
		if(appState == GAME_MODE.ADD_FUNDS)
		{
			console.log("save your money u cants save the world");
		}
	},
	render : function()
	{
		//draw user's money, etc...
	}
};
function addFunds(val)
{
	var MAX_MONEY = 50000000;
	var newTotal = money + val;
	money = newTotal > MAX_MONEY ? MAX_MONEY : newTotal;
}
//jQuery Interface
$('#addAllowanceBtn').click(function()
{	//allowance accumulates every few seconds
	money += 1;
});
$('#addMinorFundsBtn').click(function()
{	//open paypal form
	//transfering game currency to user's account
	addFunds(500);
});
$('#addMediumFundsBtn').click(function()
{	//open paypal form
	//transfering game currency to user's account
	addFunds(1500);
});
$('#addMajorFundsBtn').click(function()
{	//open paypal form
	//transfere game currency to user's account
	addFunds(50000);
});
