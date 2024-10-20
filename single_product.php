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
$id = $_GET['Id'];
// $query = "select * from product_tbl where P_Id=$id";
$query = "Select p.*,s.SC_Id,c.C_Id from product_tbl p JOIN subcategory_tbl s ON p.P_SC_Id=s.SC_Id JOIN category_tbl c ON s.C_Id=c.C_Id where p.P_Id=$id";
$result = mysqli_query($con, $query);
$r = mysqli_fetch_assoc($result);
$sc_id = $r['P_SC_Id'];
$c_id = $r['C_Id'];
?>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <h3 class="mb-5" style="color:white;"><?php echo $r['P_Company_Name'] ?></h3>
                <p class="price" style="color:white;">Rs. <?php echo $r['P_Price'] ?></p>
                <div class="product-image">
                    <img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" alt="Product Image"
                        class="img-fluid rounded">
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
                    <a href="order.php?<?php echo $r['P_Id'] ?>"><button class="cirbutton">
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
                <h2 class="mb-5" style="color:white;"><?php echo $r['P_Name'] ?></h2>
                <div class="product-image-large">
                    <img src="db_img/product_img/<?php echo $r['P_Img2'] ?>" alt="Large Product Image"
                        class="img-fluid rounded">
                    <div class="description-on-hover">
                        <p><?php echo $r['P_Desc'] ?></p>
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
            <h2>Featured Products</h2>
            <div class="row mt-1">
                <div class="art-grid">
                    <?php
                    // $q = "Select * from product_tbl where P_SC_Id=$sc_id";
                    $q = "Select p.*,s.SC_Id,c.C_Id from product_tbl p JOIN subcategory_tbl s ON p.P_SC_Id=s.SC_Id JOIN category_tbl c ON s.C_Id=c.C_Id where p.P_Id != $id AND (s.C_Id=$c_id OR p.P_SC_Id=$sc_id )";
                    $result = mysqli_query($con, $q);
                    while ($r = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="card">
                            <a href="single_product.php?Id=<?php echo $r['P_Id'] ?>" class="card">
                                <img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" class="card__image"
                                    alt="<?php echo $r['P_Name']; ?>" />
                                <div class="card__overlay">
                                    <div class="card__header">
                                        <div class="card__header-text">
                                            <h3 class="card__title"><?php echo $r['P_Name'] ?></h3>
                                            <span class="card__status">Rs. <?php echo $r['P_Price'] ?></span>
                                        </div>
                                    </div>
                                    <p class="card__description"><?php echo $r['P_Company_Name'] ?></p>
                                </div>
                            </a>
                        </div>
                        <?php
                    } ?>
                    <!-- <div class="art-item">
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
                    </div> -->
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