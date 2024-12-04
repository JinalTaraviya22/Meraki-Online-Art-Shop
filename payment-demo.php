<?php
session_start();
include_once 'conn.php';
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// Razorpay API credentials
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

    // Payment verified, process the order
    $email = 'poojagojariya@gmail.com'; // Assuming 'user' stores the logged-in email
    $address = $_SESSION['address'];
    $order_id = $_SESSION['order_id'];
    $total = $_SESSION['total'];
    $order_array = $_SESSION['order_array'];
    $order_total = $order_array['total'];
    $order_discount = $order_array['discount'];
    $offer_code = $order_array['offer'];

    // Fetch cart items for the user
    $cart_query = "SELECT * FROM cart_tbl WHERE Ct_U_Email = '$email'";
    $cart_result = mysqli_query($conn, $cart_query);

    if (!$cart_result || mysqli_num_rows($cart_result) == 0) {
        throw new Exception("Cart is empty or could not be fetched.");
    }

    // Loop through each cart item and process the order
    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $product_id = $cart_row['Ct_P_Id'];
        $quantity = $cart_row['Ct_Quantity'];

        // Fetch product details
        $product_query = "SELECT P_Price, P_Discount, P_Stock FROM product_tbl WHERE P_Id = $product_id";
        $product_result = mysqli_query($conn, $product_query);

        if (!$product_result || mysqli_num_rows($product_result) == 0) {
            throw new Exception("Product ID $product_id not found.");
        }

        $product = mysqli_fetch_assoc($product_result);

        // Check stock availability
        if ($product['P_Stock'] < $quantity) {
            throw new Exception("Insufficient stock for Product ID $product_id.");
        }

        // Calculate discount and actual price
        $discount_amount = ($product['P_Price'] * ($product['P_Discount'] / 100)) * $quantity;
        $actual_price = ($product['P_Price'] * $quantity) - $discount_amount;

        // Insert order into database
        $insert_order_query = "
            INSERT INTO order_tbl (
                O_Order_Id, O_Sub_Order_Id, O_P_Id, O_Quantity, O_U_Email, O_Total_Amount,
                O_Delivery_Address, O_Offer_Name, O_Discount_Amount, O_Actual_Amount, O_Delivery_Status, O_Payment_Status, O_Date
            ) VALUES (
                '$razorpay_order_id', '$razorpay_order_id-$product_id', $product_id, $quantity,
                '$email', $total, '$address', '$offer_code', $discount_amount, $actual_price,
                'Ordered', 'Completed', NOW()
            )
        ";

        if (!mysqli_query($conn, $insert_order_query)) {
            throw new Exception("Error inserting order: " . mysqli_error($conn));
        }

        // Update product stock
        $remaining_stock = $product['P_Stock'] - $quantity;
        $update_stock_query = "UPDATE product_tbl SET P_Stock = $remaining_stock WHERE P_Id = $product_id";

        if (!mysqli_query($conn, $update_stock_query)) {
            throw new Exception("Error updating stock for Product ID $product_id: " . mysqli_error($conn));
        }

        // Remove item from cart
        $delete_cart_query = "DELETE FROM cart_tbl WHERE Ct_U_Email = '$email' AND Ct_P_Id = $product_id";

        if (!mysqli_query($conn, $delete_cart_query)) {
            throw new Exception("Error deleting cart item for Product ID $product_id: " . mysqli_error($conn));
        }
    }

    // If everything is successful, return success response
    echo "success";

} catch (Exception $e) {
    // Handle exceptions and rollback if needed
    error_log("Error processing payment: " . $e->getMessage());
    echo "error: " . $e->getMessage();
}
?>
