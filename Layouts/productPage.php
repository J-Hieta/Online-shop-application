<?php
    include_once "../Scripts/connection.php";
    include_once "../Scripts/sanitization.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../Styles/styles.css">
  <script src="../Scripts/index.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>  
    <h1>Product page</h1>

    <div class="container-fluid">
    <div class="row content">

      <!-- Left side: Product picture -->
      <div class="col-sm-4 left">
        <img src="" alt="Product image" class="img-rounded" id="productImage" />
      </div>

      <!-- Right side: Product info -->
      <div class="col-sm-8 right">
      </div>

    </div>
  </div>
</body>
</html>