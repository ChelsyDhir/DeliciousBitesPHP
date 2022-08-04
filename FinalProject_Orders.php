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

session_start();
if(!empty($_SESSION) && $_SESSION['type']!='customer'){
    echo "please sign in as an customer from <a href=./index.php> HERE</a>";
 exit;
}

OrderDAO::initialize();


// create a new order and return its id
if(isset($_GET['order'])){
    $_SESSION['current_order_id'] = OrderDAO::createOrder();
}


FoodDAO::initialize();
CustomerDAO::initialize();
OrderDetailsDAO::initialize();

OrdersPage::header();


if(!empty($_POST)){
    if(isset($_POST['action']) && $_POST['action'] == "create"){

        $newOrderDetails = new OrderDetails();
        $newOrderDetails->setOrderID($_SESSION['current_order_id']);
        $newOrderDetails->setFoodID($_POST['food']);
        $newOrderDetails->setSize($_POST['size']);
        $newOrderDetails->setQuantity($_POST['quantity']);

        if($_POST['size'] == "s"){
            $price = FoodDAO::getSmallPrice($_POST['food']);
            $newOrderDetails->setSize($price->getSmallPrice());
            $newOrderDetails->setPrice($price->getSmallPrice() * $_POST['quantity'] );

        }
        elseif($_POST['size'] == "m"){
            $price = FoodDAO::getMediumPrice($_POST['food']);
            $newOrderDetails->setSize($price->getMediumPrice());
            $newOrderDetails->setPrice($price->getMediumPrice() * $_POST['quantity'] );

        }
        else{
            $price = FoodDAO::getLargePrice($_POST['food']);
            $newOrderDetails->setSize($price->getLargePrice());
            $newOrderDetails->setPrice($price->getLargePrice() * $_POST['quantity'] );
        }
        OrderDetailsDAO::createOrderDetails($newOrderDetails);
    }
} 



//To cancel order by customer
if(!empty($_GET)){
    //ob_start();
    if(isset($_GET['action']) && $_GET['action'] == "cancel"){
        OrderDAO::deleteOrder($_SESSION['current_order_id']);
        header("Location: FinalProject_customer_panel.php");
        exit;
    }
}
if(!empty($_GET)){
    if(isset($_GET['action']) && $_GET['action'] == "review_orders"){

        header("Location: FinalProject_display_orders.php");
    }
}

if(!empty($_GET)){
    if(isset($_GET['action']) && $_GET['action'] == "save_orders"){

        header("Location: FinalProject_customer_panel.php");
    }
}


if(!empty($_GET)){
    if (isset($_GET["action"]) && $_GET["action"] == "delete")  {
        OrderDetailsDAO::deleteOrderDetails($_GET['recordID']);
    }
}

OrdersPage::listOrderDetails(OrderDetailsDAO::getOrderDetailsAndFoodName($_SESSION['current_order_id']));

// if (isset($_GET["action"]) && $_GET["action"] == "edit")  {
//     $recordID = $_GET["RecordID"];
//     $targetRecord = OrderDetailsDAO::getOrderDetails($recordID);
//     // OrdersPage::editPurchaseForm($targetRecord);
// } 
OrdersPage::addOrderForm(FoodDAO::getFoods());
OrdersPage::ReviewOrders();
OrdersPage::SaveOrders();
OrdersPage::cancelOrder();

OrdersPage::footer();
?>