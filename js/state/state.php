<?php
//
//state\meta.php
//Created by Tyler R. Drury,
//(C) 8.5:1 Entertainment, All Rights Reserved
//
header('Content-type: application/javascript; charset: UTF-8');
//js/state meta header, including all js into a single source file,
//less code is repeated as this header call needs to be made only once,
//opposed to at the start of each individual file
//require_once 'auction.php';
require_once 'garage.php';
//require_once 'carView.php';
require_once 'store.php';
require_once 'AuctionSelect.php';
require_once 'SaleView.php';
require_once 'profile.php';
require_once 'repair.php';
//require_once 'slots.php';
//require_once 'AuctionSell.php';
//require_once 'AuctionSelect.php';
?>