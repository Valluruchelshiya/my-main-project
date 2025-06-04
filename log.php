<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$roll_no = $_POST['roll_no'];
$password_2 = $_POST['password_2'];
$query = "SELECT * FROM registerform WHERE roll_no='$roll_no' AND password_2='$password_2'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['roll_no'] = $roll_no; // ✅ store roll number in session
    header("Location: student.php");
    exit();
} else {
    echo "Login failed";
}
?>
