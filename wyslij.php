<?php

function wyslijmail($imie, $nazwisko, $login, $haslo, $email, $hash) {
    $do = 'andrzej(at)standard.lublin.pl';
    $temat = 'Weryfikacja konta'; // Give the email a subject 
    $tresc = '
Twoje konto zostało utworzone. <br >
Twoje dane:<br>
Imie: ' . $imie . '<br>
Nazwisko: ' . $nazwisko . '<br>
Login: ' . $login . '<br>
Hasło: ' . $haslo . '<br>
Email: ' . $email . '<br>
Potwirdź za pomocą linku aktywacyjnego poniżej.<br>
http://www.yourwebsite.com/verify.php?email=' . $email . '&hash=' . $hash . '';

    $naglowki = 'From:bartlomiej.cuper@standard.lublin.pl' . "\r\n";
    mail($do, $temat, $tresc, $naglowki);
}


if (isset($_POST['imie']) || isset($_POST['nazwisko']) || isset($_POST['login']) || isset($_POST['haslo']) ||
        isset($_POST['haslo2']) || isset($_POST['dataur']) || isset($_POST['email'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $haslo2 = $_POST['haslo2'];
    $dataur = $_POST['dataur'];
    $email = $_POST['email'];
    $datautworzenia = date("Y.m.d");
    $hash = md5(rand(0, 1000));

    if (empty($imie) || strlen($imie) <= 2) {
        echo "Proszę podać imie, musi on zawierać przynajmiej dwa znaki<br />";
    } elseif (empty($nazwisko) || strlen($nazwisko) <= 2) {
        echo "Proszę podać nazwisko, musi on zawierać przynajmiej dwa znaki<br />";
    } elseif (empty($login) || strlen($login) <= 2) {
        echo "Proszę podać login, musi on zawierać przynajmiej dwa znaki<br />";
    } elseif (empty($haslo) || strlen($haslo) <= 7) {
        echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
    } elseif (empty($haslo2) || strlen($haslo2) <= 7) {
        echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
    } elseif ($haslo != $haslo2) {
        echo "Hasła się różnią<br />";
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $email)) {
        echo "Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @.<br />";
    } else {


        $link = mysqli_connect('localhost', 'root', '', '20170602');
        if (mysqli_connect_errno()) {
            echo 'Nie udało się połączyć z bazą danych. Spróbuj za kilka minut';
            echo '<br>Szczegóły błędu:' . mysqli_connect_error();
            exit();
        }

        $llogin = mysqli_query($link, "select *  from uzytkownicy where login='" . $login . "'");
        $lmail = mysqli_query($link, "select *  from uzytkownicy where mail='" . $email . "'");
        $res1 = mysqli_fetch_row($llogin);
        $res2 = mysqli_fetch_row($lmail);


        if ($res1 != 0) {
            echo '<form action="index.php" method="POST"><input type="hidden" name="imie" value="'.$imie.'"><input type="hidden" name="nazwisko" value="'.$nazwisko.'"><input type="hidden" name="login" value="'.$login.'">'
                    . '<input type="hidden" name="haslo" value="'.$haslo.'"><input type="hidden" name="haslo2" value="'.$haslo.'"><input type="hidden" name="dataur" value="'.$dataur.'">'
                    . '<input type="hidden" name="email" value="'.$email.'"><h1>Podany login istnieje w bazie</h1><br><input type="submit" value="Powrót" /></form>';
        } elseif ($res2 != 0) {
            echo '<form action="index.php" method="POST"><input type="hidden" name="imie" value="'.$imie.'"><input type="hidden" name="nazwisko" value="'.$nazwisko.'"><input type="hidden" name="login" value="'.$login.'">'
                    . '<input type="hidden" name="haslo" value="'.$haslo.'"><input type="hidden" name="haslo2" value="'.$haslo.'"><input type="hidden" name="dataur" value="'.$dataur.'">'
                    . '<input type="hidden" name="email" value="'.$email.'"><h1>Podany adres email istnieje w bazie</h1><br><input type="submit" value="Powrót" /></form>';
        } else {
            mysqli_query($link, "SET NAMES 'utf8'");
            $sql = "INSERT INTO `uzytkownicy`(imie, nazwisko, login, haslo, dataurodzenia, mail, datautworzenia, hash) VALUES('$imie', '$nazwisko', '$login', '$haslo', '$dataur', '$email', '$datautworzenia', '$hash')";
            $res = mysqli_query($link, $sql);
            echo '<h1>Dodano wpis</h1>';
            wyslijmail($imie, $nazwisko, $login, $haslo, $email, $hash);
            echo'<h1>Wysłano link aktywacyjny.</h1>';
            echo '<form action="index.php" method="POST"><input type="submit" value="Powrót" /></form>';
            mysqli_close($link);
        }
    }
} else {
    echo '<h1>Nie przekazano żadnych parametrów. </h1><form action="index.php" method="POST"><input type="submit" value="Powrót" /></form>';
}
