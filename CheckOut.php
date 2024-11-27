<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="validation.js"></script>
    <?php
    include 'Header.php';
    require 'vendor/autoload.php';
    use Razorpay\Api\Api;

    // session of logged in user
    if (!isset($_SESSION['U_Admin']) && !isset($_SESSION['U_User'])) {
        header("Location: Login.php");
        exit();
    }
    $Email_Session = isset($_SESSION['U_User']) ? $_SESSION['U_User'] : $_SESSION['U_Admin'];

    ?>
</head>

<body class="bg-dark">
    <div class="container-fluid mt-5 bgcolor">
        <div class="row mb-5" style="text-align: center;">
            <h2>Payment for blah😒!</h2>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST">
                    <div class="form-group">
                        <label for="total"><b>Net Payable Amount</b></label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['total']; ?>" disabled>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="order_id"><b>Order ID</b></label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['order_id']; ?>" disabled>
                    </div>
                    <br>
                    <button id="rzp-button" class="btn btn-dark">Pay Now</button>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <script>
                        var options = {
                            "key": "<?php echo $api_key; ?>", // Enter the API key here
                            "amount": "<?php echo $total * 100; ?>", // Amount in paise
                            "currency": "INR",
                            "name": "Merki : Online Art Shop",
                            "description": "Test Transaction",
                            "image": "https://upload.wikimedia.org/wikipedia/en/5/5b/RK_University_logo.png",
                            "order_id": "<?php echo $_SESSION['order_id']; ?>", // Razorpay Order ID
                            "prefill": {
                                "name": "Merki : Online Art Shop",
                                "email": "jtaraviya932@rku.ac.in",
                                "contact": "8155825235"
                            },
                            "theme": {
                                "color": "#ffffff"
                            },
                            "handler": function (response) {
                                $.post("payment_razorpay_checkout.php", {
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature
                                }, function (data) {
                                    if (data === "success") {
                                        // Redirect to user order page
                                        window.location.href = "user_order.php";
                                    } else {
                                        alert("Payment verification failed. Please contact support.");
                                    }
                                });
                            }
                        };

                        var rzp = new Razorpay(options);
                        document.getElementById('rzp-button').onclick = function (e) {
                            rzp.open();
                            e.preventDefault();
                        };
                    </script>
                    <input type="hidden" name="hidden">
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <?php
    include 'Footer.php';

    
    ?>
</body>

</html>