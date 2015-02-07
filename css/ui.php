<?php
//functions which output common CSS properties
function defaultBG(){
    echo "background:url('../images/defaultBG.jpg') no-repeat 0 0;";
    echo "background-size:100% 100%;";
}
function defaultBtnBG(){
    echo "background:url('../images/defaultBtn.png') no-repeat 0 0;";
    echo "background-size:100% 100%;";
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

class css{
    public static function color($color = 'red'){
        //string representing hex, word(ie red, white, blue), or rbga
        echo 'color:'.$color.';';
    }
    public static function width($str){
        //if( (int)$str > 0){
        echo 'width:'.$str.';';
        //}
        //else throw outOfBounds or not convertable to int
    }
    public static function height($str){
        echo 'height:'.$str.';';
    }
    //static interface to function generating common css fragments
    public static function size($width = '100%', $height = '100%'){
        css::width($width);
        css::height($height);
    }
}
?>