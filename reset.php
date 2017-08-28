<?php
if (isset($_POST['loginlog']) && isset($_POST['emaillog'])) {


    $mail = $_POST['emaillog'];
    $login = $_POST['loginlog'];
    $haslonowe = rand(10000000, 99999999);
    

// walidacja loginu i email
    if (empty($login) || strlen($login) <= 2) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Proszę podać login, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $mail)) {
        echo '<div class="alert alert-warning" role="alert">';
        echo "Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @.<br />";
        echo '</div>';
    } else {
        include 'bd.php';
        $uzytkownik = mysqli_query($link, "select *  from uzytkownicy where login='" . $login . "' AND mail='" . $mail . "'");
        $res1 = mysqli_num_rows($uzytkownik);
        // czy istnieje uzytkownik o podanym adresie mail i loginie
        if ($res1 != 1) {
            echo '<div class="alert alert-warning" role="alert">';
            echo 'Podano nieprawidłowy login lub hasło<br>';
            echo '</div>';
        } else {
            //istnieje i pobieramy jego hash
            $row = mysqli_fetch_array(mysqli_query($link, "SELECT hash FROM uzytkownicy WHERE login='" . $login . "' AND mail='" . $mail . "'"));
            $hash = $row['hash'];
            //wyslanie maila aktywacyjnego
            
            wyslijhaslo($haslonowe, $loginlog, $maillog, $hash);
            echo '<div class="alert alert-success" role="alert">Wysłano mail z nowym hasłem na pocztę.<br><br><a href="index.php" class="alert-link">Powrót</a></div>';
            mysqli_close($link);
        }
    }
}
?>
<h2>Resetowanie hasła</h2>
<div>
    <form <form class="form-horizontal" action="index.php?t=reset" method="POST">
            
            <div id="divloginlog" class="form-group has-feedback">
                <label class="col-sm-4 control-label" for="loginlog">Login:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="loginlog" name="loginlog"></input>
                    <span class="help-block"></span>
                                <span id="spanloginlog" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div id="divemaillog" class="form-group has-feedback">
                <label class="col-sm-4 control-label" for="emaillog">Mail:</label>
                <div class="col-md-4">
                    <input type="email" class="form-control" id="emaillog" name="emaillog"></input>
                     <span class="help-block"></span>
                                <span id="spanemaillog" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div  id="submit" class="col-md-4"> 
                <div  class="col-md-4"></div>
                <button  type="submit" class="btn btn-success">Resetuj hasło</button>             
            </div>       
        </form>
</div>