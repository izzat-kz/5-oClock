<?php
session_start();
include('../config/dbcon.php');

if(isset($_POST['register_btn'])){
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['cPassword']);

    if($password == $confirm_password)
    {
        // Check Email
        $checkemail = "SELECT email FROM customers WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run) > 0)
        {
            // Email Already Exists
            $_SESSION['message']="Email Already Exists";
            header("Location: register.php");
            exit(0);
        }
        else
        {
            $user_query = "INSERT INTO customers (fullname, email, password) VALUES('$fullname','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run)
            {
                $_SESSION['message'] = "Registered Succesfully";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "Something Went Wrong!";
                header("Location: register.php");
                exit(0);
            }
        }
    }
    else
    {
        $_SESSION['message'] = "Password And Confirm Password Does Not Match!";
        header("Location: register.php");
        exit(0);
    }
    
}

else
{
    header("Location: register.php");
    exit(0);
}


?>