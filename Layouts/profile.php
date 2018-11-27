<?php
    include_once '../Scripts/connection.php';
    include_once '../Scripts/sanitization.php';

    session_start();
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        include '../Scripts/getUserInfo.php';
    }
    else {
        header('location: ./login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Profile View</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- JQuery UI CSS-->
  <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- JQuery UI Js-->
  <script
  src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"
  integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI="
  crossorigin="anonymous"></script>
  <!-- JQuery Parsley validator -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.js"></script>
  <link rel="stylesheet" href="../Styles/styles.css">
  <link rel="stylesheet" href="../Styles/profile.css">
  <!-- MAYBE RENAME THIS SCRIPT! -->
  <script src="../Scripts/registration.js"></script>
</head>

<body>
  <?php
    include 'navbar.php';
  ?>
  <!-- On successful update -->
  <div class="collapse" id="success_update">
      <div class="alert alert-success text-center center-block" role="alert" style="width: 99%; margin-top: 2px;">
          Records Updated Succesfully
      </div>
  </div><br>



  <div class="container-fluid">
    <div class="row content">

      <!-- Left side: Profile picture, buttons for info and orders -->
      <div class="col-sm-4 left">
        <img src="<?php echo $image_path;?>" alt="../Resources/UserImages/default.jpg" class="img-rounded" id="userImage" />
        <br>
        <table class="table table-bordered table-striped table-responsive table-hover">
          <tbody>
            <tr>
              <td onclick="showInfo()">Personal Info</td>
            </tr>
            <tr>
              <td onclick="showOrders()">Orders</td>
            </tr>
          </tbody>
        </table>

        <!-- Upload profile picture -->
        <form action="../Scripts/uploadImage.php" method="post" enctype="multipart/form-data">

          <!-- This button styling and logic to display chosen picture was borrowed from here: -->
          <!-- https://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3 -->
          <!-- Own modifications: btn class used, input accept which works as filter -->
          <div class="input-group">
            <label class="input-group-btn">
              <span class="btn btn-info">
                Browse&hellip; <input type="file" style="display: none;" accept=".jpg, .jpeg, .png" name="profilePicture">
              </span>
            </label>
            <input type="text" class="form-control" readonly>
          </div><br>
          <!-- End of borrowed code -->

          <div class="row">
            <label class="btn btn-primary">
              Change Profile Picture
              <button type="submit" name="submit" style="display: none;"></button>
            </label>
          </div>
                    
        </form>
      </div>

      <!-- Right side: Actual info, edit text fields etc -->
      <div class="col-sm-8 right">

        <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="user_form"> -->
        <form id="user_form" data-parsley-validate>
          <!-- First Name -->
          <div class="form-group col-md-7">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name;?>"
                required=""
                data-parsley-pattern="^[A-Za-zÀ-ÿ ,.'-]+$" >
          </div>
        
          <!-- Last Name -->
          <div class="form-group col-md-7">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name;?>"
                required="" 
                data-parsley-pattern="^[A-Za-zÀ-ÿ ,.'-]+$">
          </div>
        
          <!-- Email -->
          <div class="form-group col-md-7">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email@Example.com" value="<?php echo $email;?>"
              required="">
          </div>
        
          <!-- Date of Birth -->
          <!-- <div class="form-group col-md-7">
              <input type="text" class="form-control" name="date_picker" id="date_picker" placeholder="Date of Birth" autocomplete="off" value="<?php echo $dob;?>">
          </div> -->
        
          <!-- Old Password -->
          <div class="form-group col-md-7">
              <input type="password" class="form-control" name="password_old" id="password_old" placeholder="Old Password"
              data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d@$!%*#?&]{8,}$"
              title="Password must be at least 8 characters long and must have at least one upper case and one lower case letter">
          </div>
        
          <!-- New Password -->
          <div class="form-group col-md-7">
              <input type="password" class="form-control" name="password_new" id="password_new" placeholder="New Password" 
              data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d@$!%*#?&]{8,}$"
              title="Password must be at least 8 characters long and must have at least one upper case and one lower case letter">
          </div>
        
          <!-- Confirm password -->
          <div class="form-group col-md-7">
              <input type="password" class="form-control" name="password_confirm_update" id="password_confirm_update" placeholder="Confirm Password"
              data-parsley-equalto="#password_new"
              title="Match this field with the new password">
          </div>
        
          <!-- Update Button -->
          <div class="form-group col-md-7">
              <button type="submit" class="btn btn-success btn-lg btn-block" id="update_button">Update</button>
          </div>
        </form>

        <!-- Orders. Hidden or shown on button click -->
        <div id="orders_table" hidden>
          <?php 
            include '../Scripts/getOrders.php';
          ?>
        </div>
      </div>
    </div>
  </div>
  <script src="../Scripts/profile.js"></script>
</body>
</html>