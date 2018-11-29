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
      echo '<div class="orders">
              <table>
                <tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th></th>
                </tr>';

      foreach ($orders as $order) {
        // Fetch each product's information
        $product_id = $order['product_id'];
        // Little chaining magic
        $product = $conn->query("SELECT * FROM products WHERE product_id = '$product_id'")->fetch();

        echo '<tr>';
        echo '<td>'.$product['product_name'].'</td>';
        echo '<td>'.$product['category'].'</td>';
        echo '<td>'.$product['product_price'].'€</td>';
        echo '<td>'.$order['order_amount'].'</td>';
        echo '<td><img src="'.$product['product_image_path'].'" alt="Product image" /></td>';
        echo '</tr>';
      }

      echo '</table>';
      echo '</div>';
    }
  ?>
</body>
</html>




