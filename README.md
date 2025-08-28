# Hostel Management System

![hostelMS](https://github.com/user-attachments/assets/a1a87e10-73c6-40a2-9e24-e8faeec4965f)


This project is a collaborative web-based application developed to manage hostel operations efficiently within an academic institution. It provides  student registration, intelligent room allocation, real-time occupancy tracking, and administrative control .

---

## Project Overview

The Hostel Management System was built as part of our coursework in Web Programming, under the guidance of Prof.Felix Aryeh. It demonstrates practical application of procedural PHP, MySQL database design, and responsive UI development. The project also emphasizes collaborative software engineering practices using GitHub for version control and team coordination.

---

## Technologies Used

- Frontend: HTML5, CSS3 (Glassmorphism, Responsive Design)
- Backend: PHP (Procedural)
- Database: MySQL
- Visualization: Chart.js
- Version Control: Git and GitHub

---

## Features

- Secure login system for administrators
- Student registration with course, phone number, and room assignment
- Intelligent room allocation based on capacity (1, 2, or 4 occupants)
- Real-time dashboard displaying total students, rooms occupied, and rooms available
- Live pie chart visualization of room occupancy
- Student removal functionality with automatic room slot updates
- Navigation panel for assigning, removing, and logging out

---

## Database Schema

### rooms Table

| Column       | Type     | Description                    |
|--------------|----------|--------------------------------|
| id           | INT (PK) | Unique room ID                 |
| building     | VARCHAR  | Building identifier |
| room_number  | VARCHAR  | Room label     |
| capacity     | INT      | Maximum number of occupants    |
| occupied     | INT      | Current number of occupants    |

### students Table

| Column   | Type     | Description                  |
|----------|----------|------------------------------|
| id       | INT (PK) | Unique student ID            |
| name     | VARCHAR  | Full name                    |
| course   | VARCHAR  | Course of study              |
| phone    | VARCHAR  | Contact number               |
| room     | INT (FK) | Assigned room ID             |

### users Table

| Column   | Type     | Description                  |
|----------|----------|------------------------------|
| id       | INT (PK) | Admin ID                     |
| username | VARCHAR  | Admin username               |
| password | VARCHAR  | Hashed password              |

---

## Contributors

- Felix Nana Kyere Koomson  FCM.41.008.102.24 <br>
- Gankui Elliot Elikem Kwabla  FCM .41.008.087.25 <br>
- Christodia Jacquelin    FCM.41.008.071.24<br>
- Vanessa Terna-Manza Nyaku   FCM.41.008.119.24 <br>
- Josephine Naa Adoley Allotey   FCM.41.008.023.24<br>
- Acquah Kofi Awuah  FCM.41.008.008.24<br>
- Azure Malachi Sumdengya   FCM.41.008.054.24<br>
- Linda Perwodie    FCM.41.008.134.24<br>
- Aryee Joefred    FCM.41.008.037.24<br>
- Tsegah Desmond FCM.41.008.037.24<br>
- Nanleeb Solomon kok   FCM.41.008.113.24<br>

This project was developed collaboratively using GitHub for version control, issue tracking, and peer review.

---

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/Hackexdecodebreaker/HMS.git
