<?php 
session_start();
if (empty($_SESSION['loggedin'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <?php include'links.php'; ?>
        <title>Admin Panel</title>
        <style>
             body{
                 background-image:  url('image/adminWallpaper.jpg');
                  background-repeat: no-repeat;
                  background-attachment: fixed; 
                  background-size: 100% 100%;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    </head>
    <body>
        
        <?php
        require_once 'config.php';
        
        $sql="SELECT * from product";
        $productArray = mysqli_query($link, $sql);
        $numOfRow = $link->affected_rows;   
        ?>
        <div style="margin-left: 10px;">
        <h2>All Products</h2>
        <div style="margin-bottom: 5px;">
            <a href="welcome_admin.php" style="color:black;"><i class="fa fa-arrow-circle-o-left" style="font-size:36px"></i></a>
        </div>
        
        <table class="table" style="width:80%">
            <thead>
                <tr><th style="width:10%">Product ID</th><th style="width:20%">Product Name</th><th style="width:20%">Category</th><th style="width:10%">Price(RM)</th><th style="width:30%">Image</th><th style="width:10%">Action</th></tr>
            </thead>
            <tbody>   
          <?php
            while ($row = $productArray->fetch_assoc()) {
                switch ($row['cat_id']) {
                    case "BL01":
                        $category = "Blazers";
                        break;
                    case "ST01":
                        $category = "Shirts";
                        break;
                    case "FS01":
                        $category = "Formal Shoes";
                        break;
                    default:
                        $category = "Others";
                        break;
                }
                echo "<tr>"
                    ."<td>{$row['productID']}</td>"
                    ."<td>{$row['productName']}</td>"
                    ."<td>{$category}</td>"
                    ."<td>",number_format((float)$row['price'],2,'.',''),"</td>"
                    ."<td><img src=\"./image/products/{$row["productImage"]}\"></td>"
                    ."<td><a  style='color : black;' href='editProduct.php?pID={$row['productID']}'><i style='font-size:20px' class='fas'>&#xf5ad;</i></a><a href='deleteProduct.php?pID={$row['productID']}'><i class='fa fa-trash-o' style='font-size:24px; color:black;'></i></a><td>";
            }
            
            ?>
            </tbody></table>
        </div>
        
    </body>
</html>
