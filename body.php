<?php

include 'funkcje.php';
if (isset($_GET['t'])) { //dane i wylogowywanaie
    $t = $_GET['t'];
} else
    $t = '';

switch ($t) {
    case 'out':
        $_SESSION['zalogowany'] = 0;
        unset($_SESSION);
        session_unset();
        session_destroy();
        echo '<div class="alert alert-success" role="alert">Zostałeś wylogowany z serwisu<br><a href="index.php" class="alert-link">Odśwież</a>';
        $page = $_SERVER['PHP_SELF'];
 $sec = "2";
 $header = header("Refresh: $sec; url=$page");
 echo 'Strona się odświerzy za 2 sekundy.</div>';
        break;
    case 'dane':
        if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
            echo '<div class="alert alert-danger" role="alert"><strong>Nie jesteś zalogowany</strong></div>';
        } else {
            //gdy zalogowany
            include 'dane.php';
        }
        break;
    case 'set':
        include 'ustawienia.php';
        break;
    case 'rej':
        include 'rejestracja.php';
        break;
    case 'zh':
        include 'zamienhaslo.php';
        break;
    default :

        if ($_SESSION['zalogowany'] == 0) {
            if (empty($_POST['login']) && empty($_POST['haslo']))
            //gdy uzytkownik nie jest zalogowany
                include 'zaloguj.php';

            elseif (isset($_POST['login']) || isset($_POST['haslo'])) {
                //gdy przeslano login i haslo
                $login = $_POST['login'];
                $haslo = $_POST['haslo'];

                include 'bd.php'; //łączenie z bd

                $result = mysqli_query($link, "SELECT login, haslo FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'");

                if (mysqli_num_rows($result) != 1) { //sprawdzanie poprawnosci danych
                    echo '<div class="alert alert-warning" role="alert">Nieprawidłowy login lub hasło. <br><a href="index.php" class="alert-link">Wstecz</a>';
                    $sec = "2";
                    $header = header("Refresh: $sec; url=$page");
                     echo 'Strona się odświerzy za 2 sekundy.</div>';
                } else {
                    $row = mysqli_fetch_array(mysqli_query($link, "SELECT active FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'"));
                    if ($row['active'] == 1) { //sprawdzanie czy konto aktywowane
                        $row = mysqli_fetch_array(mysqli_query($link, "SELECT imie, nazwisko, mail, id, dataurodzenia, datautworzenia, active FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'"));
                        mysqli_close($link);
                        if (isset($_SESSION['zalogowany'])) {
                            //gdy dane poprawne i konto aktywowane
                            $_SESSION['zalogowany'] = 1;
                            echo '<div class="alert alert-success" role="alert">Zalogowałeś się.<br><a href="index.php" class="alert-link">Odśwież</a>';
                            $_SESSION['login'] = $login;
                            $_SESSION['imie'] = $row['imie'];
                            $_SESSION['nazwisko'] = $row['nazwisko'];
                            $_SESSION['mail'] = $row['mail'];
                            $_SESSION['dataurodzenia'] = $row['dataurodzenia'];
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['datautworzenia'] = $row['datautworzenia'];
                            $_SESSION['active'] = $row['active'];
                            $sec = "2";
                             $header = header("Refresh: $sec; url=$page");
                             echo 'Strona się odświerzy za 2 sekundy.</div>';
                        }
                    } else {
                        //gdy konto nieaktywne
                        echo '<div class="alert alert-warning" role="alert"><strong>Twoje konto nie jest aktywne.</strong><br><a href="index.php" class="alert-link">Wstecz</a><br>';
                        echo '<form class ="form-"action="wyslijponownie.php" method="POST"><input type="hidden" name="login" value="' . $login . '">'
                        . '<input type="hidden" name="haslo" value="' . $haslo . '"><input type="submit" type="button" class="alert-link btn-link" value="Wyślij ponownie link aktywacyjny" /></form>';
                        $sec = "2";
 $header = header("Refresh: $sec; url=$page");
 echo 'Strona się odświerzy za 2 sekundy.</div>';
                    }
                }
            }
        } else {
            //po odswierzeniu i zalogowaniu
            echo '<h1>Witaj ' . $_SESSION['imie'] . ' ' . $_SESSION['nazwisko'] . '</h1>';
        }
        break;
}
?>