<?php session_start(); ?>
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
        include_once "../Scripts/connection.php";
        include_once "../Scripts/sanitization.php";
        $category = "";
        $input = "";
          if(isset($_GET['category'])) {
            $category = test_input($_GET['category']);
          }

          if (isset($_GET['input'])) {
              $input = test_input($_GET['input']);
          }
        
         try {
          $pProduct = $conn->query("SELECT product_name, product_price from products WHERE category like '$category' and product_name like '%$input%'");
          
          foreach($pProduct as $product) {
            echo '<div style="padding-right: 1px" class="col-sm-5">
            <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
            <h3>'.$product['product_name'].'</h3><p>'.$product['product_price'].'</p></div>';
          }          
          
        }
        catch(PDOException $e) {
          echo "Connect failed " . $e->getMessage();

        }        
      ?>  
    </div>
</body>