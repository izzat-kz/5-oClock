<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Panel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <?php include('message.php'); ?>
        
        
        <!-- sales summary -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Sales
                    <?php
                    $total_sales_query = "SELECT SUM(grand_total) AS total_sales
                                        FROM orders";
                    $total_sales_query_run = mysqli_query($con, $total_sales_query);

                    $total_sales = mysqli_fetch_assoc($total_sales_query_run)['total_sales'];

                    if ($total_sales) {
                        echo '<h4 class="mb-0">RM' . $total_sales . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">No Sales</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="sales.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- users summary -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Users
                <?php
                $dash_user_query = "(SELECT cust_id FROM customers) UNION (SELECT admin_id FROM admins)";
                $dash_user_query_run = mysqli_query($con, $dash_user_query);

                    if($user_total = mysqli_num_rows($dash_user_query_run))
                    {
                        echo '<h4 class="mb-0"> '. $user_total .' </h4>';
                    }
                    else
                    {
                        echo '<h4 class="mb-0"> No Data </h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="user-view.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- products summary -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">Total Products
                    <?php
                    $dash_product_query = "SELECT * FROM products";
                    $dash_product_query_run = mysqli_query($con, $dash_product_query);

                    if($product_total = mysqli_num_rows($dash_product_query_run))
                    {
                        echo '<h4 class="mb-0"> '. $product_total .' </h4>';
                    }
                    else
                    {
                        echo '<h4 class="mb-0"> No Data </h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="product-view.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- brands summary -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Total Brands
                    <?php
                    $dash_brand_query = "SELECT * FROM brand";
                    $dash_brand_query_run = mysqli_query($con, $dash_brand_query);

                    if($brand_total = mysqli_num_rows($dash_brand_query_run))
                    {
                        echo '<h4 class="mb-0"> '. $brand_total .' </h4>';
                    }
                    else
                    {
                        echo '<h4 class="mb-0"> No Data </h4>';
                    }
                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="brand-view.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div><br><br>
        </div><br>
        
    <div class="row justify-content-between">
        <div class="col-7">
            <canvas id="salesChart" style="width: 400px; height: 230px;"></canvas>
        </div>
            <div class="col-4">
                <figure>
                <canvas id="brandPopularityChart" style="width: 100px; height: 100px; align-items:right;"></canvas>
                <figcaption>Brand Popularity Chart</figcaption>
            </figure>
            </div>
    </div>
    </div>
</div>    <br><br>
                                
<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>