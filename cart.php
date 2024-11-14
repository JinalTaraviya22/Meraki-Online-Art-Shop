<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
    $Email_Session = isset($_SESSION['U_User']) ? $_SESSION['U_User'] : $_SESSION['U_Admin'];
    ?>
    <style>
        tr {
            border: 1px black solid;
            text-align: center;
        }

        table {
            width: 100%;
        }

        th,
        td {
            width: 100%;
            border: 1px black solid;
            padding: 10px;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 40%;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container-fluid mt-5 bgcolor">
        <div class="row" style="text-align: center;">
            <h2>Welcome to Cart!</h2>
            <div class="col-md-6">
                <?php
                $totalAmount = 0;
                $query = "SELECT p.*, c.* FROM product_tbl p JOIN cart_tbl c ON p.P_Id = c.Ct_P_Id WHERE c.Ct_U_Email = '$Email_Session' ORDER BY c.Ct_Id DESC";
                $result = mysqli_query($con, $query);
                $cartItems = mysqli_num_rows($result);

                if ($cartItems > 0) {
                    while ($r = mysqli_fetch_assoc($result)) {
                        $totalAmount += $r['P_Price'] * $r['Ct_Quantity']; // total
                    }
                    ?>
                    <p>Total:<?php echo $totalAmount ?></p>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-dark">Check Out</button>
                </div>

            </div>
        </div>

        <div class="container-fluid mt-5 mb-5 bgcolor">
            <div class="row" id="product">
                <table>
                    <tr>
                        <!-- <th style="width:50px">Id</th> -->
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Order</th>
                        <th>Disable</th>
                    </tr>
                    <?php
                    $query = "SELECT p.*,c.* FROM product_tbl p JOIN cart_tbl c ON p.P_Id=c.Ct_P_Id WHERE c.Ct_U_Email='$Email_Session' order by c.Ct_Id desc";
                    $result = mysqli_query($con, $query);
                    while ($r = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <!-- <td><?php echo $r['Ct_Id'] ?></td> -->
                            <td><?php echo $r['P_Name'] ?></td>
                            <td><?php echo $r['P_Price'] ?></td>
                            <td>
                                <!-- <select>
                                <option>3</option>
                                <option>1</option>
                            </select> -->
                                <?php echo $r['Ct_Quantity'] ?>
                            </td>
                            <td><img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" height="100px" width="100px"></td>
                            <td><img src="db_img/product_img/<?php echo $r['P_Img2'] ?>" height="100px" width="100px"></td>
                            <form method="post">
                                <input type="hidden" name="cartId" value="<?php echo $r['Ct_Id'] ?>">

                                <td><a href="order.php"><button type="submit" name="order" id="order" class="btn btn-dark"><i
                                                class="fa fa-shopping-bag"></i></button></a></td>
                                <td><button type="submit" name="deleteitem" class="btn btn-dark"
                                        style="background-color:#ad3434;"><i class="fa fa-times"></i></button></td>
                            </form>
                        </tr>
                    <?php
                    }
                } else {
                    echo 'Your cart is empty!';
                } ?>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <?php
    include 'Footer.php';

    // if (isset($_POST['order'])) {
    //     $or_P_Id = $id;
    //     $or_U_Email = $Email_Session;
    //     $sql = "INSERT INTO orders_tbl (or_U_Email,or_P_Id, or_Quantity) VALUES ('$or_U_Email', '$or_P_Id', '$Ct_Quantity')";
    //     $data = mysqli_query($con, $sql);
    
    //     if ($data) {
    //         echo "<script>location.replace('order.php');</script>";
    //     } else {
    //         echo "Error inserting data into wishlist";
    //     }
    // }
    
    if (isset($_POST['deleteitem'])) {
        $id = $_POST['cartId'];

        $query = "delete from cart_tbl where Ct_Id=$id";
        $data = mysqli_query($con, $query);

        if ($data) {
            setcookie('success', "Product removed from cart", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'cart.php';
            </script>";
            <?php
        }
        echo $id;

    }
    ?>
</body>

</html>