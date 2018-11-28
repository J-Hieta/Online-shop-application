<?php
    include_once '../Scripts/connection.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        include_once '../Scripts/getUserInfo.php';
    }
    else {
        header('location: ./login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../Styles/profile.css">
</head>
<body>
  <?php
    // Fetch all user's orders
      $orders = $conn->query("SELECT * FROM orders WHERE user_id = '$user_id'");

    if ($orders->rowCount() <= 0) {
      echo '<h3>Looks like you have not ordered anything. All your orders will appear here</h3>'; 
    }
    else {
      echo '<div class="orders">';
      echo '<table>';
      echo '<tr>';
      echo '<th>Name</th>';
      echo '<th>Category</th>';
      echo '<th>Price</th>';
      echo '<th>Quantity</th>';
      echo '<th></th>';
      echo '</tr>';

      foreach ($orders as $order) {
        // Fetch each product's information
        $product_id = $order['product_id'];
        // Little chaining magic
        $product = $conn->query("SELECT * FROM products WHERE product_id = '$product_id'")->fetch();

        echo '<tr>';
        echo '<td><a>'.$product['product_name'].'</a></td>';
        echo '<td><a>'.$product['category'].'</a></td>';
        echo '<td>'.$product['product_price'].'€</td>';
        echo '<td>'.$order['order_amount'].'</td>';
        echo '<td><a><img src="'.$product['product_image_path'].'" alt="Product image" /></a></td>';
        echo '</tr>';
      }

      echo '</table>';
      echo '</div>';
    }
  ?>
</body>
</html>




