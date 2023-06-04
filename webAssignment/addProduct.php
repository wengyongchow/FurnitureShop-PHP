<?php 
session_start();
if (empty($_SESSION['loggedin'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <?php include 'links.php'?>
        <title>Admin Panel</title>
        
        <style  type="text/css">
            #addForm{
                display:block;
                margin: auto;
            }     
            body{
                 background-image:  url('image/adminWallpaper.jpg');
                  background-repeat: no-repeat;
                  background-attachment: fixed; 
                  background-size: 100% 100%;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php
        require_once 'config.php';
                
        if(isset($_POST['submit']))
        {
            $product_name = trim($_POST['productName']);
            $product_price = trim($_POST['price']);
            $cat = trim($_POST['category']);
            $product_name = $link-> real_escape_string($product_name);
            $file_name=$_FILES['pImg']['name'];
            $destination = 'image/products/'.$file_name;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            
            $chkProduct = "select * from product where UPPER(productName) LIKE UPPER('$product_name')";
            $file = $_FILES['pImg']['tmp_name'];
            $size = $_FILES['pImg']['size'];
            $link -> query($chkProduct);
            
            if(!in_array($extension,['png','jpeg','jpg','PNG']))
                $message = "Invalid file type";
            
             elseif($_FILES['pImg']['size'] > 1000000)
                echo 'File too large';
             else if(mysqli_affected_rows($link) == 1)
             {
                 echo '<script>alert("Product is exsited")</script>'; 
                 $message = "Product is exsited..";
             }
             else if(empty ($message))
              {
                if(move_uploaded_file($file, $destination))
                {
                    
                    $sql = "INSERT INTO product (cat_id,productName,price,productImage) VALUES ('$cat','$product_name',$product_price,'$file_name')";
                        if(mysqli_query($link, $sql) > 0)
                        {echo "<h1 style='color: Blue'>Successfully Added</h1>";}
                        
                    else
                    {echo "<h1 style='color: red'>Failed to add</h1>";}
                }
              }
              $link -> close();     
        }  
        ?>
        
        <div class="container" style="margin-left: 10px;">
            <form action='addProduct.php' method='post' class="needs-validation" novalidate id="addForm" enctype="multipart/form-data">
            <h2>Add product</h2>
            <div>
                <a href="welcome_admin.php"class="w3-xlarge"><i class="fa fa-close"></i></a>
            </div>
            <table class="table table-borderless">                
                    <tr>
                        <td><label for="productName">Product Name:</label></td>
                        <td><input type="text" name="productName" class="form-control"></td>
                    </tr>
                
            
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="number" name="price" class="form-control" min="0.00" placeholder="RM" step="1.00"></td>    
                </tr>
            
           
                <tr>
                    <td><label for="category">Category:</label></td>
                <td>
                    <select name='category' class="form-control" required="required">
                        <option value = '' hidden="hidden">-Select one-</option>
                         <option value='BL01'>Blazers</option>
                         <option value='ST01'>Shirts</option>
                         <option value='FS01'>Formal Shoes</option>
                </select>
                </td>
                </tr>
            
                    <tr>
                        <td><label for="productImg">Product Image:</label></td>
                        <td><input type="file" name="pImg" id="pImg"></td>
                    </tr>
                
                </table>
            <?php 
            if(!empty($message)){
                echo'<p style="color:red;">'.$message.'</p>';                             
            }
                ?>
            <input type="submit" name="submit" class="btn btn-primary">
            <input type="reset" name="reset" class="btn btn-danger" onclick="location.reload();">
            
         </form>
        </div>
        
    </body>
    
</html>
