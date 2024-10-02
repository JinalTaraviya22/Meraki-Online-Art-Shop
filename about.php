<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="validation.js"></script>
  <?php
  include('Header.php');
  ?>
  <style>
    /* .container {
      background-color: rgba(165, 165, 165, 0.7);
      border-radius: 50px;
      padding: 50px;
    } */
  </style>
</head>


<!-- <body style="background-image: url(img/firstbigbox.png);background-size: cover;color:white;"> -->
<body class="bg-dark">
  <div class="container mt-5">
    <div class="row">
      <h2>Meraki</h2>
      <!-- Left Column -->
      <div class="col-md-4">
        <p class="price"></p>
        <div class="product-image">
          <img src="img/categories.png" alt="User Image" class="img-fluid rounded">
        </div>
      </div>

      <!-- Right Column -->
      <div class="col-md-8">
        <!-- <h3 class="mb-5">Account Information</h3> -->
        <div class="product-image-large">
          <!-- user Information -->
          <div id="info">
            <div class="row">
              <div class="col-md-12 mb-6"><br>
                <label for="name" class="form-label" style="font-weight: bold;">Our History</label> <br><br>
                <p>With the intent to make the most premium quality art more accessible, Dessine Art is here to
                  revolutionize the Art Industry and enhance the confidence of online art buyers.
                  <br>
                  <br>With us, you can effortlessly buy art ranging from every style, from classical to contemporary and
                  affordable to high-end pieces.

                  Every artwork on Dessine Art is creatively curated by our team to cater to the aesthetics of art
                  lovers around the world. Along with established artists, we are also promoting the work of budding
                  artists so that it can help them reach out to a wider audience.
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

  </div>
  </div>
  </div>
  </div>
  </div>
  <div class="container mt-5 mb-5">
    <!-- Add a Review Section -->
    <div class="row mt-5">
      <h2>Contact Us</h2><br /><br />
      <div class="col">
        <form onsubmit="return(conForm())">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">First Name :</label>
              <input type="text" class="form-control" id="fname" placeholder="Enter First Name">
              <span id="FnmError"></span>
            </div>
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Last Name :</label>
              <input type="text" class="form-control" id="lname" placeholder="Enter Last Name">
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
              <textarea class="form-control" id="add" placeholder="Enter your full address"></textarea>
              <span id="AddError"></span>
            </div>
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">City :</label>
              <input type="text" class="form-control" id="city" placeholder="Enter City">
              <span id="CityError"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-11 mb-3">
            </div>
            <div class="col-md-1 mb-3" style="align-content: end;">
              <button type="submit" class="btn btn-dark"><i class="fa fa-arrow-right"></i></input>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script type="text/javascript">
      
    function conForm(){
      event.preventDefault();
        let validate=true;
        var fn=document.getElementById('fname');
        var fn_er=document.getElementById('FnmError');
        var ln=document.getElementById('lname');
        var ln_er=document.getElementById('LnmError');
        var email=document.getElementById('email');
        var em_er=document.getElementById('EmailError');
        var phn=document.getElementById('phn');
        var phn_er=document.getElementById('PhnError');
        var add=document.getElementById('add');
        var add_er=document.getElementById('AddError');
        var city=document.getElementById('city');
        var city_er=document.getElementById('CityError');

        NameValidate(fn,fn_er);
        NameValidate(ln,ln_er);
        EmailValidate(email,em_er);
        PhnValidate(phn,phn_er);
        BigTextValidate(add,add_er);
        NameValidate(city,city_er);

      return valiate;

        }
  </script>
 
  <?php
  include('Footer.php');
  ?>
</body>

</html>