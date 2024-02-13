<?php
session_start();
include('../config/dbcon.php');

if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Please log in to your account";
    header("Location: ../index/login.php");
    exit(0);
}



//ADD TO CART
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        // is product exists in cart?
        if (array_key_exists($product_id, $cart)) {
            $cart[$product_id]['quantity'] += $_POST['quantity'];  // yes, add quantity in existing
        } else {
            $cart[$product_id] = array(  // no, add product into cart
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $_POST['quantity']
            );
        }
        $_SESSION['cart'] = $cart;
        $_SESSION['message'] = "Product added to cart";
    }

    header("Location: cart.php");
    exit(0);
}


// REMOVE FROM CART
if (isset($_GET['remove']) && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (array_key_exists($product_id, $cart)) {
        unset($cart[$product_id]);
        $_SESSION['cart'] = $cart;
        $_SESSION['message'] = "Product removed from cart";
        header("Location: cart.php");
        exit(0);
    }
}


// UPDATE CART
if (isset($_POST['update_cart'])) {
    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];

    foreach ($product_ids as $key => $product_id) {
        $quantity = $quantities[$key];

        if (array_key_exists($product_id, $cart)) {
            if ($quantity > 0) {
                $cart[$product_id]['quantity'] = $quantity;
                $_SESSION['message'] = "Cart updated";
            } else {
                unset($cart[$product_id]);
                $_SESSION['message'] = "Product removed from cart";
            }
        }
    }
    $_SESSION['cart'] = $cart;
    header("Location: cart.php");
    exit(0);
}



// DELETE CUSTOMER
if (isset($_POST['delete_cust'])) {
    $cust_id = $_POST['delete_cust'];


    $customer_query = "DELETE FROM customers WHERE cust_id='$cust_id'";
    $customer_result = mysqli_query($con, $customer_query);

    if ($customer_result) {
        $address_query = "DELETE FROM addresses WHERE cust_id='$cust_id'";
        $address_result = mysqli_query($con, $address_query);

        $cart_query = "DELETE FROM cart WHERE cust_id='$cust_id'";
        $cart_result = mysqli_query($con, $cart_query);

        $rating_query = "DELETE FROM ratings WHERE cust_id='$cust_id'";
        $rating_result = mysqli_query($con, $rating_query);

        if ($address_result && $cart_result && $rating_result) {
            $_SESSION['message'] = "Customer Deleted Successfully";
            header("Location: user-view.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header("Location: user-view.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: user-view.php");
        exit(0);
    }
}



// ADD DESTINATION
if (isset($_POST['add_destination'])) {
    $cust_id = $_POST['cust_id'];
    $location = $_POST['location'];
    $escaped_location = mysqli_real_escape_string($con, $location);
    $address1 = $_POST['address1'];
    $escaped_address1 = mysqli_real_escape_string($con, $address1);
    $address2 = $_POST['address2'];
    $escaped_address2 = mysqli_real_escape_string($con, $address2);
    $postcode = $_POST['postcode'];
    $escaped_postcode = mysqli_real_escape_string($con, $postcode);
    $city = $_POST['city'];
    $escaped_city = mysqli_real_escape_string($con, $city);
    $state = $_POST['state'];
    $escaped_state = mysqli_real_escape_string($con, $state);

  //implode address
    if (!empty($address2)) {
        $address = "$escaped_address1, $escaped_address2";
    } else {
        $address = "$escaped_address1";
    }

    $query = "INSERT INTO destination(cust_id, location, address, postcode, city, state) VALUES ('$cust_id', '$escaped_location', '$address', '$postcode', '$city', '$state')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Destination Added Successfully";
        header("Location: destinations.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: destinations.php");
        exit(0);
    }
}



// ADD DESTINATION FROM CHEKOUT
if (isset($_POST['add_destination2'])) {
    $cust_id = $_POST['cust_id'];
    $location = $_POST['location'];
    $escaped_location = mysqli_real_escape_string($con, $location);
    $address1 = $_POST['address1'];
    $escaped_address1 = mysqli_real_escape_string($con, $address1);
    $address2 = $_POST['address2'];
    $escaped_address2 = mysqli_real_escape_string($con, $address2);
    $postcode = $_POST['postcode'];
    $escaped_postcode = mysqli_real_escape_string($con, $postcode);
    $city = $_POST['city'];
    $escaped_city = mysqli_real_escape_string($con, $city);
    $state = $_POST['state'];
    $escaped_state = mysqli_real_escape_string($con, $state);

  //implode address
    if (!empty($address2)) {
        $address = "$escaped_address1, $escaped_address2";
    } else {
        $address = "$escaped_address1";
    }

    $query = "INSERT INTO destination(cust_id, location, address, postcode, city, state) VALUES ('$cust_id', '$escaped_location', '$address', '$postcode', '$city', '$state')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Destination Added Successfully";
        header("Location: checkout.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: checkout.php");
        exit(0);
    }
}


