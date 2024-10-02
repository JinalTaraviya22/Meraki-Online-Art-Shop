<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <?php
    include('Header.php');
    ?>
    <style>
        /* .container{
        background-color: rgba(165, 165, 165, 0.7);
        border-radius: 50px;
        padding: 50px;
      } */
    </style>
</head>


<!-- <body style="background-image: url(img/bg6.png);background-size: cover;color:white;"> -->
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row" style="text-align: center;">
            <h2>Order History</h2>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Left column : Image -->
            <div class="col-md-4">
                <a href="single_product.php">
                    <div class="product-image-circle">
                        <img src="img/easeal1.png" alt="User Image" class="img-fluid rounded">
                    </div>
                </a>
            </div>
            <!-- Right Column -->
            <div class="col-md-6">
                <div class="product-image-large">
                    <h4>BASIC FRAME TRIPOD EASEL PINE WOOD 5 FEET</h4></a>
                    <p class="price" style="font-size: 16px;">Rs. 1,300</p>
                    Quantity:5
                    Date & Time:23-Aug-24 11:35 PM
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <?php
    include('Footer.php');
    ?>
</body>

</html>