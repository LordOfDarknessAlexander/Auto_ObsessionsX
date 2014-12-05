//This file contains jQuery functions for manipulation of the application's 'index.html'
//functions are visable to any file linking this document
function jqToggleCredits() 
{
	$('#main').toggle();	//hides if shown
	$('#main').children().toggle();	//hides/showns all child elements
	$('#menu').toggleClass('credits');	//adds class else removes if already added
	$('#credits').toggle();	//shows if hidden
}
$('.credits').click(jqToggleCredits);
$('.back').click(jqToggleCredits);
//
//Game Menu Add funds portal button
//
function jqSetCash(val)
{
	$("label#userCash").html(val.toString());
}
function jqToggleFunds()
{
	$('#gameMenu').toggle();
    $('#AddFunds').toggle();
	jqSetCash(money);
}
$('#addFunds').click(function() 
{
	jqToggleFunds();
    $('#menu').addClass('AddFunds');
	addFundsMode();	//is ok to call external functions, as long as they are defined in program.js
});
//Inside AddFunds State Bacjbutton 
$('#addFundsBackButton').click(function()
{
	jqToggleFunds();
});
//
//Garage State interface
//
function jqToggleGarage()
{
	$('#gameMenu').toggle();
	$('#Garage').toggle();
}