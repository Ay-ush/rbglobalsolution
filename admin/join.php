<?php
$user = 0;
$success = 0;
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect1.php'; // Include your database connection file

    // Validate and sanitize user input
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the user already exists
    $sql = "SELECT * FROM admin12 WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $user = 1;
        } else {
            $sql = "INSERT INTO admin12 (firstname, lastname, username, password) 
                VALUES ('$firstname', '$lastname', '$username', '$password')";
            
            if (mysqli_query($con, $sql)) {
                $success = 1;
            } else {
                $errorMsg = "Error: " . mysqli_error($con);
            }
        }
    }
    mysqli_close($con);
}
?>




<!DOCTYPE html>
<html>
<head>
        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">


    <title>Registration Form</title>
    <style>
        /* Primary Color */
        .primary-color {
            color: #06BBCC;
        }

        /* Font Styles */
        body {
            font-family: "Nunito", sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }

        /* Form Styles */
        .registration-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
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

        /* Error Message Styles */
        .errorMsg{border:1px solid red; }
    </style>
</head>
<body>
    <?php
        if($user){
            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> User already exists!! 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        }
    ?>
        <?php
        if($success){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> User created... 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        }
    ?>
    <?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?>
    <div class="registration-form">
        <h2 class="primary-color">Registration Admin Form</h2>
        <form onsubmit="return validateForm()" method="POST" action="">
            <div class="form-group">
                </tr>   
                <td>First Name:</td>
                <td><input name="firstname" type="text" id="firstname"  required > </td>
                </tr>
                <tr>
                <td>Last Name:</td>
                <td><input name="lastname" type="text" id="lastname"  required > </td>
                </tr>
                <tr>
                <td>UserName:</td>
                <td><input name="username" type="text" id="username"  required > </td>
                </tr>
                <tr>
                <td>Password:</td>
                <td><input name="password" type="password" id="password"  required > </td>
                </tr>
                <tr>
                
                <button type ="submit" class="primary-color">Submit</button<br>

            </div><br>
            <p> <a href="sign.php">Already have an account?</a></p>

        </form>
</body>
</html>
