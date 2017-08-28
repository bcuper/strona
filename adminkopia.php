<?php
if (!isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
    echo 'Nie masz uprawnień';
    exit();
}
    ?>
    <div class="container bs-docs-container">
        <h2>Ustawienia użytkowników</h2>
        <div class="row">

            <form class="form-inline form-group" action="index.php?t=admin" method="POST">
                <div id="loginsel" class="form-inline form-group">            
                    <label  class="col-sm-4 control-label " for="loginsel">Wybierz login:</label> 

                    <select class="form-control col-md-4 " name="loginsel">
                        <?php
                        include 'bd.php';
                        $query = "SELECT login FROM uzytkownicy ";
                        $result = mysqli_query($link, $query) or die('Error, query failed');
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option';
                            if (isset($_POST['loginsel']) && $row[0] == $_POST['loginsel'])
                                echo ' selected ';
                            else
                                echo '';
                            echo '>' . $row[0] . '</option>';
                        }
                        ?>
                    </select>

                    &nbsp;&nbsp;<button class="btn btn-default">Wybierz</button>

            </form>

        </div>

    </div>
    <br>

    <?php
    if (isset($_POST['loginsel'])) {
        $login = $_POST['loginsel'];
        include 'bd.php';
        $query = "SELECT * FROM uzytkownicy WHERE login='" . $login . "'";
        $result = mysqli_query($link, $query) or die('Error, query failed');
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        $imie = $row['imie'];
        $nazwisko = $row['nazwisko'];
        $mail = $row['mail'];
        $dataur = $row['dataurodzenia'];
        $datautw = $row['datautworzenia'];
        $active = $row['active'];
        $admin = $row['admin'];
        $fotonazwaa = $row['fotonazwa'];
        $fototypa = $row['fototyp'];
        $fotosizea = $row['fotosize'] / 1000; // rozmiar w KB
        $fotozawa = $row['fotozaw'];
        ?>      
        <div>
            <div class="row">
                <div>
                    <form class="form-horizontal form-group" action="index.php?t=admin" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="loginuz" id="loginuz" value="<?php echo $login; ?>">
                        <input type="hidden" name="emailuz" id="emailuz" value="<?php echo $mail; ?>">

                        <div id="divimie" class="form-group has-feedback">                    
                            <label  class="col-sm-4 control-label " for="imie">Imię:</label>
                            <div class="col-md-4 ">
                                <input type="text" id="imie" name="imie" required  class="form-control" value="<?php echo $imie; ?>">
                                <span class="help-block"></span>
                                <span id="spanimie" class="glyphicon form-control-feedback" aria-hidden="true"></span>                   
                            </div>
                        </div>


                        <div id="divnazwisko" class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="nazwisko">Nazwisko:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="nazwisko" name="nazwisko" required value="<?php echo $nazwisko; ?>"></input>
                                <span class="help-block"></span>
                                <span id="spannazwisko" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div id="divloginu"class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="loginu">Login:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="loginu" name="loginu" required value="<?php echo $login; ?>"></input>
                                <span class="help-block"></span>
                                <span id="spanloginu" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>


                        <div id="divdatautw" class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="datautw">Data utworzenia:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="datautw" name="datautw" required value="<?php echo $datautw; ?>"></input>
                                <span class="help-block"></span>
                                <span id="spandatautw" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div id="divdataur" class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="dataur">Data urodzenia:</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="dataur" name="dataur" max="<?php echo date("Y.m.d"); ?>" required placeholder="RRRR-MM-DD" value="<?php echo $dataur; ?>"></input>
                                <span class="help-block"></span>
                                <span id="spandataur" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div id="divemailu" class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="emailu">Email:</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="emailu" name="emailu" required value="<?php echo $mail; ?>"></input>
                                <span class="help-block"></span>
                                <span id="spanemailu" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div> 

                        <div id="divactive" class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="active">Aktywny:</label>
                            <div class="col-md-4">
                                <select class="form-control" name="active" value="<?php
                                if ($active == 0)
                                    echo 'NIE';
                                else
                                    echo 'TAK';
                                ?>">
                                    <option value="1" <?php if ($active == 1) echo 'selected'; ?> >TAK</option>
                                    <option value="0" <?php if ($active == 0) echo 'selected'; ?> >NIE</option>
                                </select>
                                <span class="help-block"></span>
                                <span id="spanactive" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div id="divadmin" class="form-group has-feedback">
                            <label class="col-sm-4 control-label" for="admin">Administrator:</label>
                            <div class="col-md-4">
                                <select class="form-control" name="admin" value="<?php
                                if ($admin == 0)
                                    echo 'NIE';
                                else
                                    echo 'TAK';
                                ?>">
                                    <option value="1" <?php if ($admin == 1) echo 'selected'; ?> >TAK</option>
                                    <option value="0" <?php if ($admin == 0) echo 'selected'; ?> >NIE</option>
                                </select>
                                <span class="help-block"></span>
                                <span id="spanadmin" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div id="divzdj">
                            <table class="table table-bordered table-condensed text-center">
                                <thead>                                
                                    <tr>
                                    <td>Nazwa</td>
                                    <td>Typ</td>
                                    <td>Rozmiar</td>
                                    <td>Zawartość</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td><?php echo $fotonazwaa; ?> </td>
                                    <td><?php echo $fototypa; ?> </td>
                                    <td><?php echo $fotosizea; ?> KB </td>
                                    <td><?php echo '<img height="200" src="data:image/jpeg;base64,' . base64_encode($fotozawa) . '"/>'; ?> </td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>



                        <div> 
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div id="submit" class="col-md-4"><button type="submit" class=" btn btn-block btn-warning">Zmień</button></div>
                                <div class="col-md-4"></div>
                            </div>  
                        </div>                 
                    </form>
                </div>

                <div>
                    <form class="form-horizontal form-group" action="index.php?t=usun" method="POST">

                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="imie" id="imie" value="<?php echo $imie; ?>">
                        <input type="hidden" name="nazwisko" id="nazwisko" value="<?php echo $nazwisko; ?>">
                        <input type="hidden" name="loginu" id="loginu" value="<?php echo $login; ?>">
                        <input type="hidden" name="datautw" id="datautw" value="<?php echo $datautw; ?>">
                        <input type="hidden" name="dataur" id="dataur" value="<?php echo $dataur; ?>">
                        <input type="hidden" name="emailu" id="emailu" value="<?php echo $mail; ?>">
                        <input type="hidden" name="active" id="active" value="<?php echo $active; ?>">
                        <input type="hidden" name="admin" id="admin" value="<?php echo $admin; ?>">

                        <div> 
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div id="submit" class="col-md-4"><button type="submit" class=" btn btn-block btn-danger">Usuń użytkownika</button></div>
                                <div class="col-md-4"></div>
                            </div>  
                        </div>

                    </form>
                </div>
            </div>      
        </div>
        </div>
        <?php
    }

