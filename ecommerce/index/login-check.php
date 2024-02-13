<?php
session_start();
include('../config/dbcon.php');

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        // Customers login successful
        foreach ($login_query_run as $data) {
            $user_id = $data['cust_id'];
            $user_name = $data['fullname'];
            $user_email = $data['email'];
        }

        // Authentication
        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email
        ];
        
        header("Location: ../customer/home.php");
        exit(0);
        
    } else {
        // User not found in customers table?
        // Check admins table
        $login_query = "SELECT * FROM admins WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            // Admin login successful
            foreach ($login_query_run as $data) {
                $user_id = $data['admin_id'];
                $user_name = $data['fullname'];
                $user_email = $data['email'];
            }
    
            // Authentication
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_email' => $user_email
            ];

            $_SESSION['message'] = "Welcome to Admin Panel";
            header("Location: ../admin/dashboard.php");
            exit(0);
            
        } else {
            $_SESSION['message'] = "Invalid Email or Password";
            header("Location: login.php");
            exit(0);
        }
    }
} else {
    $_SESSION['message'] = "You are not allowed to access this file";
    header("Location: login.php");
    exit(0);
}
?>