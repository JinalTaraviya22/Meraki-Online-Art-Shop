<?php
include_once "header.php";
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// session of logged in user
if (!isset($_SESSION['U_Admin']) && !isset($_SESSION['U_User'])) {
    header("Location: Login.php");
    exit();
}
$Email_Session = isset($_SESSION['U_User']) ? $_SESSION['U_User'] : $_SESSION['U_Admin'];

if (!isset($_POST['razorpay_payment_id'], $_POST['razorpay_order_id'], $_POST['razorpay_signature'])) {
    error_log("Missing payment details. POST Data: " . print_r($_POST, true));
    echo "error asdfghjkl";
    exit;
}else {
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_order_id = $_POST['razorpay_order_id'];
$razorpay_signature = $_POST['razorpay_signature'];
?>
    <script>console.log(<?php echo $razorpay_payment_id;?>);<?php
}


// Initialize Razorpay API
$api_key = 'rzp_test_yCgrsfXSuM7SxL';
$api_secret = 'eaxt0pkgow03xe2s2ufGFmBK';
$api = new Api($api_key, $api_secret);

// Fetch payment details from the client
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_order_id = $_POST['razorpay_order_id'];
$razorpay_signature = $_POST['razorpay_signature'];

try {
    // Verify payment signature
    $attributes = [
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature
    ];
    $api->utility->verifyPaymentSignature($attributes);

    // Payment is valid, process the order

    $order_id = $_SESSION['order_id'];
    $email = $_SESSION['user'];
    $total = $_SESSION['total'];
    $address = $_SESSION['address'];
    $order_array = $_SESSION['order_array'];

    $q = "SELECT * FROM cart_tbl WHERE Ct_U_Email = '$email'";
    $cart_result = mysqli_query($con, $q);

    $order_total = $order_array['total'];
    $order_discount = $order_array['discount'];
    $offer_code = $order_array['offer_code'];

    while ($order_result = mysqli_fetch_assoc($cart_result)) {
        $product_id = $order_result['Ct_P_Id'];
        $p = "SELECT * FROM product_tbl WHERE P_Id = $product_id";
        $p_result = mysqli_fetch_assoc(mysqli_query($con, $p));

        if ($p_result['P_Stock'] > 0) {
            $total_price = $_SESSION['total'];
            $discount_amount = ($total_price / $order_total) * $order_discount;
            $actual_price = $total_price - $discount_amount;
            $quantity = $order_result['Ct_Quantity'];

            $insert_order = "INSERT INTO `order_tbl`(`O_U_Email`, `O_Order_Id`, `O_Sub_Order_Id`, `O_P_Id`,
            `O_Total_Amount`, `O_Quantity`, `O_Add`,`O_Offer_Name`) 
             VALUES ('$Email_Session','$razorpay_order_id','$razorpay_order_id-$product_id','$product_id',
             '$total_price','$quantity','$address','$offer_code')";

            mysqli_query($con, $insert_order);

            $remaining_quantity = $p_result['quantity'] - $quantity;
            $update_stock = "UPDATE product_tbl SET P_Stock = $remaining_quantity WHERE P_Id = $product_id";
            mysqli_query($con, $update_stock);

            $del_cart = "DELETE FROM cart_tbl WHERE Ct_U_Email = '$email' AND Ct_P_Id = $product_id";
            mysqli_query($con, $del_cart);
        }
    }

    echo "success";
} catch (Exception $e) {
    // Payment verification failed
    echo "error";
}
?>