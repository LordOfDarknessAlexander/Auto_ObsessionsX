<?php
class Vehicle
{   //class representing a Vehicle on the server
    //private const
    private
        $make,
        $year,  //uint
        $model,
        $price, //uint
        $info;
    
    public function __construct($make, $year, $model, $info, $price){
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
            $array['make'],
            intval($array['year']),
            $array['model'],
            intval($array['price']),
            $array['info']
        );
    }
    //public static function fromPost(){
        //return new Vehicle(
            //$AO_DB.strip($array['make']),
            //intval($array['year'],
            //$AO_DB.strip($array['model'],
            //intval($array['price']),
            //$array['$info']
        //);
    //}
    public function getFullName(){
        //return a human readable name
        return $this->_make . ' '. $this->_year . ' ' . $this->_name;
    }
    public function getLocalPath(){
        //local path in project
        return $this->_make . '/' . $this->_year . '/' . $this->_name . '.jpg';
    }
    public function getFullPath(){
        $ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'.'images/cars/';
        return $ROOT_URL.$this->getLocalPath();
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
}
?>