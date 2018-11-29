<?php
    include_once '../Scripts/connection.php';
    session_start();
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        include_once '../Scripts/getUserInfo.php';
    }
    else {
        header('location: ../Layouts/login.php');
        exit();
    }

    try {
        $delete = $conn->query("DELETE FROM users WHERE user_id = '$user_id'");
    }
    catch(PDOException $e) {
        echo 'Error';
        exit;
    }
    echo 'Deleted';
?>