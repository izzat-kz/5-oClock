<?php 
include('authentication.php');
include('includes/header.php'); 

$query = "SELECT o.*, od.*, p.price
            FROM orders o
            INNER JOIN order_details od ON od.order_id = o.order_id
            INNER JOIN products p ON p.product_id = od.product_id
            $sort_query";
$query_run = mysqli_query($con, $query);

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">View Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Order</li>
        <li class="breadcrumb-item">View Orders</li>
    </ol>

<div class="row">
<div class="col-md-12"><br>
    

    <?php include('message.php'); ?>

    <div class="card">
        <div class="card-header">
            <h4>Orders</h4>
        </div>
        <div class="card-body">
<table class="table table-bordered">
    <thead>
        <tr>
            <th> </th>
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>Grand Total</th>
            <th>Quantity</th>
            <th>Date Bought</th>
            <th>Status</th>
            <th>Tracking Number</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT o.*, od.*, p.price
                    FROM orders o
                    INNER JOIN order_details od ON od.order_id = o.order_id
                    INNER JOIN products p ON p.product_id = od.product_id";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
        <tr>
            <td>
                <a href="order-state-details.php?order_id=<?= $row['order_id'] ?>" class="btn btn-info">View</a>
            </td>
            <td><?= $row['order_id'] ?></td>
            <td><?= $row['cust_id'] ?></td>
            <td><?= $row['grand_total'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= date("H:i A \a\\t <b>d F y</b>", strtotime($row['created_at'])) ?></td>
            <td>
                <form action="crud.php" method="post">
                    <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                    <div class="input-group">
                        <select class="form-select" name="status">
                            <option value="Payment Completed" <?= $row['status'] == 'Payment Completed' ? 'selected' : '' ?>>Payment Completed</option>
                            <option value="Packing" <?= $row['status'] == 'Packing' ? 'selected' : '' ?>>Packing</option>
                            <option value="Preparing To Ship" <?= $row['status'] == 'Preparing To Ship' ? 'selected' : '' ?>>Preparing To Ship</option>
                            <option value="Picked Up By Courier" <?= $row['status'] == 'Picked Up By Courier' ? 'selected' : '' ?>>Picked Up By Courier</option>
                            <option value="Delivered" <?= $row['status'] == 'Delivered' ? 'selected' : '' ?> <?= empty($row['tracking']) ? 'disabled' : '' ?>>Delivered</option>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </td>
            <td>
                <form action="crud.php" method="post">
                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                <div class="input-group">
                <input type="text" name="tracking" class="form-control" value="<?=$row['tracking']?>" placeholder="Enter tracking number" <?= $row['status'] != 'Picked Up By Courier' ? 'disabled' : '' ?>>
                <button type="submit" name="add_tracking" class="btn btn-warning" <?= $row['status'] != 'Picked Up By Courier' ? 'disabled' : '' ?>>Enter</button>
                </div>        
                </form>
            
                
            </td>
            </div>
        </tr>
                <?php

            }
        }
        else
        {
            ?>
                <tr>
                    <td colspan="7">No orders found</td>
                </tr>
            <?php   
        }
        ?>

    </tbody>
</table>

        </div>
    </div>

</div>
    </div>
</div>    
<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>
