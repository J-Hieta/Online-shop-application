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
    <link rel="stylesheet" href="../Styles/registration.css">
</head>

<!-- All textual <input>, <textarea>, and <select> elements with class .form-control have a width of 100%. -->
<!-- Standard rules for all three form layouts:
Wrap labels and form controls in <div class="form-group"> (needed for optimum spacing)
Add class .form-control to all textual <input>, <textarea>, and <select> elements -->

<body>
    <div class="signup-form">
        <form action="PHP file for registration" method="post">
            <h2>Login</h2><br>
            <!-- Username -->
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" placeholder="Username" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Log in</button>
            </div>
        </form>
    </div>
</body>

</html>