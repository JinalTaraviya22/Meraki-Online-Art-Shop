<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <?php
    // if (!isset($_SESSION['U_Admin'])) {
    //     header("Location: Index.php");
    //     exit();
    // }
    include 'Header.php';
    if (!isset($_SESSION['U_Admin'])) {
        header("Location: Index.php");
        exit();
    }
    ?>
    <style>
        tr {
            border: 1px black solid;
            text-align: center;
        }

        th {
            border: 1px black solid;
        }

        td {
            border: 1px black solid;
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row mt-3 mb-3">
            <!-- <h2 class="col-md-3">Orders</h2>
            <div class="col-md-9" style="text-align:right;padding-right:25px;"><i class="fa fa-search"></i></div> -->
            <h2 class="col-md-3" style="color:white">Orders</h2>
            <div class="col-md-3"></div>
            <div class="col-md-6" style="text-align:right;padding-right:25px;"><input type="text"
                    placeholder="Search here...">&nbsp;<i class="fa fa-search"></i></div>
        </div>
        <div class="row" id="product">
            <table>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Shipping Add.</th>
                        <th>Payment Add.</th>
                        <th>Payment Method</th>
                        <th>City State</th>
                        <th>Zip</th>
                        <th>Approve</th>
                        <th>Decline</th>
                    </tr>
                    <tr>
                        <td>od1</td>
                        <td><a href="AdUsers.php" style="color:white;">Jinal Taraviya</a></td>
                        <td>Easeal 1</td>
                        <td>22/3/2023</td>
                        <td>MCA,School of Engineering,RK University</td>
                        <td>MCA,School of Engineering,RK University</td>
                        <td>COD</td>
                        <td>Rajkot Gujarat</td>
                        <td>360005</td>
                        <td><button class="btn btn-dark" style="background-color:green"><i
                                    class="fa fa-check"></i></button>
                        </td>
                        <td><button type="submit" class="btn btn-dark" style="background-color:#ad3434"><i
                                    class="fa fa-times"></i></button></td>
                    </tr>
            </table>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <?php
    include 'Footer.php';
    ?>
</body>

</html>