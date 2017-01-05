<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';
date_default_timezone_set('Asia/Calcutta');

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

$template = 1;
$branch = $_SESSION['branch'];
$semester = $_SESSION['semester'];
$subject_name = $_SESSION['subject_name'];
$subject_id = $_SESSION['subject_id'];
$teacher_username = $_SESSION['teacher_username'];
$query = "select * from student where branch='$branch' and semester='$semester' order by name";
$result = mysqli_query($link, $query);
$prev_date = date('y-m-d', time());
$query1 = "select * from $subject_id where date='$prev_date'";
$result1 = @mysqli_query($link, $query1);
if (empty($result1))
    $err_msg = "No student data to submit";

if (isset($_POST['submit'])) {
    $template = 2;
    $date = date('y-m-d', time());
    $day = date('D', time());
    $subject_id = $_SESSION['subject_id'];
    $roll_number = $_POST['roll_number'];
    if (!empty($roll_number)) {
        $name = $_POST['name'];
        for ($c = 0; $c < count($name); $c++)
            $attendance[] = $_POST[$c];
        $query = "select * from $subject_id where date='$date'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row['day_status'] != 'holiday') {

            if (date('h:i:s a', time()) < '11:00:00 pm') {
                if (@mysqli_num_rows($result) == 0) {
                    $query = "select * from student where semester='$semester' and branch='$branch'";
                    $result = mysqli_query($link, $query);
                    foreach ($name as $n) {
                        $q1 = "INSERT INTO `at`.`$subject_id` (`date`, `day`,`day_status`";
                        $q2 = ") VALUES ('$date', '$day','workday'";
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $rn = $roll_number[$c];
                            $at = $attendance[$c];
                            $q1.= ", `$rn`";
                            $q2.= ", '$at'";
                        }
                        $query = $q1 . $q2 . ')';
                    }
                    mysqli_query($link, $query);
                    $msg = "Attendance successfully added.";
                } else {
                    $query = "select * from student where semester='$semester' and branch='$branch'";
                    $result = mysqli_query($link, $query);
                    foreach ($name as $n) {
                        $q1 = "UPDATE `at`.`$subject_id` SET `day`='$day'";
                        $q2 = " WHERE `$subject_id`.`date` ='$date'";
                        for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                            $rn = $roll_number[$c];
                            $at = $attendance[$c];
                            $q1.= " ,`$rn`='$at'";
                        }
                        $query = $q1 . $q2;
                    }
                    mysqli_query($link, $query);
                    $msg = "Attendance Updated successfully.";
                }
            } else {
                $msg = "Sorry, Time's out.";
            }
        } else {
            $msg = "Sorry, Today's a Holiday.";
        }
    } else {
        $msg = "No attendance to submit";
    }
}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Take attendance</title>
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
                <h6>Branch : <?php echo make_name($branch); ?></h6>    
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
            <a class="w3-padding w3-green" href="index.php">Take Attendance</a>		
            <a class="w3-padding" href="see_attendence.php">See Attendance</a>		
            <a class="w3-padding" href="mark_holiday.php">Mark Holiday</a>
            <a class="w3-padding" href="add_students.php">Add students</a>
            <a class="w3-padding" href="administration.php">Administration</a>
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>

        <div id="main" style="margin-left:250px;transition:0.4s;">
            <div class="w3-container w3-margin-left">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>                                                           
                <?php if ($template == 1) { ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable"style="margin-top:35px; width:70%;">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <?php
                            $query = "select * from student where branch='$branch' and semester='$semester' order by name";
                            $result = mysqli_query($link, $query);
                            if (@mysqli_num_rows($result1) == 1) {
                                $c = 0;
                                $counter = 1;
                                $row1 = mysqli_fetch_assoc($result1);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php
                                            echo ucfirst($row['name']);
                                            $rno = $row['roll_number']
                                            ?></td>
                                        <td>
                                            <input type="radio" name="<?php echo $c; ?>"value="p"<?php if ($row1[$rno] == 'p') echo 'checked'; ?> />&nbsp;Present<br>
                                            <input type="radio" name="<?php echo $c; ?>" value="a"<?php if ($row1[$rno] == 'a') echo 'checked'; ?> />&nbsp;Absent                                        
                                        </td>
                                    <input type="hidden" name="roll_number[]" value="<?php echo $row['roll_number']; ?>"/>
                                    <input type="hidden" name="name[]" value="<?php echo $row['name']; ?>"/>
                                    </tr>
                                    <?php
                                    $c++;
                                }
                            } else {
                                $c = 0;
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo ucfirst($row['name']); ?></td>
                                        <td>
                                            <input type="radio" name="<?php echo $c; ?>"value="p" />&nbsp;Present<br>
                                            <input type="radio" name="<?php echo $c; ?>" value="a" />&nbsp;Absent                                        
                                        </td>
                                    <input type="hidden" name="roll_number[]" value="<?php echo $row['roll_number']; ?>"/>
                                    <input type="hidden" name="name[]" value="<?php echo $row['name']; ?>"/>
                                    </tr>                            
                                    <?php
                                    $c++;
                                }
                            }
                            ?>                    
                        </table>
                        <button name="submit" onclick="return confirm('Are you sure to submit this attendance ?')">Submit</button>
                    </form>         
                    <?php echo "<h3>$err_msg</h3>";
                } else if ($template == 2) { ?> 
                    <h2 style="margin-top:30px;"class="success"><?php echo $msg; ?></h2>
<?php } ?>
            </div>
        </div>
    </body>
</html> 