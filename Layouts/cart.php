<?php
session_start();
include_once "../Scripts/connection.php";
include_once "../Scripts/sanitization.php";
// if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//     $userId = $conn->query("SELECT user_id from users where email = '".$_SESSION['email']."' LIMIT 1");
//     $items = $conn->query("SELECT * from orders where in_basket = 'Y' and user_id = '$userId'");
// }

if(isset($_GET['action'])) {

  if($_GET['action'] == 'remove') {
    
      $sessionIndex = $_GET['id'];
      unset($_SESSION['p_name']);
      unset($_SESSION['p_price']);
      unset($_SESSION['p_id']);
      echo '<script>window.location="cart.php"</script>'; 
  }
  if($_GET['action'] == 'order') {
    echo "<script>alert('ordered')</script>";
    echo '<script>window.location="cart.php"</script>'; 
    //Insert to orders code here
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
      <thead>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
      </thead>
      <?php
        $totalPrice = 0;
        if(isset($_SESSION['p_name'])) {
          for($i=0;$i<count($_SESSION['p_name']);$i++){
          echo "<tr>";
          // echo "<div class='col-sm-4'>".$_SESSION['p_id'][$i]."</div>";
          echo '<td><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></td>';
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
      <a class='btn btn-success' href='../Layouts/cart.php?action=order'>Place order</a>
      <a class='btn btn-warning' href='../Layouts/cart.php?action=remove'>Clear cart</a> 
    </div>
    
    
  </div>


</body>