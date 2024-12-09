<?php 
    require_once("config.php");

    $firstDayOfMonth = date("1-m-Y");
    $totalDaysInMonth = date("t", strtotime($firstDayOfMonth));
   
    // Fetching Students 
    $fetchingStudents = mysqli_query($db, "SELECT * FROM attendance_students") OR die(mysqli_error($db));
    $totalNumberOfStudents = mysqli_num_rows($fetchingStudents);

    $studentsNamesArray = array();
    $studentsIDsArray = array();
    $studentsAttendanceArray = array(); // Array to store attendance data for each student
    $counter = 0;

    while($students = mysqli_fetch_assoc($fetchingStudents))
    {
        $studentsNamesArray[] = $students['student_name'];
        $studentsIDsArray[] = $students['id'];

        // Initialize the attendance array for each student
        $studentsAttendanceArray[$students['id']] = array_fill(1, $totalDaysInMonth, null);
    }

    // Fetching Attendance
    $fetchingAttendance = mysqli_query($db, "SELECT student_id, curr_date, attendance FROM attendance") OR die(mysqli_error($db));
    while ($attendance = mysqli_fetch_assoc($fetchingAttendance)) {
        // Store the attendance data in the corresponding student's attendance array
        $studentsAttendanceArray[$attendance['student_id']][date('j', strtotime($attendance['curr_date']))] = $attendance['attendance'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Attendance System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto; /* Enable vertical scrolling if needed */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 2px;
            text-align: center;
        }

        th {
            background-color: #e5a55b;
        }

        tr:nth-child(even) {
            background-color: #e5a55b;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>  
    <div class="container">
    <table>
        <tr>
            <th rowspan="2">Names</th>
            <?php 
                // Display days of the month
                for($j = 1; $j <= $totalDaysInMonth; $j++) {
                    echo "<th>$j</th>";
                }
            ?>
            <th rowspan="2">Attendance Percentage</th>
        </tr>
        <tr>
            <?php 
                // Display day names
                for($j = 0; $j < $totalDaysInMonth; $j++) {
                    echo "<th>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</th>";
                }
            ?>
            <th></th>
        </tr>
        <?php 
            // Display attendance data for each student
            foreach($studentsNamesArray as $index => $studentName) {
                echo "<tr>";
                echo "<td>$studentName</td>";

                $totalPresent = 0;
                foreach($studentsAttendanceArray[$studentsIDsArray[$index]] as $attendance) {
                    if($attendance == 'P') {
                        $totalPresent++;
                    }
                    echo "<td style='background-color: " . getColorForAttendance($attendance) . ";'>$attendance</td>";
                }
                // Calculate and display the attendance percentage
                $attendancePercentage = ($totalPresent / $totalDaysInMonth) * 100;
                echo "<td>" . round($attendancePercentage, 2) . "%</td>";

                echo "</tr>";
            }
        ?>
    </table>

    <?php
    // Function to determine color based on attendance status
    function getColorForAttendance($status) {
        switch ($status) {
            case 'P':
                return 'green';
            case 'A':
                return 'red';
            case 'H':
                return 'blue';
            case 'L':
                return 'brown';
            default:
                return '';
        }
    }
    ?>
    </div>
</body>
</html>
