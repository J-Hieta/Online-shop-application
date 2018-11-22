<?php
    include_once '../Scripts/connection.php';
    include_once '../Scripts/sanitization.php';

    session_start();
    
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
  <link rel="stylesheet" href="../Styles/styles.css">
  <link rel="stylesheet" href="../Styles/profile.css">
  <!-- MAYBE RENAME THIS SCRIPT! -->
  <script src="../Scripts/registration.js"></script>
</head>

<body>
  <?php
    include 'navbar.php';
  ?><br>



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

          <!-- <div class="row">
            <label class="btn btn-info btn-file ">
                Browse <input type="file" style="display: none;">
            </label>
          </div> -->
          
          <!-- <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Change Profile Picture</button>
          </div> -->
          <!-- <div class="form-group col-md-4">
            <input type="file" class="btn btn-light btn-lg btn-block" name="fileToUpload" id="fileToUpload">
          </div> -->
          
        </form>
      </div>

      <!-- Right side: Actual info, edit text fields etc -->
      <div class="col-sm-8 right">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="user_form">
            <!-- First Name -->
            <div class="form-group col-md-7">
                  <input type="text" class="form-control" name="first_name" title="Only letters allowed" value="<?php echo $first_name;?>"
                  placeholder="First Name" pattern="^[A-Za-zÀ-ÿ ,.'-]+$" required>
            </div>

            <!-- Last Name -->
            <div class="form-group col-md-7">
                  <input type="text" class="form-control" name="last_name" title="Only letters allowed" value="<?php echo $last_name;?>"
                  placeholder="Last Name" pattern="^[A-Za-zÀ-ÿ ,.'-]+$" required>
            </div>

            <!-- Email -->
            <div class="form-group col-md-7">
                <input type="email" class="form-control" name="email" placeholder="Email" required value="<?php echo $email;?>">
            </div>

            <!-- Date of Birth -->
            <div class="form-group col-md-7">
                <input type="text" class="form-control" name="date_picker" id="date_picker" placeholder="Date of Birth" autocomplete="off" value="<?php echo $dob;?>">
            </div>

            <!-- Old Password -->
            <div class="form-group col-md-7">
                <input type="password" class="form-control" name="password_old" id="password_old" placeholder="Old Password"
                title="Password must be at least 8 characters long and must have at least one upper case and one lower case letter">
            </div>

            <!-- Password -->
            <div class="form-group col-md-7">
                <input type="password" class="form-control" name="password_new" id="password_new" placeholder="New Password" pattern="^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d@$!%*#?&]{8,}$"
                title="Password must be at least 8 characters long and must have at least one upper case and one lower case letter">
            </div>

            <!-- Confirm password -->
            <div class="form-group col-md-7">
                <input type="password" class="form-control" name="password_confirm_update" id="password_confirm_update" placeholder="Confirm Password" 
                onfocusout="checkPasswordsOnUpdate()">
            </div>

            <!-- Update Button -->
            <div class="form-group col-md-7">
                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
            </div>
        </form>
    </div>

        <?php
          
          if ($_SERVER['REQUEST_METHOD'] == 'POST') { // On submission
              
              // Since js/jquery handles the validation, php assumes everything is in order and just handles db actions

              // Sanitize input
              $first_name = test_input($_POST['first_name']);
              $last_name = test_input($_POST['last_name']);
              $email = test_input($_POST['email']);
              $password = test_input($_POST['password_new']);
              
              // // Returns record with matching email
              // $account_exists = $conn->query("SELECT * FROM users WHERE email LIKE '$email'");
              
              // if ($account_exists->rowCount() === 0) {
              //     // Prepare insert statement
              //     $insert = $conn->prepare('INSERT INTO users (first_name, last_name, email, password_hash)
              //                             VALUES (:first_name, :last_name, :email, :password_hash)');
              //     $insert->bindParam(':first_name', $first_name);
              //     $insert->bindParam(':last_name', $last_name);
              //     $insert->bindParam(':email', $email);
              //     // Hash password before storing it
              //     $password_hash = password_hash($password, PASSWORD_DEFAULT);
              //     $insert->bindParam(':password_hash', $password_hash);
                  
              //     // Send new user to DB
              //     $insert->execute();
                  
              //     // Redirect user to login page
              //     header('Location: ../Layouts/login.php?message=successful');
              // }
              // else {
              //     echo "<script>alert('Account with that email already exists');</script>";
              // }
          }
        ?>

      </div>
    </div>
  </div>
  <script src="../Scripts/profile.js"></script>
</body>
</html>