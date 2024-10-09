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
            <h2 style="text-align:center">Change Password</h2>
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-3">
                <!-- new pwd form -->
                <form id="changePwd" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">New Password :</label>
                            <input type="text" class="form-control" id="newPwd" name="newPwd"
                                placeholder="Enter New password">
                            <span id="NPwdError"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Confirm Password :</label>
                            <input type="text" class="form-control" id="coPwd" name="coPwd"
                                placeholder="Re-enter new password">
                            <span id="CPwdError"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-3"></div>
                        <div class="col-md-3 mb-3" style="align-content: end;">
                            <button type="submit" name="changepwdbtn" class="btn btn-dark"><i
                                    class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
                <!-- new pwd form -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <?php
    include 'Footer.php';

    if (isset($_POST['changepwdbtn'])) {
        $oldPwd = $_POST['oldPwd'];
        $newPwd = $_POST['newPwd'];

        $query = "select * from user_tbl where `U_Email`='$email'";
        $result = mysqli_query($con, $query);
        while ($r = mysqli_fetch_assoc($result)) {
            if ($r['U_Pwd'] == $oldPwd) {
                $q = "UPDATE user_tbl SET U_Pwd='$newPwd' WHERE U_Email='$email'";
                if (mysqli_query($con, $q)) {
                    setcookie('success', "Password changed successfully", time() + 5, "/");
                    ?>
                    <script>
                        window.location.href = "Account.php";
                    </script>
                    <?php
                } else {
                    setcookie('error', "Failed to change password", time() + 5, "/");
                    ?>
                    <script>
                        window.location.href = "Account.php";
                    </script>
                    <?php
                }
            } else {
                setcookie('error', "Incorrect Old Password", time() + 5, "/");
                ?>
                <script>
                    window.location.href = "Account.php";
                </script>
                <?php
            }
        }
    }

    ?>
</body>

</html>