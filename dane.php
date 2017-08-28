<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
     echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>Nie jesteś zalogowany</strong></div>';
            echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
            echo'</div></div>';
            exit();
        }
            $nazwa[0][0] = 'id';                $nazwa[0][1] = 'Id';
            $nazwa[1][0] = 'imie';              $nazwa[1][1] = 'Imię';
            $nazwa[2][0] = 'nazwisko';          $nazwa[2][1] = 'Nazwisko';
            $nazwa[3][0] = 'login';             $nazwa[3][1] = 'Login';
            $nazwa[4][0] = 'mail';              $nazwa[4][1] = 'Mail';
            $nazwa[5][0] = 'dataurodzenia';     $nazwa[5][1] = 'Data urodzenia';
            $nazwa[6][0] = 'datautworzenia';    $nazwa[6][1] = 'Data utworzenia';
            $nazwa[7][0] = 'tel';               $nazwa[7][1] = 'Telefon';
            $nazwa[8][0] = 'active';            $nazwa[8][1] = 'Konto aktywne';
            $nazwa[9][0] = 'admin';             $nazwa[9][1] = 'Konto admina';
            $nazwa[10][0] = 'adres';            $nazwa[10][1] = 'Adres';
            
            $adres = adresy($_SESSION['id'], bd());            

?>
<div class="container bs-docs-container">
<h2>Twoje dane:</h2>
<table class="table table-bordered table-condensed table-hover text-center" > 
    <tbody>
        <?php
        for ($i = 0; $i < 11; $i++){
            echo '<tr>';
            echo '<th>' . $nazwa[$i][1] . '</th>';
            if ($i == 9 || $i == 8 )  
                echo '<td>' . $czy[$_SESSION[$nazwa[$i][0]]] . '</td>';             
            elseif($i == 5 || $i == 6) {
                list($rok, $mies, $dzien) = explode("-", $_SESSION[$nazwa[$i][0]], 3);
                 echo '<td>' . $dzien . ' '. $nazwamiesiaca[$mies] .' '. $rok . '</td>';                  
            }  
            elseif ($i == 10){
                echo '<td><table class="table table-bordered table-condensed table-hover text-center"><tbody>';
                for ($j = 0; $j < count($adres); $j++){
                echo '<tr><td>' . $adres[$j] . '</td></tr>';                 
                }
                echo '</td></tbody></table>';
            }
                else
                echo '<td>' . $_SESSION[$nazwa[$i][0]] . '</td>';             
            echo '</tr>';
        }
        $bd = bd();
        $zdj = pokazzdj($_SESSION['id'], $bd);
        ?>
        <tr>
        <th>Zdjęcie</th>
        <td>
            <?php
            echo '<img height="200"  src="data:image/jpeg;base64,' . base64_encode($zdj['fotozaw']) . '"/>';
            ?>
            <br>
            <a href="index.php?t=foto" class="link">Zmień zdjęcie</a>
        </td>
        </tr>
    </tbody>
</table>

</div>
