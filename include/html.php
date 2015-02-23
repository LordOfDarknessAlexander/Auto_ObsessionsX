<?php
$PAGE_TITLE = 'Auto Obsessions';
class html
{   //static class representing common html document fragments
    public static function docType(){?>
<!DOCTYPE html>
<?php
    }
    public static function charset(){?>
<meta charset='UTF-8'>
<?php
    }
    public static function keywords($str){
        //injects keywords meta-tag at call site,
        //pass in a comma separated list of keywords as a string?>
        <meta name='keywords' content='<?php echo $str;?>'>
<?php
    }
    public static function title($str){
        //injects html title tag at call site?>
        <title><?php echo $str;?></title>
<?php
    }
    public static function header(){
        global $PAGE_TITLE;
        //default header for application, can be changed in derived classes
        html::docType();
?>
<html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1,user-scalable=no,orientation=portrait'>
<?php
    html::charset();
    //html::keywords('Car, Auction, upgrades, hotrods, muscle cars');
    html::title($PAGE_TITLE);
    require_once 'meta.php';    //if no CSS, JS or additional scripts are needed leave file empty
?>
</head>
<body>
<?php
    //devs can customize <body>'s content for each app,
    //without having to reapeat the code bloat,
    //additionally, the paths are conditional on the files being hosted by server in ROOT_DIR,
    //devs may change the contents of these file stubs to suit their needs-->
    }
    public static function footer(){
        //Generic html document footer, nothing special, primarily contains end tags-->
?>
</body>
</html>
<?php
    }
    public static function br(){
        //line break?>
<br>
<?php
    }
    public static function hr(){
        //thematic change?>
<hr>
<?php
    }
    public static function incCSS($str){
        //the html within this function will be injected at the call site?>
<link rel='stylesheet' href='<?php echo "css/".$str.".css";?>' type='text/css' media='screen'>
<?php
    }
    public static function incPHPCSS($str){
        //links a style sheet embedded in php?>
<link rel='stylesheet' href='<?php echo "css/".$str.".php";?>' type='text/css' media='screen'>
<?php
    }
    public static function incJS($str){
    //this script generates the <script> tags to be included in the <head> of the page's html document?>
    <script type='text/javascript' src='<?php echo "js/".$str.".js";?>'></script>
<?php
    }
    public static function simpleHead($title){
        //outputs default, non-secure page header
        html::docType();
?>
<html>
<head>
<?php
        html::charset();
        html::title($title);
?>
    <style>
        body{
            background:url('http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/images/Splash.png'); no-repeat 0 0;
            font-family:Arial, Helvetica, sans-serif;
            font-size:13px;
            color: red;
        }
        li,h1 {color: white;}
        td{
            font-family:Arial, Helvetica, sans-serif;
            font-size:1em;
            color:black;
        }
        hr{ color:#3333cc; width:300; text-align:left;}
        a{ color:darkmagenta; }
    </style>
</head>
<body>
<?php
        //devs add page content after this call
    }
}
?>