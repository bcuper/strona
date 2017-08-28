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
        echo '<div class="alert alert-success" role="alert">Zostałeś wylogowany z serwisu<br><a href="index.php" class="alert-link">Odśwież</a></div>';
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
    case 'reset':
        include 'reset.php';
        break;
    case 'zalog':
        include 'zaloguj.php';
        break;
    default :

        if ($_SESSION['zalogowany'] == 0) {
            if (empty($_POST['loginlog']) && empty($_POST['haslo'])){
            //gdy uzytkownik nie jest zalogowany
                echo '<h2>Witaj!!</h2>';
                echo '<p>Nie jesteś zalogowany. <br>Kliknij w przycisk zaloguj w menu aby uzyskać dostęp.</p>';

            }elseif (isset($_POST['loginlog']) || isset($_POST['haslo'])) {
                //gdy przeslano login i haslo
                $login = $_POST['loginlog'];
                $haslo = md5($_POST['haslo']);

                include 'bd.php'; //łączenie z bd

                $result = mysqli_query($link, "SELECT login, haslo FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'");

                if (mysqli_num_rows($result) != 1) { //sprawdzanie poprawnosci danych
                    echo '<div class="alert alert-warning" role="alert">Nieprawidłowy login lub hasło. <br><a href="index.php" class="alert-link">Wstecz</a></div>';
                } else {
                    $row = mysqli_fetch_array(mysqli_query($link, "SELECT active FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'"));
                    if ($row['active'] == 1) { //sprawdzanie czy konto aktywowane
                        $row = mysqli_fetch_array(mysqli_query($link, "SELECT imie, nazwisko, mail, id, dataurodzenia, datautworzenia, active FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'"));
                        mysqli_close($link);
                        if (isset($_SESSION['zalogowany'])) {
                            //gdy dane poprawne i konto aktywowane
                            $_SESSION['zalogowany'] = 1;
                            echo '<div class="alert alert-success" role="alert">Zalogowałeś się.<br><a href="index.php" class="alert-link">Odśwież</a></div>';
                            $_SESSION['login'] = $login;
                            $_SESSION['imie'] = $row['imie'];
                            $_SESSION['nazwisko'] = $row['nazwisko'];
                            $_SESSION['mail'] = $row['mail'];
                            $_SESSION['dataurodzenia'] = $row['dataurodzenia'];
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['datautworzenia'] = $row['datautworzenia'];
                            $_SESSION['active'] = $row['active'];
                        }
                    } else {
                        //gdy konto nieaktywne
                        echo '<div class="alert alert-warning" role="alert"><strong>Twoje konto nie jest aktywne.</strong><br><a href="index.php" class="alert-link">Wstecz</a><br>';
                        echo '<form class ="form-"action="wyslijponownie.php" method="POST"><input type="hidden" name="login" value="' . $login . '">'
                        . '<input type="hidden" name="haslo" value="' . $haslo . '"><input type="submit" type="button" class="alert-link btn-link" value="Wyślij ponownie link aktywacyjny" /></form></div>';
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