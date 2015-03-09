//This file contains jQuery functions for manipulation of the application's 'index.html'
//functions and objects are visable to any file linking this document
//<php function divGame(){return 'div#gameMenu'}?>
//<php function divGarage(){return 'div#garage'}?>
//<php function divGarage(){return 'div#garage'}?>
var jq = {
	//namespace containing application bindings for jquery,
	//preforms qjery call one then stores the result as an object
	//canvas:$('#canvas'),
	adBar:$('img#adBar'),
    statBar:$('div#statBar'),
    //statBar:{
        //div:$('div#statBar'),
        //money:$('div#statBar label#money'),
        //tokens:$('div#statBar label#tokens'),
        //prest:,
        //markers:,
        //Setters
        //setMoney()
        //setTokens(),
        //setPrestige(),
        //setMarkers(),
        //
        //function setStatBar(){
            //jq.statBar.show();
            //jq.statBar.setName();
            //jq.statBar.setMoney();
            //jq.statBar.setTokens();
            //jq.statBar.setPrestige();
            //jq.statBar.setMarkers();
        //}
    //}
	userCash:$('label#userCash'),
    //msg:$('p#msg'),   //a label for sending messages to the user
    carImg:$('img#mainCar'),   //a label for sending messages to the user
	setCash : function(val)
	{	//set the html for the userCash label, to be displayed in browser
		this.userCash.html(val.toString());
	},
	Main : {
		menu:$('#main')
	},
	Game : {	//rename to something less vague
		menu : $('#gameMenu'),
		homeImg : $('img#mainCar'),
		//left menu
		toCarsBtn : $('div#gameMenu button#myCars'),
		//toProjBtn : $(''),
		//toGarageBtn : $(''),
		toAuctionBtn : $('#toAuctionBtn'),
        //toPartsSupply:$(""),
		repairBtn : $('#buyUpgradesBtn'),
		//right menu
		toProfileBtn:$('div#gameMenu button#profile'),
		toMsgBtn:$('div#gameMenu button#messages'),
		toRankingsBtn:$('div#gameMenu button#rankings'),
        toSearchBtn:$('div#gameMenu button#search'),
        toBuisnessBtn:$('div#gameMenu button#buyBusiness'),
        //toFAQBtn:$(''),
		setHomeImg : function()
		{
            //var car = Garage.getCurrentCar();
            //if(car !== null){
                //this.homeImg.attr('src', car.getFullPath() );
            //}
        }
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
		menu : $('div#Garage'),
		backBtn : $('div#Garage button#backBtn'),
		selectBtn:$('div#Garage button#select'),
		viewBtn:$('div#Garage button#viewCar'),
		toggle : function()
		{	//from game menu to garage, or vice versa
			$('#gameMenu').toggle();
			this.menu.toggle();	//this refers to jq.Garage
			//$('#Garage').toggle();
		}
	},
	AuctionSelect : {
		menu : $('div#AuctionSelect'),
		backBtn : $('div#AuctionSelect button#backBtn')
        //carView : $('div#AuctionSelect div#carView'),
	},
	Auction : {
		menu : $('div#Auction'),
		backBtn : $('div#Auction button#backBtn'),
		homeBtn : $('div#Auction button#homeBtn'),
		carPrice : $('div#Auction label#carPrice')
				
		//cashLabel:$('#myCash'),
        //carPrice:$('#carPrice');
	},
	CarView : {
		menu : $('div#CarView'),
		backBtn : $('div#CarView button#backBtn'),
		homeBtn : $('div#CarView button#homeBtn'),	//$('button#homeBtn', jq.CarView.menu),
		sellBtn : $('div#CarView button#sellBtn'),
		//carImg : $('img#car'),
		carInfo : $('div#CarView label#carInfo'),
		toggle:function()
		{	//go from (my cars to car view) || (car view to my cars)
			//jq.Garage.menu.toggle();
			//this.menu.toggle();
			jq.Garage.menu.toggle();
			$('#CarView').toggle();	//this.menu doesn't work...
		}
	},
    AuctionSell:{
		menu:$('div#AuctionSell'),
		backBtn:$('div#AuctionSell button#backBtn'),
        homeBtn:$('div#AuctionSell button#homeBtn'),
		carView:$('div#AuctionSell div#carView'),
        //carList:$('div#AuctionSell ul#auctionCars'),
        toggle:function(){
			jq.CarView.menu.toggle();
			jq.AuctionSell.menu.toggle();
		}
	},
	Funds : {
		menu : $('div#AddFunds'),
		backBtn : $('div#AddFunds button#backBtn'),
		toggle : function()
		{	//from game menu to funds or vice versa
			//$('#gameMenu').toggle();
            jq.RepairShop.menu.toggle();
			this.menu.toggle();
			//this.menu.toggle();
			jq.setCash(userStats.money);
		}
	},
	RepairShop : {
		menu : $('div#RepairShop'),
		backBtn : $('div#RepairShop button#backBtn'),
		upgrades : $('div#RepairShop div#upgrades'),
		repairs : $('div#RepairShop div#repairs'),
        //dt:$('div#RepairShop div#drivetrain'),
        //body:$('div#RepairShop div#body'),
        //interior:$('div#RepairShop div#interior'),
        //docs:$('div#RepairShop div#docs'),
        toggle : function()
		{	//from game menu to funds or vice versa
			jq.Funds.menu.toggle();
			this.menu.toggle();
		}
	},
    Sold : {
        menu : $('div#sold'),
        homeBtn:$('div#sold button#homeBtn'),
        garageBtn:$('div#sold button#garageBtn'),
    },
	 Loss : {
        menu : $('div#loss'),
        homeBtn:$('div#loss button#homeBtn'),
       
    },
    Profile:{
        menu:$('div#profile'),
        backBtn:$('div#profile button#backBtn'),
        toggle : function()
		{
			jq.Game.menu.toggle();
			jq.Profile.menu.toggle();
		}
    },
    /*Messages:{
        menu:$('div#messages'),
        backBtn:$('div#messages button#backBtn'),
        toggle : function()
		{
			jq.Game.menu.toggle();
			jq.Messages.menu.toggle();
		}
    },
    Ranks:{
        menu:$('div#ranks'),
        backBtn:$('div#ranks button#backBtn'),
        toggle : function()
		{
			jq.Game.menu.toggle();
			jq.Ranks.menu.toggle();
		}
    },
    Search:{
        menu:$('div#search'),
        backBtn:$('div#search button#backBtn'),
        toggle : function()
		{
			jq.Game.menu.toggle();
			jq.Search.menu.toggle();
		}
    },
    Business:{
        menu:$('div#business'),
        backBtn:$('div#business button#backBtn'),
        toggle : function()
		{
			jq.Game.menu.toggle();
			jq.Business.menu.toggle();
		}        
    },*/
    get:function(localPath, doneCB, failedCB){
        //get does not pass arguments to the script,
        //embed any optional params in localPath!
        //doneCB and failedCB are functions
        //$.ajax({
            //type:'GET',
            //url:getHostPath() + localPath,
            //dataType:'json',
            //data:''
        //}).done(doneCB).failed(failedCB);
    },
    post:function(localPath, doneCB, failedCB, args){
        //args must but be a js object
        //doneCB and failedCB are functions
        //$.ajax({
            //type:'POST',
            //url:getHostPath() + localPath,
            //dataType:'json',
            //data:(args === null || args === undefined)?'':args
        //}).done(doneCB).failed(failedCB);
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
$('#addFunds').click(function() 
{
	jq.Funds.toggle();
    jq.carImg.hide();
    //jq.RepairShop.toggle();
    //$('#menu').addClass('AddFunds');
	//addFundsMode();	//is ok to call external functions, as long as they are defined in program.js
});
//
//
jq.Game.toProfileBtn.click(jq.Profile.toggle);
//jq.Game.toMsgBtn.click(jq.Messages.toggle);
//jq.Game.toRankingsBtn.click(jq.Ranks.toggle);
//jq.Game.toSearchBtn.click(jq.Search.toggle);
//jq.Game.toBuisnessBtn.click(jq.Business.toggle);
//
jq.Profile.backBtn.click(jq.Profile.toggle);
//jq.Ranks.backBtn.click(jq.Ranks.toggle);
//jq.Messages.backBtn.click(jq.Messages.toggle);
//jq.Search.backBtn.click(jq.Search.toggle);
//jq.Business.backBtn.click(jq.Business.toggle);
//jq.Garage.backBtn.click(jq.Garage.toggle);

jq.AuctionSell.backBtn.click(function(){
    jq.AuctionSell.toggle();
    jq.carImg.show();
    //appState = GAME_MODE.CAR_VIEW;
});
jq.AuctionSell.homeBtn.click(function(){
    //AuctionSell.close();
    jq.AuctionSell.menu.toggle();
    jq.Game.menu.toggle();
    setHomeImg();
    js.carImg.show();
    //appState = GAME_MODE.MAIN;
});
//
//User Stat Bar interface!
//
function setName()
{
	//$('div#statBar label#fname').text('User: ' + userStats.fn.toString() );
}	
function setMoney()
{
	$('div#statBar label#money').text('Money: ' + userStats.money.toFixed(2) );
	
	if(userStats.money <= 0)
	{
		//userStats.money = 0;
		alert("You are out of money Dude!");
		$('div#statBar label#money').text('Refresh Dough???: ' + userStats.money.toFixed(2) );
	}	
}
function setTokens(){
	$('div#statBar label#tokens').text('Tokens: ' + userStats.tokens.toString() );
}
function setPrestige(){
	$('div#statBar label#prestige').text('Prestige: ' + userStats.prestige.toString() );
}
function setMarkers(){
	$('label#m_marker').text('Mile Markers: ' + userStats.marker.toString() );
}
function setStatBar(){
    jq.statBar.show();
	setName();
	setMoney();
	setTokens();
	setPrestige();
	setMarkers();
}
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