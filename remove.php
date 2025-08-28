<?php
session_start();
include 'includes/db.php';
if (!isset($_SESSION['admin'])) header("Location: login.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $delete = mysqli_query($conn, "DELETE FROM students WHERE id = '$student_id'");
    $message = $delete ? "✅ Student removed successfully." : "❌ Failed to remove student.";
}

// Group students by room
$students_by_room = [];
$result = mysqli_query($conn, "SELECT id, name, room_id FROM students ORDER BY room_id, name");
while ($row = mysqli_fetch_assoc($result)) {
    $room = $row['room_id'];
    if (!isset($students_by_room[$room])) {
        $students_by_room[$room] = [];
    }
    $students_by_room[$room][] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Student by Room</title>
    <link rel="stylesheet" href="assets/css/remove.css">
</head>
<body>
    <div class="glass-wrapper">
        <header>
            <h1> Remove Students</h1>
            
        </header>

        <?php if (isset($message)): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <section class="room-grid">
            <?php foreach ($students_by_room as $room => $students): ?>
                <div class="room-card">
                    <h2>Room <?php echo $room; ?></h2>
                    <ul>
                        <?php foreach ($students as $student): ?>
                            <li>
                                <form method="POST" class="student-form">
                                    <span><?php echo $student['name']; ?></span>
                                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                    <button type="submit">Remove</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </section>

        <nav class="nav-links">
            <a href="dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 3.293l-6 6V14h12V9.293l-6-6zM7 12h2v2H7v-2z"/>
</svg> Back to Dashboard</a>
            <a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3 2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H3zm0 1h10v10H3V3z"/>
</svg> Logout</a>
        </nav>
    </div>
</body>
</html>
