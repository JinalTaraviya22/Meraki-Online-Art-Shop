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
    // session_start();
    // if (!isset($_SESSION['U_User']) && !isset($_SESSION['U_Admin'])) {
    //     header("Location: Login.php");
    //     exit();
    // }
    $Email_Session = isset($_SESSION['U_User']) ? $_SESSION['U_User'] : $_SESSION['U_Admin'];
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
                <form method="POST" action="single_product.php?Id=<?php echo $r['P_Id']; ?>">
                    <div class="quantity mt-3">
                        <label for="quantity">Quantity:</label>
                        <select name="quan" class="form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-md-8 mt-3">
                        <a href="order.php?id=<?php echo $r['P_Id'] ?>"><button type="submit" name="order" id="order"
                                class="cirbutton">
                                <div class="icon-container">
                                    <i class="fa fa-shopping-bag" style="color:white;"></i>
                                </div><span>Buy Now</span>
                            </button></a><br /><br />
                        <a href="cart.php?id=<?php echo $r['P_Id'] ?>"><button type="submit" name="cart" id="cart"
                                class="cirbutton">
                                <div class="icon-container">
                                    <i class="fa fa-shopping-cart" style="color:white;"></i>
                                </div><span>Add to Cart</span>
                            </button></a>
                        <br /><br />
                        <a href="wishlist.php" value="<?php echo $r['P_Id'] ?>"><button type="submit" class="cirbutton"
                                name='wish' id='wish'>
                                <div class="icon-container">
                                    <i class="fa fa-heart" style="color: white;"></i>
                                </div><span>Add to Wishlist</span>
                            </button></a>
                    </div>
                </form>
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
                </div>
            </div>
        </section>
    </div>

    <?php
    include "Footer.php";
    if (isset($_POST['order'])) {
        $or_Quantity = $_POST['quan'];
        $or_P_Id = $id;
        $or_U_Email = $Email_Session;

        $sql = "INSERT INTO orders_tbl (or_U_Email,or_P_Id, or_Quantity) VALUES ('$or_U_Email', '$or_P_Id', '$or_Quantity')";
        $data = mysqli_query($con, $sql);

        if ($data) {
            echo "<script>location.replace('order.php');</script>";
        } else {
            echo "Error inserting data into wishlist";
        }

    }
    if (isset($_POST['cart'])) {
        $Ct_Quantity = $_POST['quan'];
        $Ct_P_Id = $id;
        $Ct_U_Email = $Email_Session;

        $chechQuery = "select * from cart_tbl where Ct_P_Id=$Ct_P_Id And Ct_U_Email=$Ct_U_Email";
        $CheckData = mysqli_query($con, $chechQuery);

        if ($CheckData) {
            $sql = "INSERT INTO cart_tbl (Ct_Quantity, Ct_P_Id, Ct_U_Email) VALUES ('$Ct_Quantity', '$Ct_P_Id', '$Ct_U_Email')";
            $data = mysqli_query($con, $sql);

            if ($data) {
                echo "<script>location.replace('cart.php');</script>";
            } else {
                echo "Error inserting data into cart";
            }
        } else {
            setcookie('success', "This product is already in cart!!!", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'cart.php';
            </script>";
            <?php
        }
    }

    if (isset($_POST['wish'])) {
        $W_Quantity = $_POST['quan'];
        $W_P_Id = $id;
        $W_U_Email = $Email_Session;

        $checkQuery = "select * from wishlist_tbl where W_P_Id=$W_P_Id And W_U_Email=$W_U_Email";
        $CheckData = mysqli_query($con, $checkQuery);

        if ($CheckData) {
            $sql = "INSERT INTO wishlist_tbl (W_U_Email,W_P_Id, W_Quantity) VALUES ('$W_U_Email', '$W_P_Id', '$W_Quantity')";
            $data = mysqli_query($con, $sql);

            if ($data) {
                echo "<script>location.replace('wishlist.php');</script>";
            } else {
                echo "Error inserting data into wishlist";
            }
        } else {
            setcookie('success', "This product is already in your Wishlist!!!", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'wishlist.php';
            </script>";
            <?php
        }

    }

    ?>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>