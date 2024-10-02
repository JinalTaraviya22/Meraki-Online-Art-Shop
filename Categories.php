<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories</title>
  <link rel="stylesheet" href="styles.css">
  <script src="validation.js"></script>
  <?php
  include 'Header.php';
  ?>
</head>

<body class="bg-dark">
  <div class="container mt-5 mb-5" style="padding:20px;">
    <div class="row mt-3 mb-3">
      <h2 class="col-md-3" style="color:white">Categories</h2>
      <div class="col-md-5"></div>
      <div class="col-md-3" style="text-align:right;padding-right:25px;"><input type="text" placeholder="Search here..."
          class="form-control">&nbsp;</div>
      <div class="col-md-1"><button class="btn btn-dark"><i class="fa fa-search"></i></button></div>
    </div>
    <div class="row mt-5">
      <?php
      $q = "Select * from category_tbl";
      $result = mysqli_query($con, $q);
      
      while ($r = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 cat-block">
          <a href="subCategories.php?Id=<?php echo $r['C_Id']; ?>"><img src="db_img/cat_img/<?php echo $r['C_Img'] ?>"
              alt="Product Image" class="cat-image">
            <div class="overlay">
              <div class="text"><?php echo $r['C_Name'] ?></div>
            </div>
          </a>
        </div>
        <?php
      }
      ?>
      <!-- <div class="col-lg-3 col-md-4 col-sm-6 mb-4 cat-block">
        <a href="subCategories.php"><img src="img/waterColors.png" alt="Product Image" class="cat-image">
          <div class="overlay">
            <div class="text">Water Colors</div>
          </div>
        </a>
      </div> -->
    </div>
  </div>
  <?php
  include "Footer.php";
  ?>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>