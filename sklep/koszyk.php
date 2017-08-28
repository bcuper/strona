<?php
if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] != 1) {
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
    echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo 'Nie masz uprawnień</div>';
    echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
    echo'</div></div>';
    exit();
}
if (!isset($_SESSION['koszyk']) || $_SESSION['koszyk'] == 0) {
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
    echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo 'Koszyk jest pusty</div>';
    echo'</div></div>';
    exit();
}
$bd = bd();
?>

<div class="container bs-docs-container">
    <h2>Koszyk</h2>
    <?php
//-----------------------------------------------------------------------
// modyfikacja koszyka
    if (isset($_POST['wybrilosc']) && isset($_POST['idprod']) && isset($_POST['nazwaprod']) && isset($_GET['id2']) && isset($_SESSION['koszyk'])) {
        $id2 = $_GET['id2'];
        $wybrilosc2 = $_POST['wybrilosc'];
        $idprod2 = $_POST['idprod'];
        $nazwaprod2 = $_POST['nazwaprod'];
        $cenaprod2 = $_POST['cenaprod'];
        $wylcena2 = $_POST['wylcena2'];
        $iloscprod = iloscprod($idprod2);

        $koszyk = $_SESSION['koszyk'];
        $koszyk[$id2][0] = $idprod2;
        $koszyk[$id2][1] = $nazwaprod2;
        $koszyk[$id2][2] = $cenaprod2;
        $koszyk[$id2][3] = $iloscprod;
        $koszyk[$id2][4] = $wybrilosc2;
        $koszyk[$id2][5] = $wylcena2;

        $_SESSION['koszyk'] = $koszyk;

        echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Uaktualniono koszyk, pozycja ' . $nazwaprod2 . ' w ilości ' . $wybrilosc2 . ' </div>';
    }
