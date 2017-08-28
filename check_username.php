<?php

// łączenie się z bazą danych
$con = mysqli_connect('localhost', 'root', '', '20170602');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, '20170602');


if(!empty($_POST["login"])) {
$result = mysqli_query($con, "SELECT count(*) FROM uzytkownicy WHERE login='" . $_POST["login"] . "'");
$row = mysqli_fetch_row($result);
$user_count = $row[0];
if($user_count>0)    echo '0';
else echo '1';
}