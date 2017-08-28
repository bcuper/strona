<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
    echo '<div class="alert alert-danger" role="alert">Nie jesteś zalogowany</div>';
} else {
    if (isset($_POST['haslo']) || isset($_POST['haslonowe']) || isset($_POST['haslonowe2']) || isset($_POST['id'])) {
        $haslo = $_POST['haslo'];
        $haslonowe = $_POST['haslonowe'];
        $haslonowe2 = $_POST['haslonowe2'];
        $id = $_POST['id'];
        include 'bd.php';
        $row = mysqli_fetch_array(mysqli_query($link, "SELECT haslo FROM uzytkownicy WHERE id='" . $id . "'"));
        $stare_haslo = $row['haslo'];

        if (empty($haslo) || strlen($haslo) <= 7) {
            echo '<div class="alert alert-warning" role="alert">Proszę podać stare hasło, musi on zawierać przynajmiej osiem znaków<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        } elseif (empty($haslonowe) || strlen($haslonowe) <= 7) {
            echo '<div class="alert alert-warning" role="alert">Proszę podać nowe hasło, musi on zawierać przynajmiej osiem znaków<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        } elseif ($haslonowe != $haslonowe2) {
            //gdy nowe hasla sie roznia
            echo '<div class="alert alert-warning" role="alert">Nowe hasła się nie są takie same. <br>Podaj ponownie<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        } elseif ($stare_haslo != $haslo) {
            echo '<div class="alert alert-warning" role="alert">Nieprawidłowe stare hasło <br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        } else {
            //gdy wszystko ok       


            mysqli_query($link, "SET NAMES 'utf8'");
            $sql = "UPDATE `uzytkownicy` SET  haslo='$haslonowe' WHERE id = '$id'";
            $res = mysqli_query($link, $sql);
            echo '<div class="alert alert-success" role="alert">Zmieniono hasło.<a href="index.php" class="alert-link">Powrót</a>';
            mysqli_close($link);
             $sec = "2";
                    $header = header("Refresh: $sec; url=$page");
                     echo 'Strona się odświerzy za 2 sekundy.</div>';
        }
    } else {
        ?>
<h2>Zmień hasło</h2>
        <div><form class="form-horizontal form-group"  method="post" action="index.php?t=zh">
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                <div id="divhaslo" class="form-group has-feedback">
                    <label class="col-sm-4 control-label" for="haslo">Hasło:</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="haslo" name="haslo" required="wymagane pole"></input>
                        <span class="help-block"></span>
                                <span id="spanhaslo" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>

                <div id="divhaslonowe" class="form-group has-feedback">
                    <label class="col-sm-4 control-label" for="haslonowe">Nowe hasło:</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="haslonowe" required="wymagane pole" name="haslonowe"></input>
                        <span class="help-block"></span>
                                <span id="spanhaslonowe" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>

                <div id="divhaslonowe2" class="form-group has-feedback">
                    <label class="col-sm-4 control-label" for="haslo2">Powtórz nowe hasło:</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="haslonowe2" required="wymagane pole" name="haslonowe2"></input>
                        <span class="help-block"></span>
                                <span id="spanhaslonowe2" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>

                <div id="submit" class="col-md-4"> 
                    <div class="col-md-4"></div>
                    <button type="submit" class="btn btn-warning">Zmień hasło</button><br><br>
                    
        
                </div>
            </form>            
        </div>
        <?php
    }
}
?>