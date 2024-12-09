<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: stu_index.php");
   exit(); // Make sure to stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="sstyle.css">
</head>
<body>
    <div class="wrapper">
    <h2>Student Login</h2>
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM stu_log WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: stu_index.php"); // Redirect to stu_index.php
                    exit(); // Make sure to stop further execution
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
      <form action="stu_login.php" method="post">
        <div class="input-box">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="input-box button">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
      <div><p>I am <a href="signup.php">Teacher</a></p></div>
    </div>
</body>
</html>
