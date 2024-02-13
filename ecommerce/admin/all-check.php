<?php 
session_start();

if(isset($_POST['logout_btn']))
{
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['message'] = "Logged Out Successfully";
    header("Location: ../index/login.php");
    exit(0);
}
?>