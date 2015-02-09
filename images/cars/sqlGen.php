<?php
//This script generates entries into the vehicle sql database table aoCars!
require_once '../../include/dbConnect.php';
require_once '../../include/secure.php';
//secure::adminLogin();
echo 'executing script in directory: ' . __DIR__;
?><br>
<?php
function getMakeHash($str){
    //0 is a reserved value and is not used
    if($str == 'Acura'){
        return 0x01000000;
    }elseif($str == 'AMC'){
        return 0x02000000;
    }elseif($str == 'American'){
        return 0x03000000;
    }elseif($str == 'Amphicar'){
        return 0x04000000;
    }elseif($str == 'Aston-Matrin'){
        return 0x05000000;
    }elseif($str == 'Auburn'){
        return 0x06000000;
    }elseif($str == 'Bentley'){
        return 0x07000000;
    }elseif($str == 'BMW'){
        return 0x08000000;
    }elseif($str == 'Buick'){
        return 0x09000000;
    }elseif($str == 'Cadillac'){
        return 0x0A000000;
    }elseif($str == 'Chevrolet'){
        return 0x0B000000;
    }elseif($str == 'Chrysler'){
        return 0x0C000000;
    }elseif($str == 'Delorean'){
        return 0x0D000000;
    }elseif($str == 'Devin'){
        return 0x0E000000;
    }elseif($str == 'Dodge'){
        return 0x0F000000;
    }elseif($str == 'Duesenberg'){
        return 0x10000000;
    }elseif($str == 'Dunbar'){
        return 0x11000000;
    }elseif($str == 'Excalibur'){
        return 0x12000000;
    }elseif($str == 'Ferrari'){
        return 0x13000000;
    }elseif($str == 'Ford'){
        return 0x14000000;
    }elseif($str == 'Hotchkiss'){
        return 0x15000000;
    }elseif($str == 'Hudson'){
        return 0x16000000;
    }elseif($str == 'Jaguar'){
        return 0x17000000;
    }elseif($str == 'Kaiser-Darrin'){
        return 0x18000000;
    }elseif($str == 'Lamborghini'){
        return 0x19000000;
    }elseif($str == 'Mercedes-Benz'){
        return 0x1A000000;
    }elseif($str == 'Mercury'){
        return 0x1B000000;
    }elseif($str == 'MG'){
        return 0x1C000000;
    }elseif($str == 'Packard'){
        return 0x1D000000;
    }elseif($str == 'Plymouth'){
        return 0x1E000000;
    }elseif($str == 'Pontiac'){
        return 0x1F000000;
    }elseif($str == 'Porsche'){
        return 0x20000000;
    }elseif($str == 'Roamer'){
        return 0x21000000;
    }elseif($str == 'Rolls Royce'){
        return 0x22000000;
    }elseif($str == 'Shelby'){
        return 0x23000000;
    }elseif($str == 'Studebaker'){
        return 0x24000000;
    }elseif($str == 'Triumph'){
        return 0x25000000;
    }elseif($str == 'White'){
        return 0x26000000;
?><br><?php
    echo 'invalid value: ' . $str;
?><br><?php
    //exit(); //kill the script if invalid value
}
foreach(new DirectoryIterator(__DIR__) as $file){
    $id = 0;
    //foreach manufacturer
    if($file->isDir() && !$file->isDot() ){
        $path = $file->getPathname();   //full path and file name
        $make = $file->getBasename();   //name of trailing dir
        $mHash = getMakeHash($make);
        //$next = __DIR__ . '\\' . $path;
        //echo $path;
        foreach(new DirectoryIterator($path) as $years){
            //for each year folder
            if($years->isDir() && !$years->isDot()){
                $p = $years->getPathname();
                $year = $years->getBasename();
                //shift integer so padding for make and model
                //1906, earliest vehicle in database
                $yHash = (intval($year) - 1906) << 8;    //0x0000FFFF << 8;
                //$next = __DIR__  . '\\' . $p;
                //echo $p;
                $nameHash = 0x00000000;
                foreach(new DirectoryIterator($p) as $name){
                    //for each car in folder
                    if($name->isFile() ){
                        if($name->getExtension() == 'jpg'){
                            //cap the number of cars to 255(0xFF) per year
                            if($nameHash < 0xFF){
                                $nameHash++;
                            }
                            $n = $name->getBasename('.jpg');
                            $model = $n;
                            //echo '    ' . $n;
                            if(isset($make) && isset($year) && isset($model) ){
                                $id = $mHash | $yHash | $nameHash;
                                $y = intval($year);
                                //echo 'variables set!';
                                $q = "INSERT INTO aoCars 
                                (`car_id`, `make`, `year`, `model`, `price`, `info`) 
                                VALUE
                                ($id, '$make', $y, '$n', 5000, 'default info');";
                                // ON DUPLICATE KEY UPDATE VALUES();";
?><br><?php
echo $q;
?><br><?php
                                if($AO_DB->query($q) == TRUE){
                                    echo 'add element worked!';
                                }else{
                                    echo 'failed to add entry, error: ' . mysqli_error($AO_DB->con);
                                    ?><br><?php
                                }                           
                            }
                        }
                    }
                    else{
                        //skipping directory or file
                    }
                }
            }
        }
    }
    if($file->isFile() ){
        //do nothing
    }
}

//$q = "INSERT INTO aoCars (`car_id`, `make`, `year`, `model`, `price`, `info`) VALUE ($id, '$m', $y, '$n', 5000, 'default info');"// ON DUPLICATE KEY UPDATE VALUES();";

//if($AO_DB->query($q) == TRUE){
    //echo 'add element worked!';
//}else{
    //echo 'Failed to add element, error occurred: ' . mysqli_error($AO_DB->con);
//}
?>