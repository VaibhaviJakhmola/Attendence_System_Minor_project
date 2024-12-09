<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>EDUMarK: ATTENDANCE MANAGEMENT SYSTEM</h1>
        <h3>STUDENTS ATTENDANCE OF MONTH: <u><?php echo strtoupper(date("F")); ?></u></h3>
    </header>

    <div class="container">
            <?php require_once("SmartAttendanceSheet.php"); ?>
            <hr>
            <div class="student">
            <?php require_once("addingStudents.php"); ?>
            <?php require_once("addAttendance.php"); ?>
            </div>
            <a href="Logout.php">Logout</a>
    </div>
</body>
</html>
