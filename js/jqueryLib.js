﻿//This file contains jQuery functions for manipulation of the application's 'index.html'
//functions and objects are visable to any file linking this document
//<php function divGame(){return 'div#gameMenu'}?>
var jq = {
	//namespace containing application bindings for jquery,
	//preforms qjery call one then stores the result as an object
	//canvas:$('#canvas'),
	adBar:$('img#adBar'),
    statBar:$('div#statBar'),
    error:$('pre#info'),
    nav:$('div#reg-navigation'),
    sound:$('div.sound'),
	userCash:$('label#userCash'),
    //msg:$('p#msg'),   //a label for sending messages to the user
    carImg:$('img#mainCar'),   //a label for sending messages to the user
	setCash : function(val){
        //set the html for the userCash label, to be displayed in browser
		this.userCash.html(val.toString());
	},
    setErr:function(funcName, info){
        //
        //sets the jq.error info box, to inform the user an error occured,
        //or clears the error in info is not supplied
        if(funcName === null || funcName === undefined){
            jq.error.text('');
            jq.error.hide();
            return;
        }
        else if(info === null || info === undefined){
            jq.error.text('');
            jq.error.hide();
            return;
        }
        alert(funcName + ',\nError: ' + info);
        jq.error.text(funcName + ',\nError:' + info);
        jq.error.show();
    },
    enableBtn:function(jqo){
        var def = {
            opacity:'1.0',
            cursor:'pointer'
        };
        return jqo.off().css(def);
    },
    disableBtn:function(jqo){
        var tc = {
            opacity:'0.45',
            cursor:'default'
        };
        return jqo.off().css(tc);
    },
    //ajaxFail:function(jqxhr){
        //default failure message when an Ajax call fails
        //jq.setErr('<?php echo $funcName;?>', 'ajax call failed! Reason: ' + jqxhr.responseText);
        //console.log(funcName + ', loading game resources failed, abort!');
    //},
	Main : {
		menu:$('#main')
	},
	Game : {	//rename to something less vague
		menu : $('#gameMenu'),
		homeImg : $('img#mainCar'),
		//left menu
		toGarageBtn : $('div#gameMenu button#myCars'),
		//toProjBtn : $(''),
		//toGarageBtn : $(''),
		toAuctionBtn : $('#toAuctionBtn'),
		toSlotsBtn : $('#toSlotsBtn'),
        //toPartsSupply:$(""),
		repairBtn : $('#buyUpgradesBtn'),
		//right menu
		toProfileBtn:$('div#gameMenu button#profile'),
		toMsgBtn:$('div#gameMenu button#messages'),
		toRankingsBtn:$('div#gameMenu button#rankings'),
        toSearchBtn:$('div#gameMenu button#search'),
        toBuisnessBtn:$('div#gameMenu button#buyBusiness')
        //toFAQBtn:$(''),
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
            jq.setErr();    //clear error when changing pages
		}
	},
	Garage : {
		menu : $('div#Garage'),
		//
        toggle : function()
		{	//from game menu to garage, or vice versa
			$('#gameMenu').toggle();
			this.menu.toggle();	//this refers to jq.Garage
            jq.setErr();    //clear error when changing pages
			//$('#Garage').toggle();
		}
	},
	CarView : {
		menu : $('div#CarView'),
		backBtn : $('div#CarView button#backBtn'),
		homeBtn : $('div#CarView button#homeBtn'),	//$('button#homeBtn', jq.CarView.menu),
		sellBtn : $('div#CarView button#sell'),
        selectBtn : $('div#CarView button#select'),
		//carImg : $('img#car'),
        carName : $('div#CarView label#carName'),
		carInfo : $('div#CarView label#carInfo'),
		//
        toggle:function(){
            //go from (my cars to car view) || (car view to my cars)
			//jq.Garage.menu.toggle();
			//this.menu.toggle();
			jq.Garage.menu.toggle();
			$('#CarView').toggle();	//this.menu doesn't work...
            jq.setErr();    //clear error when changing pages
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
            jq.setErr();    //clear error when changing pages
		}
	},
	Funds : {
		menu : $('div#AddFunds'),
		backBtn : $('div#AddFunds button#backBtn'),
        homeBtn : $('div#AddFunds button#homeBtn'),
		//
        toggle : function()
		{	//from game menu to funds or vice versa
			//$('#gameMenu').toggle();
            jq.RepairShop.menu.toggle();
			this.menu.toggle();
			//this.menu.toggle();
			jq.setCash(userStats.money);
            jq.setErr();    //clear error when changing pages
		}
	},
    // Sold : {
        // menu : $('div#sold'),
        // homeBtn:$('div#sold button#homeBtn'),
        // garageBtn:$('div#sold button#garageBtn'),
    // },
	Loss : {
        menu : $('div#loss'),
        homeBtn:$('div#loss button#homeBtn')       
    },
	
	Slots : {
        menu : $('div#Slots'),
        homeBtn:$('div#Slots button#homeBtn'),
		backBtn : $('div#AddFunds button#backBtn'),
		toggle:function(){
			jq.Game.menu.toggle();
			jq.Slots.menu.toggle();
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
    //high level interface for short hand calls
    //to jquery's http Ajax protocol
    //all functions return JSON formatted text,
    //which the browser will intrinsically convert
    //to javascript object(s) for use in browser-side operations
    get:function(localPath, doneCB, failedCB){
        //get does not pass arguments to the script,
        //embed any optional params in localPath!
        //doneCB and failedCB are functions
        return $.ajax({
            type:'GET',
            url:getHostPath() + localPath,
            dataType:'json'
        }).done(doneCB).fail(failedCB);
    },
    post:function(localPath, doneCB, failedCB, args){
        //args must but be a js object
        //doneCB and failedCB are functions
        return $.ajax({
            type:'POST',
            url:getHostPath() + localPath,
            dataType:'json',
            data:(args === null || args === undefined)?'':args
        }).done(doneCB).fail(failedCB);
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
function setAdBG(){
	//set a random ad
	//floor returns an integer, random returns, random returns a float
	var i = Math.floor(Math.random() * (logos.length - 1) ),	//[0,logos.length-1]
		src = "images\\logos\\" + logos[i] + ".png";
	jq.adBar.attr('src', src);
	jq.adBar.show();
}
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
//jq.Game.toMsgBtn.click(jq.Messages.toggle);
//jq.Game.toRankingsBtn.click(jq.Ranks.toggle);
//jq.Game.toSearchBtn.click(jq.Search.toggle);
//jq.Game.toBuisnessBtn.click(jq.Business.toggle);
//
//jq.Ranks.backBtn.click(jq.Ranks.toggle);
//jq.Messages.backBtn.click(jq.Messages.toggle);
//jq.Search.backBtn.click(jq.Search.toggle);
//jq.Business.backBtn.click(jq.Business.toggle);
//jq.Garage.backBtn.click(jq.Garage.toggle);
//
//User Stat Bar interface!
//
function setName(){
	//$('div#statBar label#fname').text('User: ' + userStats.fn.toString() );
}	
function setMoney(val){
    //sends a request to the server to set money to a specific value,
    //updating the html
    function sf(data){
        //sets user funds to data,
        //which may be an optional argument,
        //or null is returned when using as a cb,
        //which the ui is then appropriately updated
        if(data !== null && data !== undefined){
            userStats.money = data;  //if an argument is passed, assign value to money
        }
        
        var mstr = userStats.money.toFixed(2),
            jqm = $('div#statBar label#money');
        //assign value to html element
        
        if(userStats.money <= 0){
            //userStats.money = 0;  //can't have less than no money
            jqm.text('Refresh Dough???: ' + mstr);
        }
        else{
            jqm.text('Money: ' +  mstr);
        }
    };
//<php
//if(loggedIn() ){>
    //jq.get(
        //'pas/update.php?op=suf',
        //sf,
        //function(jqxhr){
            
        //}
    //);
//<php
//else{>
    sf(val);
//<php
//}
//>
}
function setTokens(val){
//<php
//if(loggedIn() ){>
    //jq.get(
    if(val !== null &&
        val !== undefined &&
        val >= 0 &&
        val != userStats.tokens
    ){
        userStats.tokens = val;  //if an argument is passed, assign value to money
    }
	$('div#statBar label#tokens').text('Tokens: ' + userStats.tokens.toString() );
    
    if(userStats.tokens == 0){
        //jq.Msg('No more tokens, go to the store to purchase more!')
    }
}
function setPrestige(val){
    if(val !== null &&
        val !== undefined &&
        val >= 0 &&
        val != userStats.prestige
    ){
        userStats.prestige = val;  //if an argument is passed, assign value to money
    }
	$('div#statBar label#prestige').text('Prestige: ' + userStats.prestige.toString() );
}
function setMarkers(val){
    if(val !== null &&
        val !== undefined &&
        val >= 0 &&
        val != userStats.m_marker
    ){
        userStats.m_marker = val;  //if an argument is passed, assign value to money
    }
	$('label#markers').text('Mile Markers: ' + userStats.marker.toString() );
}
function setStatBar(args){
    //pass args in to set userStats to values,
    //otherwise sets values to ones already set to userStats
    jq.statBar.show();

    if(args !== null && args !== undefined){
        //setName();
        setMoney(args.money);
        setTokens(args.tokens);
        setPrestige(args.prestige);
        setMarkers(args.m_marker);
    }
    else{
        //setName();
        setMoney();
        setTokens();
        setPrestige();
        setMarkers();
    }
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