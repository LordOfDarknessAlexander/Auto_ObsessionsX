<?php
//require_once '../include/dbConnect.php';
require_once 'part.php';
//
class Vehicle
{   //class representing a Vehicle on the server
    //private const
    private
        $_id,   //uint
        $_make,  //str
        $_year,  //uint
        $_model, //str
        $_price, //uint
        $_info;  //str
        //$_upgrades,
        //$repairs;
    
    public function __construct($id, $make, $year, $model, $price, $info){  //$upgrades, $repairs
        $this->_id = $id;
        $this->_make = $make;
        $this->_year = $year;
        $this->_model = $model;
        $this->_info = $info;
        $this->_price = $price;
        //echo $this->_make;
        //echo $this->_year;
        //echo $this->_model;
        //echo $this->_info;
        //echo $this->_price;
        //echo '<br>';
    }
    public static function fromArray($array){
        return new Vehicle(
            intval($array['car_id']),
            $array['make'],
            intval($array['year']),
            $array['model'],
            intval($array['price']),
            $array['info']
        );
    }
    //public static function fromPost(){
        //global $AO_DB;
        //return new Vehicle(
            //$AO_DB.strip($array['make']),
            //intval($array['year'],
            //$AO_DB.strip($array['model'],
            //intval($array['price']),
            //$array['$info']
        //);
    //}
    public function getID(){
        return $this->_id;
    }
    //public infoFromID(){}
    public function getFullName(){
        //return a human readable name
        return $this->_make . ' ' . $this->_year . ' ' . $this->_model;
    }
    public function getLocalPath(){
        //local path in project
        return $this->_make . '/' . $this->_year . '/' . $this->_model . '.jpg';
    }
    public function getFullPath(){
        $ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'.'images/cars/';
        return $ROOT_URL . $this->getLocalPath();
    }
    public function getPrice(){
        //returns price after accumulating upgrades and repairs
        $price = $this->_price;
        //foreach($upgrades as $u){
            //$price += $u->getPrice();
        //}
        return $price;
    }
    public function getInfo(){
        return $this->_info;
    }
    //public static function fromPost(){
        //initialize a single vehicle with values POSTed to the page
    //}
    public function toJSON(){
        //returns json representation of the vehicle data, for transfer over internet
        //Fix:accessing object values doesn't work!
        return '{"data":"this is data!"}';
        //'{"make": "", "year":"", "name":"", "info":"", "price":""}';
        //$this->_make;//, "year":"'.$this->_year.'", "name":"'.$this->_name.'", "info":"'.$this->_info.'", "price":"'.$this->_price.'"';
    }
    public function applyUpgrades(){
        //if this vehicle is in the users inventory/garage, apply upgrades
        //only vehicles the user has have upgrades/repairs
        //global $aoUserCars;
        $tableID = 'user' . strval(0);
        //$res = $aoUserCars->query("SELECT * FROM $tableID WHERE car_id = $id");
        //if($res){
            //$a = mysqli_fetch_assoc($res);
            //vehicle being created is in users inventory/garage
            $upgrades = 0x00000001; //res['upgrades'];
            //iterate over first 24 bits, lats 8 bits and ever fourth bit is reserved! values should be 1,2 or 4
            for($i = 0; $i <= 18; $i++){
                $val = $upgrades & (1 << $i);  //filter bits
                if($val){   //vehicle has upgrade
                    echo $val;
                    //$this->_upgrades[] = Part($val);
                }
            }
            $repairs = 0x00101042;  //res['repairs'];
      
            //for($i = 0; $i <= 18; $i++){
                //$val = $upgrades & (1 << $i);  //filter bits
                //if($val){
                    //$this->_repairs[] = Part($val);
                //}
            //}
        //}
        //else create new car with no repairs or upgrades
    }
}
?>