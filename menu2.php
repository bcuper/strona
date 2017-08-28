<?php

if (isset($_GET['t'])) { //dane i wylogowywanaie
    $t = $_GET['t'];
} else
    $t = '';
//linki menu


if ($_SESSION['zalogowany'] == 1) { //menu z prawej strony wyswietla imie i nazwisko gdy zalogowany i przycisk 
    echo '<ul class="nav navbar-nav">'; //menu z lewej
    //poczatek menu rozwijanego
    for ($i = 0; $i < count($m); $i++) {
        echo '<li';
        if ($t == $m[$i][0])
            echo ' class="active" ';
        echo '><a href="index.php?t=' . $m[$i][0] . '">' . $m[$i][1] . '</a></li>';
    }
   
    echo '</ul>';

//początek menu z prawej
    
    echo '<ul class="nav navbar-nav navbar-right">';        
    echo '<p class="navbar-text">Jesteś zalogowany jako: ';
    echo '<img height="20"  src="data:image/jpeg;base64,' . base64_encode($_SESSION['fotozaw']) . '"/>';
    echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">' . $_SESSION['imie'] . ' ' . $_SESSION['nazwisko'] . '</p></a><ul class="dropdown-menu">';
    for ($i = 1; $i < count($r); $i++) {
        echo '<li';
        if ($t == $r[$i][0])
            echo ' class="active" ';
        echo '><a href="index.php?t=' . $r[$i][0] . '">' . $r[$i][1] . '</a></li>';
    }
    if ($_SESSION['admin'] == 1) { //czy admin
        echo '<li role="separator" class="divider"></li>';
        echo '<li';
        if ($t == $r[0][0])
            echo ' class="active" ';
        echo '><a href="index.php?t=' . $r[0][0] . '">' . $r[0][1] . '</a></li>';
    }
    echo '</ul></li>'; //koniec menu rozwijanego
    //dalsze menu    
    
    
    echo '<li><a a href="index.php?t=out"><span class="glyphicon glyphicon-log-out"></span> Wyloguj się</a></li>';
    echo '</ul>';
}
if ($_SESSION['zalogowany'] == 0) { //gdy niezalogowany przycisk zaloguj z prawej strony
    //gdy uzytkownik nie jest zalogowany
    echo '<ul class="nav navbar-nav">'; //poczatek menu z lewej
    echo '<li><a href="index.php?t=reset"><span class="glyphicon glyphicon-asterisk"></span> Resetuj hasło</a></li>';
    echo '<li><a data-toggle="modal" data-target="#zarejestrujmodal"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>';
    echo '</ul>';

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