//defines JavaScript Ajax interface for common API calls for site
var pas = {
    //namespace encapsulating AJAX requests calling SQL commands via a php page
    insertCar:function(vehicleID){
        var funcName = 'pas::insertCar(vehicleID)';
        
        jq.post('pas/update.php?op=insert',
            function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null || data === undefined){
                    jq.setErr(funcName, 'Ajax response returned null!\n Could not add vehicle with (ID:) into database.');
                    return;
                }
                alert(funcName + ', Inserting Car into user database! ajax response success!' + JSON.stringify(data) );
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
                jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
                //console.log('loading game resources failed, abort!');
                //finished = true;
                Auction._car = null;
                ajax_loadUser();
                ajax_post();    //get user info from server
                Auction.close();
                //init(); //this exists only within the scope of document.ready()
            },
            {carID:vehicleID}
        );      
        /*$.ajax({
            type:'POST',
            url:getHostPath() + 'pas/update.php?op=insert',
            dataType:'json',
            data:{carID:vehicleID}
        }).done(function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                //alert(funcName + ', Error:ajax response returned null!\n Could not add vehicle with (ID:) into database.';
                jq.setErr(funcName, 'Ajax response returned null!\n Could not add vehicle with (ID:) into database.');
                //finished = true;
                return;
            }
            alert(funcName + ', Inserting Car into user database! ajax response success!' + JSON.stringify(data) );
            //car added remove from Auction
            Auction._car = null;
            //userGarage.push(Auction._car);
            //Garage.save();    //not needed as data in maintained by DB
            ajax_post();    //get user info from server
            Auction.close();
            init(); //this exists only within the scope of document.ready()
        }).fail(function(jqxhr){
            //call will fail if result is not properly formated JSON!
            jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
            //console.log('loading game resources failed, abort!');
            //finished = true;
            Auction._car = null;
			ajax_loadUser();
            ajax_post();    //get user info from server
            Auction.close();
            //init(); //this exists only within the scope of document.ready()
        });*/
    },
    insertLoss:function(vehicleID){
        //user losses an auction, make a record of it
        var funcName = 'js\pas.js, pas::insertLoss(vehicleID)';
        
        jq.post('pas/update.php?op=iul',
            function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null || data === undefined){
                    //alert(funcName + ', Error:ajax response returned null!');
                    jq.setErr(funcName, 'Ajax response returned null!\n Auction loss could not be added to database');
                    return;
                }
                //alert(funcName + ', User lost auction! Ajax response success!' + JSON.stringify(data) );
                
                Auction.close();
                //init(); //this exists only within the scope of document.ready()
            },
            function(jqxhr){
                //call will fail if result is not properly formated JSON!
                jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
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
            var funcName = 'js\pas.js, pas::set::userCar(vehicleID)';

            jq.post('pas/update.php?op=succ',
                function(data){
                    //the response string is converted by jquery into a Javascript object!
                    if(data === null || data === undefined){
                        jq.setErr(funcName, 'Ajax response returned null!\nCurrent vehicle could not be selected.'); 
                        return;
                    }
                    //alert(funcName + ', User lost auction! Ajax response success!' + JSON.stringify(data) );
                    _curCarID = data;
                },
                function(jqxhr){
                    //call will fail if result is not properly formated JSON!
                    jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
                },
                {carID:vehicleID}
            )
        }
    },
    query:{
        userCar:function(){
            //get user's current car ID
            var funcName = 'js\pas.js, pas::query::userCar(vehicleID)';
            
            return jq.get('pas/query.php?op=gcid',
                function(data){
                    //the response string is converted by jquery into a Javascript object!
                    if(data === null || data === undefined){
                        jq.setErr(funcName, "Ajax response returned null!\nCould't retrive user's current vehicle."); 
                        return;
                    }
                    //alert(funcName + ', User lost auction! Ajax response success!' + JSON.stringify(data) );
                    _curCarID = data;
                    setHomeImg();
                },
                function(jqxhr){
                    //call will fail if result is not properly formated JSON!
                    jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
                    //_curCarID = 0;    //no car
                    //setHomeImg();
                }
            );
        },
        loadUser:function(){
            //loads userStats from php file accessing sql database
            var funcName = 'pas::query::loadUser()';
            
            jq.post('loadUser.php',
                function(data){
                    //the response string is converted by jquery into a Javascript object!
                    if(data === null || data === undefined){
                        //alert(funcName + ', Error:ajax response returned null!');
                        jq.setErr(funcName, "Ajax response returned null!\nCould't retrive user's stats.");
                        return;
                    }
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
                    jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
                    //throw exception, game can't work without user stats
                }
            );
            /*var jqxhr = $.ajax({
                type:'POST',
                url:getHostPath() + 'loadUser.php',
                dataType:'json',
                data:''
            }).done(function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null || data === undefined){
                    //alert(funcName + ', Error:ajax response returned null!');
                    jq.setErr(funcName, 'Ajax response returned null!\nCould not retrive user's stats.');
                    return;
                }
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
            }).fail(function(jqxhr){
                //call will fail if result is not properly formatted JSON!
                jq.setErr(funcName, 'ajax call failed!\nReason: ' + jqxhr.responseText);
                //throw exception, game can't work without user stats
            });*/
        }
    }
}