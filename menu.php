<?php

if (isset($_GET['t'])) { //dane i wylogowywanaie
    $t = $_GET['t'];
} else
    $t = '';

//menu z lewej
switch ($t) {
    //po logowaniu
    case 'dane': //edycja danych
        echo '<ul class="nav navbar-nav">';
        echo '<li><a href="index.php">Strona główna</a></li>';
        echo '<li class="active"><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        echo '</ul>';
        echo '<a href = "index.php?t=out"><input type = "button" class = "btn btn-danger navbar-btn" value = "Wyloguj" /></a>';
        break;
    case 'set': //ustawienia
        echo '<ul class="nav navbar-nav">';
        echo '<li><a href="index.php">Strona główna</a></li>';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li class="active"><a href="index.php?t=set">Ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        echo '</ul>';
        echo '<a href = "index.php?t=out"><input type = "button" class = "btn btn-danger navbar-btn" value = "Wyloguj" /></a>';
        break;
    case 'zh': //zmianahasla
        echo '<ul class="nav navbar-nav">';
        echo '<li><a href="index.php">Strona główna</a></li>';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Ustawienia konta</a></li>';
        echo '<li class="active"><a href="index.php?t=zh">Zmień hasło</a></li>';
        echo '</ul>';
        echo '<a href = "index.php?t=out"><input type = "button" class = "btn btn-danger navbar-btn" value = "Wyloguj" /></a>';
        break;
    //niezalogowany
    case 'rej': //rejestracja
        echo '<ul class="nav navbar-nav">';
        echo '<li><a href="index.php">Strona główna</a></li>';
        echo '<li><a href="index.php?t=zalog">Zaloguj się</a></li>';
        echo '<li class="active"><a href="index.php?t=rej">Zarejestruj się</a></li>';
        echo '<li><a href="index.php?t=reset">Resetuj hasło</a></li>';
        echo '</ul>';
        break;
    case 'reset': //reset hasła
        echo '<ul class="nav navbar-nav">';
        echo '<li><a href="index.php">Strona główna</a></li>';
        echo '<li><a href="index.php?t=zalog">Zaloguj się</a></li>';
        echo '<li><a href="index.php?t=rej">Zarejestruj się</a></li>';
        echo '<li class="active"><a href="index.php?t=reset">Resetuj hasło</a></li>';
        echo '</ul>';
        break;
    case 'zalog': //logowanie
        echo '<ul class="nav navbar-nav">';
        echo '<li><a href="index.php">Strona główna</a></li>';
        echo '<li class="active"><a href="index.php?t=zalog">Zaloguj się</a></li>';
        echo '<li><a href="index.php?t=rej">Zarejestruj się</a></li>';      
        echo '<li><a href="index.php?t=reset">Resetuj hasło</a></li>';
        echo '</ul>';
        break;
    
    default :
        //menu indexu
        if ($_SESSION['zalogowany'] == 0) {

            //gdy uzytkownik nie jest zalogowany
            echo '<ul class="nav navbar-nav">';
            echo '<li class="active"><a href="index.php">Strona główna</a></li>';
            echo '<li><a href="index.php?t=zalog">Zaloguj się</a></li>';
            echo '<li><a href="index.php?t=rej">Zarejestruj się</a></li>';
            echo '<li><a href="index.php?t=reset">Resetuj hasło</a></li>';
            echo '</ul>';
        } else {
            //po zalogowaniu
            echo '<ul class="nav navbar-nav">';
            echo '<li class="active"><a href="index.php">Strona główna </a></li>';
            echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
            echo '<li><a href="index.php?t=set">Ustawienia konta</a></li>';
            echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
            echo '</ul>';
            echo '<a href = "index.php?t=out"><input type = "button" class = "btn btn-danger navbar-btn" value = "Wyloguj" /></a>';
        }
        break;
}
if ($_SESSION['zalogowany'] == 1) { //menu z prawej strony wyswietla imie i nazwisko
    echo '<ul class="nav navbar-nav navbar-right"><p class="navbar-text">Jesteś zalogowany jako: ' . $_SESSION['imie'] . ' ' . $_SESSION['nazwisko'] . '</p></ul>';
}
?>

