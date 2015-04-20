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
<pre>Cars Owned:<label id='cco'><?php //echo pasGet::userCarCount();?></label>
Cars Purchased:<label id='tcp'><?php ?></label>
Upgrades Purchased:<label id='tup'><?php ?></label>
</pre>
<h2 id='statSales'>Sales</h2>
<hr>
Cars Sold:<label id='tcs'><?php //echo pasGet::userSaleCount();?></label><br>
<h2>Auctions</h2>
<hr><pre>
Wins:<label id='aWins'><?php ?></label>
Losses:<label id='aLosses'><?php ?></label>
Remaining:<label id='remain'><?php ?></label>
</pre>
    </div>
    <!---->
    <div id='salesInfo'>
<h2 id='inc'>Income</h2>
<hr><pre>
Funds Purchased:<label id='tfp'><?php ?></label>
Tokens Purchased:<label id='ttp'><?php ?></label>
Allowance per Hour:<label id='aph'><?php ?></label>
Total Allowance Earned:<label id='tae'><?php ?></label>
</pre>
<h2 id='inv'>Investments</h2>
<hr><pre>
Total Cars:<label id='tic'><?php ?></label>
Total Upgrades:<label id='tiu'><?php ?></label>
</pre>
<h2 id='incSales'>Sales</h2>
<hr><pre>
Total Funds Spent:<label id='tfs'><?php ?></label>
Total Tokens Spent:<label id='tts'><?php ?></label>
Total Paid to Auction House:<label id='tpAH'><?php ?></label>
</pre>
<h2>Profits</h2>
<hr><pre>
Net Sales Profit:<label id='nsp'><?php ?></label>
Gross Sales Profit:<label id='gsp'><?php ?></label>
Difference:<label id='ngd'><?php ?></label>
<!--average the user 'over bids' on sales-->
Average Gain/Loss per Trade:<label id='aGL'><?php ?></label>
</pre>
    </div>
</div>