<?php
//auction state stylings
header("Content-type: text/css; charset: UTF-8");
?>
/*imports relative to this document, or an absolute url.
makes maintainability easier, allowing structured includes of css sheets
but prevents asynchronous parsing of files, as if they were included as
<linl> tags in the html source*/
@import url("menu.css");
@import url("credits.css");

*, *:before, *:after {
  box-sizing: border-box;
}

body 
{
  font-family: arial, sans-serif;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  cursor: default;
  color: #751ec3;
}

canvas 
{
  position: absolute;
  top: 0;
  left: 0;
  border: 1px solid black;
  z-index: 1;
  width: 100%;
  height: 100%;
}
/*default element stylings for the entire page*/
ul 
{
  list-style: none;
  padding: 0;
  margin: 0
}
li 
{
  padding: 10px 0;
}

a 
{	/*styling for all anchor elements on page*/
  text-decoration: none;
  color:blue;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
button
{	/*all button elements will hare this background unless otherwise specified*/
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color:red;
}
button#backBtn
{   /*sets properties for all button tags with id backBtn*/
	background: url('../images/backBtn.png') no-repeat 0 0;
    cursor:pointer;
	position:absolute;
	left:5%;
	bottom:0%;
	width:10%;
	height:10%;
}
button#homeBtn
{
	background: url('../images/homeBtn.png') no-repeat 0 0;
    cursor:pointer;
	color:red;
	font-weight: bold;
    
	position:absolute;
    width:10%;
	height:10%;
	
	right:5%;
	bottom:5%;
}
/*button#homekBtn
{   sets properties for all button tags with id homeBtn
	background: url('../images/backBtn.png') no-repeat 0 0;
	
	left:5%;
	bottom:0%;
	width:10%;
	height:10%;
}*/
/*button:hover
{	alters all button appearences when being moused over
	background-color:red;
}*/
.wrapper 
{
 height:600px;
  width: 900px;
  position: absolute;
  top: 5px;
  left: 5px;
}
img#adBar
{
	/*background:url('../images/logos/AutoZone.png') no-repeat 0 0;*/
	position:absolute;
	width:50%;
	height:8%;
	left:25%;
	bottom:2%;
}

#Register
{
  background-image: url('../images/Splash.png');
  color: white;
  height:600px;
  width: 900px;
  z-index: 20;
  color:red;
	position:absolute;
	right:5%;
	top:25%;


}
#login
{
	position: absolute;
	float: left;
	top : 20%;
	
}

#splash
{
  background-image: url('../images/Splash.png');
  height:600px;
  width: 900px;
  z-index: 20;

}
p#legal
{
    font-size:0.65em;
    color:white;
    
    position:absolute;
    bottom:0%;
    left:0%;
}
/* visited link */
#div#main a:visited {
    color: #00FFFF;
}
/* mouse over link */
div#main a:hover {
    color:purple;
}
#main 
{
  display: none;
  height: 60%;
  /*overflow: auto;*/
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
}
#main form#login
{
	color:red;
	position:absolute;
	left:5%;
	top:0%;
}
#main form#register
{
	color:red;
	position:absolute;
	right:5%;
	top:25%;
}

#progress 
{
  height: 12%;
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
}
#percent 
{
  color: white;
  font-weight: bold;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
#progress-bar 
{
  width: 200px;
}

.sound 
{
  display: none;
  position: absolute;
  bottom: 5em;
  left: 3em;
  width: 30px;
  height: 25px;
  cursor: pointer;
  z-index: 3;
}
.sound-on 
{
  background-image: url('../images/soundOn.png');
  background-repeat: no-repeat;
}

.sound-off 
{
  background-image: url('../images/soundOff.png');
  background-repeat: no-repeat;
}

#enemyBid
{
 color:aqua;	
}

#main h1 
{
  color: #AFCAAF;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

.button 
{
  display: block;
  width: 150px;
  height:50px;
  margin: 0 auto;
  height: 30px;
  line-height: 30px;
  border: 1px solid #AA2666;
  color: white;
  font-weight: bold;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
  background-color: #FF0DFF;
  background-image: -webkit-linear-gradient(bottom, #990000 0%, #990000 100%);
  background-image:         linear-gradient(to bottom, #990000 0%, #B30D5D 100%);
  border-radius: 5px;
}

.button:hover 
{
  background-color: #990099;
  background-image: -webkit-linear-gradient(bottom, #B30D5D 0%, #FB1886 100%);
  background-image:         linear-gradient(to bottom, #B30D5D 0%, #FB1886 100%);
}

.music 
{
  color: #e6e71f;
}

.back, .back:hover 
{
  margin-top: 10px;
}

#sold 
{
 /* background-image: url('../images/logo.png');*/
  display: none;
  text-align: center;
  margin-top: 20em;
  padding-top: 92px;
  z-index: 1;
  width: 900px;
  height: 600px;
  position: absolute;
}

#game-over 
{
  background-image: url('../images/logo.png');
  display: none;
  text-align: center;
  padding-top: 92px;
  z-index: 1;
  width: 900px;
  height: 600px;
  position: absolute;
}
div#profile
{
    background: url('../images//defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 900px;
    height: 600px;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#messages
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 900px;
    height: 600px;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#ranks
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 900px;
    height: 600px;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#search
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 900px;
    height: 600px;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#business
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 900px;
    height: 600px;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
/* Smartphones (portrait) ----------- */
@media only screen and (max-width : 320px) 
{
/* Styles */
	
	#auction
	{
	  background: url('../images/auctionButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;; 
	  cursor:pointer;
	}
	#repair
	{
	  background: url('../images/repairButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;	  
	  cursor:pointer;
	
	  
	}
	#repairBackButton
	{
	  background: url('../images/repairBackButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;		 
	  cursor:pointer;
	
		
	}
	#addFundsBackButton
	{
	  background: url('../images/repairBackButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;		  
	  cursor:pointer;
	
		
	}
	
	#auctionBackButton
	{
	  background: url('../images/repairBackButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;		  
	  cursor:pointer;
	
		
	}
	
	#addFunds
	{
	   background: url('../images/addFundsButton.png') no-repeat 0 0;
	   color: white;
	   font-weight: bold;
	   width:200px;
	   height:100px;		   
	   cursor:pointer;
	}
	#myCars
	{
	   background: url('../images/inventoryButton.png') no-repeat 0 0;
	   color: white;
	   font-weight: bold;
	   width:200px;
	   height:100px;		   
	   cursor:pointer;
	 
	}
	
	#bid
	{
	  background: url('../images/bidButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:200px;		  
	  cursor:pointer;
	
	}
	#purchaseButton
	{
	  background: url('../images/bidButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;	
	  cursor:pointer;
	
	}
	
	
	.sound-off 
	{
	  background-image: url('../images/soundOff.png');
	  background-repeat: no-repeat;
	}
	
	#main 
	{
	  display: none;
	  height: 100%;
	  overflow: auto;
	  margin: auto;
	  position: absolute;
	  top: 0; left: 0; bottom: 0; right: 0;
	}
	#menu.gameMenu
	{
		
	  /*background-image: url('../images/logo.png');*/
	  display:inline-block;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;
	  position: absolute;
	
	}
		
	.button 
	{
	  display: block;
	  width: 200px;
	  height:200px;
	  margin: 0 auto;
	  height: 30px;
	  line-height: 30px;
	  border: 1px solid #AA2666;
	  color: white;
	  font-weight: bold;
	  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
	  background-color: #FF0DFF;
	  background-image: -webkit-linear-gradient(bottom, #990000 0%, #990000 100%);
	  background-image:         linear-gradient(to bottom, #990000 0%, #B30D5D 100%);
	  border-radius: 5px;
	 }

	
	.button:hover 
	{
	  background-color: #990099;
	  background-image: -webkit-linear-gradient(bottom, #B30D5D 0%, #FB1886 100%);
	  background-image:         linear-gradient(to bottom, #B30D5D 0%, #FB1886 100%);
	}
		
	#main 
	{
	  display: none;
	  height: 100%;
	  overflow: auto;
	  margin: auto;
	  position: absolute;
	  top: 0; left: 0; bottom: 0; right: 0;
	}
	#menu.gameMenu
	{
		
	  /*background-image: url('../images/logo.png');*/
	  display:inline-block;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;
	  position: absolute;
	
	}
	#money
	{
	 color:aqua;
		
	}
	#enemyBid
	{
	 color:aqua;
		
	}
	
	#gameMenu 
	{
	
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	  
	  position: absolute;
	}
	#gameMenu  li 
	{
	  padding: 10px 0;
	  display:inline;
	  margin: 8px;
	  margin-top: 8em;
	}
	
	#Auction
	{
	  
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	  
	  position: absolute;
	}
	
	#menu.Auction
	{
		
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	  
	  position: absolute;
	
	}
	#Auction  li 
	{
	  padding: 5px 0;
	}
	
	#RepairShop
	{
	  
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	  
	  position: absolute;
	}
	
	#menu.RepairShop
	{
		
	 
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	  
	  position: absolute;
	
	}
	#RepairShop  li 
	{
	  padding: 5px 0;
	}
	#AddFunds
	{
	  background-image: url('../images/logo.png');
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	  
	  position: absolute;
	}
	
	#menu.AddFunds
	{
		
	 background-image: url('../images/logo.png');
	  display: none;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 60%;
	  height: 100%;	
	  position: absolute;
	
	}
	#AddFunds  li 
	{
	  padding: 5px 0;
	}
	
	
	#main h1 
	{
	  color: #AFCAAF;
	  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
	}


}

/* iPads (portrait and landscape) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
{
/* Styles */
}

/* iPads (landscape) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) 
{
/* Styles */
	
	#auction
	{
	  background: url('../images/auctionButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px; 
	  cursor:pointer;
	}
	#repair
	{
	  background: url('../images/repairButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;
	  cursor:pointer;

	}
	#repairBackButton
	{
	  background: url('../images/repairBackButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;	  cursor:pointer;

	}
	#addFundsBackButton
	{
	  background: url('../images/repairBackButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;	 
	  cursor:pointer;
	
	}
	
	#auctionBackButton
	{
	  background: url('../images/repairBackButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;	  
	  cursor:pointer;
		
	}
	
	#addFunds
	{
	   background: url('../images/addFundsButton.png') no-repeat 0 0;
	   color: white;
	   font-weight: bold;
	   width:200px;
	   height:100px;	   
	   cursor:pointer;
	}
	#myCars
	{
	   background: url('../images/inventoryButton.png') no-repeat 0 0;
	   color: white;
	   font-weight: bold;
	   width:200px;
	   height:100px;	   
	   cursor:pointer;
	 
	}
	
	#bid
	{
	  background: url('../images/bidButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;
	  cursor:pointer;
	
	}
	#purchaseButton
	{
	  background: url('../images/bidButton.png') no-repeat 0 0;
	  color: white;
	  font-weight: bold;
	  width:200px;
	  height:100px;
	  cursor:pointer;
	
	}
	
	
	.sound-off 
	{
	  background-image: url('../images/soundOff.png');
	  background-repeat: no-repeat;
	}
	
	#main 
	{
	  display: none;
	  height: 100%;
	  overflow: auto;
	  margin: auto;
	  position: absolute;
	  top: 0; left: 0; bottom: 0; right: 0;
	}
	#menu.gameMenu
	{
		
	  /*background-image: url('../images/logo.png');*/
	  display:inline-block;
	  text-align: center;
	  padding-top: 92px;
	  z-index: 1;
	  width: 140%;
	  height: 100%;
	  position: absolute;
	
	}

}

/* iPads (portrait) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) 
{
/* Styles */
}
/**********
iPad 3
**********/
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) 
{
/* Styles */
}

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) 
{
/* Styles */
}
/* Desktops and laptops ----------- */
@media only screen  and (min-width : 1224px) 
{
/* Styles */