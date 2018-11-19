<?php
    session_start();    
    session_destroy();  //Destroy the current session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout</title>
    <link rel="stylesheet" href="../Styles/registration.css">
    
</head>

<body>
    <h2>Logged out succesfully. Redirecting in 5 seconds</h2>
    <script>    //Redirect to index page in 5 seconds.
        window.setTimeout(() => {
            window.location = "index.php?"; 
        }, 5000);
    </script>
</body>