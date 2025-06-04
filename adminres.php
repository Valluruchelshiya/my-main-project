<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "result");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if (isset($_POST['result'])) {
    // Retrieve and sanitize POST data
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $webTechnology = mysqli_real_escape_string($conn, $_POST['Web_Technology']);
    $cloudComputing = mysqli_real_escape_string($conn, $_POST['Cloud_Computing']);
    $machineLearning = mysqli_real_escape_string($conn, $_POST['Machine_Learning']);
    $daa = mysqli_real_escape_string($conn, $_POST['DAA']);
    $sgpa = mysqli_real_escape_string($conn, $_POST['sgpa']);

    // Insert query
    $sql = "INSERT INTO report (class, name, Web_Technology, Cloud_Computing, Machine_Learning, DAA, sgpa) 
            VALUES ('$class', '$name', '$webTechnology', '$cloudComputing', '$machineLearning', '$daa', '$sgpa')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
        header("Location: admin_result.php");  // Redirect after successful submission
        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
