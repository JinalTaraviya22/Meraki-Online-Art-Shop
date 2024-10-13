<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Category</title>
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <?php
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
            width: 10%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 40%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 40%;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row mt-3 mb-3">
            <h2 class="col-md-4" style="color:white">Main Category</h2>
            <div class="col-md-3" style="text-align:right"><input type="text" class="form-control"
                    placeholder="Search here...">&nbsp;</div>
            <div class="col-md-1"><button class="btn btn-dark"><i class="fa fa-search "></i></button></div>
            <div class="col-md-3"></div>
            <div class="col-md-1" style="text-align:right"><button class="btn btn-dark" onclick="addForm(1)"><i
                        class="fa fa-plus"></i></button></div>
        </div>

        <!-- add products -->
        <div class="container mt-5 mb-5" id="add_form" style="display:none !important">
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

        <!-- table -->
        <div class="row" id="product">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>View</th>
                    <th>Disable</th>
                </tr>
                <?php
                $q = "Select * from category_tbl";
                $result = mysqli_query($con, $q);

                while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $r['C_Id'] ?></td>
                        <td><?php echo $r['C_Name'] ?></td>
                        <td><img src="db_img/cat_img/<?php echo $r['C_Img'] ?>" height="100px" width="100px"></td>
                        <td>
                            <form method="post" action="AdCategory.php#update_form"><a href="#update_form"><button
                                        type="submit" class="btn btn-dark" value="<?php echo $r['C_Id'] ?>"
                                        name="showCat" onclick="update(1)"><i class="fa fa-eye"></i></button></a>
                            </form>
                            <!-- <a href="#update_form"><button onclick="update(1)" class="btn btn-dark"><i
                                        class="fa fa-eye"></i></button></a> -->
                        </td>

                        <td><button type="submit" class="btn btn-dark" style="background-color:#ad3434;"><i
                                    class="fa fa-times"></i></button></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>

    <!-- update product form -->
    <?php
    if (isset($_POST['showCat'])) {
        //echo $_POST['showUsr'];
        $id = $_POST['showCat'];

        $query = "select * from category_tbl where C_Id=$id";
        $result = mysqli_query($con, $query);
        $r = mysqli_fetch_assoc($result);
        ?>
        <div class="container mt-5" id="update_form">
            <div class="row">
                <!-- Images Column -->
                <div class="col-md-4">
                    <div class="product-image">
                        <img src="db_img/cat_img/<?php echo $r['C_Img'] ?>" height="100px" width="100px" alt="Product Image"
                            class="img-fluid rounded">
                    </div>
                </div>
                <!-- Right Column -->
                <div class="col-md-8">
                    <div class="product-image-large">
                        <!-- update information -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="cid" value="<?php echo $r['C_Id'] ?>">
                                <input type="hidden" name="oldimg" value="<?php echo $r['C_Img']?>">
                                <div class="col-md-6 mb-3">
                                    <label for="anm" class="form-label">Category Name:</label>
                                    <input type="text" class="form-control" name="cnm" id="anm"
                                        value="<?php echo $r['C_Name'] ?>">
                                    <span id="unm_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="anm" class="form-label">Category Image:</label>
                                    <input type="file" class="form-control" name="cimg" id="anm">
                                    <span id="unm_er" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                </div>
                                <div class="col-md-3 mb-3" style="align-content: end;">
                                    <button class="btn btn-dark" onclick="update(2)"><i class="fa fa-times"></i></button>
                                    <button type="submit" class="btn btn-dark" name="updateCat"><i
                                            class="fa fa-arrow-right"></i></button>
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
    <!-- update product form -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function update(a) {
            if (a == 1) {
                $('#update_form').show();
            }
        }
        function addForm(a) {
            if (a == 1)
                $('#add_form').show();
            else
                $('#add_form').hide();
        }
    </script>
    <script>
        function productInfo() {
            event.preventDefault();
            let validate = true;
            var nm = document.getElementById('nm');
            var nm_er = document.getElementById('nm_er');
            var price = document.getElementById('price');
            var price_er = document.getElementById('price_er');
            var desc = document.getElementById('desc');
            var desc_er = document.getElementById('desc_er');
            var img1 = document.getElementById('img1');
            var img1_er = document.getElementById('img1_er');
            var img2 = document.getElementById('img2');
            var img2_er = document.getElementById('img2_er');

            NameValidate(nm, nm_er);
            PriceValidate(price, price_er);
            BigTextValidate(desc, desc_er);
            ImgValidate(img1, img1_er);
            ImgValidate(img2, img2_er);

            return validate;
        }

        function addproductInfo() {
            event.preventDefault();
            let validate = true;

            const anm = document.getElementById('anm');
            const anm_er = document.getElementById('anm_er');
            const aprice = document.getElementById('aprice');
            const aprice_er = document.getElementById('aprice_er');
            const adesc = document.getElementById('adesc');
            const adesc_er = document.getElementById('adesc_er');
            const aimg1 = document.getElementById('aimg1');
            const aimg1_er = document.getElementById('aimg1_er');
            const aimg2 = document.getElementById('aimg2');
            const aimg2_er = document.getElementById('aimg2_er');

            validate = NameValidate(anm, anm_er) && validate;
            validate = PriceValidate(aprice, aprice_er) && validate;
            validate = BigTextValidate(adesc, adesc_er) && validate;
            validate = ImgValidate(aimg1, aimg1_er) && validate;
            validate = ImgValidate(aimg2, aimg2_er) && validate;

            return validate;
        }

        function addCat() {
            event.preventDefault();
            let validate = true;
            var catNm = document.getElementById('catNm');
            var catNm = document.getElementById('catNm_er');
            var catImg = document.getElementById('catImg');
            var catImg_er = document.getElementById('catImg_er');

            NameValidate(catNm, catNm_er);
            ImgValidate(catImg, catImg_er);

            return validate;
        }

        function addSubCat() {
            event.preventDefault();
            let validate = true;
            var scatNm = document.getElementById('scatnm');
            var scatNm_er = document.getElementById('scatnm_er');
            var scatImg = document.getElementById('scatimg');
            var scatImg_er = document.getElementById('scatImg_er');

            NameValidate(scatNm, scatNm_er);
            ImgValidate(scatImg, scatImg_er);

            return validate;
        }

    </script>
    <?php
    include 'Footer.php';

    // Add Category
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
                ?>
                <script>
                    window.location.href = "AdCategory.php";
                </script>
                <?php
            } else {
                echo "File upload error: " . $_FILES['cimg']['error'];
            }
        } else {
            setcookie('error', 'Error in adding Category', time() + 5, "/");
            ?>
            <script>
                window.location.href = "AdCategory.php";
            </script>
            <?php
        }
    }
    // if (isset($_POST['subCategory'])) {
    //     $snm = $_POST['snm'];
    //     $simg = uniqid() . $_FILES['simg']['name'];
    //     $scid = $_POST['scat'];
    
    //     $query = "INSERT INTO `subcategory_tbl`(`SC_Name`, `C_Id`, `SC_Img`) VALUES ('$snm','$scid','$simg')";
    //     if (mysqli_query($con, $query)) {
    //         if (!is_dir('db_img/subCat_img')) {
    //             mkdir('db_img/subCat_img');
    //         }
    //         move_uploaded_file($_FILES['simg']['tmp_name'], 'db_img/subCat_img/' . $simg);
    //         setcookie('success', 'Sub Category Added', time() + 5, "/");
    //     } else {
    //         setcookie('error', 'Error in adding Sub Category', time() + 5, "/");
    //     }
    // }
    
    if (isset($_POST['updateCat'])) {
        $id = $_POST['cid'];
        $cnm = $_POST['cnm'];
        $oimg = $_POST['oldimg'];

        if ($_FILES['cimg']['name'] != "") {
            $img = uniqid() . $_FILES['cimg']['name'];
            move_uploaded_file($_FILES['cimg']['tmp_name'], "db_img/cat_img/" . $img);
        } else {
            $img = $oimg;
        }

        $query = "UPDATE `category_tbl` SET `C_Name`='$cnm',`C_Img`='$img' WHERE `C_Id`=$id";
        echo $query;

        if (mysqli_query($con, $query)) {
            if ($_FILES['cimg']['name'] != "") {
                $old_image = $oimg;
                if (file_exists("db_img/cat_img/" . $old_image)) {
                    unlink("db_img/cat_img/" . $old_image);
                }
            }
            setcookie('success', "Category updated successfully", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'AdCategory.php';
            </script>
            <?php
        } else {
            setcookie('error', "Error in updating category", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'AdCategory.php';
            </script>
            <?php
        }
    }
    ?>
</body>

</html>