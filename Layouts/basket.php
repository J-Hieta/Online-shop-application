<?php
session_start();
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $userId = $conn->query("SELECT user_id from users where email = '".$_SESSION['email']."' LIMIT 1");
    $items = $conn->query("SELECT * from orders where in_basket = 'Y' and user_id = '$userId'");
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../Styles/styles.css">
</head>


<body>
  <?php include 'navbar.php'; ?>  
</body>