if (isset($_POST['id']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['loginu']) &&
        isset($_POST['datautw']) && isset($_POST['dataur']) && isset($_POST['emailu']) && isset($_POST['active']) && isset($_POST['admin'])) {

    $id = $_POST['id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $loginu = $_POST['loginu'];
    $datautw = $_POST['datautw'];
    $dataur = $_POST['dataur'];
    $emailu = $_POST['emailu'];
    $active = $_POST['active'];
    $admin = $_POST['admin'];

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
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $emailu)) {
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @. ';
        echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
        echo'</div></div>';
    } else {
        //sprawdzenie czy zostało przekazane zdj
        if (isset($_FILES['foto']['size']) && $_FILES['foto']['size'] > 0) { // czy dodano zdj
            $fotonazwa = $_FILES['foto']['name'];
            $tmpnazwa = $_FILES['foto']['tmp_name'];
            $fotosize = $_FILES['foto']['size'];
            $fototyp = $_FILES['foto']['type'];

            if (strpos($fototyp, 'image') === 0) { //czy przeslany plik to obraz
                $fp = fopen($tmpnazwa, 'r');
                $fotozaw = fread($fp, filesize($tmpnazwa));
                $fotozaw = addslashes($fotozaw);
                fclose($fp);

                if (!get_magic_quotes_gpc()) {
                    $fotonazwa = addslashes($fotonazwa);
                }



                //uaktualnienie uzytkownika do bd ze zdj
                include 'bd.php';
                mysqli_query($link, "SET NAMES 'utf8'");
                $sql = "UPDATE `uzytkownicy` SET imie = '$imie', nazwisko = '$nazwisko', login = '$loginu', dataurodzenia = '$dataur', datautworzenia = '$datautw', mail = '$emailu', active = '$active', admin = '$admin', fotonazwa = '$fotonazwa', fototyp = '$fototyp', fotosize ='$fotosize', fotozaw = '$fotozaw' WHERE id = '$id'";
                $res = mysqli_query($link, $sql);
                echo '<div class="jumbotron"><div class="container">';
                echo '<div class="alert alert-success" role="alert">Uaktualniono dane ';
                mysqli_close($link);
            }
        } else {

            //poprawianie danych bez zdj
            include 'bd.php';
            mysqli_query($link, "SET NAMES 'utf8'");
            $sql = "UPDATE `uzytkownicy` SET imie = '$imie', nazwisko = '$nazwisko', login = '$loginu', dataurodzenia = '$dataur', datautworzenia = '$datautw', mail = '$emailu', active = '$active', admin = '$admin' WHERE id = '$id'";
            $res = mysqli_query($link, $sql);
            echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-success" role="alert">Uaktualniono dane ';

            mysqli_close($link);

            echo'</div></div>';
        }
    }
}
?>