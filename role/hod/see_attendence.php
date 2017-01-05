<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

$branch = $_SESSION['main_branch'];
$teacher_username = $_SESSION['teacher_username'];
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        $query = "select * from subject where username='$teacher_username' order by subject_name";
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
            <a class="w3-padding w3-green" href="see_attendence.php">See Attendance</a>		
            <a class="w3-padding" href="mark_holiday.php">Mark Holiday</a>
            <a class="w3-padding" href="add_students.php">Add students</a>
            <a class="w3-padding" href="administration.php">Administration</a>
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>
        <div id="main" style="margin-left:250px;transition:0.4s;">
            <div class="w3-container w3-margin-left">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
                <select style="margin-top:35px;"class="w3-select w3-border" id="subject_name"name="option"onchange="change_subject();">
                    <option value="" disabled selected>Choose your option</option>
                    <?php
                    $query = "select * from subject where branch='$branch' order by subject_name";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></option>
                    <?php } ?>                    
                </select>
                <div id="content" class="w3-responsive" style="margin-right:25px;">

                </div>
            </div>    
        </div>
    </body>
</html> 