<?php
require_once 'includes/secure.inc.php';
require_once '../../includes/db.inc.php';
session_start();
$subject_id = $_GET['subject_id'];
$teacher_username = $_SESSION['teacher_username'];
$role = $_SESSION['role'];
$query = "select * from subject where username='$teacher_username' and subject_id='$subject_id'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$_SESSION['subject_id'] = $row['subject_id'];
$_SESSION['subject_name'] = $row['subject_name'];
$_SESSION['teacher_name'] = $row['teacher_name'];
$_SESSION['photo'] = $row['photo'];
$_SESSION['branch'] = $row['branch'];
$_SESSION['semester'] = $row['semester'];
?>
<!DOCTYPE html>
<html>
    <script>
        window.onload = history.go(-1);
    </script>
</html>
