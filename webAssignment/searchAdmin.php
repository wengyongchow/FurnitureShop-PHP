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
        <div class="container" style="margin-left: 10px;">
            <form action='deleteAdmin.php' method='post' class="needs-validation">
            <h2>Search Admin</h2>
            <div>
                <a href="welcome_admin.php"class="w3-xlarge"><i class="fa fa-close"></i></a>
            </div>
            <table class="table table-borderless">                
                    <tr>
                        <td><label for="adminID">Admin ID :</label></td>
                        <td><input type="text" name="adminID" class="form-control" maxlength="5" required="required"></td>
                    </tr>
                    <tr>
                        <th><input type="submit" name="submit" value="Submit" /></th>
                    </tr>
            </table>
         </form>
        </div>
        
    </body>
    
</html>
