<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <?php
    include 'Header.php';
    if (!isset($_SESSION['U_Admin']) && !isset($_SESSION['U_User'])) {
        header("Location: Login.php");
        exit();
    }
    ?>
</head>
<body class="bg-dark">    
<div class="container mt-5">
        <div class="row" style="text-align: center;">
            <h2>Welcome to Wishlist!</h2>
            <div class="col-md-6">
                <p>Total:1,300</p>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark">Remove All</button>
            </div>

        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Left column : Image -->
            <div class="col-md-4">
                <div class="product-image-circle">
                    <img src="img/easeal1.png" alt="User Image" class="img-fluid rounded">
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-md-5">
                <div class="product-image-large">
                    <!-- product Information -->
                    <h4>BASIC FRAME TRIPOD EASEL PINE WOOD 5 FEET</h4>
                    <p class="price" style="font-size: 16px;">Rs. 1,300</p>
                    <p>Himalaya Fine Arts</p>
                    <!-- Quantity:
                <select id="quantity" class="form-select" style="width: 100px;">
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select> -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-image-large">
                    <a href="cart.php"><button type="submit" class="btn btn-dark"><i
                                class="fa fa-shopping-cart"></i></button></a>
                    <a href="order.php"><button type="submit" class="btn btn-dark"><i
                                class="fa fa-arrow-right"></i></button></a>
                    <button type="submit" class="btn btn-dark"><i class="fa fa-times"></i></button>
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