<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
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
  $id = $_GET['Id'];
  ?>
</head>

<body class="bg-dark">
  <div class="container mt-5 mb-5" style="padding:20px;">
    <!-- Similar Products Section -->
    <div class="row mt-3 mb-3">
      <h2 class="col-md-3" style="color:white">Products</h2>
      <div class="col-md-3"></div>
      <div class="col-md-6" style="text-align:right;padding-right:25px;"><input type="text"
          placeholder="Search here...">&nbsp;<i class="fa fa-search"></i></div>
    </div>
    <div class="row mt-5">
      <!-- Add more blocks as needed -->
      <div class="art-grid">
        <?php
        $q = "Select * from product_tbl where P_SC_Id=$id";
        $result = mysqli_query($con, $q);

        while ($r = mysqli_fetch_assoc($result)) {
          ?>
          <div class="art-item">
            <img src="db_img/product_img/<?php echo $r['P_Img1'] ?>" alt="Artwork 1" style="width:100%;">
            <h4 class="mt-2"><?php echo $r['P_Name'] ?></h4>
            <p><?php echo $r['P_Company_Name'] ?></p>
            <p>Rs. <?php echo $r['P_Price'] ?></p>
            <a href="single_product.php?Id=<?php echo $r['P_Id'] ?>"><button class="cirbutton">View</button></a>
          </div>
          <?php
        }
        ?>
        <!-- Add more artworks as needed -->
      </div>
    </div>
  </div>
  <?php
  include "Footer.php";
  ?>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>