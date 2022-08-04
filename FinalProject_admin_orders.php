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

OrdersPage::AdminHeader();

OrderDAO::initialize();
CustomerDAO::initialize();
OrderDetailsDAO::initialize();
FoodDAO::initialize();

OrdersPage::adminSearchBar();
// if(!empty($_GET)){
//     if (isset($_GET["action"]) && $_GET["action"] == "delete")  {
//             //Use the DAO to delete the corresponding record
//             OrderDAO::deleteOrder($_GET['customer_id']);
//         }
// }

if(!empty($_GET['action']) && $_GET['action'] == "search"){
    if(isset($_GET['customer_id'])){
        OrdersPage::listAdminOrders(OrderDAO::getAdminOrderOnSearch($_GET['customer_id']));
        OrdersPage::resetButton();

    }
}elseif(!empty($_GET['action']) && $_GET['action'] == "reset"){
    OrdersPage::listAdminOrders(OrderDAO::getOrders());
}
else{
    OrdersPage::listAdminOrders(OrderDAO::getOrders());
    ?>
    <p>Click here to go back to the <a href="./FinalProject_Orders.php?order=new">main page</a>
    <?php

}


OrdersPage::footer();




?>