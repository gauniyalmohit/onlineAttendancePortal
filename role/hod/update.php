<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';
$data=$_GET['data'];
$data=explode('.',$data);
$subject_id=$data[0];
$username=$data[1];
$teacher_name=$data[2];
$teacher_name=  str_replace('%20', ' ',$teacher_name);
$query="select * from subject where subject_id='$subject_id'";
$result=mysqli_query($link, $query);
$row=  mysqli_fetch_assoc($result);
$subject_name=$row['subject_name'];
$branch=$row['branch'];
$semester=$row['semester'];
$query="update subject set username='$username', subject_id='$subject_id',subject_name='$subject_name',"
        . "teacher_name='$teacher_name',photo='img_avatar3.png',branch='$branch',semester='$semester'"
        . "where subject_id='$subject_id'";
mysqli_query($link, $query);
header('Location:administration.php');