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
    <div align="Center">
        <h2>Search results</h2>

        <?php
        $category = "";
        $input = "";
          if(isset($_GET['category'])) {
            $category = sanitize($_GET['category']);
          }

          if (isset($_GET['input'])) {
              $input = sanitize($_GET['input']);
          }

          function sanitize($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        try{
          $db="online_shop";
          $host="localhost";
          $user="root";
          $pwd="";
          $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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