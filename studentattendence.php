<?php

require_once('db4.php');
$query = "select * from time";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Student Attendance</title>
    <style>
          @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

        /* Reset margin and padding */
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Ubuntu", sans-serif;
        } 

        /* Layout */
        .main {
            display: flex;
        }

        .bigdiv {
            /* flex: 1; */
            height: 100vh;
            background-color: aliceblue;
            width: 730px;
          
        }

        h2 {
            margin-top: 30px;
            margin-left: 30px;
        }

        .timetable {
            height: 550px;
            width: 88%;
            margin-left: 50px;
            margin-top: 50px;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgb(104, 103, 103);
            margin-right: 100px;
        }

        .timing {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .timing .box {
            margin-right: 2px;
            margin-left: 50px;
        }

        .timing .box p {
            margin: 0;
        }

        .days {
            margin-top: 25px;
            display: flex;
            flex-direction: column;
        }

        .days .daybox {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .days .daybox p {
            margin-right: 20px;
            font-size: 18px;
            white-space: nowrap;
            min-width: 100px;
            margin-left: 0;
        }

        P {
            margin-left: 130px;
            margin-top: 20px;
        }

        /* Subject Boxes */
        .subject {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 0px;
        }

        .subject .smallminibox,
        .subject .largeminibox {
            text-align: center;
            padding: 5px;
            padding-top: 20px;
            border-radius: 7px;
            background-color: rgb(136, 245, 245);
            height: 60px;
            width: 100px;
            margin-right: 10px;
            transition: all 0.4s ease;
            position: relative; /* Position relative for absolute text */
        }

        .subject .largeminibox {
            width: 150px;
            background-color: pink;
        }

        /* Hover Effect */
        .subject .smallminibox:hover,
        .subject .largeminibox:hover {
            background-color: rgb(185, 251, 63);
            transform: scale(1.2);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 2;
            transition: all 0.5s ease;
            height: 80px;
            width: 110px;
            padding-top: 29px;
        }

        .subject .largeminibox:hover {
            width: 150px;
        }

        h2 {
            margin-top: 5px;
        }

        .smallminibox.space {
            background-color: white;
        }

        .smallminibox.space:hover {
            background-color: rgb(210, 169, 210);
        }

        /* Text for No Class */
        .smallminibox.space .no-class-text {
            display: none; /* Hide text by default */
            position: absolute; /* Position text absolutely */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust position to center */
            font-weight: bold; /* Make the text bold */
        }

        .smallminibox.space:hover .no-class-text {
            display: block; /* Show text on hover */
        }
        #cc{
            background-color: rgb(18, 170, 230);
        }
        #wt{
            background-color: rgb(222, 235, 36);
        }
        #daa{
            background-color: rgb(182, 148, 239);
        }
        .rightdiv{
            height: 100vh;
            width: 492px;
            background-color:aliceblue;
            /* box-shadow: ; */
        }
        .righttop{
            height: 390px;
            width: 375px;
            background-color: white;
            margin-left: 0px;
            margin-top: 100px;
            border-radius: 10px;


        }
        .top-of-right-div{
            height:60px;
            background-color: #4a69bd ;
            color: white;
            display: flex;
            /* margin-top:20px ;
            margin-left: 20px; */
            gap:20px;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
        }
        #Notifications{
            margin-top: 15px;
            margin-left: 20px;   
            font-size: 25px;
        }
        i{
            font-size: 25px;
        }
body{
    height: 100%;
    margin: 0;
    background-color: white;
}
a{
    text-decoration: none;
}
.navbar {
    display: flex;
    justify-content: space-between;
    background-color: white;
    padding: 10px;
    height: 60px;
}

.navbar a {
    margin: 0 25px;
    text-decoration: none;
    margin-top: 20px;
    color: #333;
    font-size: 16px;
}

.navbar a:hover {
    color: #007bff;
}
.profile{
    position: relative;
    top: 0;
    margin-top: 0;
    width: 300px;
    background-color:white;
    height: 1000px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px ;
}
.profile_info {
    text-align: left;
    line-height: 3;
    margin-left: 40px;
    margin-top: 70px;
}
.icon{
    height: 35px;
    width: 35px;
    border-radius: 50%;
}
.page{
    display: flex;
}
/* Style for notifications list */
.righttop ul {
    list-style-type: none; /* Remove default bullet points */
    padding-left: 15px; /* Adjust padding for alignment */
    margin: 0;
    color: #333; /* Text color */
    font-size: 16px;
}

.righttop ul li {
    margin-bottom: 10px; /* Space between items */
    padding: 8px;
    background-color: #f8f9fa; /* Light background color for items */
    border-radius: 5px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Style for the notification title */
.righttop ul li strong {
    color: #007bff; /* Accent color for title text */
    font-weight: 500;
    font-size: 17px;
}

/* Hover effect for notification items */
.righttop ul li:hover {
    background-color: #e9ecef; /* Slightly darker on hover */
    cursor: pointer;
    transform: scale(1.02);
    transition: all 0.3s ease;
}

        
    </style>
</head>
<body>
    <head>
        <nav class="navbar">
            <a href="student.php"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;&nbsp;Home</a>
            <a href="studentattendence.php"><i class="fa-solid fa-calendar-day"></i>&nbsp;&nbsp;&nbsp;Time Table</a>
            <a href="student_result.php"><i class="fa-solid fa-print"></i>&nbsp;&nbsp;&nbsp;Examination</a>
            <a href="student_announcements.php"><i class="fa-solid fa-microphone"></i>&nbsp;&nbsp;&nbsp;Announcements</a>
            <a href="chat.php">
                <span class="icon">
                    <ion-icon name="help-outline"></ion-icon>
                </span>
                <span class="title">Doubts</span>
            </a>
            <a href="try.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;&nbsp;Logout</a>
        </nav>
    </head>
    <br><br>
    <div class="page">
    <div class="profile">
        <hr color="black">
        <div class="profile_info"> Name :
            <br>
            Register Number:
            <br>
            Course:
            <br>
            DOB:
            <br>
            Conatct:
            <br>
            Email:
            <br>
            Address:
        </div>
    </div>
    <div class="main">
        <div class="info"></div>
        <div class="bigdiv">
            <div class="timetable">
                <h2>My Classes</h2>
                <p>10:00 AM &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 11:00AM &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1:15PM &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2:15PM &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3:45PM</p> 
                <div class="timing"></div>
                <div class="days">
                    <div class="daybox">
                        <p class="daybox-d">Monday</p>
                        <div class="subject">
                            <div class="smallminibox space">
                                <span class="no-class-text">No Class</span>
                            </div>
                            <div class="smallminibox" title="Cloud Computing" id="cc">CC</div>
                            <div class="largeminibox" title="Machine Learning Lab">ML Lab</div>
                            <div class="smallminibox" title="Web Technologies" id="wt">WT</div>
                        </div>
                    </div>
                    <div class="daybox">
                        <p class="daybox-d">Tuesday</p>
                        <div class="subject">
                            <div class="smallminibox" title="Machine Learning">ML</div>
                            <div class="smallminibox space">
                                <span class="no-class-text">No Class</span>
                            </div>
                            <div class="largeminibox" title="Design and Analysis of Algorithms Lab" id="daa">DAA Lab</div>
                            <div class="smallminibox" title="Design and Analysis of Algorithms" id="daa">DAA</div>
                        </div>
                    </div>
                    <div class="daybox">
                        <p class="daybox-d">Wednesday</p>
                        <div class="subject">
                            <div class="smallminibox" title="Cloud Computing" id="cc">CC</div>
                            <div class="smallminibox space">
                                <span class="no-class-text">No Class</span>
                            </div>
                            <div class="largeminibox" title="Cloud Computing Lab" id="cc">CC Lab</div>
                            <div class="smallminibox" title="Machine Learning">ML</div>
                        </div>
                    </div>
                    <div class="daybox">
                        <p class="daybox-d">Thursday</p>
                        <div class="subject">
                            <div class="smallminibox space">
                                <span class="no-class-text">No Class</span>
                            </div>
                            <div class="smallminibox" title="Machine Learning">ML</div>
                            <div class="largeminibox" title="Design and Analysis of Algorithms & Web Technologies" id="daa">DAA WT</div>
                            <div class="smallminibox space">
                                <span class="no-class-text">No Class</span>
                            </div>
                        </div>
                    </div>
                    <div class="daybox">
                        <p class="daybox-d">Friday</p>
                        <div class="subject">
                            <div class="smallminibox space">
                                <span class="no-class-text">No Class</span>
                            </div>
                            <div class="smallminibox" title="Web Technologies" id="wt">WT</div>
                            <div class="largeminibox" title="Web Technologies Lab" id="wt">WT Lab</div>
                            <div class="smallminibox" title="Design and Analysis of Algorithms" id="daa">DAA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightdiv">
            <div class="righttop">
                <div class="top-of-right-div">
                    <i id="Notifications" class="fa-solid fa-bell"></i>
                    <h2 id="Notifications">Notifications</h2>
                    <br>
                </div>
                <hr>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo "<ul>";
                    echo "<li><strong>text:</strong> " . htmlspecialchars($row['text']) . "</li>";
                    echo "</ul><br><hr><br>";
                }
                ?>
                <!-- <button id="viewbutton"> VIEW ALL</button> -->
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
