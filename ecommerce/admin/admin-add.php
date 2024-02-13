<?php 
include('authentication.php');
include('includes/header.php'); 
?>

<div class="container-fluid px-4">

    <div class="row mt-4">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Admin
                        <a href="user-view.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                <form action="crud.php" method="post">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>  
                        <div class="col-md-6 mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" name="add_admin" class="btn btn-primary">Add Admin/User</button>
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