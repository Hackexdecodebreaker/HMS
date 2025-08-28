<?php
session_start();
include 'includes/db.php';

$_SESSION['admin'] = 'admin'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $course = $_POST['course'];
    $phone = $_POST['phone'];
    $room_id = $_POST['room_id'];

    $room = mysqli_query($conn, "SELECT capacity, occupied FROM rooms WHERE id = $room_id");
    $data = mysqli_fetch_assoc($room);

    if ($data['occupied'] < $data['capacity']) {
        mysqli_query($conn, "INSERT INTO students (name, course, phone, room_id) VALUES ('$name', '$course', '$phone', $room_id)");
        mysqli_query($conn, "UPDATE rooms SET occupied = occupied + 1 WHERE id = $room_id");
        $message = "✅ Student assigned successfully.";
    } else {
        $message = "❌ Room is full.";
    }
}

// Fetch available rooms
$rooms = mysqli_query($conn, "SELECT * FROM rooms ORDER BY building, room_number");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Room</title>
 <style>
    /* Glassmorphic Assign Room Styling */
body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #1f1c2c, #928dab);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.glass-wrapper {
    width: 90%;
    max-width: 700px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
    animation: fadeIn 1.2s ease;
}

header {
    text-align: center;
    margin-bottom: 30px;
}

header h1 {
    font-size: 2em;
    color: #00ffe7;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.alert {
    background: rgba(0, 255, 255, 0.1);
    border-left: 5px solid #00ffe7;
    padding: 10px 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    font-weight: bold;
    animation: pulse 1s ease;
}

.form-box {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

input, select {
    padding: 12px;
    border-radius: 10px;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-size: 1em;
    outline: none;
    transition: background 0.3s ease;
}

input::placeholder {
    color: #ccc;
}

select option {
    background: #2a2f4a;
    color: #fff;
}

button {
    padding: 12px;
    background: linear-gradient(135deg, #00ffe7, #0077ff);
    border: none;
    border-radius: 10px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px #00ffe7;
}

.nav-links {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
}

.nav-links a {
    color: #00ffe7;
    text-decoration: none;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s ease;
}

.nav-links a:hover {
    color: #ffffff;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

</style>


</head>
<body>
    <div class="glass-wrapper">
        <header>
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm1 4a.5.5 0 0 1 .5.5V7h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0V8H6a.5.5 0 0 1 0-1h2V4.5A.5.5 0 0 1 9 4z"/>
</svg> Assign Student to Room</h1>
            
        </header>

        <?php if (isset($message)): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" class="form-box">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="text" name="course" placeholder="Course of Study" required>
            <input type="text" name="phone" placeholder="Phone Number" required>

            <label for="room_id">Select Room:</label>
            <select name="room_id" required>
                <option value="" disabled selected>Choose a room</option>
                <?php while ($room = mysqli_fetch_assoc($rooms)): ?>
                    <?php
                        $slots_left = $room['capacity'] - $room['occupied'];
                        if ($slots_left > 0):
                    ?>
                    <option value="<?php echo $room['id']; ?>">
                        <?php echo "Building {$room['building']} - Room {$room['room_number']} ({$slots_left} slots left)"; ?>
                    </option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>

            <button type="submit">Assign Room</button>
        </form>

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
