<?php
include 'adminres.php';

if (isset($_POST['result'])) {  
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Fetch the class and other form data from POST
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $webTechnology = mysqli_real_escape_string($conn, $_POST['Web_Technology']);
    $cloudComputing = mysqli_real_escape_string($conn, $_POST['Cloud_Computing']);
    $machineLearning = mysqli_real_escape_string($conn, $_POST['Machine_Learning']);
    $daa = mysqli_real_escape_string($conn, $_POST['DAA']);
    $sgpa = mysqli_real_escape_string($conn, $_POST['sgpa']);

    // Prepare SQL statement
    $sql = "INSERT INTO report (class, name, Web_Technology, Cloud_Computing, Machine_Learning, DAA, sgpa) 
            VALUES ('$class', '$name', '$webTechnology', '$cloudComputing', '$machineLearning', '$daa', '$sgpa')";

    // Execute the query
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data inserted successfully";
    } else {
        die("Error inserting data: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Admin Result</title>
    <style>
          @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");
        * {
            font-family: "Ubuntu", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .formcolumns{
            height: 33px;
            width:600px;
            font-size: 18px;
            padding: 5px;
            border-radius: 10px;
            border: 1px solid rgb(223, 140, 44);
            
        }
        .formcolumns1{
            height: 33px;
            width:600px;
            font-size: 18px;
            padding: 5px;
            border-radius: 10px;
            
        }
        .subnames{
            margin-left: 130px;
            
        }
        #viewresult{
            height:30px;
            width:150px;
            margin-top: 50px;
            font-size: 15px;
            color: white;
            background-color: rgb(233,140,44);
            margin-left: 580px;
            border-radius: 10px;
            border: 1px solid rgb(223, 140, 44);
        }
        .formdiv{
            height:550px;
            width:800px;
            background-color: white;
            margin-left:450px;
            margin-top: 80px;
            padding-top: 30px;
            padding-left: 25px;
            border:2px solid white;
            border-radius: 10px;
            box-shadow: 2px 2px 20px 2px rgb(233,140,44);
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
                    <a href="attend.php">
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
    <div class="formdiv">
    <form action="adminres.php" method="post" class="result" id="resultform">
        <label for="" class="formcolumns1">Class : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <select name="class" id="" class="formcolumns">
            <option value="Select Semester">Select Semester</option>
            <option value="5th semester">5th semester</option>
        </select>
        <br>
        <br>
        <label for="" class="formcolumns1" >Student Name :&nbsp</label>
        <input type="text" placeholder="Student Name" class="formcolumns" name="name">
        <br>
        <br>
        <p class="subnames">Web technology</p>
        <label for="" class="formcolumns1">Subjects :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <input type="text" placeholder="Enter gpa out of 10" class="formcolumns" name="Web_Technology">
        <br>
        <br>
        <p class="subnames">Cloud Computing</p>
        <label for="Cloud Computing" class="formcolumns1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <input type="text" placeholder="Enter gpa out of 10" class="formcolumns" name="Cloud_Computing">
        <br>
        <br>
        <p class="subnames">Machine Learning</p>
        <label for="Machine Learning" class="formcolumns1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <input type="text" placeholder="Enter gpa out of 10" class="formcolumns" name="Machine_Learning">
        <br>
        <br>
        <p class="subnames">DAA</p>
        <label for="DAA" class="formcolumns1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <input type="text" placeholder="Enter gpa out of 10" class="formcolumns" name="DAA">
        <br><br>
        <label for="" class="formcolumns1" >Total SGPA:&nbsp</label>
        <input type="text" placeholder="SGPA" class="formcolumns" name="sgpa">
        <button id="viewresult" type="submit" name="result" value="submit">Declare Result</button>
        <div id="toastBox"></div>
    </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    let toastBox = document.getElementById('toastBox');
    let successMsg = '<i class="fa-solid fa-circle-check"></i> Result Declared';

    function showToast(msg, duration = 3000) {
        let toast = document.createElement('div');
        toast.classList.add('toast');
        toast.innerHTML = msg;
        toastBox.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('fade-out'); 
            setTimeout(() => toast.remove(), 500); 
        }, duration);
    }
    
    document.getElementById('viewresult').addEventListener('click', (event) => {
        showToast(successMsg, 10000); 
    });
</script>

</body>
</html>