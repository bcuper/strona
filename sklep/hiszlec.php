<?php
if ($_SESSION['zalogowany'] != 1) {
    echo '<div class="jumbotron">';
    echo '<div class="container">';
    echo '<div class="alert alert-danger alert-dismissable fade-in" role="alert">';
    echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo 'Nie jesteś zalogowany';
    echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    exit();
}
$idusr = $_SESSION['id'];
echo '<div class="container bs-docs-container">';
echo '<h2>Historia zleceń</h2>';
echo '<table class="table table-bordered table-condensed table-hover text-center">';
echo '<thead><th>Nr.</th><th>Nazwa</th><th>Ilość</th><th>Cena</th><th>Cena do zapłaty</th><th>Adres</th></thead>';
echo '<tbody>';
$bd = bd();
include 'bd.php';
$sql = "SELECT * FROM zlecenia WHERE iduser = '" . $idusr . "'";
$result = mysqli_query($link, $sql) or die('Error, query failed');
$lp = 1;
while ($row = mysqli_fetch_array($result)) {
    echo '<tr><td>' . $lp . '</td><td>'; //lp
    $arty = rozbijart($row[2]);
    for ($i = 0; $i < count($arty); $i++){
       
            echo pnazwa($arty[$i][0], $bd).'<br>'; //nzwaprod
        
    }
    echo '</td><td>';
    for ($i = 0; $i < count($arty); $i++){
        
            echo $arty[$i][1].'<br>'; //ilosc prod
        
    }
   
    echo '</td><td>';
    for ($i = 0; $i < count($arty); $i++){
        
    echo $lacznie[$i] = getcena($arty[$i][0], $arty[$i][1], $bd).'<br>'; //cena za prod
        
    }
     echo '</td><td>';
    
        
            echo array_sum($lacznie); //cena za prod
        
    
   
    echo '</td><td>' . adresyid($row[3], $bd) . '</td></tr>'; //ares 
    $lp++;
}

echo '</tbody></table>';
?>
