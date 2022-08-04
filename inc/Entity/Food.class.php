<?php

class Food{

    public $FoodID;
    public $Name;
    public $SmallPrice;
    public $MediumPrice;
    public $LargePrice;

    //Getters  
    function getFoodID() {
        return $this->FoodID;
    }

    function getName() {
        return $this->Name;
    }

    function getSmallPrice() {
        return $this-> SmallPrice;
    }

    function getMediumPrice() {
        return $this-> MediumPrice;
    }

    function getLargePrice() {
        return $this-> LargePrice;
    }

    //Setters.

    function setFoodID($foodID){
        $this->FoodID = $foodID;
    }

    function setName($name){
        $this->Name = $name; 
    }

    function setSmallPrice($smallPrice){
        $this->SmallPrice = $smallPrice;
    }

    function setMediumPrice($mediumPrice){
        $this->MediumPrice = $mediumPrice;
    }

    function setLargePrice($largePrice){
        $this->LargePrice = $largePrice;
    }
    
} 



?>