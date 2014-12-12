//Action Select State Object
var AuctionSelect =
{	//object representing
	list : $('ul#auctionCars'),
	init : function()
	{	//init buttons base on cars in xml database
		//appState = GAME_MODE.AUCTION_SElECT;
		this.list.empty();
		//
		for(var i = 0; i < /*ao.*/xdbCars.length; i++)
		{
			var btnID = "as" + (i).toString(),
				labelID = 'infoLabel';
				
			var car = xdbCars[i];	//ao.xdbCars[i];
			
			var btnStr = "<li>" + 
				"<img src=\'" + "images\\vehicle.jpg"/*car.getFullPath()*/ + "\'>" +
				"<label id=\'" + labelID + "\'>" + car.getFullName() + "</label>" +
				"<button id=\'" + btnID + "\'\'>" + 
					"<label id=\'price\'>carPrice</label><br>" +
					"Bid Now!<br>" +
					//"<label id=\'expireTime\'>Time Auction expires!</label>" +
				"</button>" +
			"</li><br>";
			this.list.append(btnStr);
			//
			var btn = $('#' + btnID);
			
			btn.click({index:i}, this.initAuction);
			//btn.css('background-image', "url(\'..\\images\\vehicle.jpg");	//car.getFullPath());
		}
	},
	initAuction : function(obj)
	{
		var i = obj.data.index;
		jq.AuctionSelect.menu.toggle();
		jq.Auction.menu.toggle();
		Auction.init(i);
	},
	update : function()
	{
	},
	render : function()
	{	//render additional, not html elements
	}
};