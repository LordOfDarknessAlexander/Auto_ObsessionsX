<?php
//functions which output common CSS properties
function defaultBG(){
    css::defaultBG('../images/bgTile.png');
    //echo "background-size:100% 100%;";
  //  css::bgSize('100%', '100%');
}
function defaultBtnBG(){
    css::defaultBG('../images/defaultBtn.png');
    //echo "background-size:100% 100%;";
    css::bgSize('100%', '100%');
}

function defaultColor($color = 'red'){?>    color:<?php echo $color;?>;
<?php
}
function fontBold(){?>    font-weight:bold;
<?php
}
function posAbs(){?>    position:absolute;
<?php
}
function cursorPtr(){?>    cursor:pointer;
<?php
}
function displayNone(){
    echo 'display:none;';
}
function displayInline(){
    echo 'display:inline;';
}
//enable y scrolling
function scrollY(){?>    overflow-y:scroll;
<?php
}

class css{
    public static function color($color = 'red'){
        //string representing hex, word(ie red, white, blue), or rbga
        ?>    color:<?php echo $color;?>;
<?php
    }
    public static function width($str){
        //if( (int)$str > 0){
        ?>    width:<?php echo $str;?>;
<?php
        //}
        //else throw outOfBounds or not convertable to int
    }
    public static function height($str){
        ?>    height:<?php echo $str;?>;
<?php
    }
    //static interface to function generating common css fragments
    public static function size($width = '100%', $height = '100%'){
        css::width($width);
        css::height($height);
    }
    public static function defaultBG($url){
        //default background image css fragment
        //image does not repeat and is positioned at (0,0)?>
    background:url('<?php echo $url;?>');
<?php
    }
    public static function bgSize($width, $height){?>
    background-size:<?php echo $width;?> <?php echo $height;?>;
<?php
    }
    public static function defaultTileBG(){
        //CSS shorthand for the site's default tiled BG
        //image tile image, set background to black and 
        //position at (0,0)
        //css::bgSize('100%', '100%');?>
    background:#000000 url('../images/bgTile.png') repeat 0 0;
<?php
    }
    public static function header(){
        header("Content-type: text/css; charset: UTF-8");
    }
    public static function right($str){?>
    right:<?php echo $str;?>;
<?php
    }
    public static function left($str){?>
    left:<?php echo $str;?>;
<?php
    }
    public static function top($str){?>
    top:<?php echo $str;?>;
<?php
    }
    public static function bottom($str){?>
    bottom:<?php echo $str;?>;
<?php
    }
    public static function rm(){  //right margin
        $hp = 5.0;  //horizontal padding
        css::right(strval($hp) . '%');
    }
    public static function lm(){  //left margin
        $hp = 5.0;  //horizontal padding
        css:: left(strval($hp) . '%');
    }
    public static function marginBtm(){
        //nav bottom margin
        $v = 2.0;
        css::bottom(strval($v) . '%');
    }
    //font
    public static function fontBold(){?>    font-weight:bold;
<?php
    }
}
//any file including this one MUST be a CSS file, so output the header when included
//css::header();
?>