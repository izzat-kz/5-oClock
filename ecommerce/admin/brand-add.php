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
                    <h4>Add Brand
                        <a href="brand-view.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                <form action="crud.php" method="post" autocomplete="off">

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="">Brand Name</label>
                            <input type="text" name="name" class="form-control" required oninvalid="this.setCustomValidity('Enter the brand name')" oninput="this.setCustomValidity('')" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows=4></textarea>
                        </div>    
                        <div class="col-md-12 mb-3">
                            <button type="submit" name="add_brd" class="btn btn-primary">Save Brand</button>
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