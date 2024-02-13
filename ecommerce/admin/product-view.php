<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Products</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Products</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Product
                        <a href="product-add.php" class="btn btn-primary float-end">Add Product</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Gender</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Created at</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT p.*, b.name AS bname FROM products p, brand b WHERE b.brand_id = p.brand_id";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row)
                                {
                                    ?>
                                        <tr>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['bname'] ?></td>
                                            <td><?= $row['gender'] ?></td>
                                            <td><?= substr($row['description'], 0, 115) . (strlen($row['description']) > 50 ? '...' : '') ?></td>
                                            <td>RM <?= $row['price'] ?></td>
                                            <td>
                                                <img src="../uploads/<?= $row['image'] ?>" width="60px" height="60px">
                                            </td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><a href="product-edit.php?product_id=<?=$row['product_id']?>" class="btn btn-warning">&#9998;</a></td>
                                            <td>
                                                <form action="crud.php" method="post">   
                                            <button type="submit" name="delete_pro" value="<?=$row['product_id']?>" class="btn btn-danger">Delete</button></td>
                                                </form> 
                                        </tr>
                                    <?php

                                }
                            }
                            else
                            {
                             ?>
                                    <tr>
                                        <td coldspan="7">No Record Found</td>
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
</div>    
                                
<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>