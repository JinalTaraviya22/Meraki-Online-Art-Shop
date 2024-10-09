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
          <a href="Forgot_password.php" style="align:left" class="form-label">Forgot Password?</a></br>
          <div class="row">
            <div class="col-md-3"></div>
            <button type="submit" id="loginBtn" name="loginBtn" class="col-md-6 btn btn-dark">Log In</button>
            <div class="col-md-3"></div>
          </div>
        </form>
        <!-- login form -->

        <!-- forgot password -->
        <!-- <form id="forgot" method="post" style="align-contect:center;display:none !important">
          <label for="name" class="form-label">Email :</label>
          <input type="text" class="form-control" id="femail" name="femail" placeholder="Enter Email">
          <span id="femail_er"></span><br> -->
          <!-- <input type="submit" name="frgt_pwd_btn" class="btn btn-dark" value="Send OTP"> -->
          <!-- <button type="submit" name="frgt_pwd_btn" class="btn btn-dark" onclick="asd(2)">Send OTP</button>
          <button type="button" class="btn btn-dark" onclick="asd(3)"><i class="fa fa-times"></i></button>
        </form> -->
        <!-- forgot password -->

        <!-- otp form -->
        <!-- <form id="otp" method="post" style="align-contect:center;display:none !important">
          <label for="name" class="form-label">Enter OTP :</label>
          <input type="text" class="form-control" id="otptxt" name="otptxt" placeholder="Enter OTP sent to your email">
          <span id="otp_er"></span><br>
          <div id="timer" class="text-danger"></div><br>
          <button type="button" id="resend_otp" name="resend_otp" class="btn btn-dark" style="display:none;">Resent
            OTP</button>
          <script>
            let timeLeft = 60; // 1 minute timer
            const timerDisplay = document.getElementById('timer');
            const resendButton = document.getElementById('resend_otp');

            // Function to start the countdown
            function startCountdown() {
              const countdown = setInterval(() => {
                if (timeLeft <= 0) {
                  clearInterval(countdown);
                  timerDisplay.innerHTML = "You can now resend the OTP.";
                  resendButton.style.display = "inline";
                  timeLeft = 60;
                } else {
                  timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;
                }
                timeLeft -= 1;
              }, 1000);
            }

            // Check if there's a remaining time in sessionStorage
            if (sessionStorage.getItem('otpTimer')) {
              timeLeft = parseInt(sessionStorage.getItem('otpTimer'));
              startCountdown();
            } else {
              startCountdown();
            }

            // Update sessionStorage every second
            setInterval(() => {
              sessionStorage.setItem('otpTimer', timeLeft);
            }, 1000);

            resendButton.onclick = function (event) {
              event.preventDefault(); // Prevent the default form submission
              window.location.href = 'resend_otp_forgot_password.php';
            };
          </script>
          <button type="submit" name="otp_btn" id="otp_btn" class="btn btn-dark">Submit</button>
        </form> -->
        <!-- otp form -->

        <div class="col-md-12">
          <br><a href="register.php">Don't have an account?Register here!</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    event.preventDefault();
    function asd(a) {
      event.preventDefault();
      if (a == 1) {
        $('#forgot').show();
        $('#Login').hide();
        $('#otp').hide();
      } else if (a == 2) {
        $('#otp').show();
        $('#Login').hide();
        $('#forgot').hide();
      }
      else {
        $('#Login').show();
        $('#forgot').hide();
        $('#otp').hide();
      }
    }
  </script>
  <!-- validations -->
  <script>
    function login() {
      event.preventDefault();
      var validate = true;
      var email = document.getElementById('email');
      var email_er = document.getElementById('email_er');
      var pwd = document.getElementById('pwd');
      var pwd_er = document.getElementById('pwd_er');
      EmailValidate(email, email_er);
      CommanValidate(pwd, pwd_er);

      return validate;
    }

    function forgotpwd() {
      event.preventDefault();
      var validate = true;
      var femail = document.getElementById('femail');
      var femail_er = document.getElementById('femail_er');

      EmailValidate(femail, femail_er);
      return validate;
    }
  </script>
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
  // when user enters email in forgot password form
  if (isset($_POST['frgt_pwd_btn'])) {
    $email = $_POST['femail'];
    $check_query = "SELECT * FROM user_tbl WHERE U_Email = '$email'";
    echo $check_query;
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
      $query = "SELECT * FROM password_token_tbl WHERE Email = '$email'";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) > 0) {
        setcookie('error', "OTP is already sent to email address. new otp will be generated after old OTP expires.", time() + 5, "/");
        ?>
        <script>
          asd(2);
          // window.location.href = "otp_form.php";
        </script>
        <?php
        exit;
      } else {
        $otp = rand(100000, 999999);

        // Use PHPMailer to send the OTP
        $mail = new PHPMailer(true);
        try {
          //Server settings
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
          $mail->SMTPAuth = true;
          $mail->Username = 'veloraa1920@gmail.com'; // SMTP username
          $mail->Password = 'rtep efdy gepi yrqj'; // SMTP password
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;

          //Recipients
          $mail->setFrom('veloraa1920@gmail.com', 'Veloraa');
          $mail->addAddress($email, 'Password reset');

          // Content
          $mail->isHTML(true);
          $mail->Subject = 'OTP for Password Reset';
          $mail->Body = "<p>Your OTP for password reset is: $otp</p>";

          $mail->send();

          // Store the email, OTP, and timestamps in the database
          $email_time = date("Y-m-d H:i:s");
          $expiry_time = date("Y-m-d H:i:s", strtotime('+1 minutes')); // OTP valid for 10 minutes
          $query = "INSERT INTO  password_token_tbl  (Email, Otp, Created_at, Expires_at) VALUES ('$email', '$otp', '$email_time', '$expiry_time')";
          mysqli_query($con, $query);

          $_SESSION['forgot_email'] = $email;
          setcookie('success', "OTP for resetting your password is sent to the registered mail address", time() + 2, "/")
            ?>
          <script>
            asd(2);
            // window.location.href = "otp_form.php";
          </script>
          <?php
          exit;
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          setcookie('error', $mail->ErrorInfo, time() + 2, "/");
          ?>
          <script>
            asd(1);
            // window.location.href = "Forgot_password.php ";
          </script>
          <?php
        }
      }
    } else {
      setcookie('error', "Email is not registered", time() + 5, "/");
      ?>
      <script>
        asd(1);
        // window.location.href = "Forgot_password.php";
      </script>
      <?php
    }
  }
  // to resend otp
  if (isset($_SESSION['forgot_email'])) {
    $email = $_SESSION['forgot_email'];

    // Check if the email is registered in the registration table
    $check_query = "SELECT * FROM registration WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if ($check_result && mysqli_num_rows($check_result) == 0) {
      // Email is not registered, display error message
      setcookie('error', "This email is not registered.", time() + 5, "/");
      ?>
      <script>
        window.location.href = "Forgot_password.php";
      </script>
      <?php
      exit; // Stop further execution
    }

    // Check if the email already exists in the password_token table
    $query = "SELECT * FROM password_token WHERE email = '$email'";
    $result = mysqli_query($con, $query);


    if ($result && mysqli_num_rows($result) > 0) {
      // Email exists, display error message and redirect to OTP form
      setcookie('error', "An OTP has already been sent to this email. New OTP will be generated once current OTP expires.", time() + 5, "/");
      ?>
      <script>
        asd(2);
        // window.location.href = "otp_form.php";
      </script>
      <?php
    } else {

      // Generate OTP
      $otp = rand(100000, 999999);

      // Use PHPMailer to send the OTP

      $mail = new PHPMailer();
      try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'veloraa1920@gmail.com'; // SMTP username
        $mail->Password = ''; // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('veloraa1920@gmail.com', 'Veloraa');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Password Reset';
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
                h1 { color: black; }
                .otp { font-size: 24px; font-weight: bold; color: #007bff; }
                .footer { margin-top: 20px; font-size: 0.8em; color: #777; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Forgot Your Password?</h1>
                <p>We received a request to reset your password. Here is your One-Time Password (OTP):</p>
                <p class='otp'>$otp</p>
                <p>Please enter this OTP on the website to proceed with resetting your password.</p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <div class='footer'>
                    <p>This is an automated message, please do not reply to this email.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $mail->send();

        // Store the email, OTP, and timestamps in the database
        $email_time = date("Y-m-d H:i:s");
        $expiry_time = date("Y-m-d H:i:s", strtotime('+1 minutes')); // OTP valid for 10 minutes
        $query = "INSERT INTO  password_token  (email, otp, created_at, expires_at) VALUES ('$email', '$otp', '$email_time', '$expiry_time')";
        mysqli_query($con, $query);


        $_SESSION['forgot_email'] = $email;
        setcookie('success', "OTP for resetting your password is sent to the registered mail address", time() + 2, "/")
          ?>
        <script>
          asd(2);
          // window.location.href = "otp_form.php";
        </script>
        <?php
        exit;
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }
  }
  // to chek if otp is valid or not
  if (isset($_POST['otp_btn'])) {
    if (isset($_SESSION['forgot_email'])) {
      $email = $_SESSION['forgot_email'];
      $otp = $_POST['otptxt'];

      // Fetch the OTP from the database for the given email
      $query = "SELECT Otp FROM password_token_tbl WHERE Email = '$email' ";
      $result = mysqli_query($con, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $db_otp = $row['Otp'];

        // Compare the OTPs
        if ($otp == $db_otp) {
          // Redirect to new password page
          ?>
          <script>
            window.location.href = 'new_password_form.php';
          </script>
          <?php

        } else {
          setcookie('error', 'Incorrect OTP', time() + 5, '/');
          ?>

          <script>
            asd(2);
            // window.location.href = 'otp_form.php';
          </script>
          <?php
        }
      } else {
        setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 2, '/');
        ?>
        <script>
          asd(1);
          // window.location.href = 'Forgot_password.php';
        </script>
        <?php
      }
    }
  }
  ?>
</body>

</html>