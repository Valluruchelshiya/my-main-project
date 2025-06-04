<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "timetable");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if (isset($_POST['text'])) {
    // Retrieve and sanitize POST data
    $class = mysqli_real_escape_string($conn, $_POST['text']);
    // Insert query
    $sql = "INSERT INTO time (text) 
            VALUES ('$text')";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
        header("Location: admincalender.html");  
        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

