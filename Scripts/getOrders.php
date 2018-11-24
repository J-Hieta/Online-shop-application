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
  <div class="orders">
    <table>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Quantity</th>
        <th></th>
      </tr>
      <?php
        // Fetch all user's orders
        // $orders = $conn->query("SELECT * FROM orders WHERE user_id = '$user_id'");
        $orders = $conn->query("SELECT * FROM orders WHERE user_id = 2");

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
      ?>
    </table>
  </div>
</body>
</html>




