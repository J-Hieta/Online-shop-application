<!-- Standalone navbar file to be called on any page that requires it. -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">Logo</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li><span id="items_in_cart"></span> <a href="../Layouts/cart.php" style="cursor: pointer" ><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          
           <?php
                include_once "../Scripts/connection.php";
                include_once "../Scripts/sanitization.php";  
                
                //Check if user has logged in and create correct navigation buttons.
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    
                    $fname = $conn->query("SELECT first_name from users where email = '".$_SESSION['email']."' LIMIT 1");
                    foreach($fname as $name){ 
                        echo '<li><h4 style="color:white">Welcome '.$name['first_name'].'</h4></li>';
                    }

                    echo '<li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                          <li> <a href="./profile.php">My Profile</a></li>';

                } else {
                    echo '<li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
                          <li><a href="./registration.php">Register</a></li>';
                }                     
            ?>
        </ul>
      </div>
    </div>
  </nav>