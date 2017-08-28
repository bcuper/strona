<?php
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Nie masz uprawnień</div>';
            echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
            echo'</div></div>';
    exit();
}
    // $nazwa[][0] = 'id';              $nazwa[][1] = 'id' $nazwa[][2] = 'Id'; $nazwa [][3] = 'id' $nazwa[][4] = 'text'; 
    //  id elementu  input glownego      id z bazy                       id z do zm                 typ                        nazwa
    $nazwa[0][0] = 'id';            $nazwa[0][1] = 'id';              $nazwa[0][2] = 'id';        $nazwa[0][3] = 'text';   $nazwa[0][4] = 'Id';                   
    $nazwa[1][0] = 'imie';          $nazwa[1][1] = 'imie';            $nazwa[1][2] = 'imie';      $nazwa[1][3] = 'text';   $nazwa[1][4] = 'Imię';                 
    $nazwa[2][0] = 'nazwisko';      $nazwa[2][1] = 'nazwisko';        $nazwa[2][2] = 'nazwisko';  $nazwa[2][3] = 'text';   $nazwa[2][4] = 'Nazwisko'; 
    $nazwa[3][0] = 'loginu';        $nazwa[3][1] = 'login';           $nazwa[3][2] = 'login';     $nazwa[3][3] = 'text';   $nazwa[3][4] = 'Login'; 
    $nazwa[4][0] = 'datautw';       $nazwa[4][1] = 'datautworzenia';  $nazwa[4][2] = 'datautw';   $nazwa[4][3] = 'date';   $nazwa[4][4] = 'Data utworzenia konta'; 
    $nazwa[5][0] = 'dataur';        $nazwa[5][1] = 'dataurodzenia';   $nazwa[5][2] = 'dataur';    $nazwa[5][3] = 'date';   $nazwa[5][4] = 'Data urodzenia'; 
    $nazwa[6][0] = 'emailu';        $nazwa[6][1] = 'mail';            $nazwa[6][2] = 'mail';      $nazwa[6][3] = 'email';  $nazwa[6][4] = 'Email'; 
    $nazwa[7][0] = 'tel';           $nazwa[7][1] = 'tel';             $nazwa[7][2] = 'tel';       $nazwa[7][3] = 'text';   $nazwa[7][4] = 'Telefon'; 
    $nazwa[8][0] = 'active';        $nazwa[8][1] = 'active';          $nazwa[8][2] = 'active';    $nazwa[8][3] = 'text';   $nazwa[8][4] = 'Konto aktywne'; 
    $nazwa[9][0] = 'admin';         $nazwa[9][1] = 'admin';           $nazwa[9][2] = 'admin';     $nazwa[9][3] = 'text';   $nazwa[9][4] = 'Konto administratora'; 
    
    $foto[0][0] = 'fotonazwaa';    $foto[0][1] = 'fotonazwa';      $foto[0][2] = 'Nazwa';
    $foto[1][0] = 'fototypa';      $foto[1][1] = 'fototyp';        $foto[1][2] = 'Typ';
    $foto[2][0] = 'fotosizea';     $foto[2][1] = 'fotosize';       $foto[2][2] = 'Rozmiar w KB';
    $foto[3][0] = 'fotozawa';      $foto[3][1] = 'fotozaw';        $foto[3][2] = 'Zawartość';
    
    
    $dataur[0][0] = 'dzien';        $dataur[0][1] = 1;      $dataur[0][2] = 31;         $dataur[0][3] = 'Dzień';
    $dataur[1][0] = 'miesiac';      $dataur[1][1] = 1;      $dataur[1][2] = 12;         $dataur[1][3] = 'Miesiąc';   
    $dataur[2][0] = 'rok';          $dataur[2][1] = 1940;   $dataur[2][2] = date("Y");  $dataur[2][3] = 'Rok';
  
    $dbh = bd();
    ?>
    <div class="container bs-docs-container">
        <h2>Ustawienia użytkowników</h2>
        <div class="row">
            <form class="form-inline form-group" action="index.php?t=admin" method="POST">
                <div id="loginsel" class="form-inline form-group">            
                    <label  class="col-sm-4 control-label " for="loginsel">Wybierz login:</label> 
                    <select class="form-control col-md-4 " name="loginsel">
                        <?php
                        try{
                            $temp = $dbh->query('SELECT login FROM uzytkownicy');
                        while ($row = $temp->fetch()) {
                            echo '<option';
                            if (isset($_POST['loginsel']) && $row[0] == $_POST['loginsel'])
                                echo ' selected ';
                            else
                                echo '';
                            echo '>' . $row[0] . '</option>';
                        }
                        
                    echo '</select>
                    &nbsp;&nbsp;<button class="btn btn-default">Wybierz</button>';
                        } catch (Exception $ex) {
                        die ('Błąd połączenia z bazą danych, ' . $ex->getMessage());
                        }
                   ?>     
            </form>
        </div>
    </div>
    <br>
    <?php
    if (isset($_POST['loginsel'])) {
       
          $login = $_POST['loginsel'];
        $temp = $dbh->prepare('SELECT * FROM uzytkownicy WHERE login = :login');
        $temp->bindValue(':login', $login, PDO::PARAM_STR);
        $temp->execute();
        $row = $temp->fetch();  
        
        
       
        for ($i = 0; $i < 10; $i++){ //zapisanie danych z bd do tablicy nazwa
            $nazwa[$i][5] = $row[$nazwa[$i][1]];
        }                
        for ($i = 0; $i < 4; $i++){ //zapisanie danych o foto z bd
            if ($i == 2) $foto[$i][5] = $row[$foto[$i][1]] / 1000; 
            else $foto[$i][5] = $row[$foto[$i][1]];
        }      
        ?>      
        <div>
            <div class="row">
                <div>
                    <form class="form-horizontal form-group" action="index.php?t=admin" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $nazwa[0][5]; ?>">
                        <input type="hidden" name="loginuz" id="loginuz" value="<?php echo $nazwa[3][5]; ?>">
                        <input type="hidden" name="emailuz" id="emailuz" value="<?php echo $nazwa[6][5]; ?>">
                        
                        <?php
                        for ($i = 1; $i < 10; $i++){
                            if ($i != 4 && $i != 5) echo '<div id="div'. $nazwa[$i][0] .'" class="form-group form-horizontal has-feedback">';
                            else echo '<div id="div'. $nazwa[$i][0] .'" class="form-group form-horizontal">';                            
                            echo '<label class="col-sm-4 control-label " for="' . $nazwa[$i][0] . '">' . $nazwa[$i][4] . ':</label>';
                              echo '<div class="col-md-4">';
                            if ($i != 9 && $i != 8 && $i != 4 && $i != 5){                              
                                echo '<input type="' . $nazwa[$i][3] . '" id="' . $nazwa[$i][0]. '" name="' . $nazwa[$i][0] . '" required  class="form-control" value="' . $nazwa[$i][5]. '">'; 
                            }elseif($i == 9 || $i == 8){
                                //admin i active
                                echo '<select class="form-control" id="' . $nazwa[$i][0]. '" name="' . $nazwa[$i][0] . '">';
                                for ($j = 0; $j < 2; $j++){
                                    echo '<option value="' . $j . '"'; 
                                    if ($nazwa[$i][5] == $j) echo ' selected ';
                                    echo '>' . $czy[$j] . '</option>';
                                }                         
                                echo '</select>';
                            } else{
                                //dataur i datautw  
                                list($dataur[2][4], $dataur[1][4], $dataur[0][4]) = explode("-", $nazwa[$i][5], 3);
                           echo '<div class="form-inline">';
                                for ($k = 0; $k < 3; $k++){
                                   // echo '<label>'.$dataur[$k][3].':</label>';
                                    echo '<select class="form-control" id="' . $nazwa[$i][0].$dataur[$k][0] . '" name="' . $nazwa[$i][0].$dataur[$k][0] . '">';
                                        for ($j = $dataur[$k][1]; $j <= $dataur[$k][2]; $j++){
                                            echo '<option value="' . $j . '"'; 
                                            if ($dataur[$k][4] == $j) echo ' selected ';
                                            if($k == 1) echo '>' . $nazwamiesiaca[$j] . '</option>';
                                            else echo '>' . $j . '</option>';
                                        }                         
                                echo '</select>&nbsp;&nbsp;'; 
                                }
                        echo '</div>';
                            }                           
                            echo '<span class="help-block"></span>';
                            echo '<span id="span' . $nazwa[$i][0] . '" class="glyphicon form-control-feedback" aria-hidden="true"></span>  ';
                            echo '</div>';
                            echo '</div>';
                        }                     
                        ?>
                        <div id="divzdj">
                            <table class="table table-bordered table-condensed text-center">
                                <thead>                                
                                    <tr>
                                        <?php 
                                        for ($i = 0; $i < 4; $i++){
                                            echo '<td>' . $foto[$i][2]. '</td>';
                                        }
                                    ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        for ($i = 0; $i < 3; $i++){
                                            echo '<td>' . $foto[$i][5]. '</td>';
                                        }
                                    ?>
                                    <td><?php echo '<img height="200" src="data:image/jpeg;base64,' . base64_encode($foto[3][5]) . '"/>'; ?> </td>
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
                        <?php 
                        for ($i = 0; $i < 10; $i++){
                            echo '<input type="hidden" name="' . $nazwa[$i][0] . '" id="' . $nazwa[$i][0] . '" value="' . $nazwa[$i][5] . '">';
                        }
                        ?>             
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
        isset($_POST['datautwrok']) && isset($_POST['datautwmiesiac']) &&isset($_POST['datautwdzien']) &&isset($_POST['dataurrok']) && isset($_POST['dataurmiesiac']) && isset($_POST['dataurdzien']) && isset($_POST['emailu']) && isset($_POST['active']) && isset($_POST['admin']) && isset($_POST['tel'])) {

    for ($i = 0; $i < 10; $i++){
       if ($i != 4 && $i != 5) $$nazwa[$i][0] = $_POST[$nazwa[$i][0]];
       else $$nazwa[$i][0] = $_POST[$nazwa[$i][0].'rok'].'-'.$_POST[$nazwa[$i][0].'miesiac'].'-'.$_POST[$nazwa[$i][0].'dzien'];
    }
    
    $waliderror = 0;
            do{
                for($i = 1; $i < 4; $i++){
                    walidacja1($$nazwa[$i][0], $nazwa[$i][1]);
                }
            } while ($waliderror != 0);
            
    if($waliderror != 0){
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Popraw dane. ';
        echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
        echo'</div></div>'; 
    
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $emailu)) {
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Wprowadzony e-mail jest za krótki, lub niepoprawny, musi zawierać znak @. ';
        echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
        echo'</div></div>';
    }elseif(waliddata($_POST['dataurdzien'], $_POST['dataurmiesiac'], $_POST['dataurrok']) == 0){
         echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo 'Wprowadzona data jest niepoprawna, nie ma takiej liczby dni w tym miesiącu ';
        echo '<br><a href="index.php?t=set" class="alert-link">Powrót</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php?t=set" />';
        echo'</div></div>';              
    } else {
        
            //poprawianie danych bez zdj    
       
            uaktualnijdane($id, $loginu, $imie, $nazwisko, $dataur, $emailu, $tel, $dbh);
            $temp = $dbh->prepare('UPDATE uzytkownicy SET  datautworzenia = :datautw, active = :active, admin = :admin WHERE id = :id');
            $temp->bindValue(':datautw', $datautw, PDO::PARAM_STR);
            $temp->bindValue(':active', $active, PDO::PARAM_BOOL);
            $temp->bindValue(':admin', $admin, PDO::PARAM_BOOL);
            $temp->bindValue(':id', $id, PDO::PARAM_INT);
            $temp->execute();
            echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-success" role="alert">Uaktualniono dane ';
    
            echo'</div></div>';
        
    }
} 
?>