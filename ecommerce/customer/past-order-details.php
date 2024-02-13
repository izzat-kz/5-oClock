<?php
session_start();
include('../config/dbcon.php');

$cust_id = $_SESSION['auth_user']['user_id'];

$query = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
$result = mysqli_query($con, $query);
$customer = mysqli_fetch_assoc($result);

$order_query = "SELECT o.order_id, o.created_at, o.status, GROUP_CONCAT(p.name SEPARATOR ', ') AS product_names
                FROM orders o 
                INNER JOIN order_details od ON o.order_id = od.order_id
                INNER JOIN products p ON od.product_id = p.product_id
                WHERE o.cust_id = '$cust_id' 
                GROUP BY o.order_id
                ORDER BY o.created_at DESC";
$order_result = mysqli_query($con, $order_query);

$destination_query = "SELECT * FROM destination WHERE cust_id = '$cust_id'";
$destination_result = mysqli_query($con, $destination_query);

include('includes/header.php');
?>

<div class="col-md-9 mx-auto mt-2">
    <h1 class="mt-4">Past Order</h1>
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item active">Past Order</li>
        <li class="breadcrumb-item">View Past Order Details</li>
    </ol>
</div>
<div class="container-fluid px-4">

    <div class="row">
        <div class="col-md-9 mx-auto mb-5">
            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Order Details
                        <a href="past-order.php" class="btn btn-danger float-end">Back</a>     
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['order_id'])) {
                        $order_id = $_GET['order_id'];

                        $query= "SELECT o.*, GROUP_CONCAT(CONCAT(' <b>(', od.quantity, ')</b> ', b.name, ' ', p.name) SEPARATOR '<br> ') AS product_names, c.fullname, d.*
                                FROM orders o 
                                INNER JOIN order_details od ON o.order_id = od.order_id
                                INNER JOIN products p ON od.product_id = p.product_id
                                INNER JOIN brand b ON p.brand_id = b.brand_id
                                INNER JOIN customers c ON c.cust_id = o.cust_id 
                                INNER JOIN destination d ON d.destination_id = o.destination_id 
                                WHERE o.order_id = $order_id
                                GROUP BY o.order_id";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $order = mysqli_fetch_assoc($query_run);
                            ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Order ID</th>
                                        <td><?= $order['order_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total</th>
                                        <td>RM <?= $order['grand_total'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td><?= $order['product_names'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bought At</th>
                                        <td><?= $order['created_at'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pay via</th>
                                        <td><?= $order['payment_option'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><i><?= $order['status'] ?></i></td>
                                    </tr>
                                    <?= $order['status'] == 'Picked Up By Courier' || $order['status'] == 'Delivered' ? "<tr><th>Tracking Number</th><td><i>{$order['tracking']}</i></td></tr>" : '' ?>
                                    <tr>
                                        <th>Shipping Destination</th>
                                        <td><b><?= $order['location'] ?></b><br>
                                        <?= $order['address'].', '.$order['postcode'].', '.$order['city'].', '.$order['state'] ?></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <a href="view-invoice.php?order_id=<?= $order['order_id'] ?>" class="btn btn-outline-primary float-start">View Invoice</a>
                            <?php
                        } else {
                            echo "Order not found.";
                        }
                    } else {
                        echo "Invalid order ID.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
