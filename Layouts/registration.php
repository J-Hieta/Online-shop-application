<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Styles/registration.css">
    <!-- Google JQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JQuery UI CSS-->
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <script src="../Scripts/registration.js"></script>
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
                    <div class="col-xs-6"><input type="text" class="form-control" name="first_name" title="Illegal characters found" 
                    placeholder="First Name" pattern="^[A-Za-z�-� ,.'-]+$" required></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="last_name" title="Illegal characters found" 
                    placeholder="Last Name" pattern="^[A-Za-z�-� ,.'-]+$" required></div>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" pattern="/^(?=[a-z])(?=[A-Z])[a-zA-Z]{8,}$/" title="Only letters allowed" required>
            </div>

            <!-- Confirm password -->
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" id="password_confirm" placeholder="Confirm Password" onfocusout="check_passwords" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="login.html">Sign in</a></div>
    </div>
    <?php
        $formError = [];
        $first_name = $last_name = $email = $password = $password_confirm = '';
        
        function test_input($data) {
            $data = trim($data);              // Trims whitespace around
            $data = stripslashes($data);      // Removes / and \
            $data = htmlspecialchars($data);  // Disables code injections
            return $data;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // On submission
            // FIRST NAME
            if (empty($_POST['first_name'])) {
                $formError['first_name'] = 'First name is required';
            }
            else {
                $first_name = test_input($_POST['first_name']);
                if (!preg_match("/^[A-Za-zÀ-ÿ ,.'-]+$/", $first_name)) {
                    $formError['first_name'] = 'Check your spelling. Illegal characters found';
                }
            }
            // LAST NAME
            if (empty($_POST['last_name'])) {
                $formError['last_name'] = 'Name is required';
            }
            else {
                $last_name = test_input($_POST['last_name']);
                if (!preg_match("/^[A-Za-zÀ-ÿ ,.'-]+$/", $last_name)) {
                    $formError['last_name'] = 'Check your spelling. Illegal characters found';
                }
            }
            // EMAIL
            if (empty($_POST['email'])) {
                $formError['email'] = 'Email is required';
            }
            else {
                $email = test_input($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $formError['email'] = 'E.g. An@Example.com';
                }
            }
            // PASSWORD
            if (empty($_POST['password'])) {
                $formError['password'] = 'Password is required';
            }
            else {
                $password = test_input($_POST['password']);
                // This regex checks that password has at least one lower case 
                // and one upper case letter and minimum length is 8 characters
                if (!preg_match("/^(?=[a-z])(?=[A-Z])[a-zA-Z]{8,}$/", $password)) {
                    $formError['password'] = 'Password must be at least 8 characters long and 
                                          must have at least one upper case and one lower case letter';
                }
            }
            // CONFIRM PASSWORD
            if (empty($_POST['confirm_password'])) {
                $formError['password_confirm'] = 'Confirmation is required';
            }
            else {
                $password_confirm = test_input($_POST['confirm_password']);
                if ($password_confirm != $password) {
                    $formError['password_confirm'] = 'Passwords do not match';
                }
            }
            // Everything checks out
            if (empty($formError)) {
                // Register user to database
                echo "<script type='text/javascript'>alert('Registrarion successful');</script>";
            }
        }
    ?>
</body>

</html>