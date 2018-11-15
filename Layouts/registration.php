<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <!-- Google JQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JQuery UI CSS-->
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <script src="../Scripts/registration.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Styles/registration.css">
</head>

<!-- All textual <input>, <textarea>, and <select> elements with class .form-control have a width of 100%. -->
<!-- Standard rules for all three form layouts:
Wrap labels and form controls in <div class="form-group"> (needed for optimum spacing)
Add class .form-control to all textual <input>, <textarea>, and <select> elements -->
<body>
    <div class="signup-form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Register</h2><br>
            <!-- Name -->
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="first_name" title="Only letters allowed" 
                    placeholder="First Name" pattern="^[A-Za-z�-� ,.'-]+$" required></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="last_name" title="Only letters allowed" 
                    placeholder="Last Name" pattern="^[A-Za-z�-� ,.'-]+$" required></div>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{8,}$"
                title="Password must be at least 8 characters long and must have at least one upper case and one lower case letter" required>
            </div>

            <!-- Confirm password -->
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" id="password_confirm" placeholder="Confirm Password" onfocusout="check_passwords()" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="login.html">Sign in</a></div>
    </div>
    <?php
        $formError = [];
        $first_name = $last_name = $email = $password = '';
        
        function test_input($data) {
            $data = trim($data);              // Trims whitespace around
            $data = stripslashes($data);      // Removes / and \
            $data = htmlspecialchars($data);  // Disables code injections
            return $data;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // On submission
            
            // Since js/jquery handles the validation, php assumes everything is in order and just handles db actions
            // Sanitize input
            $first_name = test_input($_POST['first_name']);
            $last_name = test_input($_POST['last_name']);
            $email = test_input($_POST['email']);
            $password = test_input($_POST['password']);
            
            // Connect to DB 
            
            // Send new user to DB
        }
    ?>
</body>

</html>