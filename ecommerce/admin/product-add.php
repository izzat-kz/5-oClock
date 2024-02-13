<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">

    <div class="row mt-4">
        <div class="col-md-12">

        <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Add Product
                        <a href="product-view.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                <form action="crud.php" method="post" autocomplete="off" enctype="multipart/form-data">

                    <div class="row">  

                        <div class="col-md-4 mb-3">
                            <label for="">Product Name</label>
                            <input type="text" name="name" autocomplete="off" class="form-control" required oninvalid="this.setCustomValidity('Enter the product name')" oninput="this.setCustomValidity('')" >
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
                                        <option value="<?=$brand_item['brand_id']?>"><?=$brand_item['name'] ?></option>
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
                                <select name="gender" class="form-control" required oninvalid="this.setCustomValidity('Select the gender type')" oninput="this.setCustomValidity('')" >
                                    <option value="">--Select Gender--</option>
                                    <option value="Men">Men</option>
                                    <option value="Women">Women</option>
                                </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>  
                        <div class="col-md-3 mb-3">
                            <label for="">Price</label>
                            <input type="number" name="price" class="form-control" required oninvalid="this.setCustomValidity('Enter the price')" oninput="this.setCustomValidity('')" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" required oninvalid="this.setCustomValidity('Set the product image')" oninput="this.setCustomValidity('')" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" name="add_pro" class="btn btn-primary">Save Product</button>
                        </div>      
                    </div>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>    
                                
<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>