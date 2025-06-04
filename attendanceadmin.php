<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "register";
$showToast = isset($_GET['submitted']) && $_GET['submitted'] === 'true';


// Connect to MySQL
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get students
$students_query = "SELECT roll_no, username FROM registerform";
$students_result = $conn->query($students_query);

// Define subjects
$subjects = ['Math', 'Science', 'English'];
$selected_subject = isset($_POST['subject']) ? $_POST['subject'] : $subjects[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Upload Attendance</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f2f3f5;
      margin: 0;
      padding: 0;
    }
    :root {
  --orange: rgb(223, 140, 44);
  --white: #fff;
  --gray: #f5f5f5;
  --black1: #222;
  --black2: #999;
}
        .navigation {
  position: fixed;
  width: 300px;
  height: 100%;
  left:0;
  top: 0;
  background: var(--orange);
  border-left: 10px solid var(--orange);
  transition: 0.5s;
  overflow: hidden;
}
.navigation.active {
  width: 80px;
}
.navigation ul {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
}

.navigation ul li {
  position: relative;
  width: 100%;
  list-style: none;
  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
}

.navigation ul li:hover,
.navigation ul li.hovered {
  background-color: var(--white);
}

.navigation ul li:nth-child(1) {
  margin-bottom: 40px;
  pointer-events: none;
}

.navigation ul li a {
  position: relative;
  display: block;
  width: 100%;
  display: flex;
  text-decoration: none;
  color: var(--white);
}
.navigation ul li:hover a,
.navigation ul li.hovered a {
  color: var(--orange);
}

.navigation ul li a .icon {
  position: relative;
  display: block;
  min-width: 60px;
  height: 60px;
  line-height: 75px;
  text-align: center;
}
.navigation ul li a .icon ion-icon {
  font-size: 1.75rem;
}

.navigation ul li a .title {
  position: relative;
  display: block;
  padding: 0 10px;
  height: 60px;
  line-height: 60px;
  text-align: start;
  white-space: nowrap;
}

/* --------- curve outside ---------- */
.navigation ul li:hover a::before,
.navigation ul li.hovered a::before {
  content: "";
  position: absolute;
  right: 0;
  top: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px 35px 0 10px var(--white);
  pointer-events: none;
}
.navigation ul li:hover a::after,
.navigation ul li.hovered a::after {
  content: "";
  position: absolute;
  right: 0;
  bottom: -50px;
  width: 50px;
  height: 50px;
  background-color: transparent;
  border-radius: 50%;
  box-shadow: 35px -35px 0 10px var(--white);
  pointer-events: none;
}
.btn-orange {
        background-color:orange;
        color: white;
    }

    .btn-light-green {
        background-color: lightgreen;
        color: white;
    }  
    .toast {
    width: 400px;
    height: 60px;
    background-color: #fff;
    font-weight: 500;
    margin: 15px 0;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    position: relative;
    animation: slideIn 0.5s forwards; /* Slide in when appearing */
    transition: opacity 0.5s ease, transform 0.5s ease; /* Smooth fade-out */
}

.toast i {
    margin: 0 20px;
    font-size: 35px;
    color: green;
}

.toast::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 5px;
    background: green;
    animation: anim 3s linear forwards;
}

@keyframes slideIn {
    from { transform: translateX(100%); }
    to { transform: translateX(0); }
}

@keyframes anim {
    100% { width: 0; }
}

.fade-out {
    opacity: 0;
    transform: translateY(-20px); /* Slide up slightly as it fades */
}

    .attendance-container {
      max-width: 1000px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      margin-left: 400px;
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #ffb84d;
      color: white;
    }
    .submit-btn {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      background-color: #ffa500;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .submit-btn:hover {
      background-color: #ffcc66;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                     
                </a>
            </li>

            <li>
                <a href="admindas.html">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="attendanceadmin.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Attendance</span>
                </a>
            </li>

            <li>
                <a href="adminnotification.html">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Notices</span>
                </a>
            </li>

            <li>
                <a href="adchat.php">
                    <span class="icon">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title">Doubts</span>
                </a>
            </li>

            <li>
                <a href="admin_result.php">
                    <span class="icon">
                        <ion-icon name="clipboard-outline"></ion-icon>
                    </span>
                    <span class="title">Result</span>
                </a>
            </li>

            <li>
                <a href="admincalender.html">
                    <span class="icon">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </span>
                    <span class="title">TimeTable</span>
                </a>
            </li>

            <li>
                <a href="mainadmin.html">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
  <div class="attendance-container">
    <h2>Upload Attendance</h2>
    <form method="POST" action="upload_attendance.php">
    <label for="attendance_date">Select Date:</label>
    <input type="date" name="attendance_date" id="attendance_date" required style="margin-bottom: 20px;">
    <label for="subject">Select Subject:</label>
<select name="subject" id="subject" required style="margin-bottom: 20px;">
  <?php foreach ($subjects as $subject): ?>
    <option value="<?= htmlspecialchars($subject) ?>" <?= $selected_subject == $subject ? 'selected' : '' ?>>
      <?= htmlspecialchars($subject) ?>
    </option>
  <?php endforeach; ?>
</select>
      <table>
        <thead>
          <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th><?= htmlspecialchars($selected_subject) ?></th>
          </tr>
        </thead>
        <tbody>
        <?php while ($student = $students_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $student['roll_no'] ?></td>
                            <td><?= $student['username'] ?></td>
                            <?php foreach ($subjects as $subject): ?>
                              <td>
  <label><input type="radio" name="<?= $student['roll_no'] ?>" value="present" required> Present</label><br>
  <label><input type="radio" name="<?= $student['roll_no'] ?>" value="absent"> Absent</label>
</td>
            <?php endforeach; ?>
                        </tr>
                    <?php endwhile; ?>
        </tbody>
      </table>
      <button type="submit" class="submit-btn">Submit Attendance</button>
    </form>
  </div>
  <?php if ($showToast): ?>
  <div class="toast" id="successToast">
    <i class="fas fa-check-circle"></i>
    <span>Attendance submitted successfully!</span>
  </div>

  <script>
    setTimeout(() => {
      const toast = document.getElementById('successToast');
      if (toast) {
        toast.classList.add('fade-out');
        setTimeout(() => toast.remove(), 500);
      }
    }, 3000);
  </script>
<?php endif; ?>

  <script src="main.js"></script>

  ====== ionicons =======
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
