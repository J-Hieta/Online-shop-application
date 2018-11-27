<?php
    include_once '../Scripts/connection.php';
    include_once '../Scripts/sanitization.php';

    session_start();
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        include '../Scripts/getUserInfo.php';
    }
    else {
        header('location: ./login.php');
        exit();
    }

    // Sanitize input
    $first_name   = test_input($_POST['first_name']);
    $last_name    = test_input($_POST['last_name']);
    $email        = test_input($_POST['email']);
    // $birthday     = $_POST['date_picker'];
    $password_old = test_input($_POST['password_old']);
    $password_new = test_input($_POST['password_new']);

    // User is not updating password
    if (!isset($password_new) || $password_new === '') {
        $update = $conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name,
                                email = :email WHERE user_id = '$user_id'");

        $update->bindParam(':first_name', $first_name);
        $update->bindParam(':last_name', $last_name);
        $update->bindParam(':email', $email);
    }
    // User is also changing password
    else {
      // $password is from getUserInfo.php (so, from db)
      if(password_verify($password_old, $password)) {
        // Prepare
        $update = $conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name,
        email = :email, password_hash = :password_hash WHERE user_id = '$user_id'");

        $update->bindParam(':first_name', $first_name);
        $update->bindParam(':last_name', $last_name);
        $update->bindParam(':email', $email);
        // Hash password before storing it
        $password_hash = password_hash($password_new, PASSWORD_DEFAULT);
        $update->bindParam(':password_hash', $password_hash);
      }
      else {
        // Passwords don't match
        echo 'Wrong password';
        exit;
      }
    }

    // Update records
    try {
        $update->execute();
        echo 'Success';
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }

    // Update DOB
    // if (isset($birthday) || $birthday !== '') {
    //   $update_dob = $conn->prepare("UPDATE users SET date_of_birth = :dob WHERE user_id = '$user_id'");
    //   // Since MYSql wants dates in yyyy-mm-dd format, some math is required
    //   $pieces   = explode('-', $birthday);
    //   $new_dob  = $pieces[2].'-'.$pieces[1].'-'.$pieces[0];
    //   $update_dob->bindParam(':dob', $new_dob);

    //   // Update records
    //   try {
    //     $update_dob->execute();
    //   }
    //   catch(PDOException $e) {
    //     echo $e->getMessage();
    //     exit;
    //   }
    // }
?>