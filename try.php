<?php
$username = $course = $roll_no = $class_name = $password_1 = $password_2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['course'])) {
        $course = $_POST['course'];
    }
    if (isset($_POST['roll_no'])) {
        $roll_no = $_POST['roll_no'];
    }
    if (isset($_POST['class_name'])) {
        $class_name = $_POST['class_name'];
    }
    if (isset($_POST['password_1'])) {
        $password_1 = $_POST['password_1'];
    }
    if (isset($_POST['password_2'])) {
        $password_2 = $_POST['password_2'];
    }

    // Additional server-side validation
    if ($password_1 !== $password_2) {
        echo "<p style='color:red;'>Passwords do not match!</p>";
    } else {
        // Process the form (store into DB or other actions)
        // Example: Save user data into the database
        // You can write the database insertion code here.
        $_SESSION['success'] = "Registration successful!";
        header("Location: register_page.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="try.css">
    <title>Login-Register landing page</title>
    <script>
        function validateForm() {
            const formFields = ['username', 'course', 'date', 'email', 'password_1', 'password_2'];
            for (let field of formFields) {
                let input = document.forms["registrationForm"][field].value;
                if (input === "") {
                    alert("Please fill in all fields.");
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="back-image">
       <img src="blue.jpeg" alt="background image" style="border-radius: 20%;">
    </div>
    <section class="left">
        <section class="side login">
            <p class="title">Not an account?</p>
            <p class="message" style="font-size: 10px;">ClassSync is the EdTech Partner of Choice to enhance student learning experience and enables access to Academic Content, Records.</p>
            <button>Register</button>
            <img src="reg_back.svg" alt="">
        </section>

        <section class="main register">
            <div class="container">
                <p class="title">Register</p>
                <form method="post" action="c.php" onsubmit="return validateForm()">
                    <?php
                        if (isset($_SESSION['success'])) {
                            echo "<p style='color:green;'>".$_SESSION['success']."</p>";
                            unset($_SESSION['success']);
                        }
                    ?>
                    <div class="form-control">
                        <input type="text" placeholder="Username" name="username" required value="<?php echo htmlspecialchars($username); ?>">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form-control">
                        <input type="text" placeholder="Course" name="course" required value="<?php echo htmlspecialchars($course); ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div class="form-control">
                        <input type="text" placeholder="Roll number" name="roll_no" required value="<?php echo htmlspecialchars($roll_no); ?>">
                        
                    </div>
                    <div class="form-control">
                        <input type="text" placeholder="Class name" name="class_name" required value="<?php echo htmlspecialchars($class_name); ?>">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="form-control">
                        <input type="password" placeholder="Password" name="password_1" required>
                        <i class="fas fa-unlock"></i>
                    </div>
                    <div class="form-control">
                        <input type="password" placeholder="Confirm password" name="password_2" required>
                        <i class="fas fa-lock"></i>
                    </div>

                    <button class="submit" name="reg_user">Register</button>
                </form>
            </div>
        </section>
    </section>

    <section class="right">
        <section class="side register">
            <p class="title">Already registered?</p>
            <p class="message" style="font-size: 10px;">ClassSync is the EdTech Partner of Choice to enhance student learning experience and enables access to Academic Content, Records.</p>
            <button>Login</button>
            <img src="log_back.svg" alt="">
        </section>

        <section class="main login">
            <div class="container">
                <p class="title">Login</p>
                <form method="post" action="log.php">
                    <div class="form-control">
                        <input type="text" placeholder="Roll number" name="roll_no" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form-control">
                        <input type="password" placeholder="Password" name="password_2" required>
                        <i class="fas fa-unlock"></i>
                    </div>

                    <button class="submit" name="login_user" value="login">Login</button>
                </form>
            </div>
        </section>
    </section>

    <script>
        var sideButtons = document.querySelectorAll('.side button');
        sideButtons.forEach(btn => btn.addEventListener('click', () => {
            document.body.classList.toggle('signup');
        }))
    </script>
</body>
</html>
