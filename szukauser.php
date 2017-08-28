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
$szukaj[0][0] = 'id';       $szukaj[0][1] = 'Lp.';
$szukaj[1][0] = 'login';    $szukaj[1][1] = 'Login';
$szukaj[2][0] = 'imie';     $szukaj[2][1] = 'Imię';
$szukaj[3][0] = 'nazwisko'; $szukaj[3][1] = 'Nazwisko';
$szukaj[4][0] = 'mail';     $szukaj[4][1] = 'Email';
$szukaj[5][0] = 'tel';      $szukaj[5][1] = 'Telefon';
$szukaj[6][0] = 'fotozaw';  $szukaj[6][1] = 'Zdjęcie';
?>

<div class="container bs-docs-container">
    <h2>Szukaj użytkownika</h2>
    <form action = "index.php?t=szukaju" method = "GET">
        <div>
            <input type = "hidden" name = "t" value="szukaju" /> 
            <input type = "text" name = "nazwa" />
            <input type = "submit" value = "Szukaj" />
        </div>
    </form>
    <br>
    <div>
        <table class="table table-bordered table-condensed table-hover text-center">
            <thead class="text-center">
                <tr>
                    <?php
                    if (!empty($_GET['nazwa'])) {
                        for ($i = 0; $i < 6; $i++) {
                            echo '<th> ' . $szukaj[$i][1];
                            echo '<a href="index.php?t=szukaju&nazwa=' . $_GET['nazwa'] . '&posort=' . $szukaj[$i][0] . ' DESC"><span type="submit" class="glyphicon glyphicon-arrow-down"></span></a>                        
                    <a href="index.php?t=szukaju&nazwa=' . $_GET['nazwa'] . '&posort=' . $szukaj[$i][0] . ' ASC"><span class="glyphicon glyphicon-arrow-up"></span></a>';
                            echo '</th>';
                        }
                    } else {
                        for ($i = 0; $i < 6; $i++) {
                            echo '<th> ' . $szukaj[$i][1];
                            echo '<a href="index.php?t=szukaju&posort=' . $szukaj[$i][0] . ' DESC"><span type="submit" class="glyphicon glyphicon-arrow-down"></span></a>                        
                    <a href="index.php?t=szukaju&posort=' . $szukaj[$i][0] . ' ASC"><span class="glyphicon glyphicon-arrow-up"></span></a>';
                            echo '</th>';
                        }
                    }
                    ?>
                <th>
                    Zdjęcie                    
                </th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'bd.php';
                if (empty($_GET['posort']) && empty($_GET['nazwa'])) //gdy nic nie podano
                    $sql = "SELECT id, login, imie, nazwisko, mail, tel, fotozaw FROM uzytkownicy";
                elseif (!empty($_GET['nazwa']) && empty($_GET['posort'])) { // gdy wyszukano
                    $zap = $_GET['nazwa'];
                    $sql = "SELECT id, login, imie, nazwisko, mail, tel, fotozaw FROM uzytkownicy WHERE id LIKE '%" . $zap . "%' OR login LIKE '%" . $zap . "%' OR imie LIKE '%" . $zap . "%' OR nazwisko LIKE '%" . $zap . "%' OR mail LIKE '%" . $zap . "%'";
                } elseif (empty($_GET['nazwa']) && !empty($_GET['posort'])) { // gdy posortowano
                    $posort = $_GET['posort'];
                    $sql = "SELECT id, login, imie, nazwisko, mail, tel, fotozaw FROM uzytkownicy ORDER BY " . $posort . "";
                } elseif (!empty($_GET['nazwa']) && !empty($_GET['posort'])) { // gdy wyszukano i posortowano
                    $posort = $_GET['posort'];
                    $zap = $_GET['nazwa'];
                    $sql = "SELECT id, login, imie, nazwisko, mail, tel, fotozaw FROM uzytkownicy WHERE id LIKE '%" . $zap . "%' OR login LIKE '%" . $zap . "%' OR imie LIKE '%" . $zap . "%' OR nazwisko LIKE '%" . $zap . "%' OR mail LIKE '%" . $zap . "%' ORDER BY " . $posort . "";
                }
                $result = mysqli_query($link, $sql) or die('Error, query failed');
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    if (!empty($_GET['nazwa']))
                        echo '<td>' . str_ireplace($_GET['nazwa'], '<b>' . $_GET['nazwa'] . '</b>', $row[0]) . '</td><td>' . str_ireplace($_GET['nazwa'], '<b>' . $_GET['nazwa'] . '</b>', $row[1]) . '</td><td>' . str_ireplace($_GET['nazwa'], '<b>' . $_GET['nazwa'] . '</b>', $row[2]) . '</td><td>' . str_ireplace($_GET['nazwa'], '<b>' . $_GET['nazwa'] . '</b>', $row[3]) . '</td><td>' . str_ireplace($_GET['nazwa'], '<b>' . $_GET['nazwa'] . '</b>', $row[4]) . '</td><td>' . str_ireplace($_GET['nazwa'], '<b>' . $_GET['nazwa'] . '</b>', $row[5]) . '</td><td><img height="50"  src="data:image/jpeg;base64,' . base64_encode($row[6]) . '"/></td>';
                    else
                        echo '<td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td>' . $row[5] . '</td><td><img height="50"  src="data:image/jpeg;base64,' . base64_encode($row[6]) . '"/></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>

        </table>
    </div>
</div>


        <?php


