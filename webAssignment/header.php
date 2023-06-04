<style>
    .row{
        padding-bottom: 10px;  
    }
    .mini-header{
        margin-left: 25px;
        color: black;
    }
    .mini-header:hover{
        color: lightgreen;
        text-decoration:none;
    }  
    #link-nav-right{
        color: white;
    }
    .nav-item:hover, .navbar-brand:hover{
        font-weight: bold;
    }
    body
    {
        background-image: url("image/pageWallpaper.jpg");
    }
    @font-face 
    {
      font-family: myFirstFont;
      src: url(sansation_light.woff);
    }
    .logu{
        visibility: visible;
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-header">
    <img src="image/logo.jpg" class="mx-auto d-block"> 
    <p></p>
</div>

<nav class="navbar navbar-expand-md bg-warning navbar-dark">
    <a class="navbar-brand" href="index.php?<?php if (isset($_REQUEST['member'])) { echo "member={$_REQUEST['member']}"; } ?>">
        <p><i class="w3-xlarge w3-spin fa fa-home" style="font-size:20px"></i></p></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">  
            
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="product.php?<?php if (isset($_REQUEST['member'])) {
    echo "member={$_REQUEST['member']}&";
} ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
                
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" style="color : black;" href="product.php?<?php if (isset($_REQUEST['member'])) {
    echo "member={$_REQUEST['member']}&";
} ?>filter=all">All</a>
                    <a class="dropdown-item" style="color : black;" href="product.php?<?php if (isset($_REQUEST['member'])) {
    echo "member={$_REQUEST['member']}&";
} ?>filter=blazers">Blazers</a>
                    <a class="dropdown-item" style="color : black;" href="product.php?<?php if (isset($_REQUEST['member'])) {
    echo "member={$_REQUEST['member']}&";
} ?>filter=shirts">Shirts</a>
                    <a class="dropdown-item" style="color : black;" href="product.php?<?php if (isset($_REQUEST['member'])) {
    echo "member={$_REQUEST['member']}&";
} ?>filter=formalShoes">Formal Shoes</a>
               </div>
            </li>


            <li class="nav-item active" id="adm">
                <a class="nav-link" href="admin_login.php">Admin</a>
            </li>
            
            <li class="nav-item active" id="logu">
                <a class="nav-link" href="member_logout.php">Logout</a>    
            </li>

            <li class="nav-item active" id="signin">
                <a class="nav-link" href="signin.php">Sign In/Register</a>    
            </li>
            
            <li class="nav-item active">
                <a class="nav-link"  href="cart.php?<?php
                if (isset($_REQUEST['member'])) {
                    echo "member=".$_REQUEST['member'];
                }
                ?>"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
            </li>

        </ul>
        <h1 class="font-Change">
            <?php
            if (isset($_SESSION['loggedin']))
                {
                    echo'<style>#adm{visibility:hidden;}#signin{visibility:hidden;}</style>';
                    echo'<div class="text-center" style="background-color: black; color:wheat; font-family: myFirstFont;">Welcome ' . strtoupper($_SESSION['name']) . '</div>';
                } 
            else 
                echo'<style>#logu{visibility:hidden;}</style>';
            ?>
        </h1>
    </div>
</nav>

