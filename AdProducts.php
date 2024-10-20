<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
            <h2 class="col-md-4" style="color:white">Products</h2>
            <div class="col-md-3" style="text-align:right">
                <!-- form for search Start -->
                <form method="get"><input type="text" name="search" class="form-control"
                        placeholder="Search here...">&nbsp;
            </div>
            <div class="col-md-1"><button class="btn btn-dark"><i class="fa fa-search "></i></button></div>
            </form>
            <!-- form for search End -->
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
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>View</th>
                    <th>Status</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                // SQL query to include the search condition
                $search_query = '';
                if (!empty($search)) {
                    $search_query = "WHERE P_Id LIKE '%$search%' OR P_Name LIKE '%$search%'OR P_Price LIKE '%$search%'OR P_Stock LIKE '%$search%' OR P_Status LIKE '%$search%'";
                }
                // Determine the total number of records
                $q = "SELECT p.*,s.SC_Name,c.C_Name FROM product_tbl p JOIN subcategory_tbl s ON p.P_SC_Id=s.SC_Id JOIN category_tbl c ON s.C_Id=c.C_Id $search_query";
                $result = mysqli_query($con, $q);
                $total_records = mysqli_num_rows($result);

                // Set the number of records per page
                $records_per_page = 2;

                // Calculate the total number of pages
                $total_pages = ceil($total_records / $records_per_page);

                // Get the current page number
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the start record for the current page
                $start_from = ($page - 1) * $records_per_page;

                // Fetch the records for the current page
                $q = $q . " LIMIT $start_from, $records_per_page";
                $result = mysqli_query($con, $q);



                while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $r['P_Id'] ?></td>
                        <td><?php echo $r['P_Name'] ?></td>
                        <td><?php echo $r['P_Price'] ?></td>
                        <td><?php echo $r['P_Stock'] ?></td>
                        <td><a href="AdSubcategory.php"><?php echo $r['SC_Name'] ?></a></td>
                        <td><img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" height="100px" width="100px"></td>
                        <td><img src="db_img/product_img/<?php echo $r['P_Img2'] ?>" height="100px" width="100px"></td>
                        <td>
                            <form method="post" action="AdProducts.php#update_form"><a href="#update_form"><button
                                        type="submit" class="btn btn-dark" value="<?php echo $r['P_Id'] ?>"
                                        name="showProduct" onclick="update(1)"><i class="fa fa-eye"></i></button></a>
                            </form>
                            <!-- <a href="#update_form"><button onclick="update(1)" class="btn btn-dark"><i
                                        class="fa fa-eye"></i></button></a> -->
                        </td>

                        <td>
                            <form method="post" action="AdProducts.php">
                                <input type="hidden" name="productId" value="<?php echo $r['P_Id']; ?>">
                                <input type="hidden" name="currentStatus" value="<?php echo $r['P_Status']; ?>">
                                <button type="submit" name="changeStatus" class="btn btn-dark">
                                    <?php echo $r['P_Status'] == 'Active' ? 'Hide' : 'Show'; ?>
                                </button>
                            </form></button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <nav>
            <ul class="pagination">
                <?php
                if ($page > 1) {
                    echo "<li class='page-item'><a class='page-link btn-dark' href='?page=" . ($page - 1) . "&search=" . $search . "'><i class='fa fa-chevron-left'></i></a></li>";
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "&search=" . $search . "'>" . $i . "</a></li>";
                }
                if ($page < $total_pages) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "&search=" . $search . "'><i class='fa fa-chevron-right'></i></a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>

    <!-- update product form -->
    <?php
    if (isset($_POST['showProduct'])) {
        //echo $_POST['showUsr'];
        $id = $_POST['showProduct'];

        $query = "select * from product_tbl where P_Id=$id";
        $result = mysqli_query($con, $query);
        $r = mysqli_fetch_assoc($result);
        $p_status = $r['P_Status'];
        $default_subcat_id = $r['P_SC_Id'];
        ?>
        <div class="container mt-5" id="update_form">
            <div class="row">
                <!-- Images Column -->
                <div class="col-md-4">
                    <div class="product-image">
                        <img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" height="100px" width="100px"
                            alt="Product Image" class="img-fluid rounded">
                    </div>
                    <div class="product-image mt-2">
                        <img src="db_img/product_img/<?php echo $r['P_Img2'] ?>" height="100px" width="100px"
                            alt="Product Image" class="img-fluid rounded">
                    </div>
                </div>
                <!-- Right Column -->
                <div class="col-md-8">
                    <div class="product-image-large">
                        <!-- update information -->
                        <form method="post" id="upProduct" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="hidden" name="uid" value="<?php echo $r['P_Id'] ?>" />
                                    <input type="hidden" name="Oldimg1" value="<?php echo $r['P_Img1'] ?>" />
                                    <input type="hidden" name="Oldimg2" value="<?php echo $r['P_Img2'] ?>" />
                                    <label for="anm" class="form-label">Product Name:</label>
                                    <input type="text" class="form-control" name="upnm" id="anm"
                                        value="<?php echo $r['P_Name'] ?>">
                                    <span id="unm_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="aprice" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" name="ucnm" id="aprice"
                                        value="<?php echo $r['P_Company_Name'] ?>">
                                    <span id="uprice_er" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="udesc" class="form-label">Description:</label>
                                    <textarea class="form-control" name="udesc" id="adesc"
                                        placeholder="Enter Description"><?php echo $r['P_Desc'] ?></textarea>
                                    <span id="udesc_er" class="text-danger"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="aprice" class="form-label">Price:</label>
                                    <input type="text" class="form-control" name="uprice" id="aprice"
                                        value="<?php echo $r['P_Price'] ?>">
                                    <span id="uprice_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Stock :</label>
                                    <input type="text" class="form-control" id="ustock" name="ustock"
                                        value="<?php echo $r['P_Stock'] ?>">
                                    <span id="StockError"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Status :</label>
                                    <select class="form-control" name="ustatus">
                                        <option <?php if ($p_status == 'Active')
                                            echo 'selected'; ?> value="Active">Active
                                        </option>
                                        <option <?php if ($p_status == 'Deactivate')
                                            echo 'selected'; ?> value="Deactivate">
                                            Deactivate</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subcategory" class="form-label">Category:</label>
                                    <select class="form-control" id="subcategory" name="usub-cat">
                                        <?php
                                        $q = "Select * from subcategory_tbl s join category_tbl c on s.C_Id=c.C_Id";
                                        $result = mysqli_query($con, $q);
                                        while ($r = mysqli_fetch_assoc($result)) {
                                            $selected = ($r['SC_Id'] == $default_subcat_id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $r['SC_Id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $r['C_Name'] . " > " . $r['SC_Name']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="aimg1" class="form-label">Image 1:</label>
                                    <input type="file" class="form-control" name="uimg1" id="aimg1">
                                    <span id="uimg1_er" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="uimg2" class="form-label">Image 2:</label>
                                    <input type="file" class="form-control" name="uimg2" id="aimg2">
                                    <span id="uimg2_er" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                </div>
                                <div class="col-md-3 mb-3" style="align-content: end;">
                                    <button class="btn btn-dark" onclick="update(2)"><i class="fa fa-times"></i></button>
                                    <button type="submit" name="updateProduct" id="updateProduct" class="btn btn-dark"><i
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

    // add product
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
    //update product
    if (isset($_POST['updateProduct'])) {
        $id = $_POST['uid'];
        $pnm = $_POST['upnm'];
        $cnm = $_POST['ucnm'];
        $price = $_POST['uprice'];
        $stock = $_POST['ustock'];
        $cat = $_POST['usub-cat'];
        $desc = $_POST['udesc'];
        $status = $_POST['ustatus'];
        // For old images
        $oimg1 = $_POST['Oldimg1'];
        $oimg2 = $_POST['Oldimg2'];
        // $img1 = uniqid() . $_FILES['uimg1']['name'];
        // $img2 = uniqid() . $_FILES['uimg2']['name'];
    
        if ($_FILES['uimg1']['name'] != "") {
            $img1 = uniqid() . $_FILES['uimg1']['name'];
            move_uploaded_file($_FILES['uimg1']['tmp_name'], "db_img/product_img/" . $img1);
        } else {
            $img1 = $oimg1;
        }

        if ($_FILES['uimg2']['name'] != "") {
            $img2 = uniqid() . $_FILES['uimg2']['name'];
            move_uploaded_file($_FILES['uimg2']['tmp_name'], "db_img/product_img/" . $img2);
        } else {
            $img2 = $oimg2;
        }

        // Update query
        $query = "UPDATE `product_tbl` SET `P_Name`='$pnm',`P_Price`='$price',`P_Stock`='$stock',`P_Company_Name`='$cnm',`P_SC_Id`='$cat',`P_Desc`='$desc',`P_Img1`='$img1',`P_Img2`='$img2',`P_Status`='$status' WHERE `P_Id`=$id ";

        if (mysqli_query($con, $query)) {
            if ($_FILES['uimg1']['name'] != "") {
                $old_image1 = $oimg1;
                if (file_exists("db_img/product_img/" . $old_image1)) {
                    unlink("db_img/product_img/" . $old_image1);
                }
            }
            if ($_FILES['uimg2']['name'] != "") {
                $old_image2 = $oimg2;
                if (file_exists("db_img/product_img/" . $old_image2)) {
                    unlink("db_img/product_img/" . $old_image2);
                }
            }
            setcookie('success', "Product updated successfully", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'AdProducts.php';
            </script>
            <?php
        } else {
            setcookie('error', "Error in updating product", time() + 5, "/");
            ?>
            <script>
                window.location.href = 'AdProducts.php';
            </script>
            <?php
        }
    }
    // status update from table
    if (isset($_POST['changeStatus'])) {
        $id = $_POST['productId'];
        $currentStatus = $_POST['currentStatus'];

        // Determine the new status
        $newStatus = ($currentStatus == 'Active') ? 'Deactivate' : 'Active';

        // Update the status in the database
        $query = "UPDATE `product_tbl` SET `P_Status`='$newStatus' WHERE `P_Id`=$id";

        if (mysqli_query($con, $query)) {
            setcookie('success', "Status updated successfully", time() + 5, "/");
        } else {
            setcookie('error', "Error in updating status", time() + 5, "/");
        }
        ?>
        <script>
            window.location.href = 'AdProducts.php';
        </script>
        <?php
    }
    ?>
</body>

</html>