<?php
include 'includes/db.php';

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
if (mysqli_query($conn, $sql)) {
    echo "User created successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
