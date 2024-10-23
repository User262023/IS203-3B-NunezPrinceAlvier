<?php 
require('./database.php'); // Include your database connection

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    
    // Fetch the user record based on the ID
    $query = "SELECT * FROM tbl1 WHERE ID = '$id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update query
    $updateQuery = "UPDATE tbl1 SET FirstName=?, MiddleName=?, LastName=?, Username=?, Email=? WHERE ID=?";
    if ($stmt = mysqli_prepare($connection, $updateQuery)) {
        mysqli_stmt_bind_param($stmt, "sssssi", $firstName, $middleName, $lastName, $username, $email, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo '<script>alert("Record updated successfully!"); window.location.href="view_records.php";</script>';
    } else {
        echo '<script>alert("Error updating record.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Record</title>
</head>
    <style>
        body {
            background-color: grey; /* Background color */
            color: white; /* Text color */
        }
    </style>
<body>
    <div class="container mt-5">
        <h2>Edit Record</h2>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($row['FirstName']); ?>" required>
            </div>
            <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo htmlspecialchars($row['MiddleName']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($row['LastName']); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Record</button>
            <a href="view_records.php" class="btn btn-secondary">Previous</a> <!-- Previous Button -->
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
