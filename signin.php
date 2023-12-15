<?php
$login=0;
$invalid=0;
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php'; // Include your database connection file

    // Validate and sanitize user input
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the user exists based on their username
    $sql = "SELECT * FROM `register1` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $login=1;
            session_start();
            $_SESSION["username"] = $username;
            header('location:home.html');
        } else {
            $invalid=1;
        }
    } else {
        echo 'Error executing the query: ' . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Sign-In</title>
    <style>
        /* Primary Color and Font Styles */
        .primary-color {
            color: #06BBCC;
        }

        body {
            font-family: "Nunito", sans-serif;
            font-weight: 700;
            line-height: 1.2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Styles */
        .form {
            max-width: 500px; /* Increase the maximum width */
            margin: auto;
            width: 90%; /* Adjust the width as a percentage of the parent container */
            height: auto; /* Increase the height */
            padding: 30px; /* Increase padding for more space inside the form */
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;

        }

        .form-group label {
            display: block;
            margin: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            background-color: #06BBCC;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #048FAF;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
<?php
        if($invalid){
            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>data</strong> Invalid!! 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        }
    ?>
        <?php
        if($login){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> login... 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        }
    ?>
    <?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
    <div class="form">
        <h2 class="primary-color">Sign-In Form</h2>
        <form method="POST" onsubmit="return validateSignIn()">
                <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"  required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Sign In">
            </div>

            <p class="error-message" id="signin_error_message"></p>

            <p><a href="joinnow.php">Don't have an account?</a></p>
            <p> <a href="index.html">Back to Home</a></p>

        </form>
    </div>
</body>
</html>
