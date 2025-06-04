<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$attendance_date = $_POST['attendance_date'];
$selected_subject = $_POST['subject'];

foreach ($_POST as $key => $value) {
 // Expected format: roll_subject => present/absent
 if ($key !== 'attendance_date' && $key !== 'subject') {
    $roll_no = $key;
    $status = $value;

 $checkQuery = $conn->prepare("SELECT * FROM attendance WHERE roll_no = ? AND subject = ? AND date = ?");
 $checkQuery->bind_param("sss", $roll_no, $selected_subject, $attendance_date);
 $checkQuery->execute();
 $checkQuery->store_result();

 if ($checkQuery->num_rows == 0) {
 $stmt = $conn->prepare("INSERT INTO attendance (roll_no, subject, status,date) VALUES (?, ?, ?,?)");
 $stmt->bind_param("ssss", $roll_no, $selected_subject, $status,$attendance_date);
 $stmt->execute();
 $stmt->close();
}
$checkQuery->close();
 }
}

$conn->close();
header("Location: attendanceadmin.php?submitted=true");
exit();
?>
