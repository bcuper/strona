<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert">Nie jesteś zalogowany</div>';
    echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
    echo'</div></div>';
    exit();
} 
        $nazwa[0][0] = 'id';        $nazwa[0][2] = 'Id: ';
        $nazwa[1][0] = 'imie';      $nazwa[1][2] = 'Imię: ';
        $nazwa[2][0] = 'nazwisko';  $nazwa[2][2] = 'Nazwisko: ';
        $nazwa[3][0] = 'loginu';    $nazwa[3][2] = 'Login: ';
        $nazwa[4][0] = 'emailu';    $nazwa[4][2] = 'Email: ';
        $nazwa[5][0] = 'datautw';   $nazwa[5][2] = 'Data utworzenia konta: ';
        $nazwa[6][0] = 'dataur';    $nazwa[6][2] = 'Data urodzenia: ';
        $nazwa[7][0] = 'active';    $nazwa[7][2] = 'Konto aktywne: ';
        $nazwa[8][0] = 'admin';     $nazwa[8][2] = 'Konto administratora: ';


        if (!isset($_POST['conf']) || $_POST['conf'] != 1) { //czy potwierdzone
            //brak potwierdzenia
            if (isset($_POST['id']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['loginu']) &&
                    isset($_POST['datautw']) && isset($_POST['dataur']) && isset($_POST['emailu']) && isset($_POST['active']) && isset($_POST['admin'])) {

               for ($i = 0; $i < 9; $i++){
                   $nazwa[$i][1] = $_POST[$nazwa[$i][0]];
               }               
                //zapytanie o potwierdzenie
                ?>                
                <div class="container">
                    <div class="alert alert-danger" role="alert">Czy usunąć użytkownika: 
                        <table><tbody>
                        <?php
                        for ($i = 0; $i < 7; $i++){
                            echo '<tr><td>' .$nazwa[$i][2] . '</td><td>' . $nazwa[$i][1] . '</td></tr>';
                        }
                        ?>
                            </tbody></table>
                    </div></div><div>
                    <form class="form-horizontal form-group" action="index.php?t=usun" method="POST">                        
                        <?php
                        for ($i = 0; $i < 9; $i++){
                            echo '<input type="hidden" name="' . $nazwa[$i][0] . '" id="' . $nazwa[$i][0] . '" value="' . $nazwa[$i][1] . '">';
                        }
                        ?>
                        <input type="hidden" name="conf" id="conf" value="1">
                        <div> 
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div id="submit" class="col-md-2"><button type="submit" class=" btn btn-block btn-danger">Usuń użytkownika</button></div>
                                <div class="col-md-2"><a class="btn btn-block btn-success" href="index.php">Wróć</a></div>
                                <div class="col-md-4"></div>
                            </div>  
                        </div>
                    </form>
                </div>
                <?php
            }
        } else {
            //gdy potwierdzono
            if (isset($_POST['id']) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['loginu']) &&
                    isset($_POST['datautw']) && isset($_POST['dataur']) && isset($_POST['emailu']) && isset($_POST['active']) && isset($_POST['admin'])) {
                for ($i = 0; $i < 9; $i++){
                   $$nazwa[$i][0] = $_POST[$nazwa[$i][0]];
               }              
                   
                    // usuwanie konta
                    mysqli_query($link, "SET NAMES 'utf8'");
                    $bd = bd();
                    $temp = $bd->prepare('DELETE FORM uzytkownicy WHERE imie = :imie AND nazwisko = :nazwisko AND login = :loginu AND dataurodzenia = :dataur AND datautworzenia = :datautw AND mail = :emailu AND active = :active AND admin = :admin AND id = :id');
                    $temp->bindValue(':imie', $imie, PDO::PARAM_STR);
                    $temp->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
                    $temp->bindValue(':loginu', $loginu, PDO::PARAM_STR);
                    $temp->bindValue(':dataur', $dataur, PDO::PARAM_STR);
                    $temp->bindValue(':datautw', $datautw, PDO::PARAM_STR);
                    $temp->bindValue(':emailu', $emailu, PDO::PARAM_STR);
                    $temp->bindValue(':active', $active, PDO::PARAM_BOOL);
                    $temp->bindValue(':admin', $admin, PDO::PARAM_BOOL);
                    $temp->bindValue(':id', $id, PDO::PARAM_INT);
                    $temp->execute();
                    echo '<div class="jumbotron"><div class="container">';
                    echo '<div class="alert alert-success" role="alert">Usunięto użytkownika ';
                    echo '<a class="btn btn-block btn-success"href="index.php">Wróć</a></div>';
                   
                
            }
        }
    

