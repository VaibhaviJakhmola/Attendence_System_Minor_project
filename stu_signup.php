<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: stu_index.php");
   exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="sstyle.css">
</head>
<body>
    <div class="wrapper">
        <h2>Student Sign-up</h2>
        <?php
        if (isset($_POST["submit"])) {
            // Get form data
            $studentName = $_POST["student_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeat_password"];
            
            // Validate form data
            $errors = [];
            if (empty($studentName) || empty($email) || empty($password) || empty($repeatPassword)) {
                $errors[] = "All fields are required";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            if ($password !== $repeatPassword) {
                $errors[] = "Passwords do not match";
            }

            // If no errors, proceed with registration
            if (empty($errors)) {
                require_once "database.php";
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO stu_log (student_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $studentName, $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registration successful!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Failed to prepare statement</div>";
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            } else {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
        }
        ?>
        <form action="stu_signup.php" method="post">
            <div class="input-box">
                <input type="text" placeholder="Student Name" name="student_name" class="form-control">
            </div>
            <div class="input-box">
                <input type="email" placeholder="Email" name="email" class="form-control">
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" class="form-control">
            </div>
            <div class="input-box">
                <input type="password" placeholder="Repeat Password" name="repeat_password" class="form-control">
            </div>
            <div class="input-box button">
                <input type="submit" value="Register" name="submit" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p>Already have an account? <a href="stu_login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
