<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Brand</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Brand</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Brand
                        <a href="brand-add.php" class="btn btn-primary float-end">Add Brand</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM brand";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                        <tr>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><a href="brand-edit.php?brand_id=<?=$row['brand_id']?>" class="btn btn-warning">&#9998;</a></td>
                                            <td>
                                                <form action="crud.php" method="post">   
                                            <button type="submit" name="delete_brd" value="<?=$row['brand_id']?>" class="btn btn-danger">Delete</button></td>
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
</div>    
                                
<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>