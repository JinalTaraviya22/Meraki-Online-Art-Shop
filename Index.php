<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="validation.js"></script>
  <?php
  include 'Header.php';

  ?>
  <style>
    .container {
      background-color: rgba(165, 165, 165, 0.7);
      border-radius: 50px;
      padding: 50px;
    }

    body {
      margin: 0;
      color: white;
      font-family: Arial, Helvetica, sans-serif;
    }

    a {
      color: #000000;
      text-decoration: none;
    }

    a:hover {
      color: #ffffff
    }

    .featured {
      padding: 50px 20px;
      text-align: center;
    }

    .featured h2 {
      margin-bottom: 30px;
    }

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
</head>

<body class="bg-dark">
  <!-- <body style="background-color:#48172d"> -->
  <div class="container mt-5">
    <div class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        $query = "select * from slider_tbl where Id=1";
        $result = mysqli_query($con, $query);
        $r = mysqli_fetch_assoc($result);
        ?>
        <div class="carousel-item active">
          <img src="db_img/slider_img/<?php echo $r['Img_1'] ?>" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5>MERAKI</h5> -->
          </div>
        </div>
        <div class="carousel-item">
          <img src="db_img/slider_img/<?php echo $r['Img_2'] ?>" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5>MERAKI</h5> -->
          </div>
        </div>
        <div class="carousel-item">
          <img src="db_img/slider_img/<?php echo $r['Img_3'] ?>" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h5>MERAKI</h5> -->
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="container mt-5">
    <div class="row">
      <!-- Left Column -->
      <div class="col-md-4">
        <p class="price"></p>
        <div class="product-image">
          <img src="img/aboutus.png" alt="User Image" class="img-fluid rounded">
        </div>
      </div>
      <!-- Right Column -->
      <div class="col-md-8">
        <div class="product-image-large">
          <div id="info">
            <div class="row">
              <div class="col-md-12 mb-6"><br>
                <label for="name" class="form-label" style="font-weight: bold;">Our History</label> <br><br>
                <p>With the intent to make the most premium quality art more accessible, Dessine Art is here to
                  revolutionize the Art Industry and enhance the confidence of online art buyers.
                  <br>
                  <br>With us, you can effortlessly buy art ranging from every style, from classical to contemporary and
                  affordable to high-end pieces.Every artwork on Dessine Art is creatively curated by our team to cater
                  to the aesthetics of art lovers around the world. Along with established artists, we are also
                  promoting the work of budding artists so that it can help them reach out to a wider audience.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <!-- Featured products -->
  <div class="container mt-5 mb-5">
    <div class="row mt-1">
      <div class="col">
        <section class="featured" id="latest">
          <h2>Bestsellers</h2>
          <div class="art-grid">
            <a href="single_product.php">
              <div class="art-item">
                <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                <h3>Product Name</h3>
                <p>Company Name</p>
                <p>Rs. 13,000</p>
              </div>
            </a>
            <a href="single_product.php">
              <div class="art-item">
                <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                <h3>Product Name</h3>
                <p>Comapny Name</p>
                <p>$200</p>
              </div>
            </a>
            <a href="single_product.php">
              <div class="art-item">
                <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                <h3>Product Name</h3>
                <p>Comapny Name</p>
                <p>$200</p>
              </div>
            </a>
          <!-- Add more artworks as needed -->
          </div>
        </section>
      </div>
    </div>
  </div> 

  
  <!-- offers -->
  <div class="container mt-5 mb-5">
    <h5>Offers</h5>
    <div class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/slide3.png" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <h5>5% dicount on Himalaya products</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide1.png" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <h5>5% dicount on Himalaya products</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide2.png" class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <h5>5% dicount on Himalaya products</h5>
          </div>
        </div>
      </div>

    </div>
  </div>


  <!-- Newest products -->
  <div class="container mt-5 mb-5">
    <div class="row mt-1">
      <div class="col">
        <section class="featured" id="latest">
          <h2>Newest Products</h2>
          <div class="art-grid">
            <a href="single_product.php">
              <div class="art-item">
                <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                <h3>Product Name</h3>
                <p>Company Name</p>
                <p>Rs. 13,000</p>
              </div>
            </a>
            <a href="single_product.php">
              <div class="art-item">
                <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                <h3>Product Name</h3>
                <p>Comapny Name</p>
                <p>$200</p>
              </div>
            </a>
            <a href="single_product.php">
              <div class="art-item">
                <img src="Img/categories.png" alt="Artwork 1" style="width:100%;">
                <h3>Product Name</h3>
                <p>Comapny Name</p>
                <p>$200</p>
              </div>
            </a>
            <!-- Add more artworks as needed -->
          </div>
        </section>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

  <?php
  include('Footer.php');
  ?>
</body>

</html>