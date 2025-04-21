<?php
ob_start();
session_start();
require_once '../includes/config.php';
$errors = [];
if(isset($_POST)){
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if(empty($firstName)){
     $errors[] = "First name must required";   
    }
    if(empty($email)){
     $errors[] = "email name must required";   
    }
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid Email Address";   
    }
    if(empty($password)){
     $errors[] = "Password name must required";   
    }
    if(empty($cpassword)){
     $errors[] = "Confirm Password must required";   
    }
    if(!empty($password) && !empty($cpassword) && $password != $cpassword){
     $errors[] = "Confirm password doesn't match.";   
    }
    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        header('location:' . SITEURL . 'signup.php');
        exit();
    }


    // print_arr($_POST);
}

?>