// UPDATE DESTINATION
if (isset($_POST['update_destination'])) {
    $destination_id = $_POST['destination_id'];
    $cust_id = $_POST['cust_id'];
    $location = $_POST['location'];
    $escaped_location = mysqli_real_escape_string($con, $location);
    $address = $_POST['address'];
    $escaped_address = mysqli_real_escape_string($con, $address);
    $postcode = $_POST['postcode'];
    $escaped_postcode = mysqli_real_escape_string($con, $postcode);
    $city = $_POST['city'];
    $escaped_city = mysqli_real_escape_string($con, $city);
    $state = $_POST['state'];
    $escaped_state = mysqli_real_escape_string($con, $state);

    $query = "UPDATE destination SET location='$escaped_location', address='$escaped_address', postcode='$escaped_postcode', city='$escaped_city', state='$escaped_state' WHERE destination_id='$destination_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Updated Successfully";
        header("Location: destinations.php?cust_id=".$cust_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: destination-edit.php?destination_id=$destination_id&cust_id=$cust_id");
        exit(0);
    }
}


// DELETE DESTINATION
if (isset($_POST['delete_destination'])) {
    $destination_id = $_POST['delete_destination'];
    $cust_id = $_POST['cust_id'];

    $query = "DELETE FROM destination WHERE destination_id='$destination_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Address Deleted Successfully";
        header("Location: destinations.php?cust_id=".$cust_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: destinations.php?cust_id=".$cust_id);
        exit(0);
    }
}



// ADD RATINGS
if (isset($_POST['submit_rating'])) {
    $product_id = $_GET['product_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $escaped_review = mysqli_real_escape_string($con, $review);
    $cust_id = $_SESSION['auth_user']['user_id'];


    $insert_rating_query = "INSERT INTO ratings (product_id, cust_id, rating, review, created_at) VALUES ($product_id, $cust_id, $rating, '$escaped_review', NOW())";
    $insert_rating_result = mysqli_query($con, $insert_rating_query);

    if ($insert_rating_result) {
        header("Location: product-details.php?product_id=$product_id");
        exit();
    } else {
        header("Location: product-details.php?product_id=$product_id");
        exit();
    }
}


// REMOVE RATINGS
if (isset($_POST['remove_rating'])) {
    $product_id = $_GET['product_id'];
    $rating_id = $_POST['remove_rating'];
    $cust_id = $_SESSION['auth_user']['user_id'];

    $remove_rating_query = "DELETE FROM ratings WHERE rating_id = $rating_id AND cust_id = $cust_id";
    $remove_rating_result = mysqli_query($con, $remove_rating_query);

    if ($remove_rating_result) {
        $_SESSION['message'] = "Rating Removed Successfully";
        header("Location: product-details.php?product_id=$product_id");
        exit();
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: product-details.php?product_id=$product_id");
        exit();
    }
}



// CHECKOUT
if (isset($_POST['checkout'])) {
    $cust_id = $_SESSION['cust_id'];
    $grand_total = $_POST['grand_total'];

    $check_customer_query = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
    $check_customer_result = mysqli_query($con, $check_customer_query);
    $customer = mysqli_fetch_assoc($check_customer_result);

    if (!$customer) {
        $_SESSION['message'] = "Invalid customer";
        header("Location: checkout.php");
        exit(0);
    }

    $insert_order_query = "INSERT INTO orders (product_id, cust_id, grand_total, created_at, status) VALUES ";
    $values = array();
    foreach ($cart as $product_id => $product) {
        $values[] = "('$product_id', '$cust_id', '$grand_total', NOW(), 'Pending')";
    }
    $insert_order_query .= implode(", ", $values);

    $result = mysqli_query($con, $insert_order_query);

    if ($result) {
        $_SESSION['cart'] = array();
        header("Location: placed_order.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: checkout.php");
        exit(0);
    }
}



// UPDATE USER
if(isset($_POST['update_cust']))
{
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE customers SET fullname='$fullname', email='$email', password='$password'
                WHERE cust_id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Profile Updated Successfully";
        header("Location: profile.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: profile.php");
        exit(0);
    
    }

}

?>