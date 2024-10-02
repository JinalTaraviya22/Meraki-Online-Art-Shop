<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
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
            <h2 style="text-align:center">Register</h2>
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-3">
                <form id="update" method="post"enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">First Name :</label>
                            <input type="text" class="form-control" id="fnm" name="Fnm" placeholder="Enter First Name">
                            <span id="fnm_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Last Name :</label>
                            <input type="text" class="form-control" id="lnm" name="Lnm" placeholder="Enter Last Name">
                            <span id="lnm_er"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Email :</label>
                            <input type="text" class="form-control" id="email" name="Email" placeholder="Enter Email">
                            <span id="email_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Phone No. :</label>
                            <input type="text" class="form-control" id="phn" name="Phn" placeholder="Enter Mobile No.">
                            <span id="phn_er"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Address :</label>
                            <textarea class="form-control" id="add" name="Add"
                                placeholder="Enter your full address"></textarea>
                            <span id="add_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">City :</label>
                            <input type="text" class="form-control" id="city" name="City" placeholder="Enter City">
                            <span id="city_er"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">State :</label>
                            <input type="text" class="form-control" id="state" name="State" placeholder="Enter State">
                            <span id="state_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Zip Code :</label>
                            <input type="text" class="form-control" id="zip" name="Zip" placeholder="Enter Zip code">
                            <span id="zip_er"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Password :</label>
                            <input type="text" class="form-control" id="pwd" name="Pwd" placeholder="Enter Password">
                            <span id="pwd_er"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Profile Image :</label>
                            <input type="file" class="form-control" id="img" name="Img">
                            <span id="img_er"></span>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-10 mb-3">
                        </div>
                        <div class="col-md-2 mb-3" style="align-content: end;">
                            <button type="submit" name="register" class="btn btn-dark"><i
                                    class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script>
        function reg() {
            event.preventDefault();
            let validate = true;
            var fn = document.getElementById('fnm');
            var fn_er = document.getElementById('fnm_er');
            var ln = document.getElementById('lnm');
            var ln_er = document.getElementById('lnm_er');
            var email = document.getElementById('email');
            var em_er = document.getElementById('email_er');
            var phn = document.getElementById('phn');
            var phn_er = document.getElementById('phn_er');
            var add = document.getElementById('add');
            var add_er = document.getElementById('add_er');
            var city = document.getElementById('city');
            var city_er = document.getElementById('city_er');
            var state = document.getElementById('state');
            var state_er = document.getElementById('state_er');
            var zip = document.getElementById('zip');
            var zip_er = document.getElementById('zip_er');
            var pwd = document.getElementById('pwd');
            var pwd_er = document.getElementById('pwd_er');
            var img = document.getElementById('img');
            var img_er = document.getElementById('img_er');

            NameValidate(fnm, fnm_er);
            NameValidate(lnm, lnm_er);
            //EmailValidate(email, email_er);
            CommanValidate(email, email_er);
            PhnValidate(phn, phn_er);
            //BigTextValidate(add, add_er);
            CommanValidate(add, add_er);
            NameValidate(city, city_er);
            NameValidate(state, state_er);
            ZipValidate(zip, zip_er);
            //PwdValidate(pwd, pwd_er);
            CommanValidate(pwd, pwd_er);
            ImgValidate(img, img_er);

            return validate;

        }
    </script>

<?php
include 'Footer.php';

if (isset($_POST['register'])) {
    $fnm = $_POST['Fnm'];
    $lnm = $_POST['Lnm'];
    $email = $_POST['Email'];
    $phn = $_POST['Phn'];
    $add = $_POST['Add'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['Zip'];
    $pwd = $_POST['Pwd'];
    $img = uniqid() . $_FILES['Img']['name'];

    $query = "INSERT INTO `user_tbl`(`U_Fnm`, `U_Lnm`, `U_Email`, `U_Phn`, `U_Add`, `U_City`, `U_State`, `U_Zip`, `U_Pwd`, `U_Profile`) VALUES ('$fnm','$lnm','$email','$phn','$add','$city','$state','$zip','$pwd','$img')";

    if (mysqli_query($con, $query)) {
        if (!is_dir("db_img/user_img")) {
            mkdir("db_img/user_img");
        }
        move_uploaded_file($_FILES['Img']['tmp_name'], "db_img/user_img/" . $img);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'veloraa1920@gmail.com';
            $mail->Password = 'leae sksb iwta wsvx';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('veloraa1920@gmail.com', 'Veloraa');
            $mail->addAddress($email, $fnm);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $activation_link = "http://localhost/demo/verify_email.php?em=" . $email;
            $mail->Body = "<html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; }
                    h1 { color: black; }
                    .button { display: inline-block; padding: 10px 20px; background-color: black; color: white; text-decoration: none; border-radius: 5px; }
                    .footer { margin-top: 20px; font-size: 0.8em; color: #777; }
                    a { text-decoration: none; color: white; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>Welcome, $fn!</h1>
                    <p>Thank you for registering. Please click the button below to activate your account:</p>
                    <p><a href='$activation_link' class='button'>Activate Your Account</a></p>
                    <p>If you didn't register on our website, please ignore this email.</p>
                    <div class='footer'>
                        <p>This is an automated message, please do not reply to this email.</p>
                    </div>
                </div>
            </body>
            </html>";

            $mail->send();
        } catch (Exception $e) {
            // $_SESSION['error'] = "Error in sending email: ". $mail->ErrorInfo;
            setcookie('error', "Error in sending email: " . $mail->ErrorInfo, time() + 5);
        }

        // $_SESSION['success'] = "Registration Successfull. VErify your Email using verification link sent to registered Email Address";
        setcookie('success', 'Registration Successfull. Verify your Email using verification link sent to registered Email Address', time() + 5, "/");
        ?>

        <script>
            window.location.href = "login.php";
        </script>
        <?php
    } else {
        // $_SESSION['error'] = "Error in Registration. Try again."
        setcookie('error', 'Error in Registration. Try again.', time() + 5, "/");
        ?>

        <script>
            window.location.href = "register.php";
        </script>
        <?php
    }
}
?>
</body>

</html>