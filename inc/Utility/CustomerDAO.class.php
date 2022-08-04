<?php

class CustomerDAO  {

    // Declare Static DB member to store the database    
    private static $db;

    static function initialize()    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService("Customer");
    }

    //creating new Customer
    static function createCustomer(Customer $newCustomer)  {
       
        //This is Statement:
        $sql = "INSERT INTO Customer (Name, Phone, Email, password)
                VALUES (:name, :phone, :email, :password)";

        // QUERY 
        self::$db->query($sql);
        
        // BIND 
        self::$db->bind(':name', $newCustomer->getName());
        self::$db->bind(':phone', $newCustomer->getPhone());
        self::$db->bind(':email', $newCustomer->getEmail());
        self::$db->bind(':password', $newCustomer->getPassword());

        //EXECUTE
        self::$db->execute();

        // You may want to return the last inserted id
        return self::$db->lastInsertedId();
    }
    
    static function getCustomerName($CustomerID){
        $sql = "SELECT Name FROM Customer WHERE CustomerID=:customerID";
        self::$db->query($sql);
        self::$db->bind(':customerID', $CustomerID);
        self::$db->execute();
        return self::$db->singleResult();

    }

    static function getCustomer(string $email)  {

        //This is statement
        $sql = "SELECT * from Customer WHERE Email =:email";
         
        //QUERY
        self::$db->query($sql);

        //BIND
        self::$db->bind(':email', $email);

        //EXECUTE
        self::$db->execute();

        //RETURN (the single result)
        return self::$db->singleResult();

    }

    static function getCustomers() : Array {

        $sql = "SELECT * from customer WHERE Email NOT IN ('chelsy@student.douglascollege.ca')";
        //Prepare the Query
        self::$db->query($sql);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->resultSet();
    }
    
    // UPDATE means update
    static function updateCustomer (Customer $CustomerToUpdate): int {

        // QUERY
        $sql = "UPDATE customer SET Name=:name, 
                     Phone=:phone,
                     Email=:email,
                     Password=:password
                     WHERE CustomerID=:customerID";
                
        //QUERY
        self::$db->query($sql);
        //BIND
        self::$db->bind(':customerID', $CustomerToUpdate->getCustomerID());
        self::$db->bind(':name', $CustomerToUpdate->getName());
        self::$db->bind(':phone', $CustomerToUpdate->getPhone());
        self::$db->bind(':email', $CustomerToUpdate->getEmail());
        self::$db->bind(':password', $CustomerToUpdate->getPassword());

        self::$db->execute();

        // You may want to return the rowCount
        return self::$db->rowCount();

    }
    
    // Sorry, I need to DELETE your record
    static function deleteCustomer(string $CustomerId) {
        $sql = "DELETE FROM customer WHERE CustomerID=:customerID";

        try{
            self::$db->query($sql);
            self::$db->bind(':customerID', $CustomerId);
            self::$db->execute();

            if(self::$db->rowCount() != 1){
                throw new Exception("Problem deleting record $CustomerId");
            }

        }catch(Exception $exc){
            echo $exc->getMessage();
        }   
    } 
}


?>