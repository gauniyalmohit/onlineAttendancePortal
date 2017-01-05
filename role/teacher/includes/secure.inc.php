<?php
session_start();
if (!isset($_SESSION['teacher_username'])) {
    header('Location:../../index.php?'.'error=true');
} else if ($_SESSION['role'] != 'teacher') {
    header('Location:../../index.php?'.'error=true');
}