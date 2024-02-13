<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Users</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Registered Customer</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM customers";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                        <tr>
                                            <td><?= $row['cust_id'] ?></td>
                                            <td><?= $row['fullname'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><a href="user-edit.php?id=<?=$row['cust_id']?>" class="btn btn-warning">&#9998;</a></td>
                                            <td>
                                                <form action="crud.php" method="post">   
                                            <button type="submit" name="delete_cust" value="<?=$row['cust_id']?>" class="btn btn-danger">Delete</button></td>
                                                </form> 
                                        </tr>
                                    <?php

                                }
                            }
                            else
                            {
                             ?>
                                    <tr>
                                        <td coldspan="5">No Record Found</td>
                                    </tr>
                             <?php   
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Registered Admin
                        <a href="admin-add.php" class="btn btn-primary float-end">Add Admin</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM admins";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                        <tr>
                                            <td><?= $row['admin_id'] ?></td>
                                            <td><?= $row['fullname'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><a href="admin-edit.php?admin_id=<?=$row['admin_id']?>" class="btn btn-warning">&#9998;</a></td>
                                            <td>
                                                <form action="crud.php" method="post">   
                                            <button type="submit" name="delete_admin" value="<?=$row['admin_id']?>" class="btn btn-danger">Delete</button></td>
                                                </form> 
                                        </tr>
                                    <?php

                                }
                            }
                            else
                            {
                             ?>
                                    <tr>
                                        <td coldspan="5">No Record Found</td>
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