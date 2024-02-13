<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (isset($_POST['place_order'])) {
    $cust_id = $_SESSION['auth_user']['user_id'];
    $destination_id = $_SESSION['destination_id'];
    $payment_option = $_SESSION['payment_option'];

    $query = "SELECT * FROM destination WHERE destination_id = '$destination_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $location = $row['location'];
    $address = $row['address'];
    $postcode = $row['postcode'];
    $city = $row['city'];
    $state = $row['state'];

    $grand_total = 0;
    foreach ($cart as $product_id => $product) {
        $quantity = $product['quantity'];
        $total = $product['price'] * $quantity;
        $grand_total += $total;
    }

    // INSERT INFORMATION INTO ORDER
    $insert_order_query = "INSERT INTO orders (cust_id, destination_id, payment_option, grand_total, created_at, status) VALUES ('$cust_id', '$destination_id', '$payment_option', '$grand_total', NOW(), 'Payment Completed')";
    $result = mysqli_query($con, $insert_order_query);

    if ($result) {
        $order_id = mysqli_insert_id($con);
        
        // INSERTING ALL PRODUCT INTO THE ORDER
        foreach ($cart as $product_id => $product) {
            $quantity = $product['quantity'];
            $insert_order_detail_query = "INSERT INTO order_details (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
            mysqli_query($con, $insert_order_detail_query);
        }

        $_SESSION['cart'] = array();


    // order confirmation message
    echo '<div class="text-center">
              <h2>YOUR ORDER HAS BEEN PLACED, THANK YOU</h2>
          </div>';


    // order receipt
    echo '<div class="container mt-5">
          <div class="row">
              <div class="col-md-6 offset-md-3">

        <div id="receipt" style="background-color: white; border: 1px solid black; 
        padding: 20px; margin: 20px; box-shadow: 5px 10px #888888;">
        <h2>Order Summary</h2>
        <br>
        <hr>
        <table style="border-collapse: collapse; width: 100%;">
            <tr style="border: 1px solid black; padding: 10px;">
                <th style="border: 1px solid black; padding: 10px;">Product</th>
                <th style="border: 1px solid black; padding: 10px;">Quantity</th>
            </tr>';
    foreach ($cart as $product_id => $product) {
    echo '<tr style="border: 1px solid black; padding: 10px;">
                <td style="border: 1px solid black; padding: 10px;">' . $product['name'] . '</td>
                <td style="border: 1px solid black; padding: 10px;">' . $product['quantity'] . '</td>
            </tr>';
    }
    echo '      </table><br>
            Grand Total: RM' . number_format($grand_total, 2) . '<br>
            Payment Option: ' . $payment_option . '<br><br>';
            if ($payment_option == 'Credit/Debit Card') {
                echo '<p>Card Details</p>';
                echo 'Card Number: '.$_POST['cardNumber'];
                echo 'Expiry Date: '.$_POST['expiryDate'];
                echo 'CVV: '.$_POST['cvv'];
            
            } elseif ($payment_option == 'Online Banking') {
                echo '<p>Preferred Bank <b>'.$_POST['bank']. '</b></p>';
            }
            echo '<br><br>
            Shipping To:- <br>
            <b>(' . $location . ') </b>' . $address . ', ' . $postcode . ', ' . $city . ', ' . $state . ' <br>
        </div>
        </div>
        <div class="row" align="center">
            <div class="col">
            <a href="past-order.php" class="btn btn-info btn-lg btn-block" style="width:40%;">View Past Purchases</a>
        </div><br><br><br><br></div>
        <div class="row" align="center">
            <div class="col">
            <a href="home.php" class="btn btn-primary btn-lg btn-block" style="width:40%;">Back to Store</a>
        </div></div>

              </div>
              </div>
</div>';
}
} else {
    // error message if the order placement failed
    echo '<div class="text-center">
                <p>Sorry, something went wrong while placing your order. Please try again later.</p>
            </div>';
}

?><br><br><br><br><br>
<?php include('includes/footer.php'); ?>