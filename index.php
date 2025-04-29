<?php
ob_start();
session_start();
require_once './includes/config.php';
require_once './includes/db.php';
$conn = db_connect();
?>
<style>
    .btn{
        background-color: navy;
        border-radius: 5px;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        font-size:16px;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to contact books</title>
</head>
<body>
    <div style="text-align: center; padding: 15%;">
        <p style="font-size:50px; font-weight:bold;">
            Hello <?php if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
            $query = mysqli_query($conn, "SELECT users . * FROM `users` WHERE users.email = '$email'");   
             while($data = mysqli_fetch_array($query)){
                // echo $data['first_name'] . ' ' . $data['last_name'];
             }   
               }?>
        </p>
        <a title="Logout" href="logout.php" class="btn">Logout</a>
    </div>

    <?php
               
    class player{
        public $name;
        public $email;

        // Method
       function set_name($name){
        $this->name = $name; 
       } 
       function get_name(){
        return $this->name; 
       } 
    }           
    echo "Lets Work on OOPs <br>";
    $player1 = new player();
    $player1->set_name('Hasnain Mawia <br>');
    echo $player1->get_name();
    $player1 = new player();
    $player1->set_name('Osama Sheikh <br>');
    echo $player1->get_name();
    $player1 = new player();
    $player1->set_name('Anas Khan <br>');
    echo $player1->get_name();


?>


</body>
</html>