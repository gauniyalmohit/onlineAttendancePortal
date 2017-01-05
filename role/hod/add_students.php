<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';

function make_name($name) {
    $new_name = ucwords(str_replace('_', ' ', $name));
    return $new_name;
}

$teacher_username = $_SESSION['teacher_username'];
date_default_timezone_set('Asia/Calcutta');
if (isset($_POST['submit'])) {
    $roll_number = $_POST['roll_number'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $branch = $_SESSION['branch'];
    $teacher_branch=$_SESSION['teacher_branch'];
    $semester = $_POST['semester'];
    $i = 0;
    foreach ($name as $n) {
        $rno = $roll_number[$i];
        $d = date('Y-m-d', strtotime($dob[$i]));
        $sem = $semester[$i];
        $query = "INSERT INTO student VALUES ($rno, '$n', '$d', '$teacher_branch','$sem')";
        mysqli_query($link, $query);
        $query = "select * from subject where semester='$sem' and branch='$branch'";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $subject_id = $row['subject_id'];
            $query = "show tables like '$subject_id'";
            if (mysqli_num_rows(mysqli_query($link, $query)) != 1) {
                $query = "CREATE TABLE `at`.`$subject_id` (`date` DATE NOT NULL PRIMARY KEY,`day` VARCHAR( 15 ) NOT NULL,`day_status` VARCHAR( 15 ) NOT NULL,`$rno` VARCHAR( 2 ) NOT NULL DEFAULT 'NA')"; //if table is created first time
                mysqli_query($link, $query);
            } else {
                $query = "ALTER TABLE `at`.`$subject_id` ADD `$rno` VARCHAR( 2 ) NOT NULL DEFAULT 'NA'";
                mysqli_query($link, $query);
            }
        }
        $i++;
    }
}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../styles/myCss.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/overcast/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/w3.css">
    <script src="../../js/jquery-1.8.3.js"></script>
    <script src="../../js/jquery-ui-1.9.2.custom.js"></script>
    <script>
    <?php require_once '../../includes/MyJsFunctionsLibrary.inc.js';?>
    </script>
    <link rel="stylesheet" href="../../styles/w3.css">
    <body style="background:#e6e6e6;color:black;">

        <nav class="w3-sidenav w3-light-grey w3-card-4 w3-animate-left" style="width:250px" id="mySidenav">
            <header class="w3-container w3-dark-grey">
                <h5>Menu <a href="javascript:void(0)" 
                            onclick="w3_close()"
                            class="w3-right w3-xlarge w3-closenav" title="close sidenav">&times;</a></h5>
                <img src="../../images/teachers/<?php echo$_SESSION['photo']; ?>" alt="" style="height:100%;width: 100%"/>
                <h4  style="width:inherit">Mr. <?php echo make_name($_SESSION['teacher_name']); ?></h4>
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
            <a class="w3-padding" href="index.php">Take Attendance</a>		
            <a class="w3-padding" href="see_attendence.php">See Attendance</a>		
            <a class="w3-padding" href="mark_holiday.php">Mark Holiday</a>
            <a class="w3-padding w3-green" href="add_students.php">Add students</a>
            <a class="w3-padding" href="administration.php">Administration</a>
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>
        <div id="main" style="margin-left:250px;transition:0.4s;">
            <div class="w3-container w3-margin-left w3-responsive">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
                <fieldset style="margin-top: 30px">
                    <legend>Add Student</legend>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">                       
                        <table class="w3-table w3-striped w3-border" id="dataTable" >
                            <tr>
                                <td><input type="checkbox" required="required" name="" checked="checked" /></td>
                                <td>
                                    <label>Roll number</label>
                                    <input type="text" required="required" name="roll_number[]">
                                </td>
                                <td>
                                    <label>Name</label>
                                    <input type="text" required="required" name="name[]">
                                </td>
                                <td>
                                    <label>Date Of Birth</label>
                                    <input class="datepicker"type="date" required="required" name="dob[]">
                                </td>
                                <td>
                                    <label>Semester</label>
                                    <select name="semester[]" required="required">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <input type="button" value="Add Student" onClick="addRow('dataTable')" /> 
                        <input type="button" value="Remove Student" onClick="deleteRow('dataTable')"  />
                        <button class="w3-btn w3-green w3-right w3-margin-right" name="submit">Add to attendance Register&raquo;</button>
                    </form>
                </fieldset>
            </div>                
        </div>
    </body>
</html> 