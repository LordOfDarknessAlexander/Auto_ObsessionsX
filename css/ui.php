<?php
//functions which output common CSS properties
function defaultBG(){
    css::defaultBG('../images/defaultBG.jpg');
    //echo "background-size:100% 100%;";
    css::bgSize('100%', '100%');
}
function defaultBtnBG(){
    css::defaultBG('../images/defaultBtn.png');
    //echo "background-size:100% 100%;";
    css::bgSize('100%', '100%');
}

function defaultColor($color = 'red'){
    echo 'color:' . $color . ';';
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
function scrollY(){
    //enable y scrolling
    echo 'overflow-y:scroll;';
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
    public static function defaultBG($url){
        //default background image css fragment
        //image does not repeat and is positioned at (0,0)?>
        background:url('<?php echo $url;?>') no-repeat 0 0;
    <?php
    }
    public static function bgSize($width, $height){?>
        background-size:<?php echo $width;?> <?php echo $height;?>;
    <?php
    }
    public static function header(){
        header("Content-type: text/css; charset: UTF-8");
    }
}
?>