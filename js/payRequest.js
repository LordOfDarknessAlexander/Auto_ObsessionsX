//PayPal interface and variables
function getHostPath(){
    //gloablly accessable function, the local path maybe diffrent,
    //DON'T CHANGE THE PATH, instead rename/relocate your project folder,
    //so devs don't have a commit war, having to change this function
    //for each of their projects each time they commit!
    var localExecution = true;
    return localExecution ? 'http://localhost/Auto_ObsessionsX/'
            : 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/';
}
function payRequest(amount, triggerCB)
{	//pass the ammount for purchasing
    //valid currency codes(for english speaking countries only)
    //CAD, canadian dolla
    //USD, us dollar,
    //AUD, austrailian dollar,
    //EUR,  euro,
    //NZD,    new zealand dollar
	var currencyCode = 'CAD',
		returnURL = getHostPath() + 'index.php',
		cancelURL = getHostPath() + 'index.php',
 		//company's email
		recieverEmail = 'that_canadianguy@hotmail.com';
		
	var request = {
		'returnUrl':returnURL,
		'requestEnvelope':{'errorLanguage':'en_US'},
		'currencyCode':currencyCode,
		'receiverList':{
			'receiver':[
				{'email':recieverEmail,
				'amount':amount.toString()
                }
			]
		},
		'cancelUrl':cancelURL,
		'actionType':'PAY'
	};
	//save application state to sessionStorage for when user returns to page
	//var req = PAYPAL.Pay(request);
    
	//must be set so paypal knows which purchase to process
	//$('form input#paykey').attr('value').html(req.payKey);
	//create the payPal flow
	//return new PAYPAL.apps.DGFlow(triggerCB)
}