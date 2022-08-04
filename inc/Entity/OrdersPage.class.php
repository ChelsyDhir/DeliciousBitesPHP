<?php


class OrdersPage  {

    static function header()   { ?>
        <!-- Start the page 'header' -->
        <!DOCTYPE html>
        <html>
            <head>
                <title>Delicious Bites!</title>
                <meta charset="utf-8">
                <meta name="author" content="chelsy, chelsy">
                <title></title>   
                <link href="css/styles_A.css" rel="stylesheet">     
            </head>
            <body>
                <header>
                    <h1>Hey <?= $_SESSION['customer_name']?>! Check your order here.</h1>
                </header>
                <article>
    <?php }

    static function AdminHeader()   { ?>
        <!-- Start the page 'header' -->
        <!DOCTYPE html>
        <html>
            <head>
                <title>Delicious Bites!</title>
                <meta charset="utf-8">
                <meta name="author" content="chelsy, chelsy">
                <title></title>   
                <link href="css/styles_A.css" rel="stylesheet">     
            </head>
            <body>
                <header>
                    <h1>List of all the orders</h1>
                </header>
                <article>
    <?php }


    static function footer()   { ?>
        <!-- Start the page's footer -->            
                </article>
            </body>

        </html>

    <?php }

    

    static function listOrderDetails(Array $orderDetails)    {
        ?>
            <!-- Start the page's show data form -->
            <section class="main">
            <table id="list">
                <thead>
                    <tr>
                        <th>Food</th>
                        <th>Size Price</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </thead>
                <?php
    
                    //List all the orders
                    $i=0;
                    foreach($orderDetails as $order)  {
            
                        if($i%2==1)
                            echo"<tbody class=\"evenRow\">";
                        else
                            echo"<tbody class=\"oddRow\">";
                        echo "<tr>";
                        echo "<td>".$order->Name."</td>";
                        echo "<td>$".$order->Size."</td>";
                        echo "<td>".$order->Quantity."</td>";
                        echo "<td>$".$order->Total_Price."</td>";

                        // $_SESSION['total_price'] = number_format($order->Quantity * $order->Size, 2);
                        // echo "<td>$". $_SESSION['total_price']. "</td>";

                        $link = $_SERVER['PHP_SELF']."?action=delete&recordID=".$order->RecordID;
                        echo "<td><a href=".$link.">Delete</a></td>";
    
                        echo "</tr>";
                        $i++;
                    } 
            echo'</tbody>';
            echo '</table>
                </section>';
        
    
    }
    
    static function listOrders(Array $orders)    {
        //["OrderID"]=> int(37) ["CustomerID"]=> int(1002) ["Date"]=> string(10) "0000-00-00" ["total_price"]=> float(151.6) ["number_items"]=> int(3)
        ?>
            <!-- Start the page's show data form -->
            <section class="main">
            <table id="list">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Total Items</th>
                        <th>Date</th>
                </thead>
                <?php
    
                    //List all the orders
                    $i=0;

                    foreach($orders as $order)  {
                        if($i%2==1)
                            echo"<tbody class=\"evenRow\">";
                        else
                            echo"<tbody class=\"oddRow\">";
                        echo "<tr>";
                        echo "<td>".$order->OrderID."</td>";
                        echo "<td>$".$order->total_price."</td>";
                        echo "<td>".$order->number_items."</td>";
                        echo "<td>".$order->Date."</td>";
                        
                        echo "</tr>";
                        $i++;
                    } 
            echo'</tbody>';
            echo '</table>
                </section>';
        }


        
    static function listAdminOrders(Array $orders)    {
        // orderdetails.OrderID, orders.CustomerID, customer.Name, Date,SUM(Price) as total_price, count(orderdetails.OrderID) as 'number_items'        ?>
            <!-- Start the page's show data form -->
            <section class="main">
            <table id="list">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Total Items</th>
                        <th>Date</th>
                    </thead>
                <?php
    
                    //List all the orders
                    $i=0;

                    foreach($orders as $order)  {
                        if($i%2==1)
                            echo"<tbody class=\"evenRow\">";
                        else
                            echo"<tbody class=\"oddRow\">";
                        echo "<tr>";
                        echo "<td>".$order->OrderID."</td>";
                        echo "<td>".$order->CustomerID."</td>";
                        echo "<td>".$order->Name."</td>";
                        echo "<td>".$order->total_price."</td>";
                        echo "<td>".$order->number_items."</td>";
                        echo "<td>".$order->Date."</td>";
                        // $link = $_SERVER['PHP_SELF']."?action=delete&customer_id=".$order->CustomerID;
                        // echo "<td><a href=\"".$link."\">Delete</a></td>";

                        echo "</tr>";
                        $i++;
                    } 
            echo'</tbody>';
            echo '</table>
                </section>';
        }

    static function addOrderForm(array $food)   { 
        ?>
        
        <section class="form1">
                <h3>Your Order Number is <?= $_SESSION['current_order_id']?></h3>

                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <table>
                        <tr>
                            <td><strong>Hello <?= $_SESSION['customer_name']?>!&#128515</strong></td> 
                        </tr>
                        <tr>
                            <td>Food Name</td> 
                            <td><select name="food">
                            <?php 
                            foreach($food as $foods){?>
                            <option value=<?= $foods->getFoodID()?>><?= $foods->getName()?></option>    
                            <?php
                            }

                            ?>
                           </select>
                           </td>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <td>
                            <select name="size">
                                    <option value="s">Small</option>
                                    <option value="m">Medium</option>
                                    <option value="l">Large</option>
                            </select>
                            </td>
                        </tr>                                                
                        <tr>
                            <td>Quantity</td>
                            <td><input type="text" name="quantity" id="quantity" placeholder="Number of items" required></td>
                        </tr>    
                                                                        
                    </table>                                        
                    <input type="hidden" name="action" value="create">
                    <input type="submit" value="Add item to Order">

                </form>
            </section>
            

    <?php }
    
    static function cancelOrder() {
        ?>
        <section class="form1">
            <form action="<?= $_SERVER['PHP_SELF']?>" method="GET">
                    <input type="hidden" name="action" value="cancel">
                    <input type="submit" value="Cancel Order ">
            </form>
            </section>
        <?php
    }

    static function ReviewOrders() {
        ?>
        <section class="form1">
            <form action="" method="GET">
                    <input type="hidden" name="action" value="review_orders">
                    <input type="submit" value="Review Orders ">
            </form>
            </section>
        <?php
    }

    static function SaveOrders() {
        ?>
        <section class="form1">
            <form action="" method="GET">
                <input type="hidden" name="action" value="save_orders">
                <input type="submit" value="Save Orders ">
            </form>
            </section>
        <?php
    }


    static function searchBar(){
        ?>
            <div class="container">
            <form method="GET" action="<?= $_SERVER['PHP_SELF']?>">
                <input type="text" name="order_id"  placeholder="Search order ID">
                <input type="hidden" name="action" value="search">
                <button type="submit">Search</button>
            </form>
            </div>
        <?php
    }

    static function adminSearchBar(){
        ?>
            <div class="container">
            <form method="GET" action="<?= $_SERVER['PHP_SELF']?>">
                <input type="text" name="customer_id"  placeholder="Search customer ID">
                <input type="hidden" name="action" value="search">
                <button type="submit">Search</button>
            </form>
            </div>
        <?php
    }

    static function resetButton(){
        ?>
            <div class="container">
            <form method="GET" action="<?= $_SERVER['PHP_SELF']?>">
                <input type="hidden" name="action" value="reset">
                <button style="background-color: pink;" type="submit" name="Reset">Search Reset</button>
            </form>
            </div>
        <?php
    }
    
}