<?php
// Sample PHP code with a navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Navbar Example</title>
    <style>
        body {
            background-color: grey; /* Background color */
            color: white; /* Text color */
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
