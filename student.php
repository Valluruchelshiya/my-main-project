<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['roll_no'])) {
    header("Location: login.php");
    exit();
}

$roll_no = $_SESSION['roll_no'];
$query = "SELECT * FROM registerform WHERE roll_no = '$roll_no'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <title>Student Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    .sidebar {
    width: 250px;
    background-color: #1a1a2e;
    color: white;
    min-height: 100vh;
    transition: width 0.3s ease;
    overflow-x: hidden;
    position: fixed;
    left: 0;
    top: 0;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: white;
    text-decoration: none;
    white-space: nowrap;
    transition: background 0.3s, color 0.3s;
}

.sidebar a i {
    min-width: 30px;
    font-size: 18px;
}

.sidebar a span {
    transition: opacity 0.3s;
}

.sidebar.collapsed a span {
    opacity: 0;
    pointer-events: none;
}

.sidebar a:hover {
    background-color: #16213e;
    color: #e94560;
}

.toggle-btn {
    padding: 10px 15px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    margin: 10px 15px;
    width: calc(100% - 30px);
    text-align: left;
}


.sidebar.collapsed ~ .toggle-btn {
    left: 80px;
}
    .dashboard {
      max-width: 700px;
      margin: 40px auto;
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 8px 24px  #16213e;
      text-align: center;
      margin-left: 440px;
    }

    .profile-img {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #007bff;
      margin-bottom: 20px;
      background-color: #e0e7ff;
    }

    h2 {
      margin: 10px 0;
      color: #333;
    }

    .profile-details {
      margin-top: 30px;
      text-align: left;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid #eee;
      font-size: 17px;
    }

    .label {
      font-weight: bold;
      color: #555;
    }

    .value {
      color: #333;
    }

    .btn-container {
      margin-top: 30px;
    }

    button {
      padding: 10px 25px;
      font-size: 16px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
         <a href="static/attendancestu.html"><i class="fa-solid fa-id-badge"></i><span> Attendance</span></a>
        <a href="studentattendence.php"><i class="fa-solid fa-calendar-day"></i><span> Time Table</span></a>
        <a href="student_result.php"><i class="fa-solid fa-print"></i><span> Examination</span></a>
        <a href="student_announcements.php"><i class="fa-solid fa-microphone"></i><span> Announcements</span></a>
        <a href="enroll.html"><i class="fa-solid fa-comments"></i><span>Code Room</span></a>
        <a href="try.php"><i class="fa-solid fa-right-from-bracket"></i><span> Logout</span></a>
    </div>
  <div class="dashboard">
    <!-- Profile Image -->
    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Student Image" class="profile-img" id="studentImage">

    <!-- Name and Course -->
    <h2><strong>Name:</strong> <?php echo $row['username']; ?></h2>
    <h3><strong>Course:</strong> <?php echo $row['course']; ?></h3>

    <!-- Details -->
    <div class="profile-details">
      <div class="detail-row">
        <p><strong>Roll_number:</strong> <?php echo $row['roll_no']; ?></p>
      </div>
      <div class="detail-row">
        <p><strong>Class_name:</strong> <?php echo $row['class_name']; ?></p>
      </div>
    </div>
  </div>

  <script>
    function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
    }
  </script>
</body>
</html>