<?php
class Vehicle
{   //class representing a Vehicle on the server
    //private const
    public $make;
    public $year;
    public $model;
    public $info;
    public $price;
    
    public function __construct($make, $year, $model, $info, $price){
        $this->$make = $make;
        $this->$year = $year;
        $this->$model = $model;
        $this->$info = $info;
        $this->$price = $price;
    }
    public function getFullName(){
        //return a human readable
        return $this->$make.' '.$this->$year.' '.$this->$name;
    }
    public function getLocalPath(){
        return $this->$make.'/'.$this->$year.'/'.$this->$name;
    }
    public function getFullPath(){
        $ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'.'images/cars/';
        return $ROOT_URL.$this->getLocalPath().'.jpg';
    }
    public function toJSON(){
        //returns json representation of the vehicle data, for transfer over internet
        return '{"make":"string data!"}';//, "year":"'.$this->$year.'", "name":"'.$this->$name.'", "info":"'.$this->$info.'", "price":"'.$this->$price.'"';
    }
}
?>