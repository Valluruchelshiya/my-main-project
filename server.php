<?php
session_start();

$username = "";
$email    = "";
// $register = "";
$course   = "";
$date      = "";
// $contact  = "";
// $address  = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'register');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  // $register = mysqli_real_escape_string($db, $_POST['register']);
  $course   = mysqli_real_escape_string($db, $_POST['course']);
  $date      = mysqli_real_escape_string($db, $_POST['date']);
  // $contact  = mysqli_real_escape_string($db, $_POST['contact']);
  // $address  = mysqli_real_escape_string($db, $_POST['address']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($course)) { array_push($errors, "Course is required"); }
  if (empty($date)) { array_push($errors, "Date of Birth is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  // if (empty($register)) { array_push($errors, "Register Number is required"); }
  // if (empty($contact)) { array_push($errors, "Contact is required"); }
  // if (empty($address)) { array_push($errors, "Address is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
    $password = $password_1;

  	$query = "INSERT INTO registerform (username,course,date,email,password) 
  			  VALUES('$username','$course','$date','$email','$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Registration Successful!";
    exit();
  }else{
    foreach($errors as $error){
      echo "<p style='color:red;'>$error</p>";
    }
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
    
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  // header('location: student.html');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
}
    else{
        array_push($errors,"User does not exist");
    }
  }


?>