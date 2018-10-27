<?php
$error_staff = '';
if (isset($_GET['error'])) {
    $error_staff = "You need to login first";
}

$error_student = '';
if (isset($_GET['error_student'])) {
    $error_student = "You need to login first";
}
//teacher login code
if (isset($_POST['teacher_login'])) {
    $teacher_username = $_POST['teacher_username'];
    $teacher_password = sha1($_POST['teacher_password']);
    $query = "select * from login where username='$teacher_username' and password='$teacher_password'";
    require_once 'includes/db.inc.php';
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['teacher_username'] = $teacher_username;
        $_SESSION['role'] = $row['role'];
        $_SESSION['teacher_branch']=$row['teacher_branch'];
        $query = "select * from subject where username='$teacher_username'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['subject_id'] = $row['subject_id'];
        $_SESSION['subject_name'] = $row['subject_name'];
        $_SESSION['teacher_name'] = $row['teacher_name'];
        $_SESSION['photo'] = $row['photo'];
        $_SESSION['branch'] = $row['branch'];
        $_SESSION['semester'] = $row['semester'];

        if ($_SESSION['role'] == 'teacher')
            header('Location:role/teacher/index.php');
        if ($_SESSION['role'] == 'hod'){
                        $_SESSION['main_branch']=$_SESSION['branch']; //HOD main branch
                        header('Location:role/hod/index.php');
        }
        if ($_SESSION['role'] == 'principal')
            header('Location:role/principal/index.php');
    } else {
        $error_staff = "Wrong username or password entered";
    }
}

if (isset($_POST['student_login'])) {
    $student_username = $_POST['student_username'];
    $student_password = $_POST['student_password'];
    $student_password = date('y-m-d', strtotime($student_password));
    require_once 'includes/db.inc.php';
    $query = "select * from student where roll_number='$student_username' and dob='$student_password'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['student_username'] = $student_username;
        $_SESSION['name'] = $row['name'];
        header('Location:role/student/index.php');
    } else {
        $error_student = "Wrong ROLL NUMBER or DOB entered";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Online Attendance portal</title>
        <link rel="stylesheet" href="styles/myCss.css" type="text/css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
        <link href="styles/w3.css" rel="stylesheet" type="text/css"/>
        <link href="css/overcast/jquery-ui-1.9.2.custom.css" rel="stylesheet">
        <script src="js/jquery-1.8.3.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.js"></script>
        <script>
            <?php require_once './includes/MyJsFunctionsLibrary.inc.js';?>
        </script>
    </head>
    <body onload="openLogin(event, 'staff');">
        <header class="w3-container w3-blue">
            <h2 style="margin:25px;text-align: center; font-family: monospace;">ONLINE ATTENDANCE PORTAL</h2>
        </header>
        <section style="margin: 4%; text-align: center; padding: auto" class=" w3-centered w3-center">
            <div>
                <div class="w3-col l2 m2 w3-hide-small">&nbsp</div>
                <div class="w3-row w3-center">
                    <a href="#staff" onclick="openLogin(event, 'staff');">
                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">STAFF LOGIN</div>
                    </a>
                    <a href="#student" onclick="openLogin(event, 'student');">
                        <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red">STUDENT LOGIN</div>
                    </a>
                </div>
                <div>
                <div id="staff" class="w3-container loginTab">
                    <div class="signup-form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" role="form" id="register-form" autocomplete="off">
                            <div class="form-header">
                                <h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span> Log In</h3>
                                <div class="pull-right">
                                    <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
                                </div>
                            </div>
                            <div class="form-body">
                                <div id="errorDiv"></div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                        <input name="teacher_username" required="" type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <span class="help-block" id="error"></span>
                                </div>     
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                        <input name="teacher_password" id="password" required="" type="password" class="form-control" placeholder="Password">
                                    </div>  
                                    <span class="help-block" id="error"></span>                    
                                </div>      
                                <?php
                                if (!empty($error_staff)) {
                                    ?>
                                    <div class="form-group">
                                        <div class="alert alert-danger">
                                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $error_staff; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>				   
                            </div>            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-block btn-primary" name="teacher_login">Sign In</button>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="student" class="w3-container loginTab">
                    <div class="signup-form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" role="form" id="register-form" autocomplete="off">
                            <div class="form-header">
                                <h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span>See Attendance</h3>
                                <div class="pull-right">
                                    <h3 class="form-title"><span class="glyphicon glyphicon-paperclip"></span></h3>
                                </div>
                            </div>
                            <div class="form-body">
                                <div id="errorDiv"></div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                        <input name="student_username" required="" type="text" class="form-control" placeholder="Roll number">
                                    </div>
                                    <span class="help-block" id="error"></span>
                                </div>     
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input name="student_password" type="password" class=" datepicker form-control" placeholder="D.O.B">
                                    </div>  
                                    <span class="help-block" id="error"></span>                    
                                </div>      
                                <?php
                                if (!empty($error_student)) {
                                    ?>
                                    <div class="form-group">
                                        <div class="alert alert-danger">
                                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $error_student; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>				   
                            </div>            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-block btn-primary" name="student_login">Show</button>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <footer style="text-align: center">
            <div class="alert alert-info" style="height: 7%;">
                <h5 style="margin: auto">Designed and Developed by : CSE Vth SEM 2016-17</h5>
            </div>
        </footer>
    </body>
</html>
