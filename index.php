<?php

session_start();
if(isset($_GET['login'])){

    if ($_GET['login']=="customer"){
        // echo "<h1> welcome back, login please</h1>";
        if(!empty($_SESSION) && $_SESSION['type']=='customer')

            header("Location: FinalProject_customer_panel.php");
        else
            header("Location: FinalProject_login.php");

        exit;
    }
    if ($_GET['login']=="admin"){
        // echo "<h1>Admin Login, please enter your login informatio\</h1>";
        if(!empty($_SESSION) && $_SESSION['type']=='admin')

            header("Location: FinalProject_food.php");
        else
            header("Location: FinalProject_login.php");

        exit;
    }
}

if(isset($_GET['logout'])){
    session_destroy();
    header("location: index.php");
}

if(isset($_GET['create'])){
    if ($_GET['create']=="customer"){
        header("Location: FinalProject_register.php");
        exit;
    }
}
showHeader();
main_page();

function main_page(){
?>
<div class="header">
<h1>Delicious Bites!</h1>    
<img src="./images/login.jpg" class="center"  width="1200" height="400">
<h4><a href=<?= $_SERVER['PHP_SELF']."?create=customer"?>> Create an account</a><h2>
<h4><a href=<?= $_SERVER['PHP_SELF']."?login=customer"?>> Customer login</a><h2>
<h4><a href=<?= $_SERVER['PHP_SELF']."?login=admin"?>> Admin login</a><h2>
<?php
}

function showHeader() { ?>
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
<?php }

?>

