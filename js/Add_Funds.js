//
//Funds State interface
//
function addFunds(val)
{
	var MAX_MONEY = 50000000;
	var newTotal = money + val;
	money = newTotal > MAX_MONEY ? MAX_MONEY : newTotal;
}
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
