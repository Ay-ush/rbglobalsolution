            <?php
            session_start(); // Start the session to check if the admin user is logged in

            if (!isset($_SESSION['username'])) {
                header('location: sign.php'); // Redirect to the admin login page if not logged in
                exit(); // Exit to prevent further execution
            }

            include 'connect1.php'; // Include your database connection file

            // Fetch admin data
            $adminQuery = "SELECT * FROM admin12 WHERE username = '{$_SESSION['username']}'";
            $adminResult = mysqli_query($con, $adminQuery);
            $adminData = mysqli_fetch_assoc($adminResult);

            // Fetch user data
            $userQuery = "SELECT * FROM register1";
            $userResult = mysqli_query($con, $userQuery);

            // Close the database connection

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['delete_user'])) {
                    // Delete user based on username
                    $usernameToDelete = mysqli_real_escape_string($con, $_POST['delete_user']);
                    $deleteUserQuery = "DELETE FROM register1 WHERE username = '$usernameToDelete'";
                    mysqli_query($con, $deleteUserQuery);
                } elseif (isset($_POST['update_user'])) {
                }
            }

            mysqli_close($con); // Close the database connection
            ?>

            <!DOCTYPE html>
            <html>
            <head>
                <title>Admin Dashboard</title>
                <style>
                    /* CSS to center-align text within elements */
                    .text-center {
                        text-align: center;
                    }

                    /* Additional styling as needed */
                    .mt-5 {
                        margin-top: 5px;
                    }

                    /* Float left for admin section */
                    #admin-section {
                        float: left;
                        width: 50%;
                        padding-left:auto;
                    }

                    /* Float right for user section */
                    #user-section {
                        float: right;
                        width: 50%;
                        padding-right: auto;
                    }
                </style>
            </head>
            <body>
                <div id="header" class="text-center mt-5">
                    <h1>Welcome to the Admin Dashboard</h1>
                    <a href="logout.php">Logout</a> <!-- Create a logout script (logout.php) -->
                </div>
                <div id="admin-section">
                    <h2>Admin Information</h2>
                    <p><strong>Username:</strong> <?php echo $adminData['username']; ?></p>
                </div>

                <div id="user-section">
                    <h2>User Information</h2>
                    <?php while ($userData = mysqli_fetch_assoc($userResult)): ?>
                        <p><strong>Username:</strong> <?php echo $userData['username']; ?></p>
                        <p><strong>Password:</strong> <?php echo $userData['password']; ?></p>
                        <form action="updateuserform.html" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $userData['id']; ?>">
                            <button type="submit">Update</button>
                        </form>
                        <br>
                        <form action="" method="post">
                            <input type="hidden" name="delete_user" value="<?php echo $userData['username']; ?>">
                            <button type="submit">Delete</button>
                        </form><br><br>
                    <?php endwhile; ?>
                </div>
            </body>
            </html>
