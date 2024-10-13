<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <link rel="stylesheet" href="styles.css">
  <script src="validation.js"></script>
  <style>
    /* .container {
      background-color: rgba(165, 165, 165, 0.7);
      border-radius: 50px;
      padding: 50px;
    } */

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
  ?>
</head>

<body class="bg-dark">
  <div class="container mt-5 mb-5" style="padding:20px;">
    <!-- Similar Products Section -->
    <div class="row mt-3 mb-3">
            <h2 class="col-md-3" style="color:white">Products</h2>
            <div class="col-md-3"></div>
            <div class="col-md-6" style="text-align:right;padding-right:25px;"><input type="text" placeholder="Search here...">&nbsp;<i class="fa fa-search"></i></div>
        </div>
    <div class="row mt-5">
      <!-- Add more blocks as needed -->
      <div class="art-grid">
        <div class="art-item">
          <img src="img/easeal1.png" alt="Artwork 1" style="width:100%;">
          <h3 class="mt-2">Product Name</h3>
          <p>Company Name</p>
          <p>Rs. 13,000</p>
          <a href="single_product.php"><button class="cirbutton">View</button></a>
        </div>
        <div class="art-item">
          <img src="img/easeal2.png" alt="Artwork 1" style="width:100%;">
          <h3 class="mt-2">Product Name</h3>
          <p>Comapny Name</p>
          <p>$200</p>
          <a href="single_product.php"><button class="cirbutton">View</button></a>
        </div>
        <div class="art-item">
          <img src="img/easeal3.png" alt="Artwork 1" style="width:100%;">
          <h3 class="mt-2">Product Name</h3>
          <p>Comapny Name</p>
          <p>$200</p>
          <a href="single_product.php"><button class="cirbutton">View</button></a>
        </div>
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