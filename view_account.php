<?php
session_start(); // Start session to access logged-in user info
require('./database.php'); // Include your database connection

// Check if the user is logged in by checking the session
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's information from the database using the session user ID
$user_id = $_SESSION['user_id'];
$query = "SELECT FirstName, MiddleName, LastName, username, email FROM tbl1 WHERE id = ?";
if ($stmt = mysqli_prepare($connection, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $firstName, $middleName, $lastName, $username, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

// Update user info if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $new_firstName = $_POST['firstName'];
    $new_middleName = $_POST['middleName'];
    $new_lastName = $_POST['lastName'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];

    // Update user data in the database
    $updateQuery = "UPDATE tbl1 SET FirstName = ?, MiddleName = ?, LastName = ?, username = ?, email = ? WHERE id = ?";
    if ($updateStmt = mysqli_prepare($connection, $updateQuery)) {
        mysqli_stmt_bind_param($updateStmt, "sssssi", $new_firstName, $new_middleName, $new_lastName, $new_username, $new_email, $user_id);
        if (mysqli_stmt_execute($updateStmt)) {
            // Update session variables
            $_SESSION['username'] = $new_username;
            $_SESSION['email'] = $new_email;
            echo '<script>alert("Account updated successfully!");</script>';
        } else {
            echo '<script>alert("Error updating account.");</script>';
        }
        mysqli_stmt_close($updateStmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>View Account</title>
    <style>
        body {
            background-color: grey; /* Background color */
            color: white; /* Text color */
        }
        .nav-link {
            font-size: 1.5rem; /* Increase font size */
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
</head>
<body>
    <!-- Navbar -->
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <a class="text-muted nav-link" href="userpage.php">Home</a>
                    <a class="text-muted nav-link" href="view_account.php">View Account</a>
                    <a class="text-muted nav-link" href="login.php">Logout</a>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand mb-0 h1">USER PAGE</span>
        </nav>
    </div>

    <div class="container mt-5">
        <h2>View Account Information</h2>
        <form method="POST" action="view_account.php">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
            </div>
            <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo htmlspecialchars($middleName); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Account</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
