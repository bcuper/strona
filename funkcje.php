<?php

function wyslijmail($imie, $nazwisko, $login, $email, $hash) {
    $do = $email;
    $temat = 'Weryfikacja konta';  
    $tresc = '
Twoje konto zostało utworzone.
Twoje dane:
Imie: ' . $imie . '
Nazwisko: ' . $nazwisko . '
Login: ' . $login . '
Email: ' . $email . '
Potwirdź za pomocą linku aktywacyjnego poniżej.
http://10.10.10.10/i2/strona/verify.php?email=' . $email . '&hash=' . $hash . '';

    $naglowki = 'From:bartlomiej.cuper@standard.lublin.pl' . "\r\n";
    mail($do, $temat, $tresc, $naglowki);
}

function wyslijhaslo($haslo, $login, $email, $hash) {
    $do = $email;
    $temat = 'Weryfikacja zmiany hasła'; 
    $tresc = '
Twoje hasło zostało zmienione.
Twoje dane:
Login: ' . $login . '
Email: ' . $email . '
Nowe hasło: ' . $haslo . '
Potwirdź za pomocą linku aktywacyjnego poniżej.
http://10.10.10.10/i2/strona/verifyzh.php?email=' . $email . '&hash=' . $hash . '&haslo=' . md5($haslo) . '';

    $naglowki = 'From:bartlomiej.cuper@standard.lublin.pl' . "\r\n";
    mail($do, $temat, $tresc, $naglowki);
    
}


function checkmail($email) {
    if (!empty($email)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE mail='" . $email . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}
function checkmaillog($email) {
    if (!empty($email)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE mail='" . $email . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count == 1)
            echo '0';
        else
            echo '1';
    }
}

function checkmailu($emailu) {
    if (!empty($emailu)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE mail='" . $emailu . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];

        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

function username($login) {
    if (!empty($login)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE login='" . $login . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

function usernamelog($login) {
    if (!empty($login)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE login='" . $login . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count == 1)
            echo '0';
        else
            echo '1';
    }
}

function usernameu($loginu) {
    if (!empty($loginu)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE login='" . $loginu . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

if (isset($_POST['akcja']) && !empty($_POST['akcja']) && isset($_POST['zmienna']) && !empty($_POST['zmienna'])) {
    $action = $_POST['akcja'];
    switch ($action) {
        case 'checkmail' : checkmail($_POST['zmienna']);
            break;
        case 'checkmaillog' : checkmaillog($_POST['zmienna']);
            break;
        case 'checkmailu' : checkmailu($_POST['zmienna']);
            break;
        case 'checkusername' : username($_POST['zmienna']);
            break;
        case 'checkusernamelog' : usernamelog($_POST['zmienna']);
            break;
        case 'checkusernameu' : usernameu($_POST['zmienna']);
            break;
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

