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
include 'bd.php';
$dbh = bd();
echo '<div class="container bs-docs-container">';
echo '<h2>Produkty</h2>';

if (isset($_POST['wybrilosc']) && isset($_POST['idprod']) && isset($_POST['nazwaprod'])){
                $wybrilosc2 = $_POST['wybrilosc'];
                $idprod2 = $_POST['idprod'];
                $nazwaprod2 = $_POST['nazwaprod'];
                $cenaprod2 = $_POST['cenaprod'];
                $wylcena2 = $_POST['wylcena2'];
                $iloscprod = $_POST['iloscprod'];
                
                if (!isset ($_SESSION['koszyk'])){
                    $koszyk[0][0] = 'Id produktu';
                    $koszyk[0][1] = 'Nazwa produktu';
                    $koszyk[0][2] = 'Cena produktu';
                    $koszyk[0][3] = 'Ilość dostępnego produktu';
                    $koszyk[0][4] = 'Wybrana ilość produktu';
                    $koszyk[0][5] = 'Cena do zapłaty';
                    $_SESSION['koszyk'] = $koszyk;               
                    
                }
                $koszyk = $_SESSION['koszyk'];
                $liczba = count($koszyk);
                $koszyk[$liczba][0] = $idprod2;   
                $koszyk[$liczba][1] = $nazwaprod2;
                $koszyk[$liczba][2] = $cenaprod2;
                $koszyk[$liczba][3] = $iloscprod;
                $koszyk[$liczba][4] = $wybrilosc2;
                $koszyk[$liczba][5] = $wylcena2;                
                
                $_SESSION['koszyk'] = $koszyk;
            
                echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
                echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo 'Dodano do koszyka '. $nazwaprod2 . ' w ilości ' . $wybrilosc2 . ' </div>';  
}
            
?>
    <div class="row">
        <form class="form-inline form-group" action="index.php?t=art" method="POST">
            <div id="loginsel" class="form-inline form-group">            
                <label  class="col-sm-4 control-label " for="prodsel">Wybierz produkt:</label> 
                <select class="form-control col-md-4 " name="prodsel">
                    <?php
                    $temp = $dbh->query('SELECT nazwa FROM artykuly');
                    while ($row1 = $temp->fetch()) {
                        echo '<option';
                        if (isset($_POST['prodsel']) && $row1[0] == $_POST['prodsel'])
                            echo ' selected ';
                        else
                            echo '';
                        echo '>' . $row1[0] . '</option>';
                    }
                    ?>
                </select>
                &nbsp;&nbsp;<button class="btn btn-default">Wybierz</button>
        </form>
    </div>
</div>
<?php
if (isset($_POST['prodsel'])) {
    ?>
    <div class="row">
        <table class="table table-bordered table-condensed ">
            <tbody>  
                <?php
                $temp1 = $dbh->prepare('SELECT * FROM artykuly WHERE nazwa = :nazwa');
                $temp1->bindValue(':nazwa', $_POST['prodsel'], PDO::PARAM_STR);
                $temp1->execute();
                $row2 = $temp1->fetch();               


                echo '<tr><th>Nazwa </th><td>' . $row2[1] . '</td></tr>';
                echo '<tr><th>Cena </th><td>' . $row2[2] . '</td></tr>';
                echo '<tr><th>Ilość </th><td>';
                if ($row2[3] > 0)
                    echo 'Towar dostępny';
                else
                    echo 'Towar niedostępny';
                echo '</td></tr>';
                echo '<tr><th>Opis </th><td>' . $row2[4] . '</td></tr>';
                if ($row2[3] != 0) {
                    ?>
                    <div>
                        <tr><td></td><td>
                            <form action="index.php?t=art" method="POST">
                                <input type="hidden" name="idprod" id="idprod" value="<?php echo $row2[0]; ?>"/>
                                <input type="hidden" name="nazwaprod" id="nazwaprod" value="<?php echo $row2[1]; ?>"/>
                                <input type="hidden" name="cenaprod" id="cenaprod" value="<?php echo $row2[2]; ?>"/>
                                <input type="hidden" name="iloscprod" id="iloscprod" value="<?php echo $row2[3]; ?>"/>
                                <input type="hidden" name="prodsel" id="prodsel" value="<?php echo $_POST['prodsel']; ?>"/>

                            <input type="submit" value="Dodaj do koszyka" /></td>
                        </form>
                        </tr>
                        </table>
                    </div>
                    <?php
                    echo '</tbody></table>';
                }
            }
//------------------------------------------------------------
            if (isset($_POST['idprod']) && isset($_POST['iloscprod']) && isset($_POST['cenaprod']) && isset($_POST['nazwaprod'])) {

                $idprod = $_POST['idprod'];
                $iloscprod = $_POST['iloscprod'];
                $cenaprod = $_POST['cenaprod'];
                $nazwaprod = $_POST['nazwaprod'];
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
                            <td><?php echo $iloscprod; ?> </td>
                            <form action="index.php?t=art" method="POST">
                            <td><select name="wybrilosc" id="wybrilosc" onchange="obliczcene()" >
                                    <?php
                                    for ($i = 1; $i <= $iloscprod; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select> </td>                                
                                <input type="hidden" name="idprod" id="idprod" value="<?php echo $row2[0]; ?>"/>
                                <input type="hidden" name="nazwaprod" id="nazwaprod" value="<?php echo $row2[1]; ?>"/>
                                <input type="hidden" name="cenaprod" id="cenaprod" value="<?php echo $row2[2]; ?>"/>
                                <input type="hidden" name="wylcena2" id="wylcena2" value="1"/>
                               
                                <input type="hidden" name="iloscprod" id="iloscprod" value="<?php echo $row2[3]; ?>"/>
                                <input type="hidden" name="prodsel" id="prodsel" value="<?php echo $_POST['prodsel']; ?>"/>   
                                <td><div id="wylcena">1</div></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td><td><input type="submit" value="Dodaj"/></td>
                        </form>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
            }
            
            ?>

            </div>

