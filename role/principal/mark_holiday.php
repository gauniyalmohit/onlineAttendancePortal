<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

if (isset($_POST['mark'])) {
    $query1 = "select * from subject";
    $result1 = mysqli_query($link, $query1);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        if ($row1['username'] == 'gpdehradun')
            continue;
        $subject_id = $row1['subject_id'];
        $semester = $row1['semester'];
        $branch = $row1['branch'];
        $teacher_name = $_SESSION['teacher_name'];
        $query2 = "select * from $subject_id";
        $result2 = @mysqli_query($link, $query2);
        if (@mysqli_num_rows($result2) > 0) {           
            $query3 = "select * from student where branch='$branch' and semester='$semester'";
            $result3 = mysqli_query($link, $query3);
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result3))
                $roll_number[$counter++] = $row['roll_number'];
            if (isset($_POST['from']) && !empty($_POST['to'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];

                while (strtotime($from) <= strtotime($to)) {
                    $from = date('y-m-d', strtotime($from));
                    $day = date('D', strtotime($from));
                    $q1 = "INSERT INTO `at`.`$subject_id` (`date`, `day`,`day_status`";
                    $q2 = ") VALUES ('$from', '$day','holiday'";
                    for ($c = 0; $c < mysqli_num_rows($result3); $c++) {
                        $rn = $roll_number[$c];
                        $q1.= ", `$rn`";
                        $q2.= ", 'H'";
                    }
                    $query = $q1 . $q2 . ')';
                    mysqli_query($link, $query);
                    $query2 = "INSERT INTO `at`.`holiday` (`sno` ,`date` ,`day` ,`by` ,`for`)VALUES (NULL , "
                            . "'$from', '$day', '$teacher_name', '$subject_id');";
                    mysqli_query($link, $query2);
                    $from = date('y-m-d', strtotime('+1 days', strtotime($from)));
                }$msg="Holiday marked";
            } else if (isset($_POST['from']) && empty($_POST['to'])) {
                $from = $_POST['from'];
                $from = date('y-m-d', strtotime($from));
                $day = date('D', strtotime($from));
                $q1 = "INSERT INTO `at`.`$subject_id` (`date`, `day`,`day_status`";
                $q2 = ") VALUES ('$from', '$day','holiday'";
                for ($c = 0; $c < mysqli_num_rows($result3); $c++) {
                    $rn = $roll_number[$c];
                    $q1.= ", `$rn`";
                    $q2.= ", 'H'";
                }
                $query = $q1 . $q2 . ')';
                mysqli_query($link, $query);
                $query2 = "INSERT INTO `at`.`holiday` (`sno` ,`date` ,`day` ,`by` ,`for`)VALUES (NULL , "
                        . "'$from', '$day', '$teacher_name', '$subject_id');";
                mysqli_query($link, $query2);
                $msg="Holiday marked";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../styles/myCss.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/overcast/jquery-ui-1.9.2.custom.css" rel="stylesheet">
        <script src="../../js/jquery-1.8.3.js"></script>
        <script src="../../js/jquery-ui-1.9.2.custom.js"></script>
        <script>
                <?php require_once '../../includes/MyJsFunctionsLibrary.inc.js';?>
        </script>
        <link rel="stylesheet" href="../../styles/w3.css">
    </head>
    <body style="background:#e6e6e6;color:black;">

        <nav class="w3-sidenav w3-light-grey w3-card-4 w3-animate-left" style="width:250px" id="mySidenav">
            <header class="w3-container w3-dark-grey">
                <h5>Menu <a href="javascript:void(0)" 
                            onclick="w3_close()"
                            class="w3-right w3-xlarge w3-closenav" title="close sidenav">&times;</a></h5>
                <img src="../../images/teachers/<?php echo$_SESSION['photo']; ?>" alt="" style="height:100%;width: 100%"/>
                <h4  style="width:inherit">Mr. <?php echo$_SESSION['teacher_name']; ?></h4>

                <h1 style="color:pink; font-family: serif;"><strong><?php echo make_name($_SESSION['role']); ?></strong></h1>

            </header>	
            <a class="w3-padding" href="index.php">See Attendence</a>		
            <a class="w3-padding w3-green" href="mark_holiday.php">Mark Holiday</a>            
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>

        <div id="main" style="margin-left:250px;transition:0.4s;">

            <div class="w3-container w3-margin-left">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
                <form style="margin:5%;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="w3-card-4" style="margin-top:35px;">
                        <header class="w3-container w3-light-grey">
                            <h3>Mark Holiday</h3>
                        </header>
                        <div class="w3-container"style="margin: 10px;">
                            <p>
                                For/From : <input readonly required="" placeholder="Date"class="datepicker" name="from" value="" />
                                To : <input readonly  placeholder="Date"class="datepicker" name="to" value="" /> 
                            </p>
                        </div>
                        <button class="w3-btn-block w3-dark-grey" name="mark" onclick="return confirm('Are you sure to mark this holiday ?')"> + Mark</button>                    
                    </div>
                </form>
                <?php echo "<h3 style=\"color:green;\">$msg</h3>";?>
            </div>
        </div>
    </body>
</html> 