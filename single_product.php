<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <style>
        .art-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .art-item {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
        }
    </style>
    <?php
    include 'Header.php';
    ?>
</head>

<?php 
    
     $query = "select * from product_tbl where P_Id=''";
     $result = mysqli_query($con, $query);
     $r = mysqli_fetch_assoc($result);
?>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <h3 class="mb-5" style="color:white;">Himalaya Fine Arts</h3>
                <p class="price" style="color:white;">Rs. 1,300</p>
                <div class="product-image">
                    <img src="img/easeal1.png" alt="Product Image" class="img-fluid rounded">
                </div>
                <div class="quantity mt-3">
                    <label for="quantity">Quantity:</label>
                    <select id="quantity" class="form-select">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                    </select>
                </div>
                <div class="col-md-8 mt-3">
                    <a href="order.php"><button class="cirbutton">
                            <div class="icon-container">
                                <i class="fa fa-shopping-bag" style="color:white;"></i>
                            </div><span>Buy Now</span>
                        </button></a><br /><br />
                    <a href="cart.php"><button class="cirbutton">
                            <div class="icon-container">
                                <i class="fa fa-shopping-cart" style="color:white;"></i>
                            </div><span>Add to Cart</span>
                        </button></a><br /><br />
                    <a href="wishlist.php"><button class="cirbutton">
                            <div class="icon-container">
                                <i class="fa fa-heart" style="color: white;"></i>
                            </div><span>Add to Wishlist</span>
                        </button></a>
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-md-8">
                <h2 class="mb-5" style="color:white;">BASIC FRAME TRIPOD EASEL PINE WOOD 5 FEET</h2>
                <div class="product-image-large">
                    <img src="img/easeal2.png" alt="Large Product Image" class="img-fluid rounded">
                    <div class="description-on-hover">
                        <p>Himalaya Basic Easel is an economically priced studio easel provides excellent value for
                            money for students and professionals. The sturdy tri-mast A-frame design is lightweight,
                            portable, and durable. Collapses to flat & narrow for storage convenience.</p>
                        <div class="stars">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add a Review Section -->
    <!-- <div class="container mt-5">
        <div class="row mt-5">
            <div class="col">
                <h5>Add a review</h5>
                <form>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="name" placeholder="First Name Last Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="review" class="form-label">Review</label>
                        <textarea class="form-control" id="review" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rating" class="form-label">Ratings:</label>
                        <div class="stars">
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark"><i class="fa fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div> -->

    <!-- similar products area -->
    <div class="container mt-5 mb-5">
        <section class="featured" id="latest">
            <h2>Similar Products</h2>
            <div class="row mt-1">
                <div class="art-grid">
                        <div class="art-item">
                            <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                            <h3 class="mt-2">Product Name</h3>
                            <p>Company Name</p>
                            <p>Rs. 13,000</p>
                            <a href="single_product.php"><button class="cirbutton">View</button></a>
                        </div>
                        <div class="art-item">
                            <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                            <h3 class="mt-2">Product Name</h3>
                            <p>Comapny Name</p>
                            <p>$200</p>
                            <a href="single_product.php"><button class="cirbutton">View</button></a>
                        </div>
                        <div class="art-item">
                            <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                            <h3 class="mt-2">Product Name</h3>
                            <p>Comapny Name</p>
                            <p>$200</p>
                            <a href="single_product.php"><button class="cirbutton">View</button></a>
                        </div>
                    <!-- Add more artworks as needed -->
                </div>
            </div>
        </section>

    </div>
    <?php
    include "Footer.php";
    ?>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>