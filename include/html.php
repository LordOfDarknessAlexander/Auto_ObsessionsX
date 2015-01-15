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
    //public static function title($str){
        //echo "<title>".$str."</title>";
    //}
    public static function header(){
        //default header for application, can be changed in derived classes
        html::docType();
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,orientation=portrait">
<?php
    html::charset();
    //<meta name'keywords' content='Car, Auction'>
    //html::title($PAGE_TITLE);
    echo "<title>".$PAGE_TITLE."</title>";
    require_once 'metaCSS.php';
    require_once 'metaJS.php';
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
}
?>