<?php session_start();

include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";
$category = "";
$input = "";
$minP = "";
$maxP = "";
  if(isset($_GET['category'])) {
    $category = test_input($_GET['category']);
  }

  if (isset($_GET['input'])) {
      $input = test_input($_GET['input']);
  }
  if(isset($_GET['minP'])) {
      $minP = test_input($_GET['minP']);
  }
  if(isset($_GET['maxP'])) {
      $maxP = test_input($_GET['maxP']);
  }

  $pProduct = $conn->query("SELECT * from products WHERE category like '$category' and product_name like '%$input%' and product_price >= '$minP' and product_price <= '$maxP'");
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Online store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>

    <?php include 'navbar.php'; ?>
    <div align="Center">
        <h2>Search results</h2>

        <?php
        if($pProduct->rowCount() == 0) {
            echo "<h3>Sorry, no results!</h3>";
        }else {
        include '../scripts/getProducts.php';
    }
      ?>  
    </div>
</body>