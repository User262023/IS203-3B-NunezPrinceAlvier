<?php 
require('./database.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FName = $_POST['firstname'];
    $MName = $_POST['middlename'];
    $LName = $_POST['lastname'];
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Check if the username or email already exists
    $queryCheck = "SELECT * FROM tbl1 WHERE username = ? OR email = ?";
    $stmtCheck = mysqli_prepare($connection, $queryCheck);
    mysqli_stmt_bind_param($stmtCheck, "ss", $Username, $Email);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        echo '<script>alert("Username or Email already exists. Please choose another.")</script>';
    } else {
        // Prepare the SQL statement to insert new record
        $queryCreate = "INSERT INTO tbl1 (firstname, middlename, lastname, username, email, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtCreate = mysqli_prepare($connection, $queryCreate);
        
        // Bind parameters
        mysqli_stmt_bind_param($stmtCreate, "ssssss", $FName, $MName, $LName, $Username, $Email, $Password);

        // Execute the statement
        if (mysqli_stmt_execute($stmtCreate)) {
            echo '<script>alert("Successfully Created")</script>';
            echo '<script>window.location.href = "/bsis3b-bpm-pgn/create_account.php"</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connection) . '")</script>';
        }

        // Close the statement
        mysqli_stmt_close($stmtCreate);
    }

    // Close the check statement
    mysqli_stmt_close($stmtCheck);
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Account</title>
    <style>
        body {
            background-color: grey; /* Background color */
            color: white; /* Text color */
            height: 100vh; /* Full viewport height */
        }
        .account-container {
            background-color: #343a40; /* Dark gray background for the form */
            padding: 40px; /* Increased padding */
            border-radius: 10px;
            min-height: 500px; /* Minimum height for the container */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
        }
        .form-control {
            background-color: #495057; /* Dark input background */
            color: white; /* White text for inputs */
        }
        .form-control::placeholder {
            color: #b0b0b0; /* Light gray placeholder */
        }
        .btn-primary {
            background-color: #007bff; /* Blue button */
            border: none;
        }
        .nav-link {
            font-size: 1.5rem; /* Increase font size */
        }
    </style>
</head>
<body>
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <a class="text-muted nav-link" href="admin.php">Home</a>
                    <a class="text-muted nav-link" href="create_account.php">Create Account</a>
                    <a class="text-muted nav-link" href="view_records.php">View Records</a>
                    <a class="text-muted nav-link" href="login.php">Logout</a>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand mb-0 h1">ADMIN</span>
        </nav>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Create Account</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="account-container">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="middlename">Middle Name</label>
                            <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter your middle name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="create">Create Account</button>
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
