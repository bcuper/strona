<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert">Nie jesteś zalogowany</div>';
    echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
    echo'</div></div>';
} else {
    if ($_SESSION['admin'] != 1) {

        //gdy zalogowany

        $dzis = date("Y-m-d");
        $ile = (strtotime($dzis) - strtotime($_SESSION['datautworzenia'])) / (60 * 60 * 24);

        if ($ile > 2) {
            echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-danger" role="alert">Nie możesz edytować ustawień konta</div>';
            echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
            echo'</div></div>';
        }
    } else {


        if (isset($_POST['imie']) || isset($_POST['nazwisko']) || isset($_POST['loginu']) || isset($_POST['haslo']) || isset($_POST['haslo2']) || isset($_POST['dataur']) || isset($_POST['emailu']) || isset($_POST['id'])) {

// zapisywanie danych do zmiennych
            $id = $_POST['id'];
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $loginu = $_POST['loginu'];
            $dataur = $_POST['dataur'];
            $emailu = $_POST['emailu'];
            $haslo = md5($_POST['haslo']);
            $haslo2 = md5($_POST['haslo2']);


            //walidacja zmiennych

            if (empty($imie) || strlen($imie) <= 2) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo 'Proszę podać imie, musi on zawierać przynajmiej dwa znaki ';
                echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo'</div></div>';
            } elseif (empty($nazwisko) || strlen($nazwisko) <= 2) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo 'Proszę podać nazwisko, musi on zawierać przynajmiej dwa znak ';
                echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo'</div></div>';
            } elseif (empty($loginu) || strlen($loginu) <= 2) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo 'Proszę podać login, musi on zawierać przynajmiej dwa znaki ';
                echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo'</div></div>';
            } elseif (empty($haslo) || strlen($haslo) <= 7) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo 'Proszę podać stare hasło, musi on zawierać przynajmiej osiem znaków ';
                echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo'</div></div>';
            } elseif (empty($haslo2) || strlen($haslo2) <= 7) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo "Proszę podać hasło, musi on zawierać przynajmiej osiem znaków<br />";
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo '</div>';
                echo'</div></div>';
            } elseif ($haslo != $haslo2) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;></a>';
                echo "Hasła się różnią<br />";
                echo '</div>';
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo'</div></div>';
            } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $emailu)) {
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo 'Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @. ';
                echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
                echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                echo'</div></div>';
            } else {

                //laczenie z bd
                include 'bd.php';
                //sprawdzanie czy uzytkownik podal prawidlowe stare haslo

                $row = mysqli_fetch_array(mysqli_query($link, "SELECT haslo FROM uzytkownicy WHERE id='" . $id . "'"));
                $bd_haslo = $row['haslo'];



                if ($bd_haslo != $haslo) {
                    //czy podano prawidlowe stare haslo    
                    echo '<div class="jumbotron"><div class="container">';
                    echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                    echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo 'Podano nieprawidłowe hasło! ';
                    echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
                    echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
                    echo'</div></div>';
                } else {
                    //gdy ok
                    mysqli_query($link, "SET NAMES 'utf8'");
                    $sql = "UPDATE `uzytkownicy` SET imie = '$imie', nazwisko = '$nazwisko', login = '$loginu', dataurodzenia = '$dataur', mail = '$emailu' WHERE id = '$id'";
                    $res = mysqli_query($link, $sql);
                    echo '<div class="jumbotron"><div class="container">';
                    echo '<div class="alert alert-success" role="alert">Uaktualniono dane<br> Zaloguj się ponownie ';
                    echo '<a href="index.php?t=out" class="alert-link">Wyloguj się</a></div>';
                    mysqli_close($link);
                    echo '<meta http-equiv="refresh" content="3; URL=index.php?t=out" />';
                    echo'</div></div>';
                }
            }
        } else {    
            //tabelka
            ?>
            <div class="container bs-docs-container">
                <h2>Edytuj dane</h2>

                <div class="row">

                    <div><form class="form-horizontal form-group"  method="post" action="index.php?t=set">

                            <input type="hidden" name="loginuz" id="loginuz" value="<?php echo $_SESSION['login']; ?>">
                            <input type="hidden" name="emailuz" id="emailuz" value="<?php echo $_SESSION['mail']; ?>">
                            <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">

                            <div id="divimie" class="form-group has-feedback">                    
                                <label  class="col-sm-4 control-label " for="imie">Imię:</label>
                                <div class="col-md-4 ">
                                    <input type="text" id="imie" name="imie" required  class="form-control" value="<?php echo $_SESSION['imie']; ?>">
                                    <span class="help-block"></span>
                                    <span id="spanimie" class="glyphicon form-control-feedback" aria-hidden="true"></span>                   
                                </div>
                            </div>

                            <div id="divnazwisko" class="form-group has-feedback">
                                <label class="col-sm-4 control-label" for="nazwisko">Nazwisko:</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="nazwisko" name="nazwisko" required value="<?php echo $_SESSION['nazwisko']; ?>"></input>
                                    <span class="help-block"></span>
                                    <span id="spannazwisko" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div id="divloginu"class="form-group has-feedback">
                                <label class="col-sm-4 control-label" for="loginu">Login:</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="loginu" name="loginu" required value="<?php echo $_SESSION['login']; ?>"></input>
                                    <span class="help-block"></span>
                                    <span id="spanloginu" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div id="divhaslo" class="form-group has-feedback">
                                <label class="col-sm-4 control-label" for="haslo">Hasło:</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" id="haslo" name="haslo" required></input>
                                    <span class="help-block"></span>
                                    <span id="spanhaslo" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div id="divhaslo2" class="form-group has-feedback">
                                <label class="col-sm-4 control-label" for="haslo2">Podaj ponownie hasło:</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" id="haslo2" name="haslo2" required></input>
                                    <span class="help-block"></span>
                                    <span id="spanhaslo2" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div id="divdataur" class="form-group has-feedback">
                                <label class="col-sm-4 control-label" for="dataur">Data urodzenia:</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="dataur" name="dataur" max="<?php echo date("Y.m.d"); ?>" required placeholder="RRRR-MM-DD" value="<?php echo $_SESSION['dataurodzenia']; ?>"></input>
                                    <span class="help-block"></span>
                                    <span id="spandataur" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div id="divemailu" class="form-group has-feedback">
                                <label class="col-sm-4 control-label" for="emailu">Email:</label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" id="emailu" name="emailu" required value="<?php echo $_SESSION['mail']; ?>"></input>
                                    <span class="help-block"></span>
                                    <span id="spanemailu" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div> 


                            <div> 
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div id="submit" class="col-md-4"><button type="submit" class=" btn btn-block btn-warning">Wyślij</button></div>
                                    <div class="col-md-4"></div>
                                </div>  
                            </div>


                        </form>

                        <div> 
                            <div class="row">
                                <div class="col-md-4"></div>

                                <div id="submit" class="col-md-4"> <a class=" btn btn-block btn-success" href="index.php?t=foto"> Dodaj zdjęcie</a>
                                    <div class="col-md-4"></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>

