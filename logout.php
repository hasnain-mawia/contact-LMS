<?php
require_once './includes/config.php';
session_destroy();
header('location:'.SITEURL.'login.php');

?>