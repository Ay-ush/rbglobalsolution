<?php
include 'connect1.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the user exists
    $sql = "SELECT * FROM register1 WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Update user information
        $updateSql = "UPDATE register1 SET firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password' 
            WHERE username = '$username'";
        if (mysqli_query($con, $updateSql)) {
            echo 'User information updated successfully';
        } else {
            die(mysqli_error($con));
        }
    } 
    
    mysqli_close($con);
}
?>
