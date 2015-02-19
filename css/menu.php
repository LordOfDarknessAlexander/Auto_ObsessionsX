<?php
header("Content-type: text/css; charset: UTF-8");
//main/root menu UI stylings
require_once 'ui.php';
    
function divHome(){
    echo 'div#menu';
}
?>
<?php divHome();?>
{<?php
    posABs();
?>
  height:100%;
  width: 100%;
  border: 1px solid black;
  z-index: 2;
  text-align: center;
  background-color: black;
}
<?php divHome();?>.main 
{
  background-image:url('../images/AbsuMenu.png');
  background-size: 100% 100%;
  height:100%;
  width: 100%;
}

<?php divHome();?>.credits 
{
  background-image: url('../images/credits-bg.png');
}

<?php divHome();?>.gameMenu
{
  /*background-image: url('../images/logo.png');*/
  display:inline-block;
  text-align: center;
  padding-top: 92px;
  z-index: 1;
  width: 100%;
  height: 100%;
  position: absolute;

}
<?php divHome();?>.Auction
{
  display: none;
  text-align: center;
  padding-top: 92px;
  z-index: 1;
  width: 100%;
  height: 100%;
  position: absolute;
}
<?php divHome();?>.RepairShop
{
  display: none;
  text-align: center;
  padding-top: 92px;
  z-index: 1;
  width: 100%;
  height: 100%;
  position: absolute;
}
<?php divHome();?>.AddFunds
{
  background-image: url('../images/logo.png');
  display: none;
  text-align: center;
  padding-top: 92px;
  z-index: 1;
  width: 100%;
  height: 100%;
  position: absolute;

}