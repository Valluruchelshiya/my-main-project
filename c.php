
<?php
// Establish connection to MySQL database
$conn = mysqli_connect("localhost", "root", "", "register");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
// // If connection is successful
// echo "Connected successfully";

// SQL query to create the 'register' database (this line is redundant since you're already connecting to 'register')
$sql = "CREATE DATABASE IF NOT EXISTS register";
if (mysqli_query($conn, $sql)) {
    // echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

// Example SQL to create the 'registerform' table (make sure this is already created in your database)
$sql = "CREATE TABLE IF NOT EXISTS registerform (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    course VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table 'registerform' created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Insert data into the 'registerform' table
$username = mysqli_real_escape_string($conn, $_POST['username']);
$course = mysqli_real_escape_string($conn, $_POST['course']);
$roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);
$class_nmae = mysqli_real_escape_string($conn, $_POST['class_name']);
$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

// Ensure the passwords match before inserting
if ($password_1 === $password_2) {
    // Hash the password for security
    $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);

    // Prepare the insert query
    $sql = "INSERT INTO registerform (username, course, roll_no, class_name, password_1,password_2) 
            VALUES ('$username', '$course', '$roll_no', '$class_name', '$password_1','$password_2')";

    if (mysqli_query($conn, $sql)) {
        // echo "Entry successful!";
        header('location:try.php');
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
} else {
    echo "Passwords do not match";
}
// Close the database connection
mysqli_close($conn);
?>
