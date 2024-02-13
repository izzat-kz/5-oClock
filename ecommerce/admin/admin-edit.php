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
            <div class="card">
                <div class="card-header">
                    <h4>Edit User
                    <a href="user-view.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['admin_id']))
                    {
                        $user_id = $_GET['admin_id'];
                        $users = "SELECT * FROM admins WHERE admin_id='$user_id' ";
                        $users_run = mysqli_query($con, $users);

                        if(mysqli_num_rows($users_run) > 0)
                        {
                            foreach($users_run as $user)
                            {
                            ?>

                <form action="crud.php" method="post">
                    <input type="hidden" name="admin_id" value="<?=$user['admin_id'];?>">
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
                            <button type="submit" name="update_admin" class="btn btn-primary">Update User</button>
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
include('includes/scripts.php');
?>