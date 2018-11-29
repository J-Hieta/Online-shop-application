<?php 
    include_once '../Scripts/sanitization.php';
    $connect = mysqli_connect("localhost", "root", "", "online_shop"); //mysqli connect to database
    session_start();

    $message = "";
    //Check if either field is empty
    try {
        if(isset($_POST["login"])) {
            if(empty($_POST["email"]) || empty($_POST["password"])) {
                $message = '<script>alert("please enter both email and password")</script>';
            }
            else {
                $email = mysqli_real_escape_string($connect, $_POST["email"]);
                $password = mysqli_real_escape_string($connect, $_POST["password"]);
                $login = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($connect, $login);
                //Proceed to verify password if login query returns data
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        //Verify entered password.
                        if(password_verify($password, $row["password_hash"])) {
                            $_SESSION['loggedin'] = true;
                            $_SESSION["email"] = $email;
                            header("location: index.php");
                        }
                        else 
                        {
                            $message = '<script>alert("Invalid username or password")</script>';
                        }
                    }
                } 
                else 
                {
                    $message = '<script>alert("Invalid username or password")</script>';
                }
            }

        }
    } catch(PDOexception $error) {
        $message = $error->getMessage();
    }

    // If user is already logged in, redirect to main page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header('location: ./index.php');
    }

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../Scripts/login.js"></script>
    <link rel="stylesheet" href="../Styles/registration.css">
    

</head>

<!-- All textual <input>, <textarea>, and <select> elements with class .form-control have a width of 100%. -->
<!-- Standard rules for all three form layouts:
Wrap labels and form controls in <div class="form-group"> (needed for optimum spacing)
Add class .form-control to all textual <input>, <textarea>, and <select> elements -->

<body onload="fromRegistration('<?php echo test_input($_GET['message'])?>')">
    <!-- If user was redirected after registration. Show success message -->
    <div class="collapse" id="success_alert">
        <div class="alert alert-success text-center center-block" role="alert" style="width: 99%; margin-top: 2px;">
            Registered Successfully!
        </div>
    </div>
    <div class="signup-form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Login</h2><br>
            <!-- Username -->
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="login" class="btn btn-success btn-lg btn-block">Log in</button>
            </div>
        </form>
        <div class="text-center">
            New user? 
            <a href="registration.php">Register now!</a><br>
            Or go back to
            <a href="index.php">main page</a></div>
        </div>
    </div>
    <?php
        if(isset($message)) {
            echo '<label class="text-danger">'.$message.'</label>';
        }
    ?>
</body>

</html>