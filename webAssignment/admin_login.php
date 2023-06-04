<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
    header("location: welcome_admin.php?admin={$_SESSION["username"]}");
    exit;
    }
 
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    if(empty(trim($_POST["username"])))
            $username_err = "Please enter username.";
    else
            $username = trim($_POST["username"]);
    
    if(empty(trim($_POST["password"])))
            $password_err = "Please enter your password.";
    else
            $password = trim($_POST["password"]);
    
    if(empty($username_err) && empty($password_err))
        {
            $sql = "SELECT admin_id, username, password FROM admin WHERE username = ?";

            if($stmt = mysqli_prepare($link, $sql))
                {
                    mysqli_stmt_bind_param($stmt, "s", $param_username);

                    $param_username = $username;

                      if(mysqli_stmt_execute($stmt))
                      {
                            mysqli_stmt_store_result($stmt);

                            if(mysqli_stmt_num_rows($stmt) == 1)
                             {                    
                                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                                    while(mysqli_stmt_fetch($stmt))
                                    {
                                            if(strcmp($password, $hashed_password) == 0)
                                            {
                                                session_start();

                                                $_SESSION["loggedin"] = true;
                                                $_SESSION["admin_id"] = $id;
                                                $_SESSION["username"] = $username;                            

                                                header("location: welcome_admin.php?admin={$username}");
                                                exit;
                                            }
                                            else
                                            {
                                                $password_err = "The password you entered was not valid.";
                                            }
                                    }
                            }
                            else
                                $username_err = "No account found with that username.";
                      }
                    else
                        echo "Oops! Something went wrong. Please try again later.";

                    mysqli_stmt_close($stmt);
            }
    }
    
    mysqli_close($link);
}
?>
<html lang = "en">
   
   <head>      
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="generator" content="Jekyll v4.0.1">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>  

        <link href="assets/css/bootstrap.css" rel="stylesheet">   
        <link href="assets/css/homepage.css" rel="stylesheet">    
        <script src="assets/javascript/bootstrap.bundle.js"></script> 

        <title>AdminLogin</title> 

    </head>      
      <style type="text/css">
        body
        { 
            font: 14px sans-serif;            
            background-image:  url('image/adminWallpaper.jpg');
              background-repeat: no-repeat;
              background-attachment: fixed; 
              background-size: 100% 100%;
        }

        .wrapper
        { 
            width: 350px; 
            padding: 50px; 
            margin-left: 40%;
            margin-top: 70px;
        }
    </style>
    <script>
        function goBack() {
        window.history.back();
    }
    </script>
      
   </head>
	
   <body>      
       <div class="wrapper">
        <h2>Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
                <a href="index.php"><input style="margin-left: 10px; "type="button" class="btn btn-danger" value="Back"></a>
            </div>
        </form>            
    </div> 
      
   </body>
</html>
