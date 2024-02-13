<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');

$cust_id = $_SESSION['auth_user']['user_id'];
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Checkout</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Cart</li>
        <li class="breadcrumb-item active">Order</li>
        <li class="breadcrumb-item">Checkout</li>
    </ol>
    </div>
    <div class="container-fluid px-4">
    <div class="row justify-content-around" style="align-items: flex-start;">

        <div class="col-md-7 mx-3 mb-3">
    <?php include('message.php'); ?>

    <div class="card bg-light">
        <div class="card-header">
            <h4>Destinations</h4>
        </div>
        <div class="card-body">
        <form action="payment-details.php" method="post">
            <?php
            $query = "SELECT d.* FROM destination d JOIN customers c ON d.cust_id = c.cust_id WHERE c.cust_id = '$cust_id'";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<input type="radio" id="'.$row['destination_id'].'" name="destination_id" value="'.$row['destination_id'].'" required>';
                echo '<label for="'.$row['destination_id'].'"><h4>' .$row['location'].'</h4></label><br>';
                echo '<label class="small" for="'.$row['destination_id'].'">' .$row['address']. ', ' .$row['postcode']. ', '.$row['city']. ', '.$row['state'].'</label><br><br>';
            }
            ?>
            <a href="destination-add-2.php" name="add_destination2" class="btn btn-secondary">+ Add Destination</a>
        </div>
        </div>      
            </div>

        <div class="col-md-4 mx-3 mb-3">
            <div class="card bg-light">
                <div class="card-header">
                    <h4>Payment Options</h4>
                </div>
                <div class="card-body">
                <input type="radio" id="card" name="payment_option" value="Credit/Debit Card" required>
                <label for="card"><h4>Credit/Debit Card</h4></label><br><br>
                <input type="radio" id="online" name="payment_option" value="Online Banking" required>
                <label for="online"><h4>Online Banking</h4></label><br>    
                </div></div>
        </div>
    </div>
            
    <div class="row">
        <div class="col-md-8 mx-5 mb-5">
        <a href="cart.php" class="btn btn-danger" >Cancel</a>
            <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
        </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>