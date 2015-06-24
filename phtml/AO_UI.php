<?php
//this file contains functions for generating
//HTML UI elements
function backBtn(){?>
    <button id='backBtn'></button>
<?php
}
function homeBtn(){?>
    <button id='homeBtn'></button>
<?php
}
function carInfoLabel(){?>
    <label id='carInfo'>Default Info</label>
<?php
}
function pb($id){
    //outputs a html progress bar, defaulted to 0?>
    <progress id='<?php echo $id;?>' value='0.0'></progress>
<?php
}
function br(){
    //outputs a line break?>
<br>
<?php
}
function hr(){
    //outputs a line break?>
<hr>
<?php
}
function carFilter(){
    //?>
<div id='filter'><!--action='javascript:void(0)'-->Filters<hr>
    <div id='stage'>stage<br>
        <button id='slctAllF'>All</button><br>
        <button id='slctClassic'>Classic</button><br>
        <button id='slctCustom'>Custom</button><br>
        <button id='slctMuscleF'>Muscle</button><br>
        <button id='slctUnique'>Unique</button><br>
        <button id='slctForeign'>Foreign</button><br>
    </div>
    <div id='tier'>tier<br>
        <button id='slctAll'>All</button><br>
        <button id='slctLow'>Low</button><br>
        <button id='slctMid'>Mid</button><br>
        <button id='slctHigh'>High</button><br>
        <button id='slctElite'>Elite</button><br>
    </div>
    <br>
    <!--input id='showDisabled' type='checkbox' value=''>
    display unavailable auctions-->
    <!--input id='submit' type='submit' value='submit'-->
</div>
<?php
}
?>