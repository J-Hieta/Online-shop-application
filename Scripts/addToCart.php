<?php
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";
session_start();

if(isset($_POST['itemsInCart']))
{
    echo count($_SESSION['p_name']);
    exit();
}

if(isset($_POST['product_image'])) {

    $_SESSION['p_name'][] = $_POST['product_name'];
    $_SESSION['p_price'][] = $_POST['product_price'];
    $_SESSION['p_id'][] = $_POST['product_id'];
    $_SESSION['p_img'][] = $_POST['product_image'];
}



?>