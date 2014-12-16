//This file contains jQuery functions for manipulation of the application's 'index.html'
//functions and objects are visable to any file linking this document
var jq = {
	//namespace containing application bindings for jquery,
	//preforms qjery call one then stores the result as an object
	//canvas:$('#canvas'),
	userCash:$("label#userCash"),
	setCash : function(val)
	{	//set the html for the userCash label, to be displayed in browser
		this.userCash.html(val.toString());
	},
	Main : {
		menu:$('#main')
	},
	Game : {	//rename to something less vague
		menu : $('#gameMenu'),
		homeImg : $('img#homeImg'),
		//left menu
		toCarsBtn : $(''),
		//toProjBtn : $(''),
		//toGarageBtn : $(''),
		toAuctionBtn : $('#toAuctionBtn'),
		repairBtn : $('#buyUpgradesBtn')
		//right menu
		//toProfileBtn:$(''),
		//toMsgBtn:$(''),
		//torankingsBtn:$(''),
	},
	Credits : {
		//menu:$('#credits'),
		//backBtn:$(''),
		toggle : function()
		{	//displays the credits screen if hiden or hides it if visable
			//$('#main').toggle();	//hides if shown
			//$('#main').children().toggle();	//hides/showns all child elements
			jq.Main.menu.toggle();	//hides if shown
			jq.Main.menu.children().toggle();	//hides/showns all child elements

			$('#menu').toggleClass('credits');	//adds class else removes if already added
			$('#credits').toggle();	//shows if hidden
		}
	},
	Garage : {
		menu : $('#Garage'),
		backBtn : $('#garageBackBtn'),
		//selectCarBtn:,
		//viewCarBtn:$(),
		toggle : function()
		{	//from game menu to garage, or vice versa
			$('#gameMenu').toggle();
			this.menu.toggle();	//this refers to jq.Garage
			//$('#Garage').toggle();
		}
	},
	AuctionSelect : {
		menu : $('#AuctionSelect'),
		backBtn : $('#asBackBtn')
	},
	Auction : {
		menu : $('#Auction'),
		backBtn : $('#auctionBackButton')
		//cashLabel:$('#myCash'),
        //carPrice:$('#carPrice');
	},
	CarView : {
		menu : $('#CarView'),
		backBtn : $('button#carViewBackBtn'),
		carImg : $('img#car'),
		toggle : function()
		{	//go from (my cars to car view) || (car view to my cars)
			//jq.Garage.menu.toggle();
			//this.menu.toggle();
			jq.Garage.menu.toggle();
			$('#CarView').toggle();	//this.menu doesn't work...
		}
	},
	Funds : {
		menu : $('#AddFunds'),
		backBtn : $('#addFundsBackButton'),
		toggle : function()
		{	//from game menu to funds or vice versa
			$('#gameMenu').toggle();
			this.menu.toggle();
			//this.menu.toggle();
			jq.setCash(money);
		}
	},
	RepairShop : {
		menu : $('#RepairShop'),
		backBtn : $('#repairBackButton')
	}
	//Projects
	//Vehicles
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
$('#addFunds').click(function() 
{
	jq.Funds.toggle();
    $('#menu').addClass('AddFunds');
	addFundsMode();	//is ok to call external functions, as long as they are defined in program.js
});
//
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
}*//*
function jqToggleFunds()
{
	$('#gameMenu').toggle();
	$('#AddFunds').toggle();
	jqSetCash(money);
}*/