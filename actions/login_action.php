<?php
ob_start();
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';
$errors = [];
if(isset($_POST)){
    // print_arr($_POST); die();
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password = md5($password);

    if(empty($email)){
        $errors[] = "Email cannot be blank";   
       }
       if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
           $errors[] = "Invalid Email Address";   
       }
       if(empty($password)){
        $errors[] = "Password must required";   
       }
       if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        header('location:'.SITEURL.'login.php');
    }

    if(!empty($email) && !empty($password) ){
        // echo "All Good"; die();
        $conn = db_connect();
        // $sanitizeEmail = mysqli_real_escape_string($conn, $email);  
        $sql = "SELECT * FROM `users` WHERE email = '$email' and password = '$password'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header('location:' . SITEURL);  
            exit();
        }else{
            $errors[] = "Incorrect Password";
            $_SESSION['errors'] = $errors;
            header('location:' . SITEURL . 'login.php');
            exit(); 
        }
}
}