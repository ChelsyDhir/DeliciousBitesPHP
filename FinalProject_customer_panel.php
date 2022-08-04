<?php

showHeader();

//- start the session and grab all var
session_start();
// -spot the body
main_page();

//-------

function main_page(){
?>
<h1 style="text-align : center;">Welcome to Delicious Bites, <?= $_SESSION['customer_name'] ?> !&#127839;</h1>   
<img src="./images/food.jpg" class="center" >
<h3><a href="./FinalProject_Orders.php?order=new"> Place an order</a><h2>
<h3><a href="./FinalProject_display_orders.php"?>Display my Orders</a><h2>
<h3><a href="./index.php?logout=logout">Log out</a><h2>
<?php
}

function showHeader() { 
?>
    <!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8">
          <meta name="author" content="Chelsy, Chelsy">
          <link rel="stylesheet" href="css/style2.css">
      </head>
      <body>
          <section>
  </section>   
<?php
}