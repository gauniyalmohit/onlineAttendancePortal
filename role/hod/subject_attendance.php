<?php
require_once 'includes/secure.inc.php';
require_once '../../includes/db.inc.php';
$subject_id = $_GET['subject_name'];

function calculate_percentage($roll_number, $link, $subject_id) {
    $query = "select * from $subject_id";
    $result = mysqli_query($link, $query);
    $total_days = @mysqli_num_rows($result);
    $present = 0;
    $query1 = "select * from $subject_id where `$roll_number`='H'";
    $result2 = mysqli_query($link, $query1);
    $holidays = @mysqli_num_rows($result2);
    $total_days = $total_days - $holidays;

    while ($row = @mysqli_fetch_assoc($result)) {
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

$query2 = "select * from student where branch='$branch' and semester='$semester' order by name";
$result2 = mysqli_query($link, $query2);

$query3 = "select * from $subject_id order by date desc";
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
            $query4 = "select * from $subject_id where `$rno`='a'";
            $result4 = mysqli_query($link, $query4);
            $absent = mysqli_num_rows($result4);
            ?>
            <tr> 
                <td style="border-right: 2px solid gray; background-color: #00ffff"><?php echo $counter++ . ' ). ' . ucfirst($row2['name']) ?></td>
                <td><?php echo $total_days - $holidays - $absent ?></td>
                <td><?php echo $absent ?></td>
                <td><?php echo calculate_percentage($rno, $link,$subject_id) ?></td>
            </tr>
        <?php }?>
    </tbody>
</table>
<?php  echo "<h3>$msg</h3>"; ?>
