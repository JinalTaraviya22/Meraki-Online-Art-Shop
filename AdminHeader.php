<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
   
    <style>
        .header {
            background-color: rgba(165, 165, 165, 0.7);
            padding: 10px 20px;
            border-radius: 30px;
            margin: 20px 5%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logo img {
            height: 30px;
        }
        .nav a {
            margin: 0 15px;
            text-decoration: none;
            color: white;
            font-size: 16px;
        }
        .login-register a {
            text-decoration: none;
            color: white;
            font-size: 16px;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgba(165, 165, 165, 0.7);
            min-width: 160px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px 4px;
            z-index: 0;
        }
        .dropdown-menu{
            background-color: rgba(165, 165, 165, 0.7);
            color:white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }
            .nav a {
                margin: 5px 0;
            }
            .login-register {
                width: 100%;
                text-align: right;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand logo" href="#">
                    <img src="img/logo1.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="admin.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin.php#discount">Discount/Offers</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin.php#category">Category</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu" >
                                <li><a class="dropdown-item" href="AdOrders.php">Orders</a></li>
                                <li><a class="dropdown-item" href="AdProducts.php">Products</a></li>
                                <li><a class="dropdown-item" href="AdUsers.php">Users</a></li>
                                <li><a class="dropdown-item" href="">Site Settings</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu" >
                                <li><a class="dropdown-item" href="Index.php">User's Index</a></li>
                                <li><a class="dropdown-item" href="Account.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                <li><a class="dropdown-item" href="wishlist.php">Wish List</a></li>
                                <li><a class="dropdown-item" href="order.php">Order Now</a></li>
                                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="login-register">
                        <a href="Login.php">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    include 'conn.php';
?>