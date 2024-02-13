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
                    <h4>Edit Brand
                    <a href="brand-view.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['brand_id']))
                    {
                        $brand_id = $_GET['brand_id'];
                        $brd = "SELECT * FROM brand WHERE brand_id='$brand_id' ";
                        $brd_run = mysqli_query($con, $brd);

                        if(mysqli_num_rows($brd_run) > 0)
                        {
                            foreach($brd_run as $brand)
                            {
                            ?>

                <form action="crud.php" method="post" autocomplete="off">
                    <input type="hidden" name="brand_id" value="<?=$brand['brand_id'];?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Brand Name</label>
                            <input type="text" name="name" value="<?=$brand['name'];?>" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="4"><?=$brand['description'];?></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" name="update_brd" class="btn btn-primary">Update Brand</button>
                        </div>      
                    </div>
                </form>

                        <?php
                                }
                            }
                        else
                        {
                            echo "<h4>No Record Found</h4>";
                        }
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