<?php
include 'Header.php';
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// Check if the user is logged in
if (!isset($_SESSION['U_Admin']) && !isset($_SESSION['U_User'])) {
    header("Location: Login.php");
    exit();
}

$Email_Session = isset($_SESSION['U_User']) ? $_SESSION['U_User'] : $_SESSION['U_Admin'];

// Ensure total is set
if (!isset($_SESSION['total']) || $_SESSION['total'] <= 0) {
    echo "Invalid total price. Please check your cart.";
    exit();
}

$total = $_SESSION['total'];

// Initialize Razorpay API
$api_key = 'rzp_test_yCgrsfXSuM7SxL';
$api_secret = 'eaxt0pkgow03xe2s2ufGFmBK';
$api = new Api($api_key, $api_secret);

try {
    // Create a Razorpay order
    $order = $api->order->create([
        'receipt' => 'order_rcptid_' . time(),
        'amount' => $total * 100, // Amount in paise
        'currency' => 'INR'
    ]);

    $_SESSION['order_id'] = $order->id; // Store order ID in session
} catch (Exception $e) {
    echo "Error creating Razorpay order: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-dark">
    <div class="container-fluid mt-5 bgcolor">
        <div class="row mb-5" style="text-align: center;">
            <h2>Payment for Order!</h2>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST">
                    <div class="form-group">
                        <label for="total"><b>Net Payable Amount</b></label>
                        <input type="text" class="form-control" readonly value="<?php echo $_SESSION['total']; ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="order_id"><b>Order ID</b></label>
                        <input type="text" class="form-control" readonly value="<?php echo $_SESSION['order_id']; ?>">
                    </div>
                    <br>
                    <button id="rzp-button" class="btn btn-dark">Pay Now</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "<?php echo $api_key; ?>",
            "amount": "<?php echo $total * 100; ?>",
            "currency": "INR",
            "name": "Online Shop",
            "description": "Test Transaction",
            "image": "https://yourwebsite.com/logo.png",
            "order_id": "<?php echo $_SESSION['order_id']; ?>",
            "handler": function (response) {
                // $.post("payment-demo.php", {
                //     razorpay_payment_id: response.razorpay_payment_id,
                //     razorpay_order_id: response.razorpay_order_id,
                //     razorpay_signature: response.razorpay_signature

                // }, function (data) {
                //     if (data.trim() === "success") {
                //         window.location.href = "orderHistory.php";
                //     } else {
                //         alert("Payment verification failed. Please contact support.");
                //     }
                // });
                $.post("payment-demo.php", {
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature
                }).done(function (data) {
                    console.log(data); // Log the server's response for debugging
                    if (data.trim() === "success") {
                        window.location.href = "orderHistory.php";
                    } else {
                        alert("Payment verification failed. Please contact support.");
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.error("Error in AJAX request:", textStatus, errorThrown);
                    alert("Error processing the payment. Please try again.");
                });
            }
        };

        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function (e) {
            e.preventDefault();
            rzp.open();
        };
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>