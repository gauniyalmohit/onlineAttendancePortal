<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';
$roll_number = $_SESSION['student_username'];
$name = $_SESSION['name'];
$query = "select * from student where roll_number='$roll_number'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$branch = $row['branch'];
$semester = $row['semester'];
$query = "select * from subject where semester='$semester' and branch='$branch'";
$result = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../styles/w3.css" rel="stylesheet" type="text/css"/>
        <title><?php echo $row['name'] . ' - ' . $row['roll_number'] ?></title>
    </head>
    <body>
        <div class="w3-responsive" style="margin:auto; margin-top: 2%; width: 65%;">
            <table class="w3-table w3-bordered w3-border w3-hoverable" style="padding: 0px;">
                <thead>
                    <tr class="w3-light-grey">
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Working days</th>
                        <th>Present</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subject_id = $row['subject_id'];
                        $subject_name = $row['subject_name'];
                        $photo = $row['photo'];
                        $teacher_name = $row['teacher_name'];
                        $query = "select * from $subject_id";
                        $result1 = mysqli_query($link, $query);
                        $total_days = @mysqli_num_rows($result1);
                        ?>                   

                        <tr>
                            <td>
                                <h6><?php echo $subject_name ?></h6>
                            </td>
                            <td>

                                <div class="chip">
                                    <img src="../../images/teachers/<?php echo $photo; ?>" class=" w3-circle " width="96" height="96">                                
                                <h6><?php echo $teacher_name ?></h6>                            
                                </div>
                            </td>
                            <?php
                            $query1 = "select * from $subject_id where `$roll_number`='p'";
                            $result2 = mysqli_query($link, $query1);
                            $present = @mysqli_num_rows($result2);
                            if ($present < 1)
                                $present = 0;
                            $query1 = "select * from $subject_id where `$roll_number`='H'";
                            $result2 = mysqli_query($link, $query1);
                            $holidays = @mysqli_num_rows($result2);
                            $total_days = $total_days - $holidays;
                            @$percentage = ($present / $total_days) * 100;
                            ?>                        
                            <td><?php echo $total_days ?></td>
                            <td><?php echo $present ?></td>
                            <td><?php echo round($percentage, 2) ?> %</td>
                        </tr>
                    <?php } ?>
                </tbody>                                                
            </table>
            <button class="w3-btn-block w3-pink" onclick="document.location = '../../includes/logout.inc.php'">Logout</button>
        </div>                           
    </body>
</html>