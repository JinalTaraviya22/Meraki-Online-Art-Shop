<?php
    //error_reporting(0);
    session_start();
    if (!isset($_SESSION['U_Admin'])) {
        header("Location: Index.php");
        exit();
    }
    include 'Header.php';
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <style>
        /* large divice */
        @media (min-width: 992px) {
            .banner-image {
                height: 100px;
                width: auto;
                /* Remove height restriction for large devices */
            }

            .banner-row {
                display: flex;
                justify-content: space-between;
            }

            .banner-row>div {
                flex: 1;
                margin: 0 5px;
            }
        }


        /* medium device */
        @media (max-width: 991.98px) {
            .banner-image {
                margin-bottom: 15px;
                height: 190px;
            }
        }

        /* small device */
        @media (max-width: 480px) {
            .banner-image {
                height: 80px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body class="bg-dark">
    <!-- change Main banners -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <h2>Change Main Banners</h2>
            <div class="col">
                <div class="banner-row">
                    <!-- Responsive image layout -->
                    <div><img src="img/slide1.png" class="banner-image" alt="Banner 1"></div>
                    <div><img src="img/slide2.png" class="banner-image" alt="Banner 2"></div>
                    <div><img src="img/slide3.png" class="banner-image" alt="Banner 3"></div>
                </div>
            </div></br>
            <form id="main" onsubmit="return banner()" style="display: none !important;">
                <div class="row">
                    <div class="col-md-3">Banner 1:<input type="file" id="b1" class="form-control"><span
                            id="b1_er"></span></div>
                    <div class="col-md-3">Banner 2:<input type="file" id="b2" class="form-control"><span
                            id="b2_er"></span></div>
                    <div class="col-md-3">Banner 3:<input type="file" id="b3" class="form-control"><span
                            id="b3_er"></span></div></br>
                    <div class="col-md-3"><button type="submit" class="button-28">Change</button></div>
                </div>
            </form></br>
            <div class="row mt-3" id="btn">
                <div class="col-md-4"><button onclick="img(1)" class="button-28">Change</button></div>
            </div>
        </div>
    </div>
    </div>

    <!-- change offer banners -->
    <div class="container mt-5 mb-5" id="discount">
        <div class="row">
            <h2>Discount</h2>
            <div class="col">
                <div class="row">
                    <div class="col-md-4"><img src="img/slide1.png" height="100px" /></div>
                </div></br>
                <form id="offer" onsubmit="return discount()" style="display: none !important;">
                    <div class="row">
                        <div class="col-md-4">Start Date:<input type="date" id="sdt" class="form-control"><span
                                id="sdt_er"></span></div></br>
                        <div class="col-md-4">End Date:<input type="date" id="edt" class="form-control"><span
                                id="edt_er"></span></div></br>
                        <div class="col-md-4">Banner:<input type="file" id="bnr" class="form-control"><span
                                id="bnr_er"></span></div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-4">Rate:<input type="text" id="rate" class="form-control"><span
                                id="rate_er"></span></div>
                        <div class="col-md-4">Category:<select class="form-control">
                                <option>cat 1</option>
                                <option>cat 2</option>
                                <option>cat 3</option>
                            </select></div></br>
                        <div class="col-md-4"><button type="submit" class="button-28">Change</button>
                        </div>
                    </div>
                </form>
                <div class="row" id="btn2">
                    <div class="col-md-4"><button onclick="img(2)" class="button-28">Change</button></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category -->
    <div class="container mt-5 mb-5" id="category">
        <div class="row">
            <div class="col col-md-6">
                <h2>Add New Category</h2>
                <!-- <form onsubmit="return addCat()" > -->
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name :</label>
                            <input type="text" class="form-control" name="cnm" id="catNm"
                                placeholder="Enter Category Name">
                            <span id="catNm_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Image :</label>
                            <input type="file" class="form-control" name="cimg" id="catImg">
                            <span id="catImg_er"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 mb-3"></div>
                        <div class="col-md-2 mb-3" style="align-content: end;">
                            <button type="submit" name="csubmit" class="btn btn-dark"><i
                                    class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- sub category -->
            <div class="col col-md-6">
                <h2>Add New Sub Category</h2>
                <!-- <form onsubmit="return addSubCat()"> -->
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name :</label>
                            <input type="text" class="form-control" name="snm" id="scatnm"
                                placeholder="Enter Category Name">
                            <span id="scatnm_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Image :</label>
                            <input type="file" class="form-control" name="simg" id="scatimg">
                            <span id="scatImg_er"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Choose Main Category :</label>
                            <select class="form-control" name="scat">
                                <?php
                                $q = "Select * from category_tbl";
                                $result = mysqli_query($con, $q);
                                while ($r = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $r['C_Id']; ?>"><?php echo $r['C_Name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 mb-3"></div>
                        <div class="col-md-2 mb-3" style="align-content: end;">
                            <button type="submit" name="subCategory" class="btn btn-dark"><i
                                    class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function img(a) {
            if (a == 1) {
                $('#main').show();
                $('#btn').hide();
            }
            if (a == 2) {
                $('#offer').show();
                $('#btn2').hide();
            }
        }
    </script>
    <script>
        function banner() {
            event.preventDefault();

            let validate = true;

            var b1 = document.getElementById('b1');
            var b1_er = document.getElementById('b1_er');
            var b2 = document.getElementById('b2');
            var b2_er = document.getElementById('b2_er');
            var b3 = document.getElementById('b3');
            var b3_er = document.getElementById('b3_er');

            ImgValidate(b1, b1_er);
            ImgValidate(b2, b2_er);
            ImgValidate(b3, b3_er);

            return validate;
        }
        function discount() {
            event.preventDefault();

            validate = true;

            var sdt = document.getElementById('sdt');
            var sdt_er = document.getElementById('sdt_er');
            var edt = document.getElementById('edt');
            var edt_er = document.getElementById('edt_er');
            var bnr = document.getElementById('bnr');
            var bnr_er = document.getElementById('bnr_er');
            var rate = document.getElementById('rate');
            var rate_er = document.getElementById('rate_er');

            CommanValidate(sdt, sdt_er);
            CommanValidate(edt, edt_er);
            ImgValidate(bnr, bnr_er);
            RateValidate(rate, rate_er);

            return validate;
        }
    </script>
    <?php
    include 'Footer.php';
    if (isset($_POST['csubmit'])) {
        $cnm = $_POST['cnm'];
        $cimg = uniqid() . $_FILES['cimg']['name'];

        $query = "INSERT INTO `category_tbl`(`C_Name`, `C_Img`) VALUES ('$cnm','$cimg')";
        if (mysqli_query($con, $query)) {
            if (!is_dir('db_img/cat_img')) {
                mkdir('db_img/cat_img');
            }
            if (move_uploaded_file($_FILES['cimg']['tmp_name'], 'db_img/cat_img/' . $cimg)) {
                setcookie('success', 'Category Added', time() + 5, "/");
            } else {
                echo "File upload error: " . $_FILES['cimg']['error']; // Display error
            }
        } else {
            setcookie('error', 'Error in adding Category', time() + 5, "/");
        }
    }
    if (isset($_POST['subCategory'])) {
        $snm = $_POST['snm'];
        $simg = uniqid() . $_FILES['simg']['name'];
        $scid = $_POST['scat'];

        $query = "INSERT INTO `subcategory_tbl`(`SC_Name`, `C_Id`, `SC_Img`) VALUES ('$snm','$scid','$simg')";
        if (mysqli_query($con, $query)) {
            if (!is_dir('db_img/subCat_img')) {
                mkdir('db_img/subCat_img');
            }
            move_uploaded_file($_FILES['simg']['tmp_name'], 'db_img/subCat_img/' . $simg);
            setcookie('success', 'Sub Category Added', time() + 5, "/");
        } else {
            setcookie('error', 'Error in adding Sub Category', time() + 5, "/");
        }
    }
    ?>
</body>

</html>