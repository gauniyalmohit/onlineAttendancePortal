<?php

session_start();
if (!isset($_SESSION['teacher_username'])) {
    header('Location:../../index.php?'.'error=true');
} else if ($_SESSION['role'] != 'principal') {
    header('Location:../../index.php?'.'error=true');
}