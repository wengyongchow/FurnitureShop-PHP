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
       
    </head>
    <body>
        <?php
        require_once 'config.php';
        $productID = $_REQUEST['pID'];
        if(isset($_POST['submit'])){
            $pname = $_POST['productName'];
            $price = $_POST['price'];
            $cat = $_POST['category'];
            
            $fname=$_FILES['pImg']['name'];
            $destination = 'image/products/'.$fname;
            $extension = pathinfo($fname, PATHINFO_EXTENSION);     
            $file = $_FILES['pImg']['tmp_name'];
            $size = $_FILES['pImg']['size'];            
            
            if(!in_array($extension,['png','jpeg','jpg','PNG']))
             {
                $message = "Invalid file type";
             }
            elseif($_FILES['pImg']['size'] > 1000000)
            {
                echo 'File too large';
            }
            else{
                if(move_uploaded_file($file, $destination))
                {
                    $sql2 = "UPDATE product set cat_id='{$cat}',productName='{$pname}',price='{$price}',productImage='{$fname}' where productID='{$productID}'";
                    if(mysqli_query($link, $sql2))
                        $message = "Edit successful";
                    else
                        $message = "Edit failed, Please try again later";
                }
            }       
        }        
        
        $sql = "SELECT * from product where productID='{$productID}'";
        $result = mysqli_query($link, $sql);
        $row=$result->fetch_assoc();
        extract($row);
     
        mysqli_close($link);    
        ?>       
        
        <div class="container" style="margin-left: 10px;">
            <form action='editProduct.php?pID=<?php echo $productID;?>' method='post' class="needs-validation" novalidate enctype="multipart/form-data">
            <h2>Edit product</h2>
            <div>
                <a href="manageProduct.php"><i class="fa fa-close"></i></a>
            </div>
            <table class="table table-borderless">  
                <tr>
                    <td><label for="productID">Product ID:</label></td>
                    <td><input type="type" name="productID" class="form-control" value="<?php echo $row['productID'];?>" disabled></td>
                </tr>
                    <tr>
                        <td><label for="productName">Product Name:</label></td>
                        <td><input type="text" name="productName" class="form-control" value="<?php echo $row['productName'];?>"></td>
                    </tr>           
            
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="number" name="price" class="form-control" min="0.00" placeholder="RM" step="0.01" value="<?php echo number_format((float)$row['price'],2,'.','');?>"></td>    
                </tr>            
           
                <tr>
                    <td><label for="category">Category:</label></td>
                <td>
                    <select name='category' class="form-control" required="required">
                        <option value = '' hidden="hidden">-Select one-</option>
                        <option <?php if(strcmp($row['cat_id'],"BL01")==0){echo'selected';}?> value='BL01'>Blazers</option>
                        <option <?php if(strcmp($row['cat_id'],"ST01")==0){echo'selected';}?> value='ST01'>Shirts</option>
                        <option <?php if(strcmp($row['cat_id'],"FS01")==0){echo'selected';}?> value='FS01'>Formal Shoes</option>
                </select>
                </td>
                </tr>            
                    <tr>
                        <td><label for="productImg">Product Image:</label></td>                        
                        <td><input type="file" name="pImg" id="pImg"></td>
                        
                    </tr>                
                </table>
            
            <?php if(!empty($message)){
                echo'<p>'.$message.'</p>';                             
            }
                ?>
            <input type="submit" name="submit" class="btn btn-primary">
            <input type="button" name="cancel" value="Cancel" class="btn btn-danger" onclick="window.location.href='manageProduct.php'">
            
         </form>
        </div>
        
    </body>
    
</html>
