<?php
header('Content-type: application/javascript; charset: UTF-8');
//
require_once '../ao.php';
//
$fileName = 'js/pas.php';//__FILE__;
$funcName = '';

function eFN(){
    global $funcName;
    echo $funcName;
}
function loggedIn(){
    return isset($_SESSION) ? true : false;
   // return true;
}
//defines JavaScript Ajax interface for common API calls for site
function isValidData(){
    //determine if an object(data) is valid,
    //use to check return from ajax call and output an error to the page
?>if(data === null || data === undefined){
    jq.setErr("<?php eFN();?>", 'Ajax response returned null!');
    return;
}
<?php
}
?>
var pas = {
    //namespace encapsulating AJAX requests calling SQL commands via a php page
    insertCar:function(vehicleID){
<?php
$funcName = "$fileName, pas::insertCar(vehicleID)";
?>        
        jq.post('pas/update.php?op=insert',
            function(data){
                //the response string is converted by jquery into a Javascript object!
                <?php isValidData();?>
                alert('<?php echo "$funcName, Inserting Car into user database! ajax response success!";?>' + JSON.stringify(data) );
                //car added remove from Auction
                Auction._car = null;
                //userGarage.push(Auction._car);
                //Garage.save();    //not needed as data in maintained by DB
                ajax_post();    //get user info from server
                Auction.close();
                init(); //this exists only within the scope of document.ready()
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);
                Auction._car = null;
                ajax_loadUser();
                ajax_post();    //get user info from server
                Auction.close();
                //init(); //this exists only within the scope of document.ready()
            },
            {carID:vehicleID}
        );      
    },
    insertLoss:function(vehicleID){
        //user losses an auction, make a record of it
<?php
$funcName = "$fileName, pas::insertLoss(vehicleID)";
?>        
        jq.post('pas/update.php?op=iul',
            function(data){
                //the response string is converted by jquery into a Javascript object!
                <?php isValidData();?>
                //alert(funcName + ', User lost auction! Ajax response success!' + JSON.stringify(data) );
                
                Auction.close();
                //init(); //this exists only within the scope of document.ready()
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);
            },
            {carID:vehicleID}
        );
    },
    //pushCar:function(carID){
        //pushes a car from finalpost[aoCarsDB] to aoUsersDB[userTable]
    //}
    set:{
        userCar:function(vehicleID){
            //set user's current car ID
<?php
$funcName = "$fileName, pas::set::userCar(vehicleID)";
?>
            jq.post('pas/update.php?op=succ',
                function(data){
                    //the response string is converted by jquery into a Javascript object!
                    <?php isValidData();?>
                    //alert(funcName + ', User lost auction! Ajax response success!' + JSON.stringify(data) );
                    _curCarID = data;
                },
                function(jqxhr){
                    //call will fail if result is not properly formated JSON!
                    jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);
                },
                {carID:vehicleID}
            )
        },
        userProfileData:function(){
<?php
$funcName = "$fileName, pas::set::userUserProfileData()";
?>
            jq.post('pas/profile.php',
                function(data){
                    if(data === null || data == undefined){
                        return;
                    }
                    //alert(JSON.stringify(data));
                    //
                    //set contents on page, then transition,
                    //as it is much cleaner and ensures the user does not
                    //witness the page updates
                    //
                    jq.Profile.stats.set(data.stats);
                    jq.Profile.sales.set(data.income)
                    //
                    jq.Profile.toggle();
                },
                function(jqxhr){
                    //do not show screen transition,
                    //play failure sound
                    jq.setErr("<?php echo $funcName;?>", jqxhr.responseText);
                }
            );
        }
    },
    query:{
        userCar:function(){
            //get user's current car ID
<?php
$funcName = "$fileName, pas::query::userCar(vehicleID)";
?>            
            return jq.get('pas/query.php?op=gcid',
                function(data){
                    //the response string is converted by jquery into a Javascript object!
                    <?php isValidData();?>
                    //alert(funcName + ', User lost auction! Ajax response success!' + JSON.stringify(data) );
                    _curCarID = data;
                    setHomeImg();
                },
                function(jqxhr){
                    //call will fail if result is not properly formated JSON!
                    jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);
                    //_curCarID = 0;    //no car
                    //setHomeImg();
                }
            );
        },
        loadUser:function(){
            //loads userStats from php file accessing sql database
<?php
$funcName = "$fileName, pas::query::loadUser()";
?>            
            jq.post('loadUser.php',
                function(data){
                    //the response string is converted by jquery into a Javascript object!
                    <?php isValidData();?>
                    //alert('ajax response received:' + JSON.stringify(data) );
                    //access and set values in the document's html page
                    //$('div#statBar label#fname').text(data.uname);
                    userStats = {
                        money:data.money,
                        tokens:data.tokens,
                        prestige:data.prestige,
                        marker:data.m_marker
                    };
                    _curCarID = data.cid;
                    console.log('cur car id:' + _curCarID.toString() );
                    setStatBar();
                    setHomeImg();
                },
                function(jqxhr){
                    //call will fail if result is not properly formatted JSON!
                    jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);
                    //throw exception, game can't work without user stats
                }
            );
        }
    }
}
