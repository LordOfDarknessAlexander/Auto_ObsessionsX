//defines JavaScript Ajax interface for common API calls for site
var pas = {
    //namespace encapsulating AJAX requests calling SQL commands via a php page
    insertCar:function(vehicleID){
        var funcName = 'pas::insertCar(vehicleID)';
        
        $.ajax({
            type:'POST',
            url:getHostPath() + 'pas/update.php?op=insert',
            dataType:'json',
            data:{carID:vehicleID}
        }).done(function(data){
            //the response string is converted by jquery into a Javascript object!
            if(data === null){
                alert(funcName + ', Error:ajax response returned null!');
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
            alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
            //console.log('loading game resources failed, abort!');
            //finished = true;
            Auction._car = null;
			ajax_loadUser();
            ajax_post();    //get user info from server
            Auction.close();
            init(); //this exists only within the scope of document.ready()
        });
    },
    //pushCar:function(carID){
        //pushes a car from finalpost[aoCarsDB] to aoUsersDB[userTable]
    //}
    query:{
        loadUser:function()
        {
            var funcName = 'pas::query::loadUser()';
            //loads userStats from php file accessing sql database
            var jqxhr = $.ajax({
                type:'POST',
                url:getHostPath() + 'loadUser.php',
                dataType:'json',
                data:''
            }).done(function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
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
                setStatBar();
            }).fail(function(jqxhr){
                //call will fail if result is not properly formatted JSON!
                alert(funcName + ', call failed! Reason: ' + jqxhr.responseText);
                //throw exception, game can't work without user stats
            });
        }
    }
}