<?php
if (isset($_POST['loginres']) && isset($_POST['emailres'])) {


    $mail = $_POST['emailres'];
    $login = $_POST['loginres'];
    $haslonowe = rand(10000000, 99999999999);


// walidacja loginu i email
    if (empty($login) || strlen($login) <= 2) {
         echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Proszę podać login, musi on zawierać przynajmiej dwa znaki<br />";
        echo '</div>';
        echo'</div></div>';
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $mail)) {
         echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @.<br />";
        echo '</div>';
        echo'</div></div>';
    } else {
        include 'bd.php';
        $uzytkownik = mysqli_query($link, "select *  from uzytkownicy where login='" . $login . "' AND mail='" . $mail . "'");
        $res1 = mysqli_num_rows($uzytkownik);
        // czy istnieje uzytkownik o podanym adresie mail i loginie
        if ($res1 != 1) {
             echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Podano nieprawidłowy login lub hasło<br>';
            echo '</div>';
            echo'</div></div>';
        } else {
            //istnieje i pobieramy jego hash
            $row = mysqli_fetch_array(mysqli_query($link, "SELECT hash FROM uzytkownicy WHERE login='" . $login . "' AND mail='" . $mail . "'"));
            $hash = $row['hash'];
            //wyslanie maila aktywacyjnego

            wyslijhaslo($haslonowe, $login, $mail, $hash);
             echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-success" role="alert">';
            echo 'Wysłano mail z nowym hasłem na pocztę.<br><br><a href="index.php" class="alert-link">Powrót</a>';
            echo '</div>';
            echo'</div></div>';
            mysqli_close($link);
        }
    }
}
?>
<div class="container bs-docs-container">
<h2>Resetowanie hasła</h2>

    <div>
        <form class="form-horizontal" action="index.php?t=reset" method="POST">

            <div id="divloginres" class="form-group has-feedback">
                <label class="col-sm-4 control-label" for="loginres">Login:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="loginres" name="loginres"></input>
                    <span class="help-block"></span>
                    <span id="spanloginres" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>
            <div id="divemailres" class="form-group has-feedback">
                <label class="col-sm-4 control-label" for="emailres">Mail:</label>
                <div class="col-md-4">
                    <input type="email" class="form-control" id="emailres" name="emailres"></input>
                    <span class="help-block"></span>
                    <span id="spanemailres" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div  class="col-md-4" id="zhdiv"><button type="submit" id="zhbtn" class=" btn btn-block btn-danger">Resetuj hasło</button></div>
                <div class="col-md-4"></div>
            </div>  

        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#zhdiv button').on('click', function (event) {

            var login = $('#divloginres');


            var email = $('#divemailres');


            if (login.hasClass('has-error') || email.hasClass('has-error')) {
                event.preventDefault();
                alert('Uzupełnij poprawnie wszystkie pola!');
            }

        });
    });

</script>