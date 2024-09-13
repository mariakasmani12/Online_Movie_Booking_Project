<?php 

include("header.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
    <style>
        .bg {
            background-color: #222028;
            width: 480px;
            overflow: hidden;
            margin: 0 auto;
            box-sizing: border-box;
            padding: 40px;
            font-family: 'Roboto';
            margin-top: 40px;
        }
        .card {
            background-color: #fff;
            width: 100%;
            float: left;
            margin-top: 20px; /* Reduced margin-top */
            border-radius: 5px;
            box-sizing: border-box;
            padding: 40px 20px 20px 20px; /* Adjusted padding */
            text-align: center;
            position: relative;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            /* Reduced height by adjusting padding and margins */
        }
        .card__success {
            position: absolute;
            top: -40px; /* Adjusted top position */
            left: 50%; /* Centered the icon horizontally */
            transform: translateX(-50%); /* Centered the icon horizontally */
            width: 80px; /* Reduced size */
            height: 80px; /* Reduced size */
            border-radius: 100%;
            background-color: #f9ab00;
            border: 5px solid #fff;
        }
        .card__success i {
            color: #fff;
            line-height: 80px; /* Adjusted line-height */
            font-size: 35px; /* Reduced font-size */
        }
        .card__price {
            color: #232528;
            font-size: 50px; /* Reduced font-size */
            margin-top: 15px; /* Adjusted margins */
            margin-bottom: 20px;
        }
        .card__price span {
            font-size: 60%;
        }
        .card__recipient {
            color: #232528;
            text-align: center;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px; /* Reduced font-size */
        }
    </style>
</head>
<body>
    <div class="col-12" style="margin-top:200px; margin-bottom:200px;">
    <div class="bg">
        <div class="card">
          <a href="index2.php"> <span class="card__success"><i class="bi bi-check-lg" style="margin-top 150px;"></i></span></a> 
            <div class="card__body">
                <h1 class="card__price">Payment Completed</h1>
                <p class="card__recipient">Thank you for your transfer</p>
            </div>
        </div>
    </div>
    </div>
</body>
</html>

<?php
include("footer.php");
?>
