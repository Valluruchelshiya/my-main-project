<?php
// Establish connection to MySQL database
$conn = mysqli_connect("localhost", "root", "", "notification");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Uncomment if you need to create the `notifi` table
/*
$sql = "CREATE TABLE IF NOT EXISTS notifi (
    date DATE NOT NULL,
    time TIME(6) NOT NULL,
    title VARCHAR(30) NOT NULL,
    msg VARCHAR(50) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
}
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<pre>";
    print_r($_POST);  // This will display all POST data received
    echo "</pre>";
    // Your processing code here
}

// Check if the form data exists to avoid undefined index warnings
if (isset($_POST['date'], $_POST['time'], $_POST['title'], $_POST['msg'])) {
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);

    // Prepare the insert query
    $sql = "INSERT INTO notifi (date, time, title, msg) 
            VALUES ('$date', '$time', '$title', '$msg')";

    if (mysqli_query($conn, $sql)) {
        // Redirect after successful insert
        header('Location: adminnotification.html');
        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
} else {
    echo "Form data is missing.";
}

// Close the database connection
mysqli_close($conn);
?>
