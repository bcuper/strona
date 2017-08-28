<?php
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
            echo '<li><a href="#dane">Dane konta</a></li>';
            echo '<li><a href="#set">Edytuj ustawienia konta</a></li>';
            echo '<li><a href="#foto">Dodaj zdjęcie</a></li>';
            echo '<li><a href="#zh">Zmień hasło</a></li>';
            if ($_SESSION['admin'] == 1) {
                echo '<li role="separator" class="divider"></li>';
                echo '<li><a href="#admin">Edycja użytkowników</a></li>';
            }
            echo '</ul></li>';
            echo '<li><a href="#str1">Strona 1</a></li>';
            echo '<li><a href="#str2">Strona 2</a></li>';
            echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?t=instr1"> Instrukcje 1 <span class="caret"></span></a><ul class="dropdown-menu">';
            echo '<li><a href="#instr1">Strona 1</a></li>';
            echo '<li><a href="#instr2">Strona 2</a></li>';
            echo '<li><a href="#instr3">Strona 3</a></li>';
            echo '<li><a href="#instr4">Strona 4</a></li>';
            echo '<li><a href="#instr5">Strona 5</a></li>';
            echo '<li><a href="#instr6">Strona 6</a></li>';
            echo '</ul></li>';
        echo '</ul>';}
       
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
?>