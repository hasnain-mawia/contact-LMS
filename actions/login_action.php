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
        exit();
    }

    if(!empty($email) && !empty($password) ){
        $conn = db_connect();
        $sanitizeEmail = mysqli_real_escape_string($conn, $email);  
        $sql = "SELECT * FROM `users` WHERE `email` = '{$sanitizeEmail}'";
        $sqlResult = mysqli_query($conn, $sql);
        if(mysqli_num_rows($sqlResult) > 0){
            $userInfo = mysqli_fetch_assoc($sqlResult);
            // print_arr($userInfo); die();
            if(!empty($userInfo)){
                $passwordIndb = $userInfo['password'];
                if(password_verify($password, $passwordIndb)){
                 unset($userInfo['password']);
                 $request_url = !empty($_SESSION['request_url']) ? $_SESSION['request_url'] : SITEURL;
                 unset($_SESSION['request_url']);
                 header('location:' . $request_url);   
                }
            }else{
                $errors[] = "Incorrect Password";
                $_SESSION['errors'] = $errors;
                header('location:' . SITEURL . 'login.php');
                exit();    
            }


        }else{
            $errors[] = "Email Address Don't Exists";
                $_SESSION['errors'] = $errors;
                header('location:'. SITEURL .'login.php'); 
                exit();    
            }
    }
}
