<?php session_start();

include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";
$category = "";
$input = "";
$minP = "";
$maxP = "";

$query = "SELECT * FROM products WHERE product_name LIKE ";

if (isset($_GET['input'])) {
    $input = test_input($_GET['input']);
    $query = $query."'%".$input."%'";
}
if(isset($_GET['category']) && $_GET['category'] !== '') {
    $category = test_input($_GET['category']);
    $query = $query." AND category LIKE '".$category."'";
}
if(isset($_GET['minP'])  && $_GET['minP'] !== '') {
    $minP = test_input($_GET['minP']);
    $query = $query.' AND product_price >= '.$minP;
}
if(isset($_GET['maxP'])  && $_GET['maxP'] !== '') {
    $maxP = test_input($_GET['maxP']);
    $query = $query.' AND product_price <= '.$maxP;
}

  $pProduct = $conn->query($query);  

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

        <!-- Display results, if any are found -->
        <?php
        if($pProduct->rowCount() == 0) {
            echo "<h3>Sorry, no results!</h3>";
        }else {
        include '../scripts/getProducts.php';
    }
      ?>  
    </div>
</body>