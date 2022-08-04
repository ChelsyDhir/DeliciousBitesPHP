<?php

class FoodPage  {

    static function header()   { ?>
        <!-- Start the page 'header' -->
        <!DOCTYPE html>
        <html>
            <head>
                <title>Delicious Bites!</title>
                <meta charset="utf-8">
                <meta name="author" content="Chelsy, Chelsy">
                <title></title>   
                <link href="css/styles_A.css" rel="stylesheet">     
            </head>
            <body>
                <header>
                    <h1>Please have a look on our Menu &#128522</h1>
                </header>
                <article>
    <?php }

    static function footer()   { ?>
        <!-- Start the page's footer -->    
        <p>----Click here to return to <a href="./index.php?logout=logout">logout</a>---</p>                
        <p>----Click here to check the Orders <a href="FinalProject_admin_orders.php">Orders</a>---</p>                

                </article>
            </body>

        </html>

    <?php }

    static function listFood(Array $foods)    {
    ?>
        <!-- Start the page's show data form -->
        <section class="main">
        <h2>Food in Menu</h2>
        <table id="list">
            <thead>
                <tr>
                    <th>Food ID</th>
                    <th>Name</th>
                    <th>Small Price</th>
                    <th>Medium Price</th>
                    <th>Large Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
            </thead>
            <?php

                $i=0;
                foreach($foods as $food)  {
        
                    if($i%2==1)
                        echo"<tbody class=\"evenRow\">";
                    else
                        echo"<tbody class=\"oddRow\">";
                   
                        echo "<tr>";
                    echo "<td>".$food->FoodID."</td>";
                    echo "<td>".$food->Name."</td>";
                    echo "<td>$".$food->SmallPrice."</td>";
                    echo "<td>$".$food->MediumPrice."</td>";
                    echo "<td>$".$food->LargePrice."</td>";
                                        
                    $link = $_SERVER['PHP_SELF']."?action=edit&FoodID=".$food->FoodID;
                    echo "<td><a href=\"".$link."\">Edit</a></td>";

                    $link = $_SERVER['PHP_SELF']."?action=delete&FoodID=".$food->FoodID;
                    echo "<td><a href=\"".$link."\">Delete</a></td>";

                    echo "</tr>";
                    $i++;
                } 
        echo'</tbody>';
        echo '</table>
            </section>';
  
    }

    static function addFood()   { 
        ?>
        <section class="form1">
                <h3>Add a New Food in Menu</h3>
                <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
                    <table>
                        <tr>
                            <td>Food Name</td>
                            <td><input type="text" name="name" id="name" placeholder="Name"></td>
                        </tr>
                        <tr>
                            <td>Small Price</td>
                            <td><input type="text" name="smallprice" id="smallprice" placeholder="Price of small Size"></td>
                        </tr>     
                        <tr>
                            <td>Medium Price</td>
                            <td><input type="text" name="mediumprice" id="mediumprice" placeholder="Price of medium Size"></td>
                        </tr>
                        <tr>
                            <td>Large Price</td>
                            <td><input type="text" name="largeprice" id="largeprice" placeholder="Price of large Size"></td>
                        </tr>                                           
                        
                    </table>                                        
                    <input type="hidden" name="action" value="create">
                    <input type="submit" value="Add Food">
                </form>
            </section>

    <?php }

    static function editFood(Food $foodToEdit)   {  
        ?>        
        <section class="form1">
            <h3>Edit Food</h3>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <table>
                        <tr>
                            <td><strong>Food ID : <?php echo $foodToEdit->getFoodID()?></strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" id="name" placeholder="Name"  value = <?=  $foodToEdit->getName() ?> ></td>
                        </tr>
                        <tr>
                            <td>Small Price</td>
                            <td><input type="text" name="smallprice" id="smallprice" placeholder="Price of small Size" value = <?=  $foodToEdit->getSmallPrice() ?> ></td>
                        </tr> 
                        <tr>
                            <td>Medium Price</td>
                            <td><input type="text" name="mediumprice" id="mediumprice" placeholder="Price of medium Size"  value = <?=  $foodToEdit->getMediumPrice() ?> ></td>
                        </tr>
                        <tr>
                            <td>Large Price</td>
                            <td><input type="text" name="largeprice" id="largeprice" placeholder="Price of large Size" value = <?=  $foodToEdit->getLargePrice() ?> ></td>
                        </tr>                                                
                        <tr>
                                       
                </table>
                                
                <input type="hidden" name="FoodID" value=<?= $foodToEdit->getFoodID()?> >
                <input type="hidden" name="action" value="edit">
                <input type="submit" value="Edit Food">                
            </form>
        </section>

<?php }

}