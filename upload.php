<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "upload";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $contentType = $_POST["contentType"];
    $schedule = $_POST["schedule"];

    $fileName = $_FILES["fileUpload"]["name"];
    $fileTmp = $_FILES["fileUpload"]["tmp_name"];
    $uploadDir = "uploads/";

    // Create upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($fileName);

    if (move_uploaded_file($fileTmp, $filePath)) {
        $stmt = $conn->prepare("INSERT INTO uploads (title, description, content_type, file_name, file_path, schedule_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $description, $contentType, $fileName, $filePath, $schedule);

        if ($stmt->execute()) {
            echo "File uploaded and data saved successfully!";
        } else {
            echo "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to upload file.";
    }
}
?>
