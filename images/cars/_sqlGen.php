<?php
//This script generates entries into the vehicle sql database table aoCars!
//This page is PRIVATE, not accessible on the server, FOR DEV USE ONLY
//This script should only exist in your local project and should only be
//on the server for the brief moments when the database must be updatedds
require_once '../../include/dbConnect.php';
require_once '../../secure.php';
//secure::adminLogin();
echo 'executing script in directory: ' . __DIR__;
?><br>
<?php
//in the original document, the attribute is specified as 'class',
//which is reserved in phpo and html, so will be designated as the vehicle's 'type' attribute, instead.

/*class aoCarType{
    const CLASSIC = 'classic',
        CUSTOM = 'custom',
        MUSCLE = 'muscle',
        FOREIGN = 'foreign',
        UNIQUE = 'unique';
}*/
//each can be broken down into sub-ranges, based on price, to be used with sql when retriving database entries
//low(10-30k),
//mid(30-75k),
//high(75-150k),
//elite(150k+)

function getMakeHash($str){
    //0 is a reserved value and is not used
    //returns an integer value based on the in-game manufactures(those with folders is images/cars/)
    if($str == 'Acura'){
        return 0x01000000;
    }elseif($str == 'AMC'){
        return 0x02000000;
    }elseif($str == 'American'){
        return 0x03000000;
    }elseif($str == 'Amphicar'){
        return 0x04000000;
    }elseif($str == 'Aston-Martin'){
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
    }
?><br><?php
    echo 'invalid value: ' . $str;
?><br><?php
    //exit(); //kill the script if invalid value
}
//generate xml with default nodes
//creates an xml document, populating it with default entries,

//echo $root->tagName;

//$id = '_' . strval(4);  //NOTE:XML ID attribute cannot start with a digit, so prefix with underscore :(
//$el = $doc->getElementById($id);

//if($el === null){
    //entry does not exist in xml, add new default entry
    //echo "does not have element with id: $id";
    //$node = $doc->createElement('car', 'Default Car Info');
    //$node->setIdAttribute('id', true);
    //$node->setAttribute('id', $id);
    //$node->setAttribute('price', '0');
    
    //$root->appendChild($node);
//}
//else{
    //already exists, do nothing and preserve data
    //echo "entry exists with id:$id";
//}
//$cars = $root->getElementsByTagName('car');

//if(!hasElementWithID $id){

//$doc->save($xmlPath);

//foreach($cars as $c){
    //echo $c->textContent;
    //echo '<br>';
//}
//echo $root->getElementById('24577')->textContent;
//
//if(false){
$xmlPath = __DIR__ . '/_cars.xml';
//open xml document containing additional properties
$doc = new DOMDocument();
//must be set before calling load!
$doc->formatOutput = true;
$doc->preserveWhiteSpace = false;
$doc->validateOnParse = true;   //must be enabled to use getElementByID
$doc->load($xmlPath);
$doc->validate();
//
$root = $doc->documentElement;

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
                            $model = $AO_DB->strip($n); //replace special chars
                            //echo '    ' . $n;
                            if(isset($make) && isset($year) && isset($model) ){
                                $id = $mHash | $yHash | $nameHash;
                                $node = $doc->getElementById('_' . strval($id) );
                                $price = 10000;
                                $info = 'Default info';
                                $type = 'NOT_SET';
                                
                                if($node === null){
                                    echo "no entry with id: _$id, in source xml document $xmlPath, adding entry!<br>";
                                    echo 'setting default values for price and info, please change these entries manually!<br>';
                                    
                                    $node = $doc->createElement('car', 'Default Car Info');
                                    $node->setAttribute('id', '_' . strval($id) );
                                    $node->setAttribute('price', strval($price) );
                                    $node->setAttribute('type', $type);
                                    $node->setIdAttribute('id', true);
                                    
                                    $root->appendChild($node);
                                }
                                else{
                                    //trim() values from xml, to remove whitespace from string values,
                                    //as a safety precaution in case someone is daft enough to add whitespace to the source text,
                                    //or evil enough to attempt to hack our database
                                    $price = floatval(filter_var(trim($node->attributes->getNamedItem('price')->nodeValue), FILTER_SANITIZE_NUMBER_FLOAT) );
                                    $info = filter_var(trim($node->textContent), FILTER_SANITIZE_STRING);
                                    $type = filter_var(trim($node->attributes->getNamedItem('type')->nodeValue), FILTER_SANITIZE_STRING);
                                    //$info can only be a certain length(128 chars),
                                    //so make sure it is by removing any values outside the bounds
                                    //$info = 
                                    //if(!$price OR !$info OR !$type){
                                        //data failed sanitization, so skip
                                        //continue;
                                    //}
                                }
                                
                                $y = intval($year);
                                //echo 'variables set!';
                                $aoCars = 'aoCars';
                                $q = "INSERT INTO $aoCars 
                                    (`car_id`, `make`, `year`, `model`, `price`, `info`, `type`) 
                                    VALUES
                                    ($id, '$make', $y, '$n', $price, '$info', '$type')
                                    ON DUPLICATE KEY UPDATE price = $price, type = '$type', info = '$info'";
?><br><?php
//echo $q;
?><br><?php
                                if($AO_DB->query($q) == TRUE){
                                    echo "added element with id: $id, to database!";?><br><?php
                                }else{
                                    echo "failed to add entry with id: $id, error: " . mysqli_error($AO_DB->con);
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

$doc->save($xmlPath); //save if changes made

//$q = "INSERT INTO aoCars (`car_id`, `make`, `year`, `model`, `price`, `info`) VALUE ($id, '$m', $y, '$n', 5000, 'default info');"// ON DUPLICATE KEY UPDATE VALUES();";

//if($AO_DB->query($q) == TRUE){
    //echo 'add element worked!';
//}else{
    //echo 'Failed to add element, error occurred: ' . mysqli_error($AO_DB->con);
//}
//}
?>