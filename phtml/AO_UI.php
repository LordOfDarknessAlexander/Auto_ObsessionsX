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
?>