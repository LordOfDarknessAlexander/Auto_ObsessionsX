<?php
//$ROOT_DIR = $_SERVER["DOCUMENT_ROOT"]."/phtml/";	//root path on server
?>
<div id="RepairShop">
    <h1>Repair Shop</h1>
    <!--ul>
      <li><input type="button" id="purchaseButton" onmouseover="purchaseButton()" onclick="purchasePart()"></li>
   </ul-->
   <ul>
      <li><input type="button" id="repairBackButton" onmouseover="repairBackButton()" onclick="startGame()"></li>
   </ul>
   
   <div id='upgrades'>
        <h2>Upgrades</h2>
        <!--add parts-->
        <!--buttons added dynamically from script-->
        <button id='ugBtn0'></button><br>
        <button id='ugBtn1'></button><br>
        <button id='ugBtn2'></button><br>
        <button id='ugBtn3'></button><br>
        <button id='ugBtn4'></button><br>
        <button id='ugBtn5'></button>
   </div>
   
   <div id='repairs'>
        <h2>Repairs</h2>
        <!--restore components-->
        <!--buttons altered dynamically from script-->
        <button id='fixBtn0'></button><br>
        <button id='fixBtn1'></button><br>
        <button id='fixBtn2'></button><br>
        <button id='fixBtn3'></button><br>
        <button id='fixBtn4'></button><br>
        <button id='fixBtn5'></button>
   </div>
   <img id='userCar'>
</div>