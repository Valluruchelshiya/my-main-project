
<?php
// Establish connection to MySQL database
$conn = mysqli_connect("localhost", "root", "", "achat");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
// // If connection is successful
// echo "Connected successfully";

// SQL query to create the 'register' database (this line is redundant since you're already connecting to 'register')
$sql = "CREATE DATABASE IF NOT EXISTS achat";
if (mysqli_query($conn, $sql)) {
    // echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

// Example SQL to create the 'registerform' table (make sure this is already created in your database)
// $sql = "CREATE TABLE IF NOT EXISTS registerform (
//     id INT(11) AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(255) NOT NULL,
//     course VARCHAR(255) NOT NULL,
//     date DATE NOT NULL,
//     email VARCHAR(255) NOT NULL,
//     password VARCHAR(255) NOT NULL
// )";

// if (mysqli_query($conn, $sql)) {
//     // echo "Table 'registerform' created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($conn);
// }

// Insert data into the 'registerform' table
$msg = mysqli_real_escape_string($conn, $_POST['msg']);

    $sql = "INSERT INTO achat (msg) 
            VALUES ('$msg')";

    if (mysqli_query($conn, $sql)) {
        // echo "Entry successful!";
        header('location:adchat.php');
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
// Close the database connection
mysqli_close($conn);
?>