//----------------------
// wyswietlanie zawartosci koszyka
    if (isset($_SESSION['koszyk'])) {
        $koszyk = $_SESSION['koszyk'];
        echo '<div class="row">';
        echo '<table class="table table-bordered table-condensed ">';
        foreach ($koszyk as $key => $value) {
            if ($key == 0)
                echo '<thead>';
            else
                echo '<tbody>';
            echo'<tr>';
            foreach ($value as $key2 => $value2) {
                if ($key == 0)
                    echo '<th>' . $value2 . '</th>';
                else
                    echo '<td>' . $value2 . '</td>';
            }
            if ($key != 0)
                echo '<td><a href="index.php?t=koszyk&id=' . $key . '">Zmień</a></td></tr>';
            if ($key == 0)
                echo '</thead>';
        }
        echo '</tbody></table>';
//---------------------------------------------------------------------
        //edycja produktu w koszyku
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $idprod = $koszyk[$id][0];
            $nazwaprod = $koszyk[$id][1];
            $cenaprod = $koszyk[$id][2];
            $iloscprod = iloscprod($idprod, $bd);
            $wybr = $koszyk[$id][4];
            $wyl = $koszyk[$id][5];
            ?>
            <div class="row">
                <table class="table table-bordered table-condensed table-hover text-center">
                    <thead>
                        <tr>
                        <th>Nazwa</th>
                        <th>Cena</th>
                        <th>Ilość towaru na magazynie</th>
                        <th>Ilość</th>
                        <th>Do zapłaty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td> <?php echo $nazwaprod; ?> </td>
                        <td> <?php echo $cenaprod; ?> </td>
                        <td> <?php echo $iloscprod; ?> </td>
                        <form action="index.php?t=koszyk&id2=<?php echo $id; ?>" method="POST">
                            <td><select name="wybrilosc" id="wybrilosc" onchange="obliczcene()" >
                                    <?php
                                    for ($i = 1; $i <= $iloscprod; $i++) {
                                        echo '<option ';
                                        if ($wybr == $i)
                                            echo ' selected ';
                                        else
                                            echo '';
                                        echo 'value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select> </td>                                
                            <input type="hidden" name="idprod" id="idprod" value="<?php echo $idprod; ?>"/>
                            <input type="hidden" name="nazwaprod" id="nazwaprod" value="<?php echo $nazwaprod; ?>"/>
                            <input type="hidden" name="cenaprod" id="cenaprod" value="<?php echo $cenaprod; ?>"/>
                            <input type="hidden" name="wylcena2" id="wylcena2" value=""/>

                            <input type="hidden" name="iloscprod" id="iloscprod" value="<?php echo $iloscprod; ?>"/>

                            <td><div id="wylcena" value=""><?php echo $wyl; ?></div></td>
                            </tr>
                            <tr>
                            <td colspan="4"></td><td><input type="submit" value="Zmień"/></td>
                        </form>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php
        }
        ?>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-2">
                <a class="btn btn-success btn-block" href="index.php?t=koszyk&zakup=1">Zakup</a>
            </div>
        </div>
    <div> <br>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2"><a class="btn btn-block btn-warning" href="index.php?t=koszyk&k=1">Usuń koszyk</a></div>
                        
                    </div>  
                </div>
    </div>
    <?php
    if (isset($_GET['zakup']) && $_GET['zakup'] == 1) {
        echo '<h2>Wybierz adres</h2>';
        ?>
        <div class="row">
            <form class="form-inline form-group" action="index.php?t=koszyk&zakup=1" method="POST">
                <div id="adressel" class="form-inline form-group">            
                    <label  class="col-sm-4 control-label " for="adresselsel">Wybierz adres:</label> 
                    <select class="form-control col-md-4 " name="adresselsel">
                        <?php
                        $adressel = adresy($_SESSION['id']); 
                        for ($i = 0; $i < count($adressel); $i++) {
                            echo '<option';
                            if (isset($_POST['adresselsel']) && ($i + 1) == getidadres($_POST['adresselsel'], $_SESSION['id'], $bd))
                                echo ' selected ';
                            else
                                echo '';
                            echo '>' . $adressel[$i] . '</option>';
                        }
                        
                        ?>
                    </select>
                    &nbsp;&nbsp;<button class="btn btn-default">Wybierz</button>
                </div>  
            </form>        
    </div>
<?php
}
    }
        //-------------------------------
    // zakup

    if (isset($_GET['zakup']) && $_GET['zakup'] == 1 && isset($_POST['adresselsel'])) {
        echo '<h2>Zakup</h2>';
        echo '<h2>'.$_POST['adresselsel'].'</h2>';
       
        $idad = getidadres($_POST['adresselsel'], $_SESSION['id'], $bd);
        echo $idad;
        ?>
        <div>
            <select name="wybadres">
                        <option></option>
                        <option></option>
                    </select>
            <form class="form-horizontal form-group" action="index.php?t=koszyk" method="POST">
             
                <input type="hidden" name="nradresu" id="nradresu" value="<?php echo $idad; ?>"/>
                <input type="hidden" name="potw" id="potw" value="1"/>
                
                <div> 
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div id="submit" class="col-md-4"><button type="submit" class=" btn btn-block btn-warning">Wyślij</button></div>
                        <div class="col-md-4"></div>
                    </div>  
                </div>
                </form>
            
                
         
        </div>
        <?php
    }
    //-----------------------------------
    //dodanie do zlecenia
    if (isset($_POST['nradresu']) && isset($_POST['potw']) && $_POST['potw'] == 1) {

    $nradresu = $_POST['nradresu'];   
    $iduser = $_SESSION['id'];

//---------------------------------
        $koszyk = $_SESSION['koszyk'];
        $liczba = count($koszyk);
        $idartydb = artykulybd($koszyk, 1, $liczba, 0);
//---------------------------------------
        include 'bd.php';
        mysqli_query($link, "SET NAMES 'utf8'");
        $temp = $bd->prepare('INSERT INTO zlecenia (iduser, idadresu, idarty, data VALUES (:iduser, :idadresu, :idarty, :data, now()');
        $temp->bindValue(';iduser', $iduser, PDO::PARAM_INT);
        $temp->bindValue(';idadresu', $nradresu, PDO::PARAM_INT);
        $temp->bindValue(';idarty', $idartydb, PDO::PARAM_INT);
        $temp->execute();
        
        for ($i = 1; $i < $liczba; $i++){
            $temp = $bd->prepare('UPDATE artykuly SET ilosc = (ilosc - :koszyk1) WHERE id = :id');
            $temp->bindValue(':koszyk1', $koszyk[$i][4], PDO::PARAM_INT);
            $temp->bindValue(':id', $koszyk[$i][0], PDO::PARAM_INT);
            $temp->execute();
            $koszyk[$i][3] = $koszyk[$i][3] - $koszyk[$i][4];
        }
        $_SESSION['koszyk'] = $koszyk;
         echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
         echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
         echo 'Przyjęto zamównienie </div>';
         unset($_SESSION['koszyk']);
        
    }
if (isset($_SESSION['koszyk']) && isset($_GET['k']) && $_GET['k'] == 1){
    unset($_SESSION['koszyk']);
    echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
    echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo 'Usunięto koszyk </div>';
}
function artykulybd($z, $iod, $ido, $i) {
    $d = $z[$iod][$i].'('.$z[$iod][4].')';
    for ($j = $iod + 1; $j < $ido; $j++) {
        $d .= ', ';
        $d .= $z[$j][$i].'('.$z[$j][4].')';        
    }
    return $d;
}

