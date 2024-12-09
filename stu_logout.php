<?php
session_start();
session_destroy();
header("Location: stu_login.php");
?>