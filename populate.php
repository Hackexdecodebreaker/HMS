<?php
include 'includes/db.php';
$types = [
    ['capacity' => 4, 'price' => 5500, 'count' => 34],
    ['capacity' => 2, 'price' => 7500, 'count' => 33],
    ['capacity' => 1, 'price' => 10000, 'count' => 33],
];
$room_num = 1;
foreach (['A', 'B'] as $building) {
    foreach ($types as $type) {
        for ($i = 0; $i < $type['count'] / 2; $i++) {
            mysqli_query($conn, "INSERT INTO rooms (building, room_number, capacity, price) VALUES ('$building', 'R$room_num', {$type['capacity']}, {$type['price']})");
            $room_num++;
        }
    }
}
?>
