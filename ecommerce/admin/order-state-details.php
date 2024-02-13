<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">View Order</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Order</li>
        <li class="breadcrumb-item active">View Order</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Order Details
                        <a href="order-state.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['order_id'])) {
                        $order_id = $_GET['order_id'];

                        $query = "SELECT o.*, od.*, p.name, p.price, c.fullname, d.* 
                                FROM orders o
                                INNER JOIN order_details od ON od.order_id = o.order_id
                                INNER JOIN products p ON p.product_id = od.product_id 
                                INNER JOIN customers c ON c.cust_id = o.cust_id 
                                INNER JOIN destination d ON d.cust_id = c.cust_id 
                                WHERE o.order_id = $order_id";
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
                                        <th>Created At</th>
                                        <td><?= $order['created_at'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Customer ID</th>
                                        <td><?= $order['cust_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <td><?= $order['fullname'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Product ID</th>
                                        <td><?= $order['product_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td><?= $order['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td><?= $order['quantity'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total</th>
                                        <td><?= $order['grand_total'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment By</th>
                                        <td><?= $order['payment_option'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?= $order['status'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping Destination</th>
                                        <td><?= '('.$order['location'].') ' .$order['address'].', '.$order['postcode'].', '.$order['city'].', '.$order['state'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
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

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>
