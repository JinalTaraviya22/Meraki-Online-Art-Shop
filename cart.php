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
                        $totalAmount += ($r['P_Price'] - ($r['P_Price'] * $r['P_Discount'] / 100)) * $r['Ct_Quantity']; // total
                    }
                    ?>
                    <p>Total: <b><?php echo $totalAmount;
                        $_SESSION['CartTotal']=$totalAmount;?></b></p>
                </div>
                <div class="col-md-6">
                    <a href="#checkOut_form"><button type="submit" class="btn btn-dark">Check Out</button></a>
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
                        <th>Discounted Price</th>
                        <th>Total</th>
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
                            <td><?php
                            $discounted = $r['P_Price'] * $r['P_Discount'] / 100;
                            echo $discounted ?></td>
                            <td><?php echo ($r['P_Price'] - $discounted) * $r['Ct_Quantity'] ?></td>
                            <td><img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" height="100px" width="100px"></td>
                            <td><img src="db_img/product_img/<?php echo $r['P_Img2'] ?>" height="100px" width="100px"></td>
                            <form method="post">
                                <input type="hidden" name="cartId" value="<?php echo $r['Ct_Id'] ?>">

                                <td><a href="order.php"><button type="button" name="order" id="order" class="btn btn-dark"><i
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
    <div class="container-fluid bgcolor mt-5" id="checkOut_form">
        <div class="row">
            <!-- Images Column -->
            <div class="col-md-4">
                <div class="product-image">
                    <form method="post">
                        <label for="anm" class="form-label">Offer Code:</label>
                        <input type="text" class="form-control" name="offercode" id="offercode">
                        <span id="offercode_er"></span><br>
                        <button class="btn btn-dark" type="submit" name="offerApply">Apply</button>
                    </form>
                    <hr />

                    <table style="border: none; border-collapse: collapse; width: 100%;">
                        <tr style="border: none; padding: 10px;">
                            <td style="border: none; padding: 10px;text-align:start">
                                Discount:
                            </td>
                            <td style="border: none; padding: 10px;text-align:end">
                                <span id="discount_percentage"></span>
                            </td>
                        </tr>
                        <tr style="border: none; padding: 10px;">
                            <td style="border: none; padding: 10px;text-align:start">
                                Discounted Amount:
                            </td>
                            <td style="border: none; padding: 10px;text-align:end">
                                <span id="discount_amount"></span>
                            </td>
                        </tr>
                        <tr style="border: none; padding: 10px;">
                            <td style="border: none; padding: 10px;text-align:start">
                                Total:
                            </td>
                            <td style="border: none; padding: 10px;text-align:end">
                            <span id="new_cart_total"></span>
                            </td>
                        </tr>
                    </table>
                    <!-- <img src="db_img/img/bg1.png" height="100px" width="100px" alt="Product Image"
                        class="img-fluid rounded"> -->
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-md-8">
                <div class="product-image-large">
                    <!-- update information -->
                     <?php 
                        $fetchUsr="select * from user_tbl where U_Email='$Email_Session'";
                        $result = mysqli_query($con, $fetchUsr);
                        $r = mysqli_fetch_assoc($result);
                     ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- <input type="hidden" name="ofid" value="<?php echo $r['Of_Id'] ?>"> -->
                            <!-- <input type="hidden" name="oldimg" value="<?php echo $r['Of_Img'] ?>"> -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Email :</label>
                                <input type="text" class="form-control" name="umd" id="umd" value="<?php echo $r['U_Email']?>"
                                    readonly>
                                <span id="sadd_er"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Phone Number :</label>
                                <input type="text" class="form-control" name="umd" id="umd" 
                                value="<?php echo $r['U_Phn']?>">
                                <span id="padd_er"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Shipping Address :</label>
                                <textarea class="form-control" id="sadd"
                                    placeholder="Enter your shipping address"><?php echo $r['U_Add']?></textarea>
                                <span id="sadd_er"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">State :</label>
                                <input type="text" class="form-control" name="state" id="state"
                                value="<?php echo $r['U_State']?>">
                                <span id="sadd_er"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">City :</label>
                                <input type="text" class="form-control" name="city" id="city"
                                value="<?php echo $r['U_City']?>">
                                <span id="padd_er"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Zip :</label>
                                <input type="text" class="form-control" name="zip" id="zip"
                                value="<?php echo $r['U_Zip']?>">
                                <span id="padd_er"></span>
                            </div><div class="col-md-3"></div>
                            <div class="col-md-3" style="align-content: end;">
                                <button type="submit" class="btn btn-dark" name="payNow">Check Out</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <?php
    include 'Footer.php';
    
    if(isset($_POST['offerApply']))
    {
        $cart_total=$_SESSION['CartTotal'];
        $offer=$_POST['offercode'];

        $checkCode="select * from offers_tbl where Of_Name='$offer' AND Of_Status='Active'";
        $result=mysqli_query($con,$checkCode);
        if(mysqli_num_rows($result)>0)
        {
            ?>
            <script>
                document.getElementById('offercode_er').style.color = "white";
                document.getElementById('offercode_er').innerHTML = "Offercode applied successfully";
            </script>
            <?php
             $data = mysqli_fetch_assoc($result);
             $discount_percentage = $data['Of_Discount_Percentage'];
             $discount_amount = ($cart_total * $discount_percentage) / 100;
             $order_total = $data['Of_Cart_Total'];
             $max_discount = $data['Of_Max_Discount'];
             $offer = $data['Of_Name'];

             if ($cart_total > $order_total) {

                if ($discount_amount > $max_discount) {
                    $discount_amount = $max_discount;
                } else {
                    $discount_amount = ($cart_total * $discount_percentage) / 100;
                }
                $new_cart_total = $cart_total - $discount_amount;
                ?>
                <script>
                    // document.getElementById('offer_code').innerHTML = '<?php echo $offer; ?>';
                    document.getElementById('discount_percentage').innerHTML = '<?php echo $discount_percentage; ?>%';
                    document.getElementById('discount_amount').innerHTML = 'Rs. <?php echo number_format($discount_amount, 2); ?>';
                    document.getElementById('new_cart_total').innerHTML = 'Rs. <?php echo number_format($new_cart_total, 2); ?>';
                </script>
            <?php
            }else {
                ?>
                    <script>
                        document.getElementById('offercode_er').style.color = "red";
                        document.getElementById('offercode_er').innerHTML = "To avail this offer cart total must be greater than <?php echo $order_total; ?>.";
                    </script>
                <?php
            }
            $_SESSION['total'] = $new_cart_total;
        }else{
            ?>
            <script>
                document.getElementById('offercode_er').style.color = "red";
                document.getElementById('offercode_er').innerHTML = "Invalid Code";
            </script>
            <?php
        }
    } 

    // delete item from cart
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
        // echo $id;
    }
    ?>
</body>

</html>