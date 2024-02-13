<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');


$order_id = $_GET['order_id'];

$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $order_details = mysqli_fetch_assoc($result);
    $destination_id = $order_details['destination_id'];
    $query = "SELECT * FROM destination WHERE destination_id = '$destination_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $location = $row['location'];
    $address = $row['address'];
    $postcode = $row['postcode'];
    $city = $row['city'];
    $state = $row['state'];

    $product_id = $order_details['product_id'];
    $query = "SELECT name, price FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $product_name = $row['name'];
    $price = $row['price'];

    
    // order receipt
    echo '
        <div class="container mt-5">
        <div class="row">
        <div class="col-md-6 offset-md-3">

        <div id="receipt" style="background-color: white; border: 1px solid black; 
        padding: 20px; margin: 20px; box-shadow: 5px 10px #888888;">
        <h2>Order Receipt</h2>
        Order ID: ' . $order_details['order_id'] . '<br>
        Placed At: '. $order_details['created_at'] .'<br>
        <hr>
        Product: '. $product_name .'<br>
        Quantity: '. $order_details['quantity'] .'<br>
        Grand Total: RM' . number_format($order_details['grand_total'], 2) . '<br>
        Paid Via: ' . $order_details['payment_option'] . '<br>
        Shipping To:- <br>
        <b>(' . $location . ') </b>' . $address . ', ' . $postcode . ', ' . $city . ', ' . $state . ' <br><br>
        <a href="past-order-details.php?order_id='. $order_id . '" class="btn btn-danger float">Back</a>
        </div>

    </div>
    </div>
    </div>';


}

?><br><br><br><br>
<?php include('includes/footer.php'); ?>