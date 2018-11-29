<?php
session_start();
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";

if(isset($_SESSION['email'])){
  $uid = $conn->query("SELECT user_id FROM users where email = '".$_SESSION['email']."' LIMIT 1");
  foreach ($uid as $id){
    $user_id = $id['user_id'];
} 

}

if(isset($_GET['action'])) {

  if($_GET['action'] == 'remove') {
    
      $sessionIndex = $_GET['id'];
      unset($_SESSION['p_name']);
      unset($_SESSION['p_price']);
      unset($_SESSION['p_id']);
      echo '<script>window.location="cart.php"</script>'; 
  }
  if($_GET['action'] == 'order') { 
    //Insert orders into database. Each item will appear as a separate order.
    for($c = 0 ; $c < count($_SESSION['p_name']) ; $c++) {
      $conn->query("SET foreign_key_checks = 0");
      $pid = $_SESSION['p_id'][$c];
      $ins = "INSERT INTO orders(order_amount, product_id, user_id) VALUES(1, $pid, $user_id)";
      try{
        if($conn->query($ins) == true) {
          $conn->query("SET foreign_key_checks = 1");
        }
        else {
          echo "<script>alert('Something went wrong')</script>";
        }
      }catch(PDOException $e) {
        echo $e;
      }
    }
    unset($_SESSION['p_name']);
    unset($_SESSION['p_price']);
    unset($_SESSION['p_id']);
    echo '<script>window.location="index.php"</script>';
  }
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
  <?php include 'navbar.php';?>
  
  <h1 align="center">Shopping Cart</h1>
  <br>
  <div class="row">
    <table class='table-bordered' align="center">
      <tbody>
      <?php
        if(isset($_SESSION['p_name'])) {
          echo "<thead>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
        </thead>";
        $totalPrice = 0;
          //Create elements for each product in cart.
          for($i=0;$i<count($_SESSION['p_name']);$i++){
          echo "<tr>";
          echo '<td><img src="'.$_SESSION['p_img'][$i].'" class="img-responsive" style="width:100px;height:100px%" alt="Image"></td>';
          echo "<td>".$_SESSION['p_name'][$i]." </td>";
          echo "<td>".$_SESSION['p_price'][$i]."€ </td>";
          echo "</tr>";
          $totalPrice = $totalPrice + $_SESSION['p_price'][$i];         
        }        
        echo "<tr><td>Total price: ".$totalPrice." €</td></tr>";

        }
        else {
          echo "<h3 align='center'> Your shopping cart is empty</h3>";
        }       
      
      ?>  
      

    </tbody>
    
    </table>  
    <br>

    <div class="row" align="center">
    <!-- Create an appropriate button if the user is logged in or not. -->
    <?php if(isset($_SESSION['loggedin'])) {
      echo "<a class='btn btn-success' href='../Layouts/cart.php?action=order'>Place order</a>";
    }
    else {
      echo "<a class='btn btn-danger' href='../Layouts/login.php'>Log in to order</a>";
    }
    ?>      
      <a class='btn btn-warning' href='../Layouts/cart.php?action=remove'>Clear cart</a> 
    </div>
    
    
  </div>


</body>