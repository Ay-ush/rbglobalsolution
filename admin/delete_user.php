        <?php
        // Step 1: Include your database connection file
        include 'connect1.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
            // Step 2: Get the user ID from the form data
            $user_id = $_POST['user_id'];

            // Step 3: Perform the delete operation
            $sql = "DELETE FROM register1 WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo 'User deleted successfully.';
            } else {
                die(mysqli_error($con));
            }
        } 
        // Step 4: Close the database connection
        mysqli_close($con);
        ?>
