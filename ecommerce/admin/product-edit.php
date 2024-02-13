<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Product</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Products</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
        <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product
                    <a href="product-view.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['product_id']))
                    {
                        $product_id = $_GET['product_id'];
                        $query = "SELECT * FROM products WHERE product_id='$product_id' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            $product = mysqli_fetch_array($query_run);
                            
                            ?>

                        <form action="crud.php" method="post" autocomplete="off" enctype="multipart/form-data">

                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

                        <div class="row">  
                        
                            <div class="col-md-4 mb-3">
                                <label for="">Product Name</label>
                                <input type="text" name="name" class="form-control" value="<?=$product['name']?>">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="">Brand</label>
                                <?php
                                $brand = "SELECT * FROM brand";
                                $brand_run = mysqli_query($con, $brand);

                                if(mysqli_num_rows($brand_run) > 0)
                                {
                                    ?>
                                    <select name="brand_id" class="form-control" required oninvalid="this.setCustomValidity('Select the product brand')" oninput="this.setCustomValidity('')" >
                                        <option value="">--Select Brand--</option>
                                        
                                        <?php
                                            foreach($brand_run as $brand_item){
                                            ?>
                                            <option value="<?=$brand_item['brand_id']?>"<?=$brand_item['brand_id'] == $product['brand_id'] ? 'selected' : '' ?> >
                                            <?=$brand_item['name'] ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                    <?php
                                }
                                else
                                {                               
                                    echo "<h5>No Brand Available</h5>";                               
                                }
                                ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="">Gender</label>
                                <?php
                                $gender = "SELECT * FROM gender"; ?>
                                
                                    <select name="gender" class="form-control" required oninvalid="this.setCustomValidity('Select the gender type')" oninput="this.setCustomValidity('')" >
                                        <option value="">--Select Gender--</option>
                                        <option value="Men"<?= $product['gender'] == 'Men' ? ' selected' : '' ?>>Men</option>
                                        <option value="Women"<?= $product['gender'] == 'Women' ? ' selected' : '' ?>>Women</option>

                                    </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" rows="4"><?=$product['description']?></textarea>
                            </div>  
                            <div class="col-md-3 mb-3">
                                <label for="">Price</label>
                                <input type="number" name="price" class="form-control" value="<?=$product['price']?>" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Created At</label>
                                <input readonly type="text" class="form-control" value="<?=$product['created_at']?>" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <input type="hidden" name="old_image" value="<?=$product['image']?>"/>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="update_pro" class="btn btn-primary">Update</button>
                            </div>      
                        </div>
                        </form>

                        <?php
                                
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