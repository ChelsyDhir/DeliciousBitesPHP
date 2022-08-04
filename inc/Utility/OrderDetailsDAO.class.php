<?php

class OrderDetailsDAO  {

    // Declare Static DB member to store the database    
    private static $db;

    static function initialize()    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService("OrderDetails");
    }

    static function createOrderDetails(OrderDetails $newOrderDetails)  {
       
        //This is Statement:
        $sql = "INSERT INTO OrderDetails (OrderID, FoodID, Size, Quantity, Price)
                VALUES (:orderID, :foodID, :size, :quantity, :price)";

        // QUERY 
        self::$db->query($sql);
        
        // BIND 
        self::$db->bind(':orderID', $newOrderDetails->getOrderID());
        self::$db->bind(':foodID', $newOrderDetails->getFoodID());
        self::$db->bind(':size', $newOrderDetails->getSize());
        self::$db->bind(':quantity', $newOrderDetails->getQuantity());
        self::$db->bind(':price',$newOrderDetails->getPrice());
    
        //EXECUTE
        self::$db->execute();

        // You may want to return the last inserted id
        return self::$db->lastInsertedId();
    }
    
    static function getOrderDetails(int $RecordID)  {

        //This is statement
        $sql = "SELECT * from OrderDetails WHERE RecordID = :recordID";
         
        //QUERY
        self::$db->query($sql);

        //BIND
        self::$db->bind(':recordID', $RecordID);

        //EXECUTE
        self::$db->execute();

        //RETURN (the single result)
        return self::$db->singleResult();

    }

    static function getAnOrderDetails()  {
        
        //This is statement
        $sql = "SELECT * from OrderDetails
        Where  OrderID  =:order_id";
         
        self::$db->query($sql);
        self::$db->bind(":order_id", $_SESSION["current_order_id"]);
        self::$db->execute();
        return self::$db->resultSet();

    }

    static function getOrderDetailsAndFoodName(int $OrderID)  {
        
        //This is statement
        $sql = "SELECT orderdetails.RecordID, food.Name, 
        orderdetails.Size, orderdetails.Quantity, 
        ROUND(orderdetails.Size*orderdetails.Quantity, 2)
         as Total_Price from orderdetails JOIN food 
         on orderdetails.FoodID = food.FoodID
         Where OrderID=:orderID";

        self::$db->query($sql);

        self::$db->bind(':orderID', $OrderID);

        self::$db->execute();
        
        return self::$db->resultSet();

    }
    
    // UPDATE
    static function updateOrderDetails (OrderDetails $OrderDetailsToUpdate): int {

        // QUERY
        $sql = "UPDATE OrderDetails SET 
                     OrderID=:orderID
                     FoodID=:foodID
                     Size=:size
                     Quantity=:quantity
                     Price=:price
                     WHERE RecordID=:recordID";
                
        //QUERY
        self::$db->query($sql);
        //BIND
        self::$db->bind(':orderID', $OrderDetailsToUpdate->getOrderID());
        self::$db->bind(':foodID', $OrderDetailsToUpdate->getFoodID());
        self::$db->bind(':size', $OrderDetailsToUpdate->getSize());
        self::$db->bind(':quantity', $OrderDetailsToUpdate->getQuantity());
        self::$db->bind(':price', $OrderDetailsToUpdate->getPrice());
        self::$db->bind(':recordID', $OrderDetailsToUpdate->getRecordID());
        
        self::$db->execute();

        // You may want to return the rowCount
        return self::$db->rowCount();

    }
    
    static function deleteOrderDetails($RecordID) {
        $sql = "DELETE FROM OrderDetails WHERE RecordID=:recordID";

        try{
            self::$db->query($sql);
            self::$db->bind(':recordID', $RecordID);
            self::$db->execute();

            if(self::$db->rowCount() != 1){
                throw new Exception("Problem deleting record $RecordID");
            }

        }catch(Exception $exc){
            echo $exc->getMessage();
        }
    }
}


?>