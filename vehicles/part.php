<?php
class Part
{   //class representing a Vehicle Part on the server
    private
        $_id,   //uint
       // $_name,  //str
        //$_year,  //uint
        //$_model, //str
        $_price, //uint
        $_info;  //str
    
    public function __construct($id/*$make, $year, $model, $price, $info*/){
        $this->_id = $id;
        
        //get price and info from database
        
        //$this->_info = $info;
        //$this->_price = $price;
        //echo $this->_info;
        //echo $this->_price;
        //echo '<br>';
    }
   /*public static function fromArray($array){
        return new Vehicle(
            intval($array['car_id']),
            $array['make'],
            intval($array['year']),
            $array['model'],
            intval($array['price']),
            $array['info']
        );
    }*/
    public function getID(){
        return $this->_id;
    }
    //public function getFullName(){
        //return a human readable name
        //return $this->_make . ' ' . $this->_year . ' ' . $this->_model;
    //}
   // public function getLocalPath(){
        //local path in project
       // return $this->_make . '/' . $this->_year . '/' . $this->_model . '.jpg';
   // }
   // public function getFullPath(){
       // $ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'.'images/upgrades/';
        //return $ROOT_URL . $this->getLocalPath();
    //}
    public function getPrice(){
        //returns price after accumulating upgrades and repairs
        return $this->_price;
      
    }
    public function getSalePrice(){
        //returns price after accumulating upgrades and repairs
        return $this->_price * 1.25;      
    }
    public function getInfo(){
        return $this->_info;
    }
    //public static function fromPost(){
        //initialize a single vehicle with values POSTed to the page
    //}
}
?>