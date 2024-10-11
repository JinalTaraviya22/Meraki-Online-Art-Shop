<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <?php
    // if (!isset($_SESSION['U_Admin'])) {
    //     header("Location: Index.php");
    //     exit();
    // }
    include 'Header.php';
    ?>
    <style>
        tr {
            border: 1px solid black;
            text-align: center;
        }

        th,
        td {
            border: 1px solid black;
            padding-left: 10px;
            padding-right: 10px;
        }

        table {
            width: 100%;
            /* Make the table take full width */
            border-collapse: collapse;
            /* Optional: Remove the gaps between borders */
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row mt-3 mb-3">
            <h2 class="col-md-3" style="color:white">Users</h2>
            <div class="col-md-5"></div>
            <div class="col-md-3" style="text-align:right;padding-right:25px;"><input type="text"
                    placeholder="Search here..." class="form-control">&nbsp;</div>
            <div class="col-md-1"><button class="btn btn-dark"><i class="fa fa-search"></i></button></div>
        </div>
        <div class="row w-100">
            <div class="col-12">
                <table>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>City State</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>View</th>
                        <th>Remove</th>
                    </tr>
                    <?php
                    $q = "Select * from user_tbl";
                    $result = mysqli_query($con, $q);

                    while ($r = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $r['U_Id']; ?></td>
                            <td><?php echo $r['U_Fnm'] . " " . $r['U_Lnm']; ?></td>
                            <td><?php echo $r['U_Email']; ?></td>
                            <td><?php echo $r['U_Phn']; ?></td>
                            <td><?php echo $r['U_Pwd']; ?></td>
                            <td><?php echo $r['U_City'] . ", " . $r['U_State']; ?></td>
                            <td><?php echo $r['U_Status']; ?></td>
                            <td><?php echo $r['U_Role']; ?></td>
                            <td>
                                <form method="post" action="AdUsers.php#user_profile"><a href="#user_profile"><button type="submit" class="btn btn-dark"
                                            value="<?php echo $r['U_Id'] ?>" name="showUsr" onclick="showUser(1)"><i
                                                class="fa fa-eye"></i></button></a></form>
                            </td>
                            <td><button type="submit" class="btn btn-dark" style="background-color:#ad3434"><i
                                        class="fa fa-times"></i></button></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- single user profile -->
    <?php
    if (isset($_POST['showUsr'])) {
        //echo $_POST['showUsr'];
        $id = $_POST['showUsr'];

        $query = "select * from user_tbl where U_Id=$id";
        $result = mysqli_query($con, $query);
        $r = mysqli_fetch_assoc($result);
        ?>
        <div class="container mt-5" id="user_profile">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-4">
                    <div class="product-image">
                        <img src="db_img/user_img/<?php echo $r['U_Profile']; ?>" alt="User Image"
                            class="img-fluid rounded">
                    </div>
                    <div class="buttons mt-3">
                        <a href="wishlist.php?Id=<?php echo $r['U_Id']; ?>"><button class="btn btn-dark w-100 mb-2">See
                                Wishlist</button></a>
                        <a href="cart.php?Id=<?php echo $r['U_Id']; ?>"><button class="btn btn-dark w-100 mb-2">See
                                Cart</button></a>
                        <a href="orderhistory.php?Id=<?php echo $r['U_Id']; ?>"><button class="btn btn-dark w-100">Order
                                History</button></a>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-8">
                    <div class="product-image-large">
                        <!-- user Information -->
                        <div id="info">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">First Name :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_Fnm']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Last Name :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_Lnm']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Email :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_Email']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Phone No. :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_Phn']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Address :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_Add']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">City :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_City']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">State :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_State']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Zip Code :</label>
                                    <p style="font-weight: bold;"><?php echo $r['U_Zip']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button type="submit" onclick="asd(1)" class="cirbutton"
                                        style="font-weight: bold;">Update Info</button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button type="submit" onclick="asd(2)" class="cirbutton"
                                        style="font-weight: bold;">Change Password</button>
                                </div>
                            </div>
                        </div>
                        <!-- update information -->
                        <form id="update" onsubmit="return updateForm()" style="display:none !important;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">First Name :</label>
                                    <input type="text" class="form-control" id="fnm" placeholder="Enter First Name">
                                    <span id="FnmError"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Last Name :</label>
                                    <input type="text" class="form-control" id="lnm" placeholder="Enter Last Name">
                                    <span id="LnmError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Email :</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter Email">
                                    <span id="EmailError"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Phone No. :</label>
                                    <input type="text" class="form-control" id="phn" placeholder="Enter Mobile No.">
                                    <span id="PhnError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Address :</label>
                                    <textarea class="form-control" id="add"
                                        placeholder="Enter your full address"></textarea>
                                    <span id="AddError"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">City :</label>
                                    <input type="text" class="form-control" id="city" placeholder="Enter City">
                                    <span id="CityError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">State :</label>
                                    <input type="text" class="form-control" id="state" placeholder="Enter State">
                                    <span id="StateError"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Zip Code :</label>
                                    <input type="text" class="form-control" id="zip" placeholder="Enter Zip code">
                                    <span id="ZipError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Role :</label>
                                    <select class="form-control">
                                        <option>Normal</option>
                                        <option>Admin</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Profile Image :</label>
                                    <input type="file" class="form-control" id="img">
                                    <span id="ImgError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                </div>
                                <div class="col-md-3 mb-3" style="align-content: end;">
                                    <a href="Account.php"><button type="submit" class="btn btn-dark"><i
                                                class="fa fa-times"></i></button></a>
                                    <button type="submit" class="btn btn-dark"><i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- change password -->
                        <form id="changePwd" onsubmit="return cPwd()" style="display:none !important;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Old Password :</label>
                                    <input type="text" class="form-control" id="oldPwd" placeholder="Enter Old password">
                                    <span id="OPwdError"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">New Password :</label>
                                    <input type="text" class="form-control" id="newPwd" placeholder="Enter New password">
                                    <span id="NPwdError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Confirm Password :</label>
                                    <input type="text" class="form-control" id="coPwd" placeholder="Re-enter new password">
                                    <span id="CPwdError"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 mb-3"></div>
                                <div class="col-md-3 mb-3" style="align-content: end;">
                                    <button type="button" class="btn btn-dark"><i class="fa fa-times"></i></button>
                                    <button type="submit" class="btn btn-dark"><i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <!-- single user profile -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function showUser(a) {
            if (a == 1) {
                $('#user_profile').show();
            }
        }
        function asd(a) {
            if (a == 1) {
                $('#update').show();
                $('#info').hide();
                $('#changePwd').hide();
            }
            if (a == 2) {
                $('#changePwd').show();
                $('#info').hide();
                $('#update').hide();
            }
        }
    </script>

    <?php
    include 'Footer.php';
    ?>
    <!-- <script>
        function updateForm() {
            event.preventDefault();
            let validate = true;

            // var id = document.getElementById('id');
            // var id_er = document.getElementById('idError');
            var fn = document.getElementById('fnm');
            var fn_er = document.getElementById('FnmError');
            var ln = document.getElementById('lnm');
            var ln_er = document.getElementById('LnmError');
            var email = document.getElementById('email');
            var em_er = document.getElementById('EmailError');
            var phn = document.getElementById('phn');
            var phn_er = document.getElementById('PhnError');
            var add = document.getElementById('add');
            var add_er = document.getElementById('AddError');
            var city = document.getElementById('city');
            var city_er = document.getElementById('CityError');
            var state = document.getElementById('state');
            var state_er = document.getElementById('StateError');
            var zip = document.getElementById('zip');
            var zip_er = document.getElementById('ZipError');
            var img = document.getElementById('img');
            var img_er = document.getElementById('ImgError');
            var pwd = document.getElementById('pwd');
            var pwd_er = document.getElementById('pwdError');

            // CommonValidate(id,id_er);
            NameValidate(fn, fn_er);
            NameValidate(ln, ln_er);
            EmailValidate(email, em_er);
            PhnValidate(phn, phn_er);
            BigTextValidate(add, add_er);
            NameValidate(city, city_er);
            NameValidate(state, state_er);
            ZipValidate(zip, zip_er);
            ImgValidate(img, img_er);
            PwdValidate(pwd, pwd_er);

            return validate;
        }


    </script> -->
</body>

</html>