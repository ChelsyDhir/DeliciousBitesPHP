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

OrdersPage::header();

OrderDAO::initialize();
CustomerDAO::initialize();
OrderDetailsDAO::initialize();

OrdersPage::searchBar();
// OrdersPage::listOrders(OrderDAO::getOrdersList($_SESSION['CustomerID']));
// var_dump(OrderDAO::getOrdersList($_SESSION['CustomerID']));
if(!empty($_GET['action']) && $_GET['action'] == "search"){
    if(isset($_GET['order_id'])){
        OrdersPage::listOrders(OrderDAO::getOrderOnSearch($_GET['order_id'], $_SESSION['CustomerID']));
        OrdersPage::resetButton();
        ?>
    <p>Click here to go back to the <a href="./FinalProject_Orders.php?order=new">main page</a>
    <?php

    }
}elseif(!empty($_GET['action']) && $_GET['action'] == "reset"){
    OrdersPage::listOrders(OrderDAO::getOrdersList($_SESSION['CustomerID']));
    ?>
    <p>Click here to go back to the <a href="./FinalProject_Orders.php?order=new">main page</a>
    <?php

}
else{
    OrdersPage::listOrders(OrderDAO::getOrdersList($_SESSION['CustomerID']));
    ?>
    <p>Click here to go back to the <a href="./FinalProject_Orders.php?order=new">main page</a>
    <?php

}


OrdersPage::footer();




?>