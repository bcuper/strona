<?php
$link = mysqli_connect('localhost', 'root', '', '20170602');
        if (mysqli_connect_errno()) {
            echo 'Nie udało się połączyć z bazą danych. Spróbuj za kilka minut';
            echo '<br>Szczegóły błędu:' . mysqli_connect_error();
            exit();
        }
mysqli_select_db($link, '20170602');

/*  gdy na 10.10.10.10
 * 
$link = mysqli_connect('localhost', 'informatyk', 'informatyk', 'informatyk');
        if (mysqli_connect_errno()) {
            echo 'Nie udało się połączyć z bazą danych. Spróbuj za kilka minut';
            echo '<br>Szczegóły błędu:' . mysqli_connect_error();
            exit();
        }
mysqli_select_db($link, 'informatyk');
 * 
 */