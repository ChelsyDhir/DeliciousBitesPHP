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
//start the session again
session_start();

if($_POST){
    
    CustomerDAO::initialize();
    $current_user = CustomerDAO::getCustomer($_POST['email']);

    if (empty($current_user)){
        echo "<p class='error'>Customer,Wrong username or password</p>";
        CustomerPage::showLogin();
        CustomerPage::showFooter();
        exit;
     }

    //admin login, saved in database
    if($current_user->getEmail()=="chelsy@student.douglascollege.ca" && $current_user->getPassword() == '12345'){
        session_start();
        $_SESSION['loggedin'] = $current_user->getEmail();
        $_SESSION['type'] = 'admin';
        header("Location: FinalProject_food.php");
        exit;
    }
    //if the password doesn't matches
    if(!$current_user->verifyPassword($_POST['password'])){
        CustomerPage::showLogin();
        echo "<p class='error'>Customer,Wrong username or password</p>";
        CustomerPage::showFooter();
        exit;
    }else{

        $_SESSION['customer_name'] = $current_user->getName(); // will be save to use it on the main page title
        $_SESSION['type'] = 'customer'; // to just differenciate between customer and admin
        $_SESSION['CustomerID']=$current_user->getCustomerID(); // will be use when the customer create an order
        header("Location: ./FinalProject_customer_panel.php?order=new");
        exit;
    }
    
}   

CustomerPage::showLogin();
CustomerPage::showFooter();


