<?php
session_start();
include 'includes/db.php';

$error = ""; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = $_POST['password'];

    $q = mysqli_query($conn, "SELECT password FROM users WHERE username='$u'");

    if ($q && mysqli_num_rows($q) === 1) {
        $row = mysqli_fetch_assoc($q);
        if (password_verify($p, $row['password'])) {
            $_SESSION['admin'] = $u;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
        header("Location:index.php");
        exit;
    }
}
?>

<!-- HTML form omitted for brevity -->
