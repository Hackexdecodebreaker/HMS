CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    building VARCHAR(10),
    room_number VARCHAR(10),
    capacity INT,
    price INT,
    occupied INT DEFAULT 0
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    course VARCHAR(100),
    phone VARCHAR(20),
    room_id INT,
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
