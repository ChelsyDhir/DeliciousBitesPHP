<?php


class Customer {

    public $CustomerID;
    public $Name;
    public $Phone;
    public $Email;
    public $password;

    //Setters.
    function setCustomerID($customerID){
        $this->CustomerID = $customerID;
    }

    function setName($name){
        $this->Name = $name; 
    }

    function setPhone($phone){
        $this->Phone = $phone;
    }

    function setEmail($email){
        $this->Email = $email;
    }

    function setPassword($password){
        $this->password = password_hash($password, PASSWORD_DEFAULT) ;
    }

    //Getters  
    function getCustomerID() {
        return $this->CustomerID;
    }

    function getName() {
        return $this-> Name;
    }

    function getPhone() {
        return $this-> Phone;
    }

    function getEmail() {
        return $this-> Email;
    } 

    function getPassword() {
        return $this->password;
    } 

    //Verify the password
    function verifyPassword(string $passwordToVerify) {
        return password_verify($passwordToVerify,$this->password);  
    }
    
}    
?>