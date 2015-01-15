<?php
//functions which output common CSS properties
class css{
    //static interface to function generating common css fragments
}
function defaultBG(){
    echo "background:url('../images/defaultBG.jpg') no-repeat 0 0;";
}
function defaultBtnBG(){
    echo "background:url('../images/defaultBtn.png') no-repeat 0 0;";
}
function defaultColor($color = 'red'){
    echo 'color:'.$color.';';
}
function fontBold(){
    echo 'font-weight:bold;';
}
function posAbs(){
    echo 'position:absolute;';
}
function cursorPtr(){
    echo 'cursor:pointer;';
}
function displayNone(){
    echo 'display:none;';
}
function displayInline(){
    echo 'display:inline;';
}
function cssWidth($str){
    //if( (int)$str > 0){
    echo 'width:'.$str.';';
    //}
    //else throw outOfBounds or not convertable to int
}
function cssHeight($str){
    echo 'height:'.$str.';';
}
function cssSize($width = '600px', $height = '900px'){
    cssWidth($width);
    cssHeight($height);
}
?>