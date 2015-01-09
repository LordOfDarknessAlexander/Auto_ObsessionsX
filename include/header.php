<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,orientation=portrait">
    <?php
function charset(){
    ?>
<meta charset='UTF-8'>
    <?php
}
    //$DOCTYPE = "<!DOCTYPE html>";
    $PAGE_TITLE = 'Auto Obsessions';
    charset();
    echo "<title>".$PAGE_TITLE."</title>";
    require_once("metaCSS.php");
    require_once("metaJS.php");
    ?>
</head>
<body>
<!--devs can customize <body>'s content for each app,
without having to reapeat the code bloat,
additionally, the paths are conditional on the files being hosted by server in ROOT_DIR,
devs may change the contents of these file stubs to suit their needs-->