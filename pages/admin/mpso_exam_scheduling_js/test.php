<?php
// Database connection and query to fetch existing data
include('../../../koneksi.php');
$id = $_GET['nip'];

$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row[''];
    $email = $row['email'];

    // Form submission and update
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['name'];
        $newEmail = $_POST['email'];

        $updateQuery = "UPDATE users SET name = '$newName', email = '$newEmail' WHERE id = $id";
        mysqli_query($connection, $updateQuery);

        // Redirect to a success page or display a success message
        // ...
    }
} else {
    echo "No record found.";
}

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Form Example</title>
</head>
<body>
   

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        <br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
