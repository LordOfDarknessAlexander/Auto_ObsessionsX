//This file contains jQuery functions for manipulation of the application's 'index.html'
//functions and objects are visable to any file linking this document
//<php function divGame(){return 'div#gameMenu'}?>
//<php function divGarage(){return 'div#garage'}?>
//<php function divGarage(){return 'div#garage'}?>
jq.statBar = {
    div:$('div#statBar'),
    money:$('div#statBar label#money'),
    tokens:$('div#statBar label#tokens'),
    prest:$('div#statBar label#prestige'),
    markers:$('div#statBar label#markers'),
    //Getters
    //there is no need to have getters, if a wishing to access
    //values of the user's stats, simply access the userStats
    //variable declared in globals
    //
    //Setters
    set:{
        //name:function(){
            //$('div#statBar label#fname').text('User: ' + userStats.fn.toString() );
        //},
        money:function(val){
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
                    jqm = jq.statBar.money; //$('div#statBar label#money');
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
        },
        tokens:function(val){
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
            jq.statBar.tokens.text(
                'Tokens: ' + userStats.tokens.toString()
            );
            
            if(userStats.tokens == 0){
                //jq.Msg('No more tokens, go to the store to purchase more!')
            }
        },
        prestige:function(val){
            if(val !== null &&
                val !== undefined &&
                val >= 0 &&
                val != userStats.prestige
            ){
                userStats.prestige = val;  //if an argument is passed, assign value to money
            }
            jq.statBar.prest.text(
                'Prestige: ' + userStats.prestige.toString()
            );
        },
        markers:function(val){
            if(val !== null &&
                val !== undefined &&
                val >= 0 &&
                val != userStats.m_marker
            ){
                userStats.m_marker = val;  //if an argument is passed, assign value to money
            }
            
            jq.statBar.markers.text(
                'Mile Markers: ' + userStats.marker.toString()
            );
        },
        stats:function(args){
            //pass args in to set userStats to values,
            //otherwise sets values to ones already set to userStats
            jq.statBar.div.show();
            
            var s = jq.statBar.set;

            if(args !== null && args !== undefined){
                //set stats to object/values passed to function
                s.money(args.money);
                s.tokens(args.tokens);
                s.prestige(args.prestige);
                s.markers(args.m_marker);
            }
            else{
                //set stats based on CURRENT userStats
                s.money();
                s.tokens();
                s.prestige();
                s.markers();
            }
        }
    }
};
    // setErr:function(funcName, info){
        // //
        // //sets the jq.error info box, to inform the user an error occured
        // //clear error            
        // if(funcName === null || funcName === undefined){
            // jq.error.text('');
            // jq.error.hide();
            // return;
        // }
        // else if(info === null || info === undefined){
            // jq.error.text('');
            // jq.error.hide();
            // return;
        // }
        // alert(funcName + ',\nError: ' + info);
        // jq.error.text(funcName + ',\nError:' + info);
        // jq.error.show();
    // },
    //ajaxFail:function(jqxhr){
        //default failure message when an Ajax call fails
        //jq.setErr('<?php echo $funcName;?>', 'ajax call failed! Reason: ' + jqxhr.responseText);
        //console.log(funcName + ', loading game resources failed, abort!');
    //},
    //get:function(localPath, doneCB, failedCB){
        //get does not pass arguments to the script,
        //embed any optional params in localPath!
        //doneCB and failedCB are functions
        //return $.ajax({
            //type:'GET',
            //url:getHostPath() + localPath,
            //dataType:'json'
        //}).done(doneCB).fail(failedCB);
    //},
    //post:function(localPath, doneCB, failedCB, args){
        //args must but be a js object
        //doneCB and failedCB are functions
        //return $.ajax({
            //type:'POST',
            //url:getHostPath() + localPath,
            //dataType:'json',
            //data:(args === null || args === undefined)?'':args
        //}).done(doneCB).fail(failedCB);
    //}
//};
function setAdBG(){
	//set a random ad
	//floor returns an integer, random returns, random returns a float
	var i = Math.floor(Math.random() * (logos.length - 1) ),	//[0,logos.length-1]
		src = "images\\logos\\" + logos[i] + ".png";
	jq.adBar.attr('src', src);
	jq.adBar.show();
}