<?php 
session_start();
if(!(isset($_SESSION['loggedin'])&& $_SESSION["loggedin"] === true))
{
    header("location: signin.php?alert=1");
}
else if(empty ($_COOKIE['cart']))
{
    header("location: cart.php?alert=1");
}
if ((isset($_COOKIE['cart']))&&(isset($_REQUEST['quantity']))) 
{
    $cart = explode('|', $_COOKIE['cart']);
    $quantity = $_REQUEST['quantity'];
} 
else 
{
    $cart = array();
    $quantity = array();
}
$cartString = implode('|', $cart);
setcookie('cart', $cartString);
$quantityString = implode('|', $quantity);
setcookie('quantity', $quantityString);
$con = new mysqli('localhost', 'root', '', 'webassignment');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="generator" content="Jekyll v4.0.1">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>  

        <link href="assets/css/bootstrap.css" rel="stylesheet">   
        <link href="assets/css/homepage.css" rel="stylesheet">    
        <script src="assets/javascript/bootstrap.bundle.js"></script>
        
        <style>
               body
            {
                background-image: url("image/adminWallpaper.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                margin-bottom: 0;
            }
            h1{
                color: white;
            }
           
            .item-price{
                width: 20%;
            }
            
            .img{
                width: 70px;
            }
            
           
        </style>

        <title>PAIKEA</title>

    </head>

    <body>
        <header><a href="index.php"><img src="image/logo.jpg" class="mx-auto d-block"> </a></header>
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-6">               
                    <form action="completeOrder.php" method="post">
                        <table class="table table-borderless">
                            <tr><td><label for="shipping">Shipping Address: </label></td></tr>                       
                            <tr>
                                <td><label>First Name: </label><input type="text" name="fname" placeholder="First Name" required></td>
                                <td><label>Last Name: </label><input type="text" name="lname" placeholder="Last Name" required></td>
                            </tr>
                            <tr><td colspan="2"><label>Address: </label><input type="text" name="address" size="60px" placeholder="Address" required></td></tr>
                            <tr><td colspan="2"><label>Phone Number: </label><input type="tel" name="phone" size="53px" placeholder="Phone Number"></td></tr>  
                            <tr><td colspan="2"><input class="btn btn-info" name="submit" type="submit" value="Complete Order"></td></tr>
                            <input type="hidden" name="total" value="<?php echo $_REQUEST['total']?>">
                        </table>
                    </form>
                </div>
                <div class="col-6 bg-light">
                    <table class="table table-hover" style="border-bottom:1px;">
                        <?php
                         foreach ($cart as $key => $value){
                              $sql = "select * from product where productID ={$value}";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                        echo "<tr class=\"cart cart-row\">
                            <td class=\"cart-itemimg\"><img class='img' src=\"image/products/{$row['productImage']}\"></td>
                            <td class=\"cart-itemname\" style='color: white;'>{$row['productName']}</td>                        
                            <td class=\"item-quantity\" style='color: white;'>{$quantity[$key]}</td>
                            <td class=\"item-price\" style=\"text-align:right; color: white;\">RM {$row['price']}</td>                    
                        </tr>";
                         }
                        ?>
                        <tfoot>
                            <tr>
                                <td colspan="3" style='color: white;'>Subtotal:<br>Shipping:</td>
                                <td style="text-align:right; color: white;">RM <?php echo $_REQUEST['total']?><br>RM 10</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="color: white;">Total:</td>
                                <td style="text-align: right; color: white;">RM <?php echo ($_REQUEST['total']+10)?><br></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <?php 
        $con->close();
        include 'footer.php'; ?>       

    </body>
</html>