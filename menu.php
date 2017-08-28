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
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li class="active"><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
    case 'set': //ustawienia
        echo '<ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li class="active"><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
        case 'admin': //edycja admin
        echo '<ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li class="active"><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
    case 'foto': //zmiana fotografii
        echo '<ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li class="active"><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
    case 'zh': //zmianahasla
        echo '<ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li class="active"><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
        case 'str1': //strona_1
        echo '<ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li class="active"><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
        case 'str2': //Strona_2
        echo '<ul class="nav navbar-nav">';
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
        echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
        echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
        echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
        echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
        if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
        echo '</ul></li>';
        echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
        echo '<li class="active"><a href="index.php?t=str2">Strona 2</a></li>';
        echo '</ul>';
        break;
    
    //niezalogowany

    case 'reset': //reset hasła
        echo '<ul class="nav navbar-nav">';
        echo '<li class="active"><a href="index.php?t=reset"><span class="glyphicon glyphicon-asterisk"></span> Resetuj hasło</a></li>';
        echo '<li><a data-toggle="modal" data-target="#zarejestrujmodal"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>';
        echo '</ul>';
        break;


    default :
        //menu indexu
        if ($_SESSION['zalogowany'] == 0) {

            //gdy uzytkownik nie jest zalogowany
            echo '<ul class="nav navbar-nav">';
            echo '<li><a href="index.php?t=reset"><span class="glyphicon glyphicon-asterisk"></span> Resetuj hasło</a></li>';
            echo '<li><a data-toggle="modal" data-target="#zarejestrujmodal"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>';
            echo '</ul>';
        } else {
            //po zalogowaniu
            echo '<ul class="nav navbar-nav">';
            echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span> Ustawienia konta <span class="caret"></span></a><ul class="dropdown-menu">';
            echo '<li><a href="index.php?t=dane">Dane konta</a></li>';
            echo '<li><a href="index.php?t=set">Edytuj ustawienia konta</a></li>';
            echo '<li><a href="index.php?t=foto">Dodaj zdjęcie</a></li>';
            echo '<li><a href="index.php?t=zh">Zmień hasło</a></li>';
            if ($_SESSION['admin'] == 1) {
        echo '<li role="separator" class="divider"></li>';
        echo '<li><a href="index.php?t=admin">Edycja użytkowników</a></li>';
        }
            echo '</ul></li>';
            echo '<li><a href="index.php?t=str1">Strona 1</a></li>';
            echo '<li><a href="index.php?t=str2">Strona 2</a></li>';
            echo '</ul>';
        }
        break;
}
if ($_SESSION['zalogowany'] == 1) { //menu z prawej strony wyswietla imie i nazwisko gdy zalogowany i przycisk 
    echo '<ul class="nav navbar-nav navbar-right"><p class="navbar-text">Jesteś zalogowany jako: ';

    echo '<img height="20"  src="data:image/jpeg;base64,' . base64_encode($_SESSION['fotozaw']) . '"/>';

    echo ' ' . $_SESSION['imie'] . ' ' . $_SESSION['nazwisko'] . '</p>';
    echo '<li><a a href="index.php?t=out"><span class="glyphicon glyphicon-log-out"></span> Wyloguj się</a></li>';
    echo '</ul>';
}
if ($_SESSION['zalogowany'] == 0) { //gdy niezalogowany przycisk zaloguj z prawej strony
    echo '<form class="nav navbar-form navbar-right" role="form" method="post" action="index.php">
            <div class="form-group has-feedback">
            <div id="divloginlog">
              <input type="text" placeholder="Login" id="loginlog" name="loginlog" class="form-control">
              
               <span id="spanloginlog" class="glyphicon form-control-feedback" aria-hidden="true"></span>   
            </div></div>
            <div class="form-group has-feedback">
            <div id="divhaslolog">
              <input type="password" placeholder="Hasło" id="haslolog" name="haslolog" class="form-control">              
               <span id="spanhaslolog" class="glyphicon form-control-feedback" aria-hidden="true"></span>   
            </div></div>
            <button type="submit" class="btn btn-success">Zaloguj się</button></form>';
}
//$l['skrot']['opis'];

$l[0][0] = 'dane'; $l[0][1] = 'Dane konta';
$l[1][0] = 'set'; $l[1][1] = 'Edytuj ustawienia konta';
$l[2][0] = 'zh'; $l[2][1] = 'Resetuj hasło';
$l[3][0] = 'reset'; $l[3][1] = 'Wyloguj się';
$l[4][0] = 'foto'; $l[4][1] = 'Dodaj zdjęcie';
$l[5][0] = 'str1'; $l[5][1] = 'Strona 1';
$l[6][0] = 'str2'; $l[6][1] = 'Strona 2';
$l[7][0] = 'admin'; $l[7][1] = 'Edycja użytkowników';



?>