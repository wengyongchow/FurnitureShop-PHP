<?php 
session_start();
if(empty($_SESSION['loggedin'])){
    header('Location: index.php');
}

?>
<html>
    <head>
        <?php include'links.php'; ?>
        <title>Admin Panel</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style>
        body{
                 background-image:  url('image/adminWallpaper.jpg');
                  background-repeat: no-repeat;
                  background-attachment: fixed; 
                  background-size: 100% 100%;
            }
    </style>
    <body>
        <?php
        require_once 'config.php';
        $sql="SELECT * from customer_order";
        $orderArray = mysqli_query($link, $sql);
        $numOfRow = $link->affected_rows; 
        ?>
        
        <div style="margin-left: 10px;">
        <h2>View orders</h2>
        <div style="margin-bottom: 5px;">
            <a href="welcome_admin.php"><i class="fa fa-arrow-circle-o-left" style="font-size:36px; color: black;"></i></a>
        </div>        
        <table class="table" style="width:80%">
            <thead>
                <tr><th>Order ID</th><th>Member ID</th><th>Order Date</th><th>Order Amount</th><th>Payment Status</th><th>Delivery Status</th><th width='15%'>Check</th></tr>
            </thead>
            <tbody>   
          <?php
          
            while ($row = $orderArray->fetch_assoc()) 
                {
                
                echo "<tr>"
                    ."<td>{$row['order_id']}</td>"
                    ."<td>{$row['member_id']}</td>"
                    ."<td>{$row['order_date']}</td>"
                    ."<td>","RM ",number_format((float)$row['amount'],2,'.',''),"</td>"
                    ."<td>{$row['payment_status']}</td>"    
                    ."<td>{$row['delivery_status']}</td>"                        
                    ."<td><a href='updateStatus.php?oid={$row['order_id']}'><i style='font-size:24px; color:black;' class='fa'>&#xf152;</i><a></td></tr>";
            }            
            ?>
            </tbody></table>
        </div>
        <?php
        mysqli_close($link); 
        ?>
    </body>
</html>
