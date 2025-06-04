CREATE DATABASE attendance_db;

USE attendance_db;

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50),
    subject VARCHAR(100),
    date DATE,
    status VARCHAR(10)
);
