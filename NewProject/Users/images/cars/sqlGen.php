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
    if($str == 'Audi'){
        return 0x01000000;
    }elseif($str == 'Bentley'){
        return 0x02000000;
    }elseif($str == 'BMW'){
        return 0x03000000;
    }elseif($str == 'Buick'){
        return 0x04000000;
    }elseif($str == 'Chevrolet'){
        return 0x05000000;
    }elseif($str == 'Ferrari'){
        return 0x06000000;
    }elseif($str == 'Ford'){
        return 0x07000000;
    }elseif($str == 'Jaguar'){
        return 0x08000000;
    }elseif($str == 'GMC'){
        return 0x09000000;
    }elseif($str == 'Lamborghini'){
        return 0x0A000000;
    }
?><br><?php
    echo 'invalid value: ' . $str;
?><br><?php
    //exit(); //kill the script if wrong value, don't want 
    /*
07-
08-
09-Lamborghini
0A-Porsche
0B-Shelby
0C-
0D-
0E-
0F-
//
10-
11-
12-*/
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
                $yHash = (intval($year) - 1908) << 8;    //0x0000FFFF << 8;
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