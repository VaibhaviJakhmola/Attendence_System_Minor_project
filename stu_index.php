<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #EE9A35;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        .container {
            justify-content: space-between;
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .row {
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-8 {
            flex-basis: 65%;
            margin-right: 10px;
        }

        .col-4 {
            flex-basis: 30%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #EE9A35;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ee9b35e3;
        }
        .student{
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <header>
        <h1>EDUMarK: ATTENDANCE MANAGEMENT SYSTEM</h1>
        <h3>STUDENTS ATTENDANCE OF MONTH: <u><?php echo strtoupper(date("F")); ?></u></h3>
    </header>

    <div class="container">
            <?php require_once("SmartAttendanceSheet.php"); ?>
            <hr>
            <a href="stu_logout.php">Logout</a>
    </div>
</body>
</html>
