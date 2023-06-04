<?php session_start();?>
<!DOCTYPE html>
<!-- 
Course: DIT2
Group Members: Chow weng yong, lim chiaw aik
Tutorial Group: Group 11
-->
<!doctype html>
<html lang="en">
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

        <title>PAIKEA</title> 
        
    </head>
    <body>
        <?php        
        include 'header.php';          
        ?>     


        <div id="slide" class="carousel slide" data-ride="carousel"> 
            <ul class="carousel-indicators">
                <li data-target="#slide" data-slide-to="0" class="active"></li>
                <li data-target="#slide" data-slide-to="1"></li>
                <li data-target="#slide" data-slide-to="2"></li>
            </ul>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="image/model1.jpg" alt="Slide 1">
                </div>
                
                <div class="carousel-item">
                    <img src="image/model2.jpg" alt="Slide 2">
                </div>
                
                <div class="carousel-item">
                    <img src="image/model3.jpg" alt="Slide 3">
                </div>
            </div>
            
            <a class="carousel-control-prev" href="#slide" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            
            <a class="carousel-control-next" href="#slide" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
            
            
        </div>      

        <?php
        include 'footer.php'
        ?>

</html>

