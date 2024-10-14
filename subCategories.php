<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sub Categories</title>
  <link rel="stylesheet" href="styles.css">
  <script src="validation.js"></script>
  <?php
  include 'Header.php';
  $id=$_GET['Id'];
  ?>
</head>

<body class="bg-dark">
  <div class="container mt-5 mb-5" style="padding:20px;">
    <div class="row mt-3 mb-3">
      <h2 class="col-md-3" style="color:white">Sub Categories</h2>
      <div class="col-md-5"></div>
      <div class="col-md-3" style="text-align:right;padding-right:25px;"><input type="text" placeholder="Search here..."
          class="form-control">&nbsp;</div>
      <div class="col-md-1"><button class="btn btn-dark"><i class="fa fa-search"></i></button></div>
    </div>
    <div class="row mt-5">
      <?php
      $q = "Select * from subcategory_tbl where C_Id=$id";
      $result = mysqli_query($con, $q);

      while ($r = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 cat-block">
          <a href="Products.php?Id=<?php echo $r['SC_Id']?>"><img src="db_img/subCat_img/<?php echo $r['SC_Img']; ?>" alt="Product Image" class="cat-image">
            <div class="overlay">
              <div class="text"><?php echo $r['SC_Name']?></div>
            </div>
          </a>
        </div>
        <?php
      }
      ?>
      <!-- <div class="col-lg-3 col-md-4 col-sm-6 mb-4 cat-block">
        <a href="Products.php"><img src="img/wb3.jpg" alt="Product Image" class="cat-image">
          <div class="overlay">
            <div class="text">Oil Brushes</div>
          </div>
        </a>
      </div> -->
      <!-- Add more blocks as needed -->
    </div>
  </div>
  <?php
  include "Footer.php";
  ?>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>