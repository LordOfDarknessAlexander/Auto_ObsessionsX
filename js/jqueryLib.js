//This file contains jQuery functions for manipulation of the application's 'index.html'
//functions are visable to any file linking this document

var jq = {
	//namespace containing application bindings for jquery,
	//preforms qjery call one then stores the result as an object
	userCash:$("label#userCash"),
	setCash : function(val)
	{
		this.userCash.html(val.toString());
	},
	//main : {
		//menu:
	//},
	Credits : {
		toggle : function()
		{	//displays the credits screen if hiden or hides it if visable
			$('#main').toggle();	//hides if shown
			$('#main').children().toggle();	//hides/showns all child elements
			$('#menu').toggleClass('credits');	//adds class else removes if already added
			$('#credits').toggle();	//shows if hidden
		}
	},
	Garage : {
		menu : $('#Garage'),
		toggle : function()
		{
			$('#gameMenu').toggle();
			this.menu.toggle();	//this refers to jq.Garage
			//$('#Garage').toggle();
		}
	},
	CarView : {
		menu : $('#CarView'),
		backBtn : $('button#carViewBackBtn'),
		toggle : function()
		{	//go from (my cars to car view) || (car view to my cars)
			//jq.Garage.menu.toggle();
			//this.menu.toggle();
			$('#Garage').toggle();
			$('#CarView').toggle();
		}
	},
	Funds : {
		menu : $('#AddFunds'),
		backBtn : $('#addFundsBackButton'),
		toggle : function()
		{
			$('#gameMenu').toggle();
			this.menu.toggle();
			//this.menu.toggle();
			jq.setCash(money);
		}
	}
};
/*
function jqToggleCredits() 
{
	$('#main').toggle();	//hides if shown
	$('#main').children().toggle();	//hides/showns all child elements
	$('#menu').toggleClass('credits');	//adds class else removes if already added
	$('#credits').toggle();	//shows if hidden
}*/
$('.credits').click(jq.Credits.toggle);
$('.back').click(jq.Credits.toggle);


//
//Game Menu Add funds portal button
//
/*
function jqToggleFunds()
{
	$('#gameMenu').toggle();
	$('#AddFunds').toggle();
	jqSetCash(money);
}*/
$('#addFunds').click(function() 
{
	jq.Funds.toggle();
    $('#menu').addClass('AddFunds');
	addFundsMode();	//is ok to call external functions, as long as they are defined in program.js
});
//Inside AddFunds State Bacjbutton 
//$('#addFundsBackButton')
jq.Funds.backBtn.click(function()
{
	jq.Funds.toggle();
});
jq.CarView.backBtn.click(jq.CarView.toggle);
//
//Garage State interface
//
/*function jqToggleGarage()
{
	$('#gameMenu').toggle();
	//jq.Garage.menu.toggle();
	$('#Garage').toggle();
}*//*
function jqToggleCarView()
{	//go from (my cars to car view) || (car view to my cars)
	//jq.Garage.menu.toggle();
	$('#Garage').toggle();
	$('#CarView').toggle();
}*/