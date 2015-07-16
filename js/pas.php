<?php
header('Content-type: application/javascript; charset: UTF-8');
//
require_once '../ao.php';
//require_once '../secure.php';
//
$fileName = 'js/pas.php';//__FILE__;
$funcName = '';

function eFN(){
    global $funcName;
    echo $funcName;
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
    insertCar:function(auction){
<?php
$funcName = "$fileName, pas::insertCar(auction)";
?>       
    
        var n = Auction._car !== null ? Auction._car.getFullName() : '',
            sl = $('div#sold label');
 
        jq.post('pas/update.php?op=insert',          
            function(data){
                <?php isValidData();?>  
                
                sl.html('Congratulations!<br>You won the auction for the ' + n + '<br>Go to the garage to view your prize!');

                //car added remove from Auction
                Auction._car = null;
                pas.get.user.stats();
                Auction.close();
                //init(); //this exists only within the scope of document.ready()
            },
            function(jqxhr){ 
                //call will fail if result is not properly formated JSON!
                jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);

//                var n = Auction._car.getFullName(),
//                    sl = $('div#sold label');

//                <?php 
//                $hasLostCar = hasLostCar($carID);
//                if($hasLostCar)?>
//                {
//                    sl.html('Hey,<br> you have lost this auction for the ' + n + '<br>already.');
//                }
                
                sl.html('Unfortunately,<br> you lost the auction for the ' + n + '<br>Better luck next time!');

                Auction._car = null;
                Auction.close();
            },
            {carID:auction._car.id, price:auction.currentBid}
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
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                jq.setErr('<?php eFN();?>', 'ajax call failed!\nReason: ' + jqxhr.responseText);
				Auction.close();
            },
            {carID:vehicleID}
        );
    },

    postUserCarSale:function(carid){
<?php
$funcName = "$fileName, pas::postUserCarSale(carid)";
?>  
        jq.post(
            "pas/update.php?op=pucs", 
            function(data){
                //
                if(data === null || data === undefined){
					
                    jq.setErr('<?php eFN();?>', 'Error:ajax response returned null!');
				
                    return;
                }

                //if (data.length == 0){
                //    return;
                //}

                console.log(JSON.stringify(data));
                var cid = data.car_id;
                
                if(cid == _curCarID){
                    _curCarID = 0;
                    //hideDiv
                }
                
                //if(data.car_id === _selCID){
                    //_selCID = 0;
                    //Garage.setSelect Car Div
                //}

                AuctionSell.init(data.car_id);
            }, 
            function(jqxhr){ 
                jq.setErr('<?php eFN();?>', 'error happened: ' + jqxhr.responseText);
            }, 
            {carID:carid}
        );
    },
    //pushCar:function(carID){
        //pushes a car from finalpost[aoCarsDB] to aoUsersDB[userTable]
    //}
    get:{
        user:{
            funds:function(){
<?php
$funcName = "$fileName, pas.get.user.funds()";
?>
                /*jq.post('pas/query.php?op=guf',
                    function(data){
                        //
                        <?php isValidData();?>
                        //userStats.money = typeof data == 'number' ? data : parseInt(data);
                        //jq.setFunds();
                    },
                    function(jqxhr){
                        //call will fail if result is not properly formated JSON!
                        jq.setErr('<?php eFN();?>', jqxhr.responseText);
                    }
                );
                */
            },
            tokens:function(){
                
            },
            prestige:function(){
                
            },
            markers:function(){
                
            },
            stats:function(){
<?php $funcName = "$fileName, pas.get.user.stats()";?>
                jq.post('pas/query.php?op=gus',
                    function(data){
                        //
                        <?php isValidData();?>
                        //userStats.money = typeof data == 'number' ? data : parseInt(data);
                        //console.log(JSON.stringify(data));
                        //jq.setFunds();
                        setStatBar(data);
                    },
                    function(jqxhr){
                        //call will fail if result is not properly formated JSON!
                        jq.setErr('<?php eFN();?>', jqxhr.responseText);
                    }
                );
            }
        }
    },
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
                    if(data === null || data === undefined){
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
        },
        userFunds:function(funds){
<?php
$funcName = "$fileName, pas::set::userFunds()";
?>
            jq.post('pas/update.php?op=puf',
                function(data){
                    if(data === null || data === undefined){
                        return;
                    }
                    //
                    jq.Profile.stats.set(data.stats);
                    jq.Profile.sales.set(data.income)
                    //
                    jq.Profile.toggle();
                },
                function(jqxhr){
//<?php//if($DEBUG){?>
                    jq.setErr("<?php echo $funcName;?>", jqxhr.responseText);
<?php
//}
?>
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
