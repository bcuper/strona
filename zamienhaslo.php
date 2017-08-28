<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert">Nie jesteś zalogowany</div>';
    echo'</div></div>';
    exit();
}
if (isset($_POST['haslo']) || isset($_POST['haslonowe']) || isset($_POST['haslonowe2']) || isset($_POST['id'])) {
    $haslo = md5($_POST['haslo']);
    $haslonowe = md5($_POST['haslonowe']);
    $haslonowe2 = md5($_POST['haslonowe2']);
    $id = $_POST['id'];
    $bd = bd();
  
        $temp = $bd->prepare('SELECT haslo FROM uzytkownicy WHERE id = :id');
    $temp->bindValue(':id', $id, PDO::PARAM_INT);
    $temp->execute();
    $row = $temp->fetch();
    $stare_haslo = $row['haslo'];
    
    

    if (empty($haslo) || strlen($haslo) <= 7) {
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=zh" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Proszę podać stare hasło, musi on zawierać przynajmiej osiem znaków ';
        echo '<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=zh" />';
        echo'</div></div>';
    } elseif (empty($haslonowe) || strlen($haslonowe) <= 7) {
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=zh" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Proszę podać nowe hasło, musi on zawierać przynajmiej osiem znaków ';
        echo '<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=zh" />';
        echo'</div></div>';
    } elseif ($haslonowe != $haslonowe2) {
        echo '<div class="jumbotron"><div class="container">';
        //gdy nowe hasla sie roznia
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=zh" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Nowe hasła nie są takie same. ';
        echo '<br>Podaj ponownie<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=zh" />';
        echo'</div></div>';
    } elseif ($stare_haslo != $haslo) {
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=zh" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Nieprawidłowe stare hasło ';
        echo '<br><a href="index.php?t=zh" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=zh" />';
        echo'</div></div>';
    } else {
        //gdy wszystko ok       
        
            $temp = $bd->prepare('UPDATE uzytkownicy SET haslo = :haslo WHERE id = :id');
            $temp->bindValue(':haslo', $haslonowe, PDO::PARAM_LOB);
            $temp->bindValue(':id', $id, PDO::PARAM_INT);
            $temp->execute();
            echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-success fade in" role="alert">';
            echo '<a herf=index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Zmieniono hasło. Zostaniesz wylogowany.';
            echo '<br><a href="index.php?t=out" class="alert-link">Wyloguj</a></div>';
            echo '<meta http-equiv="refresh" content="2; URL=index.php?t=out" />';
            echo'</div></div>';
       
    }
} else {
    ?>
    <div class="container bs-docs-container">
        <h2>Zmień hasło</h2>

        <div><form class="form-horizontal form-group"  method="post" action="index.php?t=zh">
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                <div id="divhaslo" class="form-group has-feedback">
                    <label class="col-sm-4 control-label" for="haslo">Hasło:</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="haslo" name="haslo" required></input>
                        <span class="help-block"></span>
                        <span id="spanhaslo" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>

                <div id="divhaslonowe" class="form-group has-feedback">
                    <label class="col-sm-4 control-label" for="haslonowe">Nowe hasło:</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="haslonowe" required name="haslonowe"></input>
                        <span class="help-block"></span>
                        <span id="spanhaslonowe" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>

                <div id="divhaslonowe2" class="form-group has-feedback">
                    <label class="col-sm-4 control-label" for="haslo2">Powtórz nowe hasło:</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="haslonowe2" required name="haslonowe2"></input>
                        <span class="help-block"></span>
                        <span id="spanhaslonowe2" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div id="submit" class="col-md-4"><button type="submit" class=" btn btn-block btn-warning">Zmień hasło</button></div>
                    <div class="col-md-4"></div>
                </div>  
            </form>
        </div>
    </div> 

    <?php
}
?>