<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: admin_login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ 
        font: 14px sans-serif; 
        text-align: center; 
        background-image: url('image/adminWallpaper.jpg');
          background-repeat: no-repeat;
          background-attachment: fixed; 
          background-size: 100% 100%;
        }
        
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Good day! <b><?php echo strtoupper($_SESSION['username']); ?></b>.</h1>
    </div>
    
      
    <div class="list-group" style="width: 30%; margin: 50px auto 10px auto;">
        <h4 class="list-group-item" style="background-color:#05326d; color: wheat">Menu action</h4>  
        <a href="manageProduct.php" class="list-group-item list-group-item-action">Manage product</a>     
        <a href="addProduct.php" class="list-group-item list-group-item-action">Add product</a>
        <a href="view_orders.php" class="list-group-item list-group-item-action">View orders</a>
        
        <?php if(strcmp($_SESSION['admin_id'], "1001") == 0){
                    echo '<a href="addAdmin.php" class="list-group-item list-group-item-action">Add admin</a>'
            . '           <a href="searchAdmin.php" class="list-group-item list-group-item-action">Delete admin</a>';
        }
?>
    </div>
    <p><a href="admin_logout.php" class="btn btn-danger">Log out</a></p>
</body>
</html>
