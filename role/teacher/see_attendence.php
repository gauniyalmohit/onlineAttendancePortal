<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';
$subject_id = $_SESSION['subject_id'];
$teacher_username = $_SESSION['teacher_username'];

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

function calculate_percentage($roll_number, $link) {
    $subject_id = $_SESSION['subject_id'];
    $query = "select * from $subject_id";
    $result = mysqli_query($link, $query);
    $total_days = mysqli_num_rows($result);
    $present = 0;
    $query1 = "select * from $subject_id where `$roll_number`='H'";
    $result2 = mysqli_query($link, $query1);
    $holidays = @mysqli_num_rows($result2);
    $total_days = $total_days - $holidays;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row[$roll_number] == 'p') {
            $present++;
        }
    }
    $percentage = @round((($present / $total_days) * 100), 2);
    return $percentage;
}

$query1 = "select * from subject where subject_id='$subject_id'";
$result1 = mysqli_query($link, $query1);
$row1 = mysqli_fetch_assoc($result1);
$branch = $row1['branch'];
$semester = $row1['semester'];
$query2 = "select * from student where branch='$branch' and semester='$semester'";
$result2 = mysqli_query($link, $query2);
$query3 = "select * from $subject_id";
$result3 = mysqli_query($link, $query3);
if (@mysqli_num_rows($result3) == 0) {
    $msg = "No attendance to show";
} else {
    $total_days = mysqli_num_rows($result3);
    $query5 = "select * from $subject_id where `day_status`='holiday'";
    $result5 = mysqli_query($link, $query5);
    $holidays = mysqli_num_rows($result5);
}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>See attendance</title>
            <link href="../../styles/myCss.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../styles/w3.css">
    <script>
    <?php require_once '../../includes/MyJsFunctionsLibrary.inc.js';?>
    </script>
    <body style="background:#e6e6e6;color:black;">
        <nav class="w3-sidenav w3-light-grey w3-card-4 w3-animate-left" style="width:250px" id="mySidenav">
            <header class="w3-container w3-dark-grey">
                <h5>Menu <a href="javascript:void(0)" 
                            onclick="w3_close()"
                            class="w3-right w3-xlarge w3-closenav" title="close sidenav">&times;</a></h5>
                <img src="../../images/teachers/<?php echo$_SESSION['photo']; ?>" alt="" style="height:100%;width: 100%"/>
                <h4  style="width:inherit">Mr. <?php echo$_SESSION['teacher_name']; ?></h4>
                <h6>Branch : <?php echo make_name($_SESSION['branch']); ?></h6>     
                <h6>Subject : 

                    <select id="select" name="subject_change" onchange="change()">
                        <?php
                        $query = "select * from subject where username='$teacher_username'";
                        $result = mysqli_query($link, $query);
                        ?>
                        <option selected value="<?php echo $_SESSION['subject_id']; ?>"><?php echo $_SESSION['subject_name']; ?></option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['subject_id'] == $_SESSION['subject_id'])
                                continue;
                            ?>                         
                            <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>

                </h6>                
                <h6>Semester : <?php echo $_SESSION['semester']; ?></h6>
            </header>
            <a class="w3-padding" href="index.php">Take Attendence</a>		
            <a class="w3-padding w3-green" href="see_attendence.php">See Attendence</a>		
            <a class="w3-padding" href="mark_holiday.php">Mark Holiday</a>
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>
        <div id="main" style="margin-left:250px;transition:0.4s;">
            <div class="w3-container w3-margin-left w3-responsive" style="margin-right:25px;">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>

                <div style="margin-top:35px;"class="w3-container w3-pale-blue w3-leftbar w3-border-blue">
                    <p>Total days : <?php echo $total_days ?></p>
                    <p>Total Classes : <?php echo $total_days - $holidays ?></p>
                    <p>Total Holidays : <?php echo $holidays ?></p>
                </div> 
                <table class="w3-table w3-border" style="margin-top:5px; text-align: left;padding:0px;">
                    <thead style="padding:0px;margin:0px">
                        <tr class="w3-light-green">
                            <th>Name</th>            
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Attendance %</th>
                        </tr>
                    </thead>
                    <tbody style="padding:0px;margin:0px">
                        <?php
                        $counter = 1;
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $rno = $row2['roll_number'];
                            $query4 = "select * from $subject_id where `$rno`='a' || `$rno`=' '";
                            $result4 = mysqli_query($link, $query4);
                            $absent = mysqli_num_rows($result4);
                            ?>
                            <tr> 
                                <td style="border-right: 2px solid gray; background-color: #00ffff"><?php echo $counter++ . ' ). ' . ucfirst($row2['name']) ?></td>
                                <td><?php echo ($total_days - $holidays) - $absent ?></td>
                                <td><?php echo $absent ?></td>
                                <td><?php echo calculate_percentage($rno, $link) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php  echo "<h3>$msg</h3>"; ?>
            </div>
        </div>
    </body>
</html>