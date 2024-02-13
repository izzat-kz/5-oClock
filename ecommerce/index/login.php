<?php 
session_start();

// Check if already logged in
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth_user']['user_id'] <= '29999') {
        header("Location: ../customer/home.php");
        exit(0);
    }
}

// Check if already logged in (admin)
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth_user']['user_id'] > '29999') {
        header("Location: ../admin/dashboard.php");
        exit(0);
    }
}


include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

            <?php include('message.php'); ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">

                    <form action="login-check.php" method="post">
                        <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required oninvalid="this.setCustomValidity('Please enter a valid email')" oninput="this.setCustomValidity('')" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control" autocomplete="off" required oninvalid="this.setCustomValidity('Please enter password')" oninput="this.setCustomValidity('')" >
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="login_btn" class="btn btn-primary">Login Now</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>