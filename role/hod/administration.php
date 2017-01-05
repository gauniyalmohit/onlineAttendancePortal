<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}
$teacher_username = $_SESSION['teacher_username'];
$teacher_branch = $_SESSION['teacher_branch'];

if (isset($_POST['add'])) {
    $error = '';
    $msg = '';
    $username = trim($_POST['username']);
    $subject_id=$_POST['subject_list'];
    $name=$_POST['name'];
    if (empty($username))
        $error = "* Username can't be empty.";
    if (empty($error)) {
        $query = "select * from login where username='$username'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) == 1)
            $error = "* Username already exists.";
    }
    if (empty($error)) {
        $query = "Insert into login values('$username','7c4a8d09ca3762af61e59520943dc26494f8941b','teacher','$teacher_branch')";
        mysqli_query($link, $query);
        $query = "update subject set username='$username', subject_id='$subject_id', teacher_name='$name' where subject_id='$subject_id'";
        mysqli_query($link, $query);
        $msg = "<h6 style=\"color:green\">Teacher successfully added</h6>"
                . "<h5 style=\"color:green\">Username : $username</h5>"
                . "<h5 style=\"color:green\">Default Password : 123456</h5>"
                . "<h6 style=\"color:green\">Now you may assign subjects to him</h6>";
    }
}
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
            <a class="w3-padding" href="add_students.php">Add students</a>
            <a class="w3-padding w3-green" href="administration.php">Administration</a>
            <a class="w3-padding" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>
        <div id="main" style="margin-left:250px;transition:0.4s;">
            <div class="w3-container w3-margin-left w3-responsive">
                <span title="open sidenav" style="position:fixed;top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
                <div>
                    <table id="admin_table"class="w3-table w3-striped w3-bordered w3-border w3-hoverable " style="margin-top:35px;">
                        <thead>
                            <tr class="w3-light-grey">                                                                
                                <th>Subject</th>
                                <th>Semester</th>
                                <th>Teacher</th>                                 
                            </tr>
                        </thead>                    
                        <?php
                        $teacher_branch = $_SESSION['teacher_branch'];
                        $query = "select * from subject where branch='$teacher_branch' order by semester";
                        $result = mysqli_query($link, $query);
                        while ($row = mysqli_fetch_assoc($result)) {                            
                            ?>
                            <tr>
                                <td><?php echo $row['subject_name']; ?></td>
                                <td><?php echo $row['semester']; ?></td>
                                <td>
                                    <?php
                                    $query = "SELECT distinct login.username,login.role,
                                        subject.teacher_name FROM login INNER JOIN subject ON 
                                        login.username=subject.username";
                                    $result2 = mysqli_query($link, $query);
                                    ?>
                                    <select id="<?php echo $row['subject_id'] ?>" class="d" onchange="update(this.value)">                                        
                                        <?php
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            if ($row2['role'] == "principal")
                                                continue;
                                            ?>                                            
                                            <option value="<?php echo $row['subject_id'] . '.' . $row2['username'] . '.' . $row2['teacher_name'] ?>"<?php if (strcmp($row['teacher_name'], $row2['teacher_name']) == 0) echo 'selected' ?> ><?php echo $row2['teacher_name'] ?></option>                                            
                                        <?php }
                                        ?>
                                    </select>
                                </td>                                                              
                            </tr>
                        <?php } ?>                   
                    </table>
                </div>
                <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"class="w3-container w3-light-grey w3-border" style="margin-top:15px;">
                    <h2>Add Teacher</h2>
                    <p class="w3-container">
                    <input style="width: 50%; margin-bottom: 5px;" placeholder="Username" required="" class="w3-input w3-border" name="username" type="text">
                    <input style="width: 50%; margin-bottom: 5px;" placeholder="Teacher name" required="" class="w3-input w3-border" name="name" type="text">
                    <select name="subject_list" class="w3-dropnav w3-border" required="">  
                            <option selected="" disabled="">Allot a subject</option>
                        <?php
                        $query = "select * from subject where branch='$teacher_branch' order by subject_name";
                        $result = mysqli_query($link, $query);
                        ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                            
                        <input style="margin-left: 0px;"class="w3-btn w3-btn-bar w3-green w3-border"type="submit" value="Add" name="add"/>
                         </p>   <?php if (!empty($error)) echo '<span style=\"color:red\">' . $error . '</span>' ?>
                    
                    <?php if (!empty($msg)) echo $msg ?>
                </form>
            </div>            
        </div>
    </body>
</html> 