<?php
class Vehicle
{   //class representing a Vehicle on the server
    //private const
    public $make;
    //public $year;
   // public $model;
    //public $info;
    //public $price;
    
    public function __construct($Make, $Year, $Model, $Info, $Price){
        $this->$make = $Make;
        //$this->$year = $Year;
        //$this->$model = $Model;
        //$this->$info = $Info;
        //$this->$price = $Price;
    }
    public function getFullName(){
        //return a human readable name
        //return $this->$make.' '.$this->$year.' '.$this->$name;
    }
    public function getLocalPath(){
        //return $this->$make.'/'.$this->$year.'/'.$this->$name;
    }
    public function getFullPath(){
        $ROOT_URL = 'http://triosdevelopers.com/A.Sanchez/Assets/AutoObsessionsGame/'.'images/cars/';
        //return $ROOT_URL.$this->getLocalPath().'.jpg';
    }
    public function toJSON(){
        //returns json representation of the vehicle data, for transfer over internet
        //Fix:accessing object values doesn't work!
        return '{"data":"this is data!"}';
        //'{"make": "", "year":"", "name":"", "info":"", "price":""}';
        //$this->$make;//, "year":"'.$this->$year.'", "name":"'.$this->$name.'", "info":"'.$this->$info.'", "price":"'.$this->$price.'"';
    }
}
?>