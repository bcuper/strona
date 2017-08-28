<?php

$link = mysqli_connect('localhost', 'root', '', '20170602');
if (mysqli_connect_errno()) {
    echo 'Nie udaĹ‚o siÄ™ poĹ‚Ä…czyÄ‡ z bazÄ… danych. SprĂłbuj za kilka minut';
    echo '<br>SzczegĂłĹ‚y bĹ‚Ä™du:' . mysqli_connect_error();
    exit();
}
$login = 'bartic';
$email = 'bartek.cuper@gmail.c';
$llogin = mysqli_query($link, "select *  from uzytkownicy where login='" . $login . "'");
$lmail = mysqli_query($link, "select *  from uzytkownicy where mail='" . $email . "'");
$res1 = mysqli_fetch_row($llogin);
$res2 = mysqli_fetch_row($lmail);


if ($res1 != 0) {
    echo 'Login istnieje w bazie';
} else {
    echo 'login nie istnieje';
}
if ($res2 != 0) {
    echo 'mail istnieje w bazie';
} else {
    echo 'mail nie istnieje';
}
