<?php
session_start();
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "admin";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $username = $_POST['username'];
 $password = $_POST['password'];
 $query = "select * from login where username='$username' and password='$password'";
 $result = mysqli_query($conn,$query);
 $count= mysqli_num_rows($result);
 if($count>0){
    header("Location: admindas.html");

 }
 else{
    header("Location: mainadmin.html");
 }
?>