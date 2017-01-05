<?php
$link=  mysqli_connect('localhost', 'root', '', 'at') or die("Can't connect to the server");
mysqli_select_db($link, 'at') or die("Can't connect to the Database");