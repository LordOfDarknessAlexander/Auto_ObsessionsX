<div id='AuctionSelect'>
    <h1>Auction Select</h1>
    <!--<backBtn();>select which car to bid for-->
    <button id='asBackBtn'>Back</button>
    <div id='carView'>
        <ul id='auctionCars'>
            <!--list populated by application xml database-->
        </ul>
    </div>
</div>

<div id="Auction">
    <h1>Auction</h1>
    
     <div style="margin-top:-6em;margin-left:26em">
       <p>Money<label id='money'>  money</label></p>
    </div>

    <!--label id='myCash'>money</label>
    <label id='carPrice'>price</label-->
    <ul>
      <li><button id="bid">"Bid:money"</button></li>
    </ul>
    <ul>
    <button id="backBtn">Back</button>
    </ul>
    <!--<
    backBtn();
    carInfoLabel();
    homeBtn();>-->
    <img id='auctionCar'>
    <label id='carPrice'></label>
    <label id='carInfo'></label>
    <button id='homeBtn'>Home</button>
</div>

<div id='AuctionSell'>
    <h1>Auctioned Cars</h1>
    <!--<backBtn();>select which car to bid for-->
    <button id='backBtn'>Back</button>
    <button id='homeBtn'>Home</button>
    <div id='carView'>
        <ul id='auctionCars'>
            <li>
                <img src=''>
                <label id='carInfo'>CarName-CarInfo<br></label>
                <button id='0'>
                    <label id='price'>$carPrice</label><br>
                    Auction expires:<label id='expireTime'></label>
                </button> 
            </li>
            <br>
            <!--populated by application with format:
            <img><label></><button></>-->
        </ul>
    </div>
</div>