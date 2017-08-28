<?php

function wyslijMail($imie, $nazwisko, $login, $haslo, $email, $hash) {
    $do = 'andrzej(at)standard.lublin.pl';
    $temat = 'Weryfikacja konta'; // Give the email a subject 
    $tresc = '
Twoje konto zostało utworzone. 
Twoje dane:
Imie: ' . $imie . '
Nazwisko: ' . $nazwisko . '
Login: ' . $login . '
Hasło: ' . $haslo . '
Email: ' . $email . '
Potwirdź za pomocą linku aktywacyjnego poniżej.
http://10.10.10.10/i2/strona_1/verify.php?email=' . $email . '&hash=' . $hash . '';

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
        case 'checkmailu' : checkmailu($_POST['zmienna']);
            break;
        case 'checkusername' : username($_POST['zmienna']);
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

