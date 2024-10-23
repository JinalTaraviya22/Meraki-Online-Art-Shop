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
    <div class="container mt-5">
        <div class="row" style="text-align: center;">
            <h2>Welcome to Cart!</h2>
            <div class="col-md-6">
                <p>Total:1,300</p>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-dark">Check Out</button>
            </div>

        </div>
    </div>

    <div class="container mt-5 mb-5">
        <!-- <div class="row">
        <div class="col-md-4">
            <div class="product-image-circle">
                <img src="img/easeal1.png" alt="User Image" class="img-fluid rounded">
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-image-large">
                 <h4>BASIC FRAME TRIPOD EASEL PINE WOOD 5 FEET</h4>
                <p class="price" style="font-size: 16px;">Rs. 1,300</p>
                Quantity:
                <select id="quantity" class="form-select" style="width: 100px;">
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
          </div>
        </div>
        <div class="col-md-2">
            <div class="product-image-large">
                <a href="Account.php"><button type="submit" class="btn btn-dark"><i class="fa fa-times"></i></button></a>
                <a href="order.php"><button type="submit" class="btn btn-dark"><i class="fa fa-arrow-right"></i></button></a>
          </div>
        </div>
    </div> -->
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
                $query = "SELECT p.*,c.* FROM product_tbl p JOIN cart_tbl c ON p.P_Id=c.Ct_P_Id WHERE c.Ct_U_Email='$Email_Session'";
                $result = mysqli_query($con, $query);
                while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <!-- <td><?php echo $r['Ct_Id'] ?></td> -->
                        <td><?php echo $r['P_Name'] ?></td>
                        <td><?php echo $r['P_Price'] * $r['Ct_Quantity'] ?></td>
                        <td>
                            <select>
                                <option>3</option>
                                <option>1</option>
                            </select>
                        </td>
                        <td><img src="db_img/product_img/<?php echo $r['P_Img1']?>" height="100px" width="100px"></td>
                        <td><img src="db_img/product_img/<?php echo $r['P_Img2']?>" height="100px" width="100px"></td>
                        <td><a href="#update_form"><button class="btn btn-dark" onclick="update(1)"><i
                                        class="fa fa-shopping-bag"></i></button></a></td>
                        <td><button type="submit" class="btn btn-dark" style="background-color:#ad3434;"><i
                                    class="fa fa-times"></i></button></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <?php
    include 'Footer.php';
    ?>
</body>

</html>