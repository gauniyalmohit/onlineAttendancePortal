<?php
require_once 'includes/secure.inc.php';
session_start();
require_once '../../includes/db.inc.php';

function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}

$teacher_username = $_SESSION['teacher_username'];

function get_file_name($photo) {
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = str_shuffle($str);
    $str = substr($str, 0, 20);
    $i = strpos($photo, '.');
    $ext_name = substr($photo, $i);
    return $str . $ext_name;
}

if (isset($_POST['submit'])) {
    $teacher_name = $_POST['teacher_name'];
    $photo = $_FILES['photo']['name'];
    $photo_size = $_FILES['photo']['size'];
    $photo_type = $_FILES['photo']['type'];
    $temp_name = $_FILES['photo']['tmp_name'];
    $old_pic = $_SESSION['photo'];
    if ($old_pic != 'img_avatar3.png')
        unlink("../../images/teachers/$old_pic");
    $photo = get_file_name($photo);
    move_uploaded_file($temp_name, "../../images/teachers/$photo");
    $subject_id = $_SESSION['subject_id'];
    $query = "update subject set teacher_name='$teacher_name', photo='$photo' where subject_id='$subject_id'";
    mysqli_query($link, $query);
    $_SESSION['photo'] = $photo;
    $_SESSION['teacher_name'] = $teacher_name;
}


if (isset($_POST['change_password'])) {
    $status = 0;
    $current_password = sha1(trim($_POST['current_password']));
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    $query = "select * from login where username='$teacher_username' and password='$current_password'";
    $result = mysqli_query($link, $query);
    if (@mysqli_num_rows($result) == 1) {
        if (strlen($new_password) >= 6) {
            if ($new_password != $confirm_password) {
                $status = 3;
            } else {
                $new_password = sha1($new_password);
                $query = "update login set password='$new_password' where username='$teacher_username'";
                mysqli_query($link, $query);
                $status = 4;
            }
        } else {
            $status = 2;
        }
    } else {
        $status = 1;
    }
}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../styles/myCss.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../../styles/w3.css">
    <script>
<?php require_once '../../includes/MyJsFunctionsLibrary.inc.js'; ?>
    </script>
    <body style="background:#e6e6e6;color:black;">

        <nav class="w3-sidenav w3-light-grey w3-card-4 w3-animate-left" style="width:250px" id="mySidenav">
            <header class="w3-container w3-dark-grey">
                <h5>Menu <a href="javascript:void(0)" 
                            onclick="w3_close()"
                            class="w3-right w3-xlarge w3-closenav" title="close sidenav">&times;</a></h5>
                <img src="../../images/teachers/<?php echo $_SESSION['photo']; ?>" alt="" style="height:100%;width: 100%"/>
                <h4  style="width:inherit">Mr. <?php echo$_SESSION['teacher_name']; ?></h4>

                <h1 style="color:pink; font-family: serif;"><strong><?php echo make_name($_SESSION['role']); ?></strong></h1>

            </header>

            <a class="w3-padding" href="index.php">See Attendence</a>		
            <a class="w3-padding" href="mark_holiday.php">Mark Holiday</a>            
            <a class="w3-padding w3-green" href="profile.php">Profile</a>
            <a href="../../includes/logout.inc.php"><button style="width:92%;margin:0px;">Logout</button></a>
        </nav>

        <div id="main" style="margin-left:250px;transition:0.4s;">

            <div class="w3-container w3-margin-left">
                <span title="open sidenav" style="top:2px;display:none" id="openNav" class="w3-opennav w3-xlarge" onclick="w3_open()">&#9776;</span>
                <div style="margin-top:35px;">
                    <form style="width:50%;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <fieldset style="padding:15px;">
                            <legend>Profile data</legend>
                            <label class="w3-label"><b>Upload your pic : </b></label><br>
                            <input type="file" required="" name="photo"><br>
                            <label class="w3-label"><b>Enter your Name : </b></label>
                            <input placeholder="Name" required="" value="<?php echo$_SESSION['teacher_name']; ?>"name="teacher_name"class="w3-input w3-border w3-animate-input" type="text" style="width:70%">
                        </fieldset>
                        <button name="submit" class="button">Submit</button>
                    </form>
                    <form style="margin-top:5px; width:50%;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <fieldset style="padding:15px;">
                            <legend>Change password</legend>
                            <label class="w3-label"><b>Enter Current password : </b></label>
                            <input placeholder="Current password" required="" name="current_password" class="w3-input w3-border w3-animate-input" type="password" style="width:30%">
                            <label class="w3-label"><b>Enter New password : </b></label>
                            <input placeholder="New password" required="" name="new_password" class="w3-input w3-border w3-animate-input" type="password" style="width:30%">
                            <label class="w3-label"><b>Confirm password : </b></label>
                            <input placeholder="Confirm password" required="" name="confirm_password" class="w3-input w3-border w3-animate-input" type="password" style="width:30%">

                            <?php if ($status == 1) { ?>
                                <span style="color:red;">* Wrong password entered.</span> 
                            <?php } else if ($status == 2) { ?>
                                <span style="color:red;">* Password should be greater than 6 characters.</span>;
                            <?php } else if ($status == 3) { ?>
                                <span style="color:red;">* Password does not match.</span>
<?php } else if ($status == 4) { ?>
                                <span style="color:green;">Password successfully changed.</span>
<?php } ?>
                        </fieldset>
                        <button name="change_password" class="button">Change password</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> 