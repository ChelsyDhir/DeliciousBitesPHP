<?php

require_once('inc/config.inc.php');
require_once('inc/Entity/Customer.class.php');
require_once('inc/Entity/CustomerPage.class.php');
require_once('inc/Entity/Food.class.php');
require_once('inc/Entity/Orders.class.php');
require_once('inc/Entity/OrderDetails.class.php');
require_once('inc/Entity/OrdersPage.class.php');
require_once('inc/Utility/CustomerDAO.class.php');
require_once('inc/Utility/LoginManager.class.php');
require_once('inc/Utility/FoodDAO.class.php');
require_once('inc/Utility/OrderDAO.class.php');
require_once('inc/Utility/OrderDetailsDAO.class.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/Validate.class.php');

CustomerPage::showHeader();

//Check if the form was posted
if(($_POST)){

    if(empty(Validate::ValidateForm())){
        // If the form entries are valid
        // initialize the DAO
        CustomerDAO::initialize();
        // instantiate a new newCustomer
        $newCustomer = new Customer();
        // assemble the newCustomer data
        $newCustomer->setName($_POST['name']);
        $newCustomer->setEmail($_POST['email']);
        $newCustomer->setPassword($_POST['password']); 
        $newCustomer->setPhone($_POST['phone']);

        
        // create the Customer
        CustomerDAO::createCustomer($newCustomer);
        // send/redirect the user to the login page
        header("Location: FinalProject_login.php");
    }
}

    
    
// Display the page elements and registration form (with updated page notifications if any)
CustomerPage::showRegistration();
CustomerPage::showFooter();

?>