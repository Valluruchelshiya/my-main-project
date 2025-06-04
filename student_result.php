<?php

require_once('db2.php');
$query = "select * from report";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
           @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

/* Reset margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Ubuntu", sans-serif;
} 
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .container {
            /* max-width: 800px; */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Adds shadow to outer box */
            border-radius: 12px; /* Rounds outer box corners */
            padding: 0;
            margin-left:320px;
        }

        .card {
            border: none;
            border-radius: 12px;

        }

        .card-header {
            background-color: #4a69bd;
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.75rem;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .card-body {
            padding: 2rem;
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
        table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            width: 100%;
        }

        .table-bordered th, .table-bordered td {
            vertical-align: middle;
        }

        .table-bordered th {
            background-color: #34495e;
            color: #ffffff;
        }

        .table-bordered td {
            font-size: 1rem;
            color: #333333;
        }

        .text-muted {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .display-6 {
            font-size: 2rem;
        }
        a{
    text-decoration: none;
}
.icon{
    height: 35px;
    width: 35px;
    border-radius: 50%;
}
.page{
    display: flex;
}
form {
    margin-left: 350px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form .username {
    padding: 8px 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    transition: border-color 0.3s ease;
    width: 250px;
}

form .username:focus {
    border-color: #007bff;
}

form button {
    padding: 8px 16px;
    font-size: 16px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<head>
<div class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <a href="#"><i class="fa-solid fa-id-badge"></i><span> Attendance</span></a>
            <a href="studentattendence.php"><i class="fa-solid fa-calendar-day"></i><span> Time Table</span></a>
            <a href="student_result.php"><i class="fa-solid fa-print"></i><span> Examination</span></a>
            <a href="student_announcements.php"><i class="fa-solid fa-microphone"></i><span> Announcements</span></a>
            <a href="enroll.html"><i class="fa-solid fa-comments"></i><span>Code Room</span></a>
            <a href="try.php"><i class="fa-solid fa-right-from-bracket"></i><span> Logout</span></a>
        </div>
    </head>
    <br><br>
    <form action="" method="GET">
    <input type="text" class="username" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Enter Username">
        <br>
        <button type="submit">Search</button>
</form>
<br>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width:1200px">
                    <div class="card-header">
                        <h2 class="display-6">Grade Card</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th style="width:30%">Semester</th>
                                    <th>Name</th>
                                    <th>Web Technology</th>
                                    <th>Cloud Computing</th>
                                    <th>Machine Learning</th>
                                    <th style="width:15%">DAA</th>
                                    <th>SGPA</th>
                                </tr>
                                <!-- <tr>
                                    <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <td><?php echo $row['class'];?></td>
                                        <td><?php echo $row['Web_Technology'];?></td>
                                        <td><?php echo $row['Cloud_Computing'];?></td>
                                        <td><?php echo $row['Machine_Learning'];?></td>
                                        <td><?php echo $row['DAA'];?></td>
                                        <td><?php echo $row['sgpa'];?></td>
                                </tr>   
                                        <?php
                                    }
                                    ?> -->
                            </thead>
                            <tbody>
                               <?php
                              if (isset($_GET['search'])) {
                                $filtervalues = mysqli_real_escape_string($conn, $_GET['search']);
                                $query = "SELECT * FROM report WHERE CONCAT(name) LIKE '%$filtervalues%'";
                                $query_run = mysqli_query($conn, $query);
                                if(mysqli_num_rows($query_run)>0)
                                  {
                                     foreach($query_run as $items)
                                     {
                                        ?>
                                         <tr>
                                        <td><?php echo $items['class']; ?></td>
                                        <td><?php echo $items['name']; ?></td>
                                        <td><?php  echo $items['Web_Technology']; ?></td>
                                        <td><?php  echo $items['Cloud_Computing']; ?></td>
                                        <td><?php echo $items['Machine_Learning']; ?></td>
                                        <td><?php echo $items['DAA']; ?></td>
                                        <td><?php echo $items['sgpa']; ?></td>
                                    </tr>
                                        <?php
                                     }
                                  }
                                  else{
                                    ?>
                                    <tr>
                                        <td colspan="6">No Record Found</td>
                                    </tr>
                                    <?php
                                  }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
         function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
         }
    </script>
</body>
</html>
