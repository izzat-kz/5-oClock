<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');

if (isset($_GET['destination_id'])) {
    $destination_id = $_GET['destination_id'];
    $dest_query = "SELECT * FROM destination WHERE destination_id='$destination_id'";
    $dest_result = mysqli_query($con, $dest_query);

    if (mysqli_num_rows($dest_result) > 0) {
        $destination = mysqli_fetch_assoc($dest_result);
    } else {
        $_SESSION['message'] = "No Record Found";
        header("Location: destinations.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid Request";
    header("Location: destinations.php");
    exit(0);
}
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12 mb-5 mt-5">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Address
                        <a href="destinations.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="crud.php" method="post">
                        <div class="row">
                            <input type="hidden" name="cust_id" value="<?= $_SESSION['auth_user']['user_id']; ?>">
                            <input type="hidden" name="destination_id" value="<?= $destination_id; ?>">
                            <div class="col-md-6 mb-3">
                                <label for="location">Location Name</label>
                                <input type="text" name="location" value="<?= $destination['location']; ?>" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address1">Address</label>
                                <input type="text" name="address" value="<?= $destination['address']; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="postcode">Postcode</label>
                                <input type="number" name="postcode" value="<?= $destination['postcode']; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="city">City</label>
                                <input type="text" name="city" value="<?= $destination['city']; ?>" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">State</label>
                                <select name="state">
                                    <option value="Johor" <?= $destination['state'] == 'Johor' ? 'selected' : '' ?>>Johor</option>
                                    <option value="Kedah" <?= $destination['state'] == 'Kedah' ? 'selected' : '' ?>>Kedah</option>
                                    <option value="Kelantan" <?= $destination['state'] == 'Kelantan' ? 'selected' : '' ?>>Kelantan</option>
                                    <option value="Melaka" <?= $destination['state'] == 'Melaka' ? 'selected' : '' ?>>Melaka</option>
                                    <option value="Negeri Sembilan" <?= $destination['state'] == 'Negeri Sembilan' ? 'selected' : '' ?>>Negeri Sembilan</option>
                                    <option value="Pahang" <?= $destination['state'] == 'Pahang' ? 'selected' : '' ?>>Pahang</option>
                                    <option value="Perak" <?= $destination['state'] == 'Perak' ? 'selected' : '' ?>>Perak</option>
                                    <option value="Perlis" <?= $destination['state'] == 'Perlis' ? 'selected' : '' ?>>Perlis</option>
                                    <option value="Pulau Pinang" <?= $destination['state'] == 'Pulau Pinang' ? 'selected' : '' ?>>Pulau Pinang</option>
                                    <option value="Sabah" <?= $destination['state'] == 'Sabah' ? 'selected' : '' ?>>Sabah</option>
                                    <option value="Sarawak" <?= $destination['state'] == 'Sarawak' ? 'selected' : '' ?>>Sarawak</option>
                                    <option value="Selangor" <?= $destination['state'] == 'Selangor' ? 'selected' : '' ?>>Selangor</option>
                                    <option value="Terengganu" <?= $destination['state'] == 'Terengganu' ? 'selected' : '' ?>>Terengganu</option>
                                    <option value="Kuala Lumpur" <?= $destination['state'] == 'Kuala Lumpur' ? 'selected' : '' ?>>Kuala Lumpur</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="update_destination" class="btn btn-primary">Update Destination</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<br><br><br><br>

<?php include('includes/footer.php'); ?>
