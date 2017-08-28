<?php
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

    if (empty($imie) || strlen($imie) <= 2) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Proszę podać imie, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (empty($nazwisko) || strlen($nazwisko) <= 2) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Proszę podać nazwisko, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (empty($login) || strlen($login) <= 2) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Proszę podać login, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (empty($haslo) || strlen($haslo) <= 7) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
        echo '</div>';
    } elseif (empty($haslo2) || strlen($haslo2) <= 7) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
        echo '</div>';
    } elseif ($haslo != $haslo2) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Hasła się różnią<br />";
        echo '</div>';
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $email)) {
        echo '<div class="alert alert-warning" role="alert">';
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
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Podany login istnieje w bazie<br>';
            echo '</div>';
        } elseif ($res2 != 0) {
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Podany adres email istnieje w bazie<br>';
            echo '</div>';
        } else {
            //wstawienie uzytkownika do bd
            mysqli_query($link, "SET NAMES 'utf8'");
            $sql = "INSERT INTO `uzytkownicy`(imie, nazwisko, login, haslo, dataurodzenia, mail, datautworzenia, hash) VALUES('$imie', '$nazwisko', '$login', '$haslo', '$dataur', '$email', '$datautworzenia', '$hash')";
            $res = mysqli_query($link, $sql);
            //wyslanie maila aktywacyjnego
            wyslijmail($imie, $nazwisko, $login, $email, $hash);
            echo '<div class="alert alert-success" role="alert"><strong>Dodano wpis</strong><br>Wysłano link aktywacyjny. <br><a href="index.php" class="alert-link">Powrót</a></div>';
            mysqli_close($link);
        }
    }
}
?>

<h2>Rejestracja</h2>
<div><form class="form-horizontal form-group"  method="post" action="index.php?t=rej">

        <div id="divimie" class="form-group has-feedback">                    
            <label  class="col-sm-4 control-label" for="imie">Imię:</label>
            <div class="col-md-4">
                <input type="text" id="imie" name="imie" required="wymagane pole"  class="form-control" value="<?php
                if (isset($_POST['imie']))
                    echo ($imie);
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spanimie" class="glyphicon form-control-feedback" aria-hidden="true"></span>   
            </div>

        </div>

        <div id="divnazwisko" class="form-group has-feedback">
            <label class="col-sm-4 control-label" for="nazwisko">Nazwisko:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="nazwisko" name="nazwisko" required="wymagane pole" value="<?php
                if (isset($_POST['nazwisko']))
                    echo $nazwisko;
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spannazwisko" class="glyphicon form-control-feedback" aria-hidden="true"></span>                
            </div>
        </div>

        <div id="divlogin"class="form-group has-feedback">
            <label class="col-sm-4 control-label" for="login">Login:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="login" name="login" required="wymagane pole" value="<?php
                if (isset($_POST['login']))
                    echo $login;
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spanlogin" class="glyphicon form-control-feedback" aria-hidden="true"></span>                
            </div>
        </div>

        <div id="divhaslo" class="form-group has-feedback">
            <label class="col-sm-4 control-label" for="haslo">Hasło:</label>
            <div class="col-md-4">
                <input type="password" class="form-control" id="haslo" name="haslo" required="wymagane pole" value="<?php
                if (isset($_POST['haslo']))
                    echo $haslo;
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spanhaslo" class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>

        <div id="divhaslo2" class="form-group has-feedback">
            <label class="col-sm-4 control-label" for="haslo2">Powtórz hasło:</label>
            <div class="col-md-4">
                <input type="password" class="form-control" id="haslo2" name="haslo2" required="wymagane pole" value="<?php
                if (isset($_POST['haslo2']))
                    echo $haslo2;
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spanhaslo2" class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>

        <div id="divdataur" class="form-group has-feedback">
            <label class="col-sm-4 control-label" for="dataur">Data urodzenia:</label>
            <div class="col-md-4">
                <input type="date" class="form-control" id="dataur" name="dataur" max="<?php echo date("Y.m.d"); ?>" required="wymagane pole" placeholder="RRRR-MM-DD" value="<?php
                if (isset($_POST['dataur']))
                    echo $dataur;
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spandataur" class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>

        <div id="divemail" class="form-group has-feedback">
            <label class="col-sm-4 control-label" for="email">Email:</label>
            <div class="col-md-4">
                <input type="email" class="form-control" id="email" name="email" required="wymagane pole" value="<?php
                if (isset($_POST['email']))
                    echo $email;
                else
                    echo '';
                ?>"></input>
                <span class="help-block"></span>
                <span id="spanemail" class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div> 


        <div  id="submit" class="col-md-4"> 
            <div  class="col-md-4"></div>
            <button  type="submit" class="btn btn-success">Zarejestruj się</button>             
        </div>               

</div>

