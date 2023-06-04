<?php
session_start();
include'header.php';
?> 
<?php
if ((isset($_COOKIE['cart'])) && (isset($_COOKIE['quantity']))) {
    $cart = explode('|', $_COOKIE['cart']);
    $quantity = explode('|', $_COOKIE['quantity']);
} else {
    $cart = array();
    $quantity = array();
}

if (isset($_REQUEST['productID'])) {
    for ($i = 0; $i < count($cart); $i++) {
        if ($_REQUEST['productID'] == $cart[$i]) {
            $error = 1;
        }
    }
    if (isset($error)) {
        $errorMsg = "Item has already been added to cart!";
    } else {
        $cart[] = $_REQUEST['productID'];
        $quantity[] = $_REQUEST['quantity'];
        $success = "Item has been added to cart successfully!";
    }
    $cartString = implode('|', $cart);
    setcookie('cart', $cartString);
    $quantityString = implode('|', $quantity);
    setcookie('quantity', $quantityString);
}
?>
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
        <link href="assets/css/product.css" rel="stylesheet">
        
        <title></title>        

    </head>
    <body>       
               
        <?php
        $con = new mysqli('localhost', 'root', '', 'webassignment');
        if (isset($_REQUEST['filter'])) {
           if ($_REQUEST['filter'] == "blazers") {
                $sql = "select * from product where cat_id='BL01'";
                $title = "Blazers";
            } else if ($_REQUEST['filter'] == "shirts") {    
                $sql = "select * from product where cat_id='ST01'";
                $title = "Shirts";
            } else if ($_REQUEST['filter'] == "formalShoes") {
                $sql = "select * from product where cat_id='FS01'";
                $title = "Formal Shoes";
            }else {
                $sql = "select * from product";
                $title = "All product";
            }
        }else {
            $sql = "select * from product";
            $title = "All product";
        }
        
        $productArray = $con->query($sql);
        
        ?>
        <div class="jumbotron text-center">            
            <div class="container">
                <h1 class="monospace">Products</h1>
            </div>
        </div>

        <div class="container-fluid filter-toolbar">            
            <div class="filter-content dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" style="color : white;">Filter By</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="product.php?filter=all">All product</a>
                    <a class="dropdown-item" href="product.php?filter=blazers">Blazers</a>
                    <a class="dropdown-item" href="product.php?filter=shirts">Shirts</a>
                    <a class="dropdown-item" href="product.php?filter=formalShoes">Formal Shoes</a>
                </div>                
                <span style="color : white;"><?php echo"$title"; ?></span>                
            </div>           
        </div>

        <div class="container">
            <?php
            if(isset($errorMsg)){
                echo"<div class='alert alert-danger'>";
                echo"<span>$errorMsg</span>";
                echo"</div>";
            }else if(isset ($success)){
                echo"<div class='alert alert-success'>";
                echo"<span>$success</span>";
                echo"</div>";
            }
            
            ?>
            <h2><?php echo $title;?></h2>

            <?php
            echo "<div class=\"row\">";


            while ($row = $productArray->fetch_assoc()) {
                echo "<div class=\"col-3\">
                    <div class=\"product-top\">
                        <img class=\"product-img\" src=\"./pics/products/{$row["productImage"]}\">
                        <div class=\"overlay\">
                            <button type=\"button\" class=\"btn btn-secondary\" onclick=\"location='preview.php?productID={$row['productID']}&catID={$row['cat_id']}'\" title=\"Preview\"><i class=\"fa fa-eye\"></i></button>
                            <button type=\"button\" class=\"btn btn-secondary\" onclick=\"location='product.php?productID={$row['productID']}&quantity=1'\" title=\"Add to cart\"><i class=\"fa fa-shopping-cart\"></i></button>                        
                        </div>
                    </div>
                    <div class=\"product-bottom text-center\">
                        <h3 style='color : white;'>{$row["productName"]}</h3>
                        <h5 style='color : white;'>RM {$row["price"]}</h5>
                    </div>
                    </div>";
            }
            echo "</div>";
            $con->close();
            ?>

            <?php include'footer.php' ?>
    </body>
</html>
