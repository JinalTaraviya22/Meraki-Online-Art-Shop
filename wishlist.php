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
    $Email_Session=isset($_SESSION['U_User'])?$_SESSION['U_User']:$_SESSION['U_Admin'];    
    
    $query = "SELECT p.*,w.* FROM product_tbl p JOIN wishlist_tbl w ON p.P_Id=w.W_P_Id WHERE w.W_U_Email='$Email_Session' order by w.W_Id desc";
    $result = mysqli_query($con, $query);
    ?>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row" style="text-align: center;">
            <h2>Welcome to Wishlist!</h2>
            <div class="col-md-6">
                <p>0</p>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark">Remove All</button>
            </div>

        </div>
    </div>

    <div class="container mt-5 mb-5">
        <?php 
             while ($r = mysqli_fetch_assoc($result)) {
        ?>
        <div class="row mb-5">
            <!-- Left column : Image -->
            <div class="col-md-3">
                <div class="product-image-circle">
                    <img src="db_img/product_img/<?php echo $r['P_Img1']?>" alt="User Image" class="img-fluid rounded">
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-md-6">
                <div class="product-image-large">
                    <!-- product Information -->
                    <h4><?php echo $r['P_Name']?></h4>
                    <p class="price" style="font-size: 16px;">Rs. <?php echo $r['P_Price']*$r['W_quantity']?></p>
                    <p><?php echo $r['P_Company_Name']?></p>
                    Quantity:
                    <select id="quantity" class="form-select" style="width: 100px;">
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
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
        <?php 
             }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <?php
    include 'Footer.php';
    ?>
</body>

</html>