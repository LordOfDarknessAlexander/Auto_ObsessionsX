<div id="gameMenu">
    <!--Root Game Menu, hub for page navigation-->
     <h1>My Home</h1>
     <!--HUD ---->
    <div id='statBar'>             
        <label id='money'>Money: </label>
        <label id='tokens'>Tokens:</label>
        <label id='prestige'>Prestige:</label>
        <label id='mileMarker'>Mile Makers:</label>
    </div> 
    <ul>
   
      <!--li><input type="button" id="auction" value="Auction" onmouseover="auctionButton()" onclick="auctionMode()"></li-->
      <li style="margin-top:26em"><input type="button" id="addFunds" value="Add Funds" onmouseover="addFundsButton()" onclick="addFundMode()"></li>
      <!--li><input type="button" id="repair" value="Repair" onmouseover="repairButton()" onclick="repairState()"></li-->
      <!--li><input type="button" id="myCars" value="My Cars" onmouseover="inventoryButton()" onclick="inventoryState()"></li-->
    </ul>
 
    <img id='homeImg' src='images\\garageEmpty.png'>
    <div id='menuRight'>
        <button id='profile'>My Profile</button><br>
        <button id='messages'>My Messages</button><br>
        <button id='rankings'>Rankings</button><br>
        <button id='search'>Search</button><br>
        <button id='buyBusiness'>Buy Business</button><br>
        <button id='FAQ/Tutorial'>FAQ/Tutorial</button><!--link to another/seperate page?-->
    </div>
    <div id='menuLeft'>
        <button id='myCars'>My Vehicles</button><br>
        <button id='projectsBtn'>My Projects</button><br>
        <button id='myGarageBtn'>My Garage</button><br>
        <button id='toAuctionBtn'>Go to Auction</button><br>
        <button id='partsSupplyBtn'>Select Parts Supply</button><br>
        <button id='buyUpgradesBtn'>Buy Upgrades</button><!--link to another/seperate page?-->
    </div>
    <img id='adBar'>
</div><!--end Game Menu-->