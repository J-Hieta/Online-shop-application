<?php 
    if(!isset($_SESSION)) {
        session_start();
    } 
    include_once 'connection.php';
    
    $user_info = $conn->query("SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
    
    foreach ($user_info as $column) {
        $user_id    = $column['user_id'];
        $first_name = $column['first_name'];
        $last_name  = $column['last_name'];
        $email      = $column['email'];
        $dob        = $column['date_of_birth'];
        $image_path = $column['user_image_path'];
        $password   = $column['password_hash'];
    }
?>