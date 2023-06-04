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
                
        if(isset($_POST['add']))
        {
            $adminID = trim($_POST['adminID']);
            $adminName = trim($_POST['uesrName']);
            $pass = trim($_POST['password']);
            $confirm_pass = trim($_POST['confirm_password']);
            $adminName = $link->  real_escape_string($adminName);
            $adminName = $link-> real_escape_string($adminName);
            
            $sql2 = "select * from admin where admin_id = '$adminID' ";
            $link -> query($sql2);
            if($link -> affected_rows > 0)
            {
                $error['id']= "The Admin ID is existed";
            }
            else if(empty ($adminID))
            {
                $error['id'] = "Admin id is required in this form";
            }
            
            if(empty ($adminName))
            {
                $error['name'] = "Your user name is required in this form";
            }
            
            if(strlen($pass) <6 )
            {
                $error['password'] = "Your password should not less than 6 character";
            }
            else if(empty ($pass))
            {
                $error['password'] = "Your password is required in this form";
            }
            else if(empty ($confirm_pass))
            {
                $error['password'] = "Please the confirm password ";
            }
            else if($pass != $confirm_pass)
            {
                $error['password'] = "Your password is no match with confirm password";
            }
            
            if(empty($error))
            {
                $sql = "INSERT INTO admin (admin_id,username,password) VALUES ('$adminID','$adminName','$pass')";
                if((mysqli_query($link, $sql) >  0))
                     echo "<h1 style='color: Blue'>Successfully Added</h1>";
                else
                    echo "<h1 style='color: red'>Failed to add</h1>";
            }
            
              $link -> close();     
        }  
        ?>
        
        <div class="container" style="margin-left: 10px;">
            <form action='' method='post' class="needs-validation">
            <h2>Add Admin</h2>
            <div>
                <a href="welcome_admin.php"class="w3-xlarge"><i class="fa fa-close"></i></a>
            </div>
            <table class="table table-borderless">                
                    <tr>
                        <td><label for="adminID">Admin ID :</label></td>
                        <td><input type="text" name="adminID" class="form-control" maxlength="5"><a style="color:red"><?php if(isset($error['id'])) {echo $error['id'];} ?></a></td>
                    </tr>
                
            
                <tr>
                    <td><label for="uesrName">User Name :</label></td>
                    <td><input type="text" name="uesrName" class="form-control"><a style="color:red"><?php if(isset($error['name'])) {echo $error['name'];} ?></a></td>    
                </tr>
            
           
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" class="form-control" maxlength="14"></td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" name="confirm_password" class="form-control" maxlength="14"><a style="color:red"><?php if(isset($error['password'])) {echo $error['password'];} ?></a></td>
                </tr>
                </table>
            <input type="submit" name="add" value="Add" class="btn btn-primary">
            <input type="reset" name="reset" class="btn btn-danger" onclick="location.reload();">
            
         </form>
        </div>
        
    </body>
    
</html>
