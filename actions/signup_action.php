<?php
ob_start();
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';
$errors = [];
if(isset($_POST)){
    // print_arr($_POST); die();
    $firstName = trim($_POST['fname']);
    $lastName = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password = md5($password);
    $cpassword = trim($_POST['cpassword'])  ;
    $cpassword = md5($cpassword);

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
        header('location:'.SITEURL.'signup.php');
        exit();
    }
    if(!empty($email)){
    $conn = db_connect();
     $emailSql = "SELECT id FROM users WHERE email = '$email'";
     $sqlResult = $conn->query($emailSql);
     if($sqlResult->num_rows>0){
        $errors[] = "Email Address Already exists.";
     }
     db_close($conn);   
    }
    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        header('location:'.SITEURL.'signup.php');
        exit();
    }

    // $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` (first_name , last_name, email , password) VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$password}')";
    $conn = db_connect();
    if(mysqli_query($conn, $sql)){
        db_close($conn);
        $message = "You are registered Successfully";
        $_SESSION['success'] = $message;    
        header('location:'.SITEURL.'login.php');
}
}

?>