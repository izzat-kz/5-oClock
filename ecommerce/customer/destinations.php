<?php
session_start();
include('includes/header.php'); 
include('../config/dbcon.php');
$cust_id = $_SESSION['auth_user']['user_id'];
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Destinations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">My Profile</li>
        <li class="breadcrumb-item">Destinations</li>
    </ol>
    <div class="row">

        <div class="col-md-12 mb-5">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    
                    <h4>Destination
                    <a href="profile.php" class="btn btn-secondary float-end mx-3">Back</a><a href="destination-add.php" class="btn btn-primary float-end">&#10010;</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Address</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM destination where cust_id=$cust_id";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                        <tr>
                                            <td><?= $row['location'] ?></td>
                                            <td><?= $row['address'].', '.$row['postcode'].', '.$row['city'].', '.$row['state'] ?></td>
                                            <td><a href="destination-edit.php?destination_id=<?=$row['destination_id']?>" class="btn btn-warning">Edit</a></td>
                                            <td>
                                                <form action="crud.php" method="post">   
                                            <button type="submit" name="delete_destination" value="<?=$row['destination_id']?>" class="btn btn-danger">Delete</button></td>
                                                </form> 
                                        </tr>
                                    <?php

                                }
                            }
                            else
                            {
                             ?>
                                    <tr>
                                        <td coldspan="4">No Record Found</td>
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
</div><br><br><br><br><br>    
                                
<?php 
include('includes/footer.php');
?>