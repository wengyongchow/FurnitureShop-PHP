<?php 
session_start();
if (empty($_SESSION['loggedin'])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'links.php'?>
        <meta charset="UTF-8">
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
        if(isset($_POST['adminID']))
        {
            $id = trim($_POST['adminID']);

            $sql = "select * from admin where admin_id = $id";
            $result = mysqli_query($link, $sql);
            $row = $result -> fetch_object();
            if(isset($row))
            {
                $adminID = $row->admin_id;
                $userName = $row->username;
                $dateCreated = $row->created_at;

                if($adminID == 1001)
                {
                    echo '<h1>This is the owner id, cannot delete..</h1>';
                    echo '<style>#copcop{visibility: hidden;} </style>';
                }
                else
                    echo '<h1>Admin Found ! </h1>';
                $result -> free();
            }
            else
            {
                echo '<h1 style="color:red;">Admin Not found</h1>';
                echo '<style>#copcop{visibility: hidden;} </style>';
            }
        }
        if(isset($_POST['yes']))
        {
            $id = $_REQUEST['adminID'];
            $sql2 = "delete from admin where admin_id = $id";
            if(mysqli_query($link, $sql2))
            {
                echo '<h1> delete successfully</h1>';
            }
            else
            {
                echo '<h1>fail to delete</h1>';
            }
        }
        $link -> close();
        ?>  
            
            <div class="container" style="margin-left: 10px;">
                <form action='deleteAdmin.php?adminID=<?php echo $id;?>' method='post' class="needs-validation" >
                    <h2 style="color : black">Delete Admin</h2>
            <div>
                <a href="manageProduct.php"><i class="fa fa-close"></i></a>
            </div>
            <table class="table table-borderless">  
                <tr>
                    <td><label for="productID">Admin ID</label></td>
                    <td><input type="type" name="id" class="form-control" value="<?php if(isset($adminID)) echo  $adminID;?>" disabled></td>
                </tr>
                    <tr>
                        <td><label for="productName">Admin Name</label></td>
                        <td><input type="text" name="userName" class="form-control" value="<?php if(isset($userName)) echo $userName;?>" disabled></td>
                    </tr>           
            
                <tr>
                    <td><label for="price">Date Created of the account </label></td>
                    <td><input type="text" name="date" class="form-control" value="<?php if(isset($dateCreated)) echo $dateCreated; ?>" disabled></td>    
                </tr>            
                </table>

            <div id="copcop">
            <input type="submit" name="yes" class="btn btn-primary" value="Yes">
            <input type="button" name="cancel" value="Cancel" class="btn btn-danger" onclick="window.location.href='welcome_admin.php'">
            </div>
         </form>
        </div>
     </body>
</html>
