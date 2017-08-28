<?php

include 'funkcje.php';
//waliacja
if (isset($_POST['imie']) || isset($_POST['nazwisko']) || isset($_POST['login']) || isset($_POST['haslo']) ||
        isset($_POST['haslo2']) || isset($_POST['dataur']) || isset($_POST['email'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $login = $_POST['login'];
    $haslo = md5($_POST['haslo']);
    $haslo2 = md5($_POST['haslo2']);
    $dataur = $_POST['dataur'];
    $email = $_POST['email'];
    $datautworzenia = date("Y.m.d");
    $hash = md5(rand(0, 1000));

    // walidacja danych

    if (empty($imie) || strlen($imie) <= 2) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Proszę podać imie, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (empty($nazwisko) || strlen($nazwisko) <= 2) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Proszę podać nazwisko, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (empty($login) || strlen($login) <= 2) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Proszę podać login, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (empty($haslo) || strlen($haslo) <= 7) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
        echo '</div>';
    } elseif (empty($haslo2) || strlen($haslo2) <= 7) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
        echo '</div>';
    } elseif ($haslo != $haslo2) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Hasła się różnią<br />";
        echo '</div>';
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $email)) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @.<br />";
        echo '</div>';
    } else {

        //sprawdzenie czy intnieje login i email w bazie
        include 'bd.php';
        $llogin = mysqli_query($link, "select *  from uzytkownicy where login='" . $login . "'");
        $lmail = mysqli_query($link, "select *  from uzytkownicy where mail='" . $email . "'");
        $res1 = mysqli_fetch_row($llogin);
        $res2 = mysqli_fetch_row($lmail);


        if ($res1 != 0) {
            echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Podany login istnieje w bazie<br>';
            echo '</div>';
        } elseif ($res2 != 0) {
            echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Podany adres email istnieje w bazie<br>';
            echo '</div>';
        } else {

            if (isset($_FILES['foto']['size']) && $_FILES['foto']['size'] > 0) { // czy dodano zdj
                $fotonazwa = $_FILES['foto']['name'];
                $tmpnazwa = $_FILES['foto']['tmp_name'];
                $fotosize = $_FILES['foto']['size'];
                $fototyp = $_FILES['foto']['type'];

                if (strpos($fototyp, 'image') === 0) { //czy przeslany plik to obraz
                    
                    $fp = fopen($tmpnazwa, 'r');
                    $fotozaw = fread($fp, filesize($tmpnazwa));
                    $fotozaw = addslashes($fotozaw);
                    fclose($fp);

                    if (!get_magic_quotes_gpc()) {
                        $fotonazwa = addslashes($fotonazwa);
                    }



                    //wstawienie uzytkownika do bd ze zdj
                    mysqli_query($link, "SET NAMES 'utf8'");
                    $sql = "INSERT INTO `uzytkownicy`(imie, nazwisko, login, haslo, dataurodzenia, mail, datautworzenia, hash, fotonazwa, fototyp, fotosize, fotozaw) "
                            . "VALUES('$imie', '$nazwisko', '$login', '$haslo', '$dataur', '$email', '$datautworzenia', '$hash', '$fotonazwa', '$fototyp', '$fotosize', '$fotozaw')";
                    $res = mysqli_query($link, $sql);
                    //wyslanie maila aktywacyjnego
                    wyslijmail($imie, $nazwisko, $login, $email, $hash);
                    echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
                    echo '<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo '<strong>Dodano wpis</strong><br>Wysłano link aktywacyjny. ';
                    echo '<br><a href="index.php" class="alert-link">Powrót</a></div>';
                    mysqli_close($link);
                } else { //gdy przesłany plik nie jest plikiem graficznym
                    echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                    echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo 'Nieprawidłowy typ pliku<br>';
                    echo '</div>';
                }
            } else {

                //wstawienie uzytkownika do bd bez zdj
                mysqli_query($link, "SET NAMES 'utf8'");
                $sql = "INSERT INTO `uzytkownicy`(imie, nazwisko, login, haslo, dataurodzenia, mail, datautworzenia, hash) VALUES('$imie', '$nazwisko', '$login', '$haslo', '$dataur', '$email', '$datautworzenia', '$hash')";
                $res = mysqli_query($link, $sql);
                //wyslanie maila aktywacyjnego
                wyslijmail($imie, $nazwisko, $login, $email, $hash);
                echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
                echo '<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo '<strong>Dodano wpis</strong><br>Wysłano link aktywacyjny. ';
                echo '<br><a href="index.php" class="alert-link">Powrót</a></div>';
                mysqli_close($link);
            }
        }
    }
}
?>



