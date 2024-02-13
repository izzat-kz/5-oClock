<?php
session_start();
include('../config/dbcon.php');

$cust_id = $_SESSION['auth_user']['user_id'];

$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$sort_query = '';
if ($sort === 'date_asc') {
    $sort_query = 'ORDER BY created_at ASC';
} elseif ($sort === 'date_desc') {
    $sort_query = 'ORDER BY created_at DESC';
} elseif ($sort === 'status_asc') {
    $sort_query = 'ORDER BY status ASC';
} elseif ($sort === 'status_desc') {
    $sort_query = 'ORDER BY status DESC';
}

$query = isset($_GET['query']) ? $_GET['query'] : '';

$query = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
$result = mysqli_query($con, $query);
$customer = mysqli_fetch_assoc($result);

$order_query = "SELECT o.order_id, o.created_at, o.status, GROUP_CONCAT(p.name SEPARATOR ', ') AS product_names
                FROM orders o 
                INNER JOIN order_details od ON o.order_id = od.order_id
                INNER JOIN products p ON od.product_id = p.product_id
                WHERE o.cust_id = '$cust_id' 
                GROUP BY o.order_id
                $sort_query";
$order_result = mysqli_query($con, $order_query);

$destination_query = "SELECT * FROM destination WHERE cust_id = '$cust_id'";
$destination_result = mysqli_query($con, $destination_query);

include('includes/header.php');
?>


<div class="col-md-9 mx-auto mt-2">
    <h1 class="mt-4">Past Order</h1>
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item">Past Order</li>
    </ol>
</div>

    <div class="col-md-9 mx-auto mb-5">
        <form action="" method="GET">
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="date_asc" <?php if ($sort === 'date_asc') echo 'selected'; ?>>Sort By Oldest</option>
                <option value="date_desc" <?php if ($sort === 'date_desc') echo 'selected'; ?>>Sort By Recent</option>
                <option value="status_asc" <?php if ($sort === 'status_asc') echo 'selected'; ?>>Sort By Status (Low to High)</option>
                <option value="status_desc" <?php if ($sort === 'status_desc') echo 'selected'; ?>>Sort By Status (High to Low)</option>
            </select>
        </form>
    </div>

<div class="row">
    

    <div class="col-md-9 mx-auto mb-5">
        <div class="card mb-5" style="border: 2px solid black;">
            <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($order_result)) { ?>
                        <tr>
                            <td><?php echo date("d M Y", strtotime($row['created_at'])); ?></td>
                            <td><?php echo date("g:i A", strtotime($row['created_at'])); ?></td>
                            <td><?php echo $row['product_names']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                            <a href="past-order-details.php?order_id=<?= $row['order_id'] ?>" class="btn btn-info">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>




</div>

<?php include('includes/footer.php'); ?>
