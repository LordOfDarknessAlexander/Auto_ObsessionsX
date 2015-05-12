<?php
//Common functions used across all scripts for validating input via $_POST and/or $_GET
function isAlpha($str){
    //is a singular word, containing only letters(a-z and/or A-Z),
    //no special characters, whitespace or symbols
    //+ matches 1 or more repetitions of pattern,
    //NOTE: string can be ANY SIZE, from 1 to Infinity.
    //This could cause memory/security issues with large strings,
    //PHP hard limit for variable allocation is 128MB, could be as large as 2GB!
    //NOTE:Also, as it validates only against numbers and letters,
    //inserting any special characters (%,&,<,>) to induce an attack
    //will be prevented(also, any attempt at escaping the string will cause it to fail)
    return preg_match('/^[[:alpha:]]+$/', $str);
}
function isAlphaSmall($str){
    //is a singular word, containing only letters(a-z and/or A-Z),
    //match must be 1-8 chars(1-byte)
    return preg_match('/^[[:alpha:]]{1,8}$/', $str);
}
//function isAlphaMedium($str){
    //match must be 1-8 bytes
    //return preg_match('/^[[:alpha:]]+{8,64}$/', $str);
//}
//function isAlphaLarge($str){
    //8-64 bytes
    //return preg_match('/^[[:alpha:]]+{64,128}$/', $str);
//}
/*
function isWord($str){
    //is a singular word, containing only letters,
    //no special characters, whitespace or symbols
    return preg_match('/^[[:word:]]+$/', $str);
}
function isNumber($str){
    //is string a continuous series of digits
    //no special characters, letters, whitespace or symbols
    return preg_match('/^[[:digit:]]+/$', $str);
}*/
function isPassword($str){
    //validates a series of {8-12} characters of digits and/or letters
    //no special characters, whitespace or symbols
    return preg_match('/^\w{8,12}$/', $str);
}
//function isArgList($str){
    //
    //return preg_match('/([[:alpha:]]+(,\s*)*)+/', $str;
//}
?>	