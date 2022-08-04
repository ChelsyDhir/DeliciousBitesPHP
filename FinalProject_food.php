<?php

require_once('inc/config.inc.php');
require_once('inc/Entity/Customer.class.php');
require_once('inc/Entity/CustomerPage.class.php');
require_once('inc/Entity/Food.class.php');
require_once('inc/Entity/Orders.class.php');
require_once('inc/Entity/OrderDetails.class.php');
require_once('inc/Entity/OrdersPage.class.php');
require_once('inc/Entity/FoodPage.class.php');
require_once('inc/Utility/CustomerDAO.class.php');
require_once('inc/Utility/LoginManager.class.php');
require_once('inc/Utility/FoodDAO.class.php');
require_once('inc/Utility/OrderDAO.class.php');
require_once('inc/Utility/OrderDetailsDAO.class.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/Validate.class.php');


// check the privilage
session_start();
if(!empty($_SESSION) && $_SESSION['type']!='admin'){
    echo "please sign in as an admin from here <a href='FinalProject_register.php'></a>";
 exit;
}
        
FoodDAO::initialize();

FoodPage::header();

if (!empty($_POST)) {

    if(isset($_POST['action'])&&$_POST['action']=="edit"){

         //Assemble the record to update        
        $editFood = new Food();
        $editFood->setFoodID($_POST['FoodID']);
        $editFood->setName($_POST['name']);
        $editFood->setSmallPrice($_POST['smallprice']);
        $editFood->setMediumPrice($_POST['mediumprice']);
        $editFood->setLargePrice($_POST['largeprice']);

        //Send the record to the DAO to be updated
         FoodDAO::updateFood($editFood);

        
    }if

        (isset($_POST['action'])&&$_POST['action']=="create"){

        //Assemble the record to Insert/Create
        $newFood = new Food();
        $newFood->setName($_POST['name']);
        $newFood->setSmallPrice($_POST['smallprice']);
        $newFood->setMediumPrice($_POST['mediumprice']);
        $newFood->setLargePrice($_POST['largeprice']);
        //Send the record to the DAO for creation
        FoodDAO::createFood($newFood);

    } 
}

if(!empty($_GET)){
if (isset($_GET["action"]) && $_GET["action"] == "delete")  {
        //Use the DAO to delete the corresponding record
        FoodDAO::deleteFood($_GET['FoodID']);
    }
}

FoodPage::listFood(FoodDAO::getFoods());

if (isset($_GET["action"]) && $_GET["action"] == "edit")  {
    $foodID = $_GET["FoodID"];
    $targetRecord = FoodDAO::getFood($foodID);
    FoodPage::editFood($targetRecord);
} else {
    
    FoodPage::addFood();
}
// Finally, call the footer function
FoodPage::footer();
?>