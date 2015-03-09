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
	var newTotal = userStats.money + val;
	userStats.money = newTotal > MAX_MONEY ? MAX_MONEY : newTotal;
	jq.setCash(userStats.money);
}
//jQuery Interface
$('#addAllowanceBtn').click(function()
{	//allowance accumulates every few seconds
	//var
		//last = getLastAllowanceTime(),
		//now = Date.now(),
		//delta = now - last;
		//carValue = getCollectionValue();
	
	var val = 1;	//(base + carvalue) * delta;
	addFunds(val);
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

jq.Funds.backBtn.click(
function(){
	jq.Funds.toggle();
	setStatBar();
//	setAdBG();
	saveUser();
    jq.carImg.show();
});