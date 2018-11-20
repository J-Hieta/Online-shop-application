<?php 
    include_once 'connection.php';
    
//     Use in final version
//     $userInfo = $conn->query("SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
//     For testing
    $userInfo = $conn->query("SELECT * FROM users WHERE email = 'test@email.com'");
    foreach ($userInfo as $column) {
        $first_name = $column['first_name'];
        $last_name = $column['last_name'];
        $email = $column['email'];
        $dob = $column['date_of_birth'];
        $image_path = $column['user_image_path'];
        $password = $column['password_hash'];
    }
?>