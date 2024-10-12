<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
            border: 1px black solid;
            text-align: center;
        }

        table {
            width: 100%;
        }

        th,
        td {
            border: 1px black solid;
            padding-left: 10px;
            padding-right: 10px;
        }

        #desc {
            width: 100px;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row mt-3 mb-3">
            <h2 class="col-md-4" style="color:white">Category</h2>
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
                <h2>Add Products</h2>
                <div class="col">
                    <form method="post" enctype="multipart/form-data" id="add">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="anm" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" name="pnm" id="anm"
                                    placeholder="Enter Product Name">
                                <span id="anm_er" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="aprice" class="form-label">Company Name:</label>
                                <input type="text" class="form-control" name="cnm" id="acname"
                                    placeholder="Enter Company Name">
                                <span id="acname_er" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="aprice" class="form-label">Price:</label>
                                <input type="text" class="form-control" name="price" id="aprice"
                                    placeholder="Enter Price">
                                <span id="aprice_er" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="category" class="form-label">Stock:</label>
                                <input type="text" class="form-control" name="stock" id="astock"
                                    placeholder="Enter Stock">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="subcategory" class="form-label">Category:</label>
                                <select class="form-control" id="subcategory" name="sub-cat">
                                    <!-- <option>Brushes</option>
                                    <option>Paints</option>
                                    <option>Paper</option> -->
                                    <?php
                                    $q = "Select * from subcategory_tbl s join category_tbl c on s.C_Id=c.C_Id";
                                    $result = mysqli_query($con, $q);
                                    while ($r = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $r['SC_Id']; ?>">
                                            <?php echo $r['C_Name'] . " > " . $r['SC_Name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="adesc" class="form-label">Description:</label>
                                <textarea class="form-control" name="desc" id="adesc"
                                    placeholder="Enter description of product"></textarea>
                                <span id="adesc_er" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="aimg1" class="form-label">Image 1:</label>
                                <input type="file" class="form-control" name="img1" id="aimg1">
                                <span id="aimg1_er" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="aimg2" class="form-label">Image 2:</label>
                                <input type="file" class="form-control" name="img2" id="aimg2">
                                <span id="aimg2_er" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 mb-3"></div>
                            <div class="col-md-2 mb-3" style="align-content: end;">
                                <button type="button" class="btn btn-dark" onclick="addForm(2)"><i
                                        class="fa fa-times"></i></button>
                                <button type="submit" name="addProduct" class="btn btn-dark"><i
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
                    <th style="width:50px">Id</th>
                    <th>Name</th>
                    <th>Image 1</th>
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
                            <!-- <form method="post" action="AdProducts.php#update_form"><a href="#update_form"><button
                                        type="submit" class="btn btn-dark" value="<?php echo $r['C_Id'] ?>"
                                        name="showProduct" onclick="update(1)"><i class="fa fa-eye"></i></button></a>
                            </form> -->
                            <a href="#update_form"><button onclick="update(1)" class="btn btn-dark"><i
                                        class="fa fa-eye"></i></button></a>
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
    if (isset($_POST['showProduct'])) {
        //echo $_POST['showUsr'];
        $id = $_POST['showProduct'];

        $query = "select * from product_tbl where P_Id=$id";
        $result = mysqli_query($con, $query);
        $r = mysqli_fetch_assoc($result);
        ?>
        <div class="container mt-5" id="update_form">
            <div class="row">
                <!-- Images Column -->
                <div class="col-md-4">
                    <div class="product-image">
                        <img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" height="100px" width="100px" alt="Product Image"
                            class="img-fluid rounded">
                    </div>
                    <div class="product-image mt-2">
                        <img src="db_img/product_img/<?php echo $r['P_Img2'] ?>" height="100px" width="100px" alt="Product Image"
                            class="img-fluid rounded">
                    </div>
                </div>
                <!-- Right Column -->
                <div class="col-md-8">
                    <div class="product-image-large">
                        <!-- update information -->
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="anm" class="form-label">Product Name:</label>
                                    <input type="text" class="form-control" name="pnm" id="anm"
                                        placeholder="<?php echo $r['P_Name'] ?>">
                                    <span id="unm_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="aprice" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" name="price" id="aprice"
                                        placeholder="<?php echo $r['P_Company_Name'] ?>">
                                    <span id="uprice_er" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="udesc" class="form-label">Description:</label>
                                    <textarea class="form-control" name="desc" id="adesc"
                                        placeholder="<?php echo $r['P_Desc'] ?>"></textarea>
                                    <span id="udesc_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="aprice" class="form-label">Price:</label>
                                    <input type="text" class="form-control" name="price" id="aprice"
                                        placeholder="<?php echo $r['P_Price'] ?>">
                                    <span id="uprice_er" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">Category:</label>
                                    <select class="form-control" id="category" name="cat">
                                        <option>Watercolor</option>
                                        <option>Oil</option>
                                        <option>Acrylic</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subcategory" class="form-label">Sub Category:</label>
                                    <select class="form-control" id="subcategory" name="sub-cat">
                                        <option>Brushes</option>
                                        <option>Paints</option>
                                        <option>Paper</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Status :</label>
                                    <select class="form-control">
                                        <option>Active</option>
                                        <option>Deactivate</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Stock :</label>
                                    <input type="text" class="form-control" id="stock" placeholder="<?php echo $r['P_Stock'] ?>">
                                    <span id="StockError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="aimg1" class="form-label">Image 1:</label>
                                    <input type="file" class="form-control" name="img1" id="aimg1">
                                    <span id="uimg1_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="uimg2" class="form-label">Image 2:</label>
                                    <input type="file" class="form-control" name="img2" id="aimg2">
                                    <span id="uimg2_er" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                </div>
                                <div class="col-md-3 mb-3" style="align-content: end;">
                                    <button class="btn btn-dark" onclick="update(2)"><i class="fa fa-times"></i></button>
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

    if (isset($_POST['addProduct'])) {
        $pnm = $_POST['pnm'];
        $cnm = $_POST['cnm'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $cat = $_POST['sub-cat'];
        $desc = $_POST['desc'];
        $img1 = uniqid() . $_FILES['img1']['name'];
        $img2 = uniqid() . $_FILES['img2']['name'];

        $query = "INSERT INTO `product_tbl`(`P_Name`, `P_Price`, `P_Stock`, `P_Company_Name`, `P_SC_Id`, `P_Desc`, `P_Img1`, `P_Img2`,`P_Status`) VALUES 
        ('$pnm','$price','$stock','$cnm','$cat','$desc','$img1','$img2','Active')";


        if (mysqli_query($con, $query)) {
            if (!is_dir("db_img/product_img")) {
                mkdir("db_img/product_img");
            }
            move_uploaded_file($_FILES['img1']['tmp_name'], "db_img/product_img/" . $img1);
            move_uploaded_file($_FILES['img2']['tmp_name'], "db_img/product_img/" . $img2);
            setcookie('success', 'Product Addes', time() + 2);
            ?>
            <script>
                window.location.href = 'AdProducts.php';
            </script>
            <?php
        } else {
            setcookie('error', 'Error Please try again.', time() + 2);
            ?>
            <script>
                window.location.href = 'AdProducts.php';
            </script>
            <?php
        }
    }
    ?>
</body>

</html>