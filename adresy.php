<div class="container bs-docs-container">
    <h2>Dodawanie adresu</h2>
    <?php
    $adres[0][0] = 'Miejscowość';       $adres[0][1] = 'miejscowosc';
    $adres[1][0] = 'Kod pocztowy';      $adres[1][1] = 'kodpocztowy';
    $adres[2][0] = 'Ulica';             $adres[2][1] = 'ulica';
    $adres[3][0] = 'Nr. domu';          $adres[3][1] = 'nrdomu';
    $adres[4][0] = 'Nr. mieszkania';    $adres[4][1] = 'nrmiesz';   
    ?>
    <div>
        <form class="form-horizontal form-group" action="index.php?t=adr" method="POST">
            <?php
            for ($i = 0; $i < 5; $i++) {
                echo '<div id="div' . $adres[$i][1] . '" class="form-group';
                if ($i != 1)
                    echo ' has-feedback';
                echo '">';
                echo '<label  class="col-sm-4 control-label" for="' . $adres[$i][1] . '">' . $adres[$i][0] . ' :</label>';
                echo '<div class="col-md-4';
                if ($i == 1) {
                    echo ' form-inline">';
                    echo '<input type="text" id="kodpocz1" name="kodpocz1" required  class="form-control" value=""  maxlength="2" size="1"></input>';
                    echo '-<input type="text" id="kodpocz2" name="kodpocz2" required  class="form-control" value=""  maxlength="3" size="1"></input>';
                    echo '<span id="helpkod" class="help-block"></span>';
                } else {
                    echo '"><input type="text" id="' . $adres[$i][1] . '" name="' . $adres[$i][1] . '" required  class="form-control" value=""></input>';
                    echo '<span class="help-block"></span>';
                }
                echo '<span id="span' . $adres[$i][1] . '" class="glyphicon form-control-feedback" aria-hidden="true"></span> ';
                echo '</div></div>';
            }
            ?>
            <div> 
                <div class="row">
                    <div class="col-md-4"></div>
                    <div id="submit" class="col-md-4"><button type="submit" class=" btn btn-block btn-warning">Wyślij</button></div>
                    <div class="col-md-4"></div>
                </div>  
            </div>
        </form>
    </div>

</div>
<?php
 if (isset($_POST['miejscowosc']) && isset($_POST['kodpocz1']) && isset($_POST['kodpocz2']) 
            && isset($_POST['ulica']) && isset($_POST['nrdomu']) && isset($_POST['nrmiesz'])) {

        foreach ($_POST as $key => $values) {
            $$key = $values;
        }
        $kodpocztowy = $kodpocz1 . '-' . $kodpocz2;
        //----------------------------

        $dbh = bd();
       
             $temp = $dbh->prepare('INSERT INTO adresy (miejscowosc, kodpocztowy, ulica, nrdomu, nrmieszkania, iduz) VALUES (:miejscowosc, :kodpocztowy, :ulica, :nrdomu, :nrmiesz, :id)');
        $temp->bindValue(':miejscowosc', $miejscowosc, PDO::PARAM_STR);
        $temp->bindValue(':kodpocztowy', $kodpocztowy, PDO::PARAM_STR);
        $temp->bindValue(':ulica', $ulica, PDO::PARAM_STR);
        $temp->bindValue(':nrdomu', $nrdomu, PDO::PARAM_STR);
        $temp->bindValue(':nrmiesz', $nrmiesz, PDO::PARAM_STR);
        $temp->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
        $temp->execute();
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Dodano adres</div>';
        echo'</div></div>';
        
       
        
            }