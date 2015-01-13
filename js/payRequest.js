//PayPal interface and variables
function payRequest(amount, triggerCB)
{	//pass the ammount for purchasing
	var currencyCode = "USD",	//CND,
		returnURL = "file:///C:/Users/Ty/Documents/GitHub/Auto_ObsessionsX/index.html",
		cancelURL = "file:///C:/Users/Ty/Documents/GitHub/Auto_ObsessionsX/index.html",
 		//company's email
		recieverEmail = 'david@example.com';
		
	var request = {
		"returnUrl":returnURL,
		"requestEnvelope":{"errorLanguage":"en_US"},
		"currencyCode":currencyCode,
		"receiverList":{
			"receiver":[
				{'email':recieverEmail,
				'amount':amount.toString()
                }
			]
		},
		'cancelUrl':cancelURL,
		'actionType':'PAY'
	};
	//save application state to sessionStorage for when user returns to page
	var req = PAYPAL.Pay(request);
	//must be set so paypal knows which purchase to process
	$('#paykey').attr('value').html(req.payKey);
	//create the payPal flow
	return new PAYPAL.apps.DGFlow(triggerCB)
}