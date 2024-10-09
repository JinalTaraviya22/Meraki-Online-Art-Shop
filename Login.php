<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="validation.js"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/jquery.validate.js"></script>
  <script src="js/additional-methods.js"></script>

  <?php
  include 'Header.php';

  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  ?>
</head>

<body class="bg-dark">
  <div class="container mt-5 mb-5">
    <div class="row">
      <h2 style="text-align:center">Log In</h2>
      <div class="col-md-4"></div>
      <div class="col-md-4 mt-3">
        <!-- login form -->
        <form method="post" id="Login">
          <label for="name" class="form-label">Email :</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
          <span id="email_er"></span><br>
          <label for="name" class="form-label">Password :</label>
          <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password">
          <span id="pwd_er"></span><br>
          <a href="Forgot_password.php" style="align:left" class="form-label">Forgot Password?</a></br></br>
          <div class="row">
            <div class="col-md-3"></div>
            <button type="submit" id="loginBtn" name="loginBtn" class="col-md-6 btn btn-dark">Log In</button>
            <div class="col-md-3"></div>
          </div>
        </form>
        <!-- login form -->

        <div class="col-md-12">
          <br><a href="register.php">Don't have an account?Register here!</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <?php
  include 'Footer.php';
  if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $q = "SELECT * FROM `user_tbl` WHERE `U_Email`='$email'";
    $result = mysqli_query($con, $q);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      while ($r = mysqli_fetch_assoc($result)) {
        if ($r['U_Pwd'] == $pwd) {
          if ($r['U_Status'] == 'Active') {
            if ($r['U_Role'] == 'Admin') {
              setcookie('success', "Login Successful", time() + 5, "/");
              $_SESSION['U_Admin'] = $email;
              ?>
              <script>
                window.location.href = "admin.php";
              </script>
              <?php
            } else {
              setcookie('success', "Login Successful", time() + 5, "/");
              $_SESSION['U_User'] = $email;
              ?>
              <script>
                window.location.href = "Index.php";
              </script>
              <?php
            }
          } else {
            setcookie("error", "Email is not verified", time() + 5, "/");
            ?>
            <script>
              window.location.href = "login.php";
            </script>
            <?php
          }
        } else {
          setcookie("error", "Incorrect Password", time() + 5, "/");
          ?>
          <script>
            window.location.href = "login.php";
          </script>
          <?php
        }
      }
    } else {
      setcookie("error", "Email is not registered", time() + 5, "/");
      ?>
      <script>
        window.location.href = "login.php"
      </script>

      <?php
    }
    $row = mysqli_fetch_array($result);
  }
  ?>
</body>

</html>