<?php
session_start();
include('../config/dbcon.php');

$cust_id = $_SESSION['auth_user']['user_id'];


$query = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
$result = mysqli_query($con, $query);
$customer = mysqli_fetch_assoc($result);


$order_query = "SELECT o.*, p.name AS product_name, p.price
                FROM orders o 
                INNER JOIN order_details od ON od.order_id= o.order_id
                INNER JOIN products p ON od.product_id = p.product_id
                WHERE o.cust_id = '$cust_id' 
                ORDER BY o.created_at DESC";
$order_result = mysqli_query($con, $order_query);


$destination_query = "SELECT * FROM destination WHERE cust_id = '$cust_id'";
$destination_result = mysqli_query($con, $destination_query);


$ratings_query = "SELECT r.*, p.name FROM ratings r
                    INNER JOIN products p ON r.product_id = p.product_id
                    WHERE r.cust_id = '$cust_id'";
$ratings_result = mysqli_query($con, $ratings_query);

include('includes/header.php');
?>

<div class="col" style="background-image: url('../images/back2.png'); background-size: cover;">
<div class="row">
    <div class="col-md-8 mx-auto">
    <?php include('message.php'); ?></div>
</div>


<div class="row justify-content-center" style="align-items: flex-start;" >
<div class="col-md-8 d-flex justify-content-start">

        

    <div class="col-md-5 mb-3 mt-5" style="margin-right: 8%;" >
        <div class="card border-dark">
            <div class="card-header">
                <h4>Profile</h4>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> <?php echo $customer['email']; ?></p>
                <p><strong>Full Name:</strong> <?php echo $customer['fullname']; ?></p>
                <p><strong>Created At:</strong> <?php echo $customer['created_at']; ?></p>
                <a href="profile-edit.php?id=<?php echo $_SESSION['auth_user']['user_id']; ?>" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

    
    <div class="col-md-6 mb-3 mt-5">
        <div class="card border-dark">
            <div class="card-header">
                <h4 href><a href="destinations.php">Destinations</a>
                <a href="destinations.php" class="btn btn-secondary float-end mx-3">View</a><a href="destination-add.php" class="btn btn-primary float-end">&#10010;</a>
                </h4>
            </div>
            <div class="card-body">
                <?php while ($destination = mysqli_fetch_assoc($destination_result)) { ?>
                    <h4><a href="destination-edit.php?destination_id=<?php echo $destination['destination_id']; ?>" class="btn btn-warning">&#9998;</a> <?php echo $destination['location']; ?></h4>
                    <p><strong>Address:</strong> <?php echo $destination['address'] .', '.$destination['postcode'].', '.$destination['city'].', '.$destination['state'] ?></p>
                    <!-- <a href="destination-edit.php?destination_id=<?php echo $destination['destination_id']; ?>" class="btn btn-warning">&#9998;</a> --->
                    
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    </div>

                    

    <div class="row">
    <div class="col-md-8 mx-auto my-5">
        <div class="card text-center border-dark">
            <div class="card-header">
                <h4>Ratings and Reviews</h4>
            </div>
            <div class="card-body">
                <?php if (mysqli_num_rows($ratings_result) > 0) { ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rating_data = mysqli_fetch_assoc($ratings_result)) { ?>
                                <tr>
                                    <td><?php echo $rating_data['name']; ?></td>
                                    <td>
                                        <?php
                                        $rating = $rating_data['rating'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '&#9733;'; // Filled star
                                            } else {
                                                echo '&#9734;'; // Empty star
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $rating_data['review']; ?></td>
                                    <td><?php echo date("d F y", strtotime($rating_data['created_at'])) ?></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No ratings and reviews made.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div><br><br><br>
</div>
<?php include('includes/footer.php'); ?>
