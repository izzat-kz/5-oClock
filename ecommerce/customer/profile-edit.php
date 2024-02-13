<?php
session_start();
include('includes/header.php'); 
include('../config/dbcon.php');

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Profile</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">My Profile</li>
        <li class="breadcrumb-item">Edit Profile</li>
    </ol>
    <div class="row">

        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User
                    <a href="profile.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['id']))
                    {
                        $user_id = $_GET['id'];
                        $users = "SELECT * FROM customers WHERE cust_id='$user_id' ";
                        $users_run = mysqli_query($con, $users);

                        if(mysqli_num_rows($users_run) > 0)
                        {
                            foreach($users_run as $user)
                            {
                            ?>

                <form action="crud.php" method="post">
                    <input type="hidden" name="user_id" value="<?=$user['cust_id'];?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Full Name</label>
                            <input type="text" name="fullname" value="<?=$user['fullname'];?>" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" value="<?=$user['email'];?>" class="form-control">
                        </div>  
                        <div class="col-md-6 mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" value="<?=$user['password'];?>" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" name="update_cust" class="btn btn-primary">Update User</button>
                        </div>      
                    </div>
                </form>

                        <?php
                                }
                            }
                        else
                        {
                            echo "No Record Found";
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
?>