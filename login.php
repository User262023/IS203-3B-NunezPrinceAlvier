<?php
session_start(); // Start a session to store user data
require('./database.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginInput = $_POST['login_input'];
    $Password = $_POST['password'];

    // Prepare the SQL statement to fetch user data by either username or email
    $query = "SELECT id, username, email, password FROM tbl1 WHERE username = ? OR email = ?";
    
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, "ss", $loginInput, $loginInput);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_id, $username, $email, $hashedPassword);
        
        if (mysqli_stmt_fetch($stmt)) {
            // Verify password
            if (password_verify($Password, $hashedPassword)) {
                // Check if the user is 'admin'
                if (($username === 'admin' || $email === 'admin') && $Password === '111') {
                    // Redirect to admin page
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    echo '<script>alert("Admin Login Successful!"); window.location.href = "admin.php";</script>';
                } else {
                    // Redirect to regular user page
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    echo '<script>alert("Login Successful!"); window.location.href = "userpage.php";</script>';
                }
            } else {
                echo '<script>alert("Invalid email/username or password.");</script>';
            }
        } else {
            echo '<script>alert("No user found with that email/username.");</script>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error in SQL preparation: ' . mysqli_error($connection) . '");</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            background-color: grey;
            color: white;
            height: 100vh;
        }
        .login-container {
            background-color: #343a40;
            padding: 40px;
            border-radius: 10px;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-control {
            background-color: #495057;
            color: white;
        }
        .form-control::placeholder {
            color: #b0b0b0;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const checkbox = document.getElementById('show-password');
            passwordInput.type = checkbox.checked ? 'text' : 'password';
        }
    </script>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <h2 class="text-center">Login</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="login_input">Email or Username</label>
                            <input type="text" class="form-control" name="login_input" id="login_input" placeholder="Enter your email or username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="show-password" onclick="togglePassword()">
                            <label class="form-check-label" for="show-password">Show Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
