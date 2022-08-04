<?php

class OrderDetails{

    public $RecordID;
    public $OrderID;
    public $FoodID;
    public $Size;
    public $Quantity;
    public $Price;

    //Getters  
    function getRecordID() {
        return $this->RecordID;
    }
    
    function getOrderID() {
        return $this->OrderID;
    }

    function getFoodID() {
        return $this->FoodID;
    }

    function getSize() {
        return $this->Size;
    }

    function getQuantity() {
        return $this-> Quantity;
    }

    function getPrice() {
        return $this-> Price;
    }


    //Setters.

    function setRecordID(string $recordID){
        $this->RecordID = $recordID;
    }

    function setOrderID(int $orderID){
        $this->OrderID = $orderID; 
    }

    function setFoodID(int $foodID){
        $this->FoodID = $foodID;
    }

    function setSize($size){
        $this->Size = $size;
    }

    function setQuantity($quantity){
        $this->Quantity = $quantity;
    }

    function setPrice($price){
        $this->Price = $price;
    }
    
} 



?>