<?php
//require_once '../pas/get.php';    //this is causing game to break :(
//require_once 'pas/profile.php';
//$stats = pasGet::userSaleStats();
?>
<div id='profile'>
    <button id='backBtn'></button>
    <!---->
    <div id='userStats'>
<h2 id='purch'>Purchasing</h2>
<hr>
Cars Owned:<p id='cco'><?php //echo pasGet::userCarCount();?></p><br>
Cars Purchased:<label id='tcp'><?php ?></label><br>
Upgrades Purchased:<label id='tup'><?php ?></label><br>
<h2 id='statSales'>Sales</h2>
<hr>
Cars Sold:<label id='tcs'><?php //echo pasGet::userSaleCount();?></label><br>
<h2>Auctions</h2>
<hr>
Auction Wins:<label id='aWins'><?php ?></label><br>
Auction Losses:<label id='aLosses'><?php ?></label><br>
Average:<label id='aAvg'><?php ?></label><br>
    </div>
    <!---->
    <div id='salesInfo'>
<h2 id='inc'>Income</h2>
<hr>
Total Funds Purchased:<label id='tfp'></label><br>
Total Tokens Purchased:<label id='ttp'></label><br>
Allowance per Hour:<label id='aph'></label><br>
Total Allowance Earned:<label id='tae'></label><br>
<hr>
Total Invested in Cars:<label id='tic'></label><br>
Total Invested in Upgrades:<label id='tiu'></label><br>
<h2 id='incSales'>Sales</h2>
<hr>
Total Funds Spent:<label id='tfs'></label><br>
Total Tokens Spent:<label id='tts'></label><br>
Total Paid to Auction House:<label id='tpAH'></label><br>
<h2>Profits</h2>
<hr>
Net Sales Profit:<label id='nsp'></label><br>
Gross Sales Profit:<label id='gsp'></label><br>
Difference:<label id='ngd'></label><br>
<!--average the user 'over bids' on sales-->
average gain/loss per trade:<label id='aGL'></label><br>
    </div>
</div>