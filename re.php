<?php
//Common functions used across all scripts for validating input via $_POST and/or $_GET
function isAlpha($str){
    //is a singular word, containing only letters(a-z and/or A-Z),
    //no special characters, whitespace or symbols
    //+ matches 0 or more repetitions
    return preg_match('/^[[:alpha:]]+$/', $str);
}/*
function isWord($str){
    //is a singular word, containing only letters,
    //no special characters, whitespace or symbols
    return preg_match('/^[[:word:]]+$/', $str);
}
function isNumber($str){
    //is string a continuous series of digits
    //no special characters, letters, whitespace or symbols
    return preg_match('/^[[:digit:]]+/$', $str);
}
function isPassword($str){
    //validates a series of {8-12} characters of digits and/or letters
    //no special characters, whitespace or symbols
    return preg_match('/^\w{8,12}$/', $str);
}*/
?>	