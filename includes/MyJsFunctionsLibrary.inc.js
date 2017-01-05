//Change subject session
function change() {
    var subject_id = document.getElementById('select').value;
    window.location.href = "change_subject.php?subject_id=" + subject_id;
}
//open side bar
function w3_open() {
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
}
//close side bar
function w3_close() {
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
}
//jQuery for datepicker
$(function () {
    $(".datepicker").datepicker({
        inline: true, dateFormat: 'dd-MM-yy', changeMonth: true, changeYear: true, yearRange: '1980:2016'
    });
});
//see attendance (HOD module)
function change_subject() {
    var c = document.getElementById("subject_name").value;
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        document.getElementById("content").innerHTML = req.responseText;
    }
    var data = "subject_name=" + c;
    req.open("get", "subject_attendance.php?" + data, true);
    req.send(null);
}
//administration (HOD module)
function update(c) {
    if (window.confirm("Data will get updated.")) {
        var req = new XMLHttpRequest();
        var data = "data=" + c;
        req.open("get", "update.php?" + data, true);
        req.send(null);
    }
}
//Add student rows
function addRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if (rowCount < 100) {
        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;
        for (var i = 0; i < colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        }
    } else {
        alert("You can add only 50 students at a time.");
    }
}
//delete student rows
function deleteRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    for (var i = 0; i < rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null != chkbox && true == chkbox.checked) {
            if (rowCount <= 1) {
                alert("Cannot Remove all rows.");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}
//front page tabs
function openLogin(evt, loginTabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("loginTab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
    }
    document.getElementById(loginTabName).style.display = "block";
    document.getElementById(loginTabName).className += " w3-border-red";
}