<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['admin'])) header("Location: login.php");

$total = mysqli_query($conn, "SELECT COUNT(*) AS count FROM students");
$occupied = mysqli_query($conn, "SELECT COUNT(*) AS count FROM rooms WHERE occupied >= capacity");
$available = mysqli_query($conn, "SELECT COUNT(*) AS count FROM rooms WHERE occupied < capacity");

$t = mysqli_fetch_assoc($total)['count'];
$o = mysqli_fetch_assoc($occupied)['count'];
$a = mysqli_fetch_assoc($available)['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostel Dashboard</title>
    <link rel="stylesheet" href="assets/css/dash.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="animated-bg">
        <ul class="particles">
            <li></li><li></li><li></li><li></li><li></li>
            <li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>

    <div class="glass-container">
        <header>
            <h1> Hostel Management Dashboard</h1>
            <p>Welcome, <strong><?php echo $_SESSION['admin']; ?></strong></p>
        </header>

        <section class="stats">
            <div class="card">
                <h2>Total Students</h2>
                <p><?php echo $t; ?></p>
            </div>
            <div class="card">
                <h2>Rooms Occupied</h2>
                <p><?php echo $o; ?></p>
            </div>
            <div class="card">
                <h2>Rooms Available</h2>
                <p><?php echo $a; ?></p>
            </div>
        </section>

        <section class="chart-section">
            <h2> Room Occupancy</h2>
            <canvas id="roomChart"></canvas>
        </section>

      <nav class="actions">
        <!-- add addition svg button -->
        <a href="assign.php"> Assign Room</a>
        <!-- svg button for remove -->
        <a href="remove.php"> Remove Student</a>
        <a href="logout.php"> Logout</a>
        </nav>

    </div>

    <script>
        const ctx = document.getElementById('roomChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Occupied', 'Available'],
                datasets: [{
                    data: [<?php echo $o; ?>, <?php echo $a; ?>],
                    backgroundColor: ['#ff4b5c', '#00c9a7'],
                    borderWidth: 2
                }]
            },
            options: {
                animation: {
                    animateScale: true,
                    duration: 1500
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
