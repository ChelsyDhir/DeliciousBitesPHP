<?php

class Orders {

    public $OrderID;
    public $CustomerID;
    public $Date;

    //Getters  
    function getOrderID() {
        return $this->OrderID;
    }

    function getCustomerID() {
        return $this-> CustomerID;
    }

    function getDate() {
        return $this-> Date;
    }

    //Setters.

    function setOrderID(string $orderID){
        $this->OrderID = $orderID;
    }

    function setCustomerID(int $customerID){
        $this->CustomerID = $customerID; 
    }

    function setDate(int $date){
        $this->Date = $date; 
    }

}    
?>