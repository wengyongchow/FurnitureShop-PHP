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
       <style>
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
        
        $productID = $_REQUEST['pID'];
        if(isset($_POST['yes']))
        {
            $sql = "DELETE FROM product where productID='{$productID}'";
            if(mysqli_query($link, $sql))
            {
                header("Location: http://localhost/webAssignment/manageProduct.php");
                exit;
            }
            else
            {
                $message = "Delete failed, Please try again later";                
            }   
        } 
        $sql = "SELECT * from product where productID='{$productID}'";
        $result = mysqli_query($link, $sql);
        $row=$result->fetch_assoc();
        mysqli_close($link);    
        ?>       
        
        <div class="container" style="margin-left: 10px;">
            <form action='deleteProduct.php?pID=<?php echo $productID;?>' method='post' class="needs-validation" novalidate enctype="multipart/form-data">
            <h2>Delete product</h2>
            <div>
                <a href="manageProduct.php"><i class="fa fa-close w3-xlarge" style="color:white;"></i></a>
            </div>
            <table class="table table-borderless">  
                <tr>
                    <td width="30%"><label for="productID" >Product ID:</label></td>
                    <td width="70%"><input type="type" name="productID" class="form-control" value="<?php echo $row['productID'];?>" disabled></td>
                </tr>
                
                <tr>
                    <td><label for="productName">Product Name:</label></td>
                    <td><input type="text" name="productName" class="form-control" value="<?php echo $row['productName'];?>" disabled></td>
                </tr>           
            
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="number" name="price" class="form-control" min="0.00" placeholder="RM" step="0.01" value="<?php echo number_format((float)$row['price'],2,'.','');?>" disabled></td>    
                </tr>            
           
                <tr>
                    <td><label for="category">Category:</label></td>
                    <td><input type="text" name="cat" class="form-control" value="<?php echo $row['cat_id'];?>" disabled></td>
                </tr>       
                
                <tr>
                    <td><label for="productImg">Product Image:</label></td>
                    <td><img src="./image/products/<?php echo $row['productImage'];?>" style="" width="100px" height="200px"></td>
                </tr>                
            </table>
            
            <?php if(!empty($message)){ echo'<p>' . $message . '</p>'; }?>
            
            <p>Are you sure you want to delete this product?</p>
            <input type="submit" name="yes" value="Yes" class="btn btn-primary">
            <input type="button" name="no" value="Cancel" class="btn btn-danger" onclick="window.location.href='manageProduct.php'">
            
         </form>
        </div>
        
    </body>
    
</html>
