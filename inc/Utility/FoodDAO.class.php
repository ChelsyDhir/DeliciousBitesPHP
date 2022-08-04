<?php

class FoodDAO  {

    // Declare Static DB member to store the database    
    private static $db;

    static function initialize()    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService("Food");
    }

    static function createFood(Food $newFood)  {
       
        //This is Statement:
        $sql = "INSERT INTO Food (Name, SmallPrice, MediumPrice, LargePrice)
                VALUES (:name, :smallPrice, :mediumPrice, :largePrice)";

        // QUERY 
        self::$db->query($sql);
        
        // BIND 
        self::$db->bind(':name', $newFood->getName());
        self::$db->bind(':smallPrice', $newFood->getSmallPrice());
        self::$db->bind(':mediumPrice', $newFood->getMediumPrice());
        self::$db->bind(':largePrice', $newFood->getLargePrice());

        //EXECUTE
        self::$db->execute();

        // You may want to return the last inserted id
        return self::$db->lastInsertedId();
    }
    
    static function getFoodNames(){
        $sql = "SELECT Name FROM Food";
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getFood(string $FoodID)  {

        //This is statement
        $sql = "SELECT * from Food WHERE FoodID = :foodID";
         
        //QUERY
        self::$db->query($sql);

        //BIND
        self::$db->bind(':foodID', $FoodID);

        //EXECUTE
        self::$db->execute();

        //RETURN (the single result)
        return self::$db->singleResult();

    }

    static function getFoods() : Array {

        $sql = "SELECT * from food";
        //Prepare the Query
        self::$db->query($sql);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->resultSet();
    }

    static function getSmallPrice($FoodID) {

        $sql = "SELECT SmallPrice from Food where FoodID=:foodID";
        //Prepare the Query
        self::$db->query($sql);
        //bind the Query
        self::$db->bind(':foodID', $FoodID);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->singleResult();
    }

    static function getMediumPrice($FoodID) {

        $sql = "SELECT MediumPrice from Food where FoodID=:foodID";
        //Prepare the Query
        self::$db->query($sql);
        //bind the Query
        self::$db->bind(':foodID', $FoodID);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->singleResult();
    }

    static function getLargePrice($FoodID) {

        $sql = "SELECT LargePrice from Food where FoodID=:foodID";
        //Prepare the Query
        self::$db->query($sql);
        //bind the Query
        self::$db->bind(':foodID', $FoodID);
        //execute the query
        self::$db->execute();
        //Return results
        return self::$db->singleResult();
    }

    // UPDATE
    static function updateFood (Food $FoodToUpdate): int {

        // QUERY
        $sql = "UPDATE food SET Name=:name, 
                     SmallPrice=:smallPrice,
                     MediumPrice=:mediumPrice,
                     LargePrice=:largePrice
                     WHERE FoodID=:foodID";
                
        //QUERY
        self::$db->query($sql);
        //BIND
        self::$db->bind(':name', $FoodToUpdate->getName());
        self::$db->bind(':smallPrice', $FoodToUpdate->getSmallPrice());
        self::$db->bind(':mediumPrice', $FoodToUpdate->getMediumPrice());
        self::$db->bind(':largePrice', $FoodToUpdate->getLargePrice());
       self::$db->bind(':foodID', $FoodToUpdate->getFoodID());

        self::$db->execute();

        // You may want to return the rowCount
        return self::$db->rowCount();

    }

    static function deleteFood(string $FoodID) {
        $sql = "DELETE FROM Food WHERE FoodID=:foodID";

        try{
            self::$db->query($sql);
            self::$db->bind(':foodID', $FoodID);
            self::$db->execute();

            if(self::$db->rowCount() != 1){
                throw new Exception("Problem deleting record $FoodID");
            }

        }catch(Exception $exc){
            echo $exc->getMessage();
        }
    }
}


?>