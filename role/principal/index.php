<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

$query = "SELECT distinct login.username, login.role,subject.teacher_name
FROM login
INNER JOIN subject
ON login.username=subject.username order by role";
$result = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html>
    <script src="../../ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <link href="../../maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
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
                <h1 style="color:pink; font-family: serif;"><strong><?php echo make_name($_SESSION['role']); ?></strong></h1>
            </header>
            <a class="w3-padding w3-green" href="index.php">See Attendence</a>		
            <a class="w3-padding" href="mark_holiday.php">Mark Holiday</a>            
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>
        <div id="main" style="margin-left:250px;transition:0.4s;">
            <div class="w3-container w3-margin-left">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
                <div class="panel-group" id="accordion" style="margin-top:35px;">
                    <?php
                    $x = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['role'] == 'principal')
                            continue;
                        ?>
                        <div class="panel panel-default">                         
                            <div  <?php
                            if ($row['role'] == 'hod')
                                echo " style=\"border-left:7px solid green\" ";
                            else
                                echo " style=\"border-left:7px solid gray\" ";
                            ?>class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x; ?>"><?php echo $row['teacher_name'] . '  <strong>(' . $row['role'] . ')</strong>'; ?></a>                                    
                                </h4>
                            </div>
                            <div id="collapse<?php echo $x; ?>" class="panel-collapse collapse w3-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <th style="width: 0px;margin: 0px;padding: 0px;"></th>
                                    <th>Subject</th>
                                    <th>Semester</th>
                                    <th>Work days</th>
                                    <th>Classes</th>
                                    <th>Holidays</th>                                    
                                    </thead>
                                    <?php
                                    $query = "select * from subject where username='{$row['username']}' order by semester";
                                    $result2 = mysqli_query($link, $query);
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $query2 = "select * from {$row2['subject_id']}";
                                        $result3 = mysqli_query($link, $query2);
                                        $total_days = @mysqli_num_rows($result3);
                                        if (empty($total_days))
                                            $total_days = 0;
                                        $query3 = "select * from {$row2['subject_id']} where day_status='holiday'";
                                        $result4 = mysqli_query($link, $query3);
                                        $holidays = @mysqli_num_rows($result4);
                                        if (empty($holidays))
                                            $holidays = 0;
                                        ?>
                                        <tbody>
                                            <tr class="panel-body">                                                
                                                <td style=" color: green;"><?php echo $row2['subject_name'] ?></td>
                                                <td><?php echo $row2['semester'] ?></td>
                                                <td style="font-size: 20px;"><?php echo $total_days ?></td>
                                                <td style="font-size: 20px;"><?php echo $total_days - $holidays ?></td>
                                                <td style="font-size: 20px;"><?php echo $holidays ?></td>                                
                                            </tr>
                                        </tbody>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>  
                        <?php
                        $x++;
                    }
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html> 