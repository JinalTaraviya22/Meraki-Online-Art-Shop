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
    <script>
    $(document).ready(function() {
        $("#form1").validate({
            rules: {
                otp: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                otp: {
                    required: "Please enter the OTP",
                    digits: "Please enter a valid OTP",
                    minlength: "OTP must be 6 digits",
                    maxlength: "OTP must be 6 digits"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
        });
    });
</script>
</head>

<body class="bg-dark">
    <div class="container mt-5 mb-5">
        <div class="row">
            <h2 style="text-align:center">OTP Form</h2>
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-3">
                <!-- otp form -->
                <form id="otp" method="post" id="form1" style="align-contect:center">
                    <label for="name" class="form-label">Enter OTP :</label>
                    <input type="text" class="form-control" id="otptxt" name="otptxt"
                        placeholder="Enter OTP sent to your email">
                    <span id="otp_er"></span><br>
                    <div id="timer" class="text-danger"></div><br>
                    <button type="button" id="resend_otp" name="resend_otp" class="btn btn-dark"
                        style="display:none;">Resent OTP</button>
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

                        // resendButton.onclick = function (event) {
                        //     event.preventDefault(); // Prevent the default form submission
                        //     window.location.href = 'resend_otp_forgot_password.php';
                        // };
                    </script>
                    <button type="submit" name="otp_btn" id="otp_btn" class="btn btn-dark">Submit</button>
                </form>
                <!-- otp form -->

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

    // to chek if otp is valid or not
    if (isset($_POST['otp_btn'])) {
        if (isset($_SESSION['forgot_email'])) {
            $email = $_SESSION['forgot_email'];
            $otp = $_POST['otptxt'];
            // echo $otp;
            // Fetch the OTP from the database for the given email
            $query = "SELECT Otp FROM password_token_tbl WHERE Email = '$email' ";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $db_otp = $row['Otp'];
                echo $row['Otp'];

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
                        window.location.href = 'otp_form.php';
                    </script>
                    <?php
                }
            } else {
                setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 2, '/');
                ?>
                <script>
                    window.location.href = 'Forgot_password.php';
                </script>
                <?php
            }
        }
    }

    // to resend otp
    if (isset($_POST['resend_otp'])) {
        if (isset($_SESSION['forgot_email'])) {
            $email = $_SESSION['forgot_email'];

            // Check if the email is registered in the registration table
            $check_query = "SELECT * FROM user_tbl WHERE U_Email = '$email'";
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
            $query = "SELECT * FROM password_token_tbl WHERE Email = '$email'";
            $result = mysqli_query($con, $query);


            if ($result && mysqli_num_rows($result) > 0) {
                // Email exists, display error message and redirect to OTP form
                setcookie('error', "An OTP has already been sent to this email. New OTP will be generated once current OTP expires.", time() + 5, "/");
                ?>
                <script>
                    window.location.href = "otp_form.php";
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
                    $mail->Password = 'rtep efdy gepi yrqj'; // SMTP password
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
                    $query = "INSERT INTO  password_token_tbl  (Email, Otp, Created_at, Expires_at) VALUES ('$email', '$otp', '$email_time', '$expiry_time')";
                    mysqli_query($con, $query);
                    
                    $_SESSION['forgot_email'] = $email;
                    setcookie('success', "OTP for resetting your password is sent to the registered mail address", time() + 2, "/")
                        ?>
                    <script>
                        window.location.href = "otp_form.php";
                    </script>
                    <?php
                    exit;
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
    ?>
</body>

</html>