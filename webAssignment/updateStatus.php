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
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        $orderID = $_REQUEST['oid'];
        if(isset($_POST['submit']))
            {
            $pStatus = $_POST['payment'];
            $dStatus = $_POST['delivery'];
           
            $sql2 = "UPDATE customer_order SET payment_status='$pStatus', delivery_status='$dStatus' where order_id='$orderID'";
            if(mysqli_query($link, $sql2)){
                echo '<script>alert("Welcome to Geeks for Geeks")</script>'; 
                header("Location: view_orders.php");
            }
            else{
                $message = "Update failed, Please try again later";
                }
        }
        $sql = "SELECT * from customer_order where order_id=$orderID";
        $result = mysqli_query($link, $sql);
        $row = $result->fetch_assoc();
        mysqli_close($link);    
        ?>       
        
        <div class="container" style="margin-left: 10px;">
            <form action='updateStatus.php?oid=<?php echo $orderID;?>' method='post' class="needs-validation" novalidate enctype="multipart/form-data">
            <h2>Update Order</h2>
            <div>
                <a href="view_orders.php"><i class="fa fa-close"></i></a>
            </div>
            <table class="table table-borderless" width='50%'>  
                <tr>
                    <td><label for="orderID">Order ID:</label></td>
                    <td><input type="text" name="orderID" class="form-control" value="<?php echo $row['order_id']; ?>" disabled></td>
                </tr>
                <tr>
                    <td><label for="Member ID">Member ID:</label></td>
                    <td><input type="text" name="memberID" class="form-control" value="<?php echo $row['member_id'];?>" disabled></td>
                </tr>  
                <tr>
                    <td><label for="date">Order Date:</label></td>
                    <td><input type="text" name="date" class="form-control" value="<?php echo $row['order_date'];?>" disabled></td>
                </tr> 
                <tr>
                    <td><label for="amount">Price:</label></td>
                    <td><input type="text" name="amount" class="form-control" value="<?php echo 'RM '.(number_format((float)$row['amount'],2,'.',''));?>" disabled></td>    
                </tr>            
           
                <tr>
                    <td><label for="payment">Payment Status:</label></td>
                <td>
                    <select name="payment" class="form-control" required="required">
                        <option <?php if(strcmp($row['payment_status'],"Pending")==0){echo'selected';}?> value='Pending'>Pending</option>
                        <option <?php if(strcmp($row['payment_status'],"Received")==0){echo'selected';}?> value='Received'>Received</option>
                        <option <?php if(strcmp($row['payment_status'],"Refunded")==0){echo'selected';}?> value='Refunded'>Refunded</option>
                </select>
                </td>
                <tr>
                    <td width='20%'><label for="delivery">Delivery Status:</label></td>
                <td width='30%'>
                    <select name="delivery" class="form-control" required="required">
                        <option <?php if(strcmp($row['delivery_status'],"Preparing")==0){echo'selected';}?> value='Preparing'>Preparing</option>
                        <option <?php if(strcmp($row['delivery_status'],"Delivering")==0){echo'selected';}?> value='Delivering'>Delivering</option>
                        <option <?php if(strcmp($row['delivery_status'],"Delivered")==0){echo'selected';}?> value='Delivered'>Delivered</option>
                        <option <?php if(strcmp($row['delivery_status'],"Cancelled")==0){echo'selected';}?> value='Cancelled'>Cancelled</option>
                </select>
                </td>
                <td width='50%'></td>
                </tr>            
                                  
                </table>
            
            <?php if(!empty($message)){
                echo'<p>'.$message.'</p>';                             
            }
                ?>
            <input type="submit" name="submit" class="btn btn-primary" value="Change Status">
            <input type="button" name="cancel" value="Cancel" class="btn btn-danger" onclick="window.location.href='view_orders.php'">
            
         </form>
        </div>
        
    </body>
    
</html>
