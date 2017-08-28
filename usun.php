<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert">Nie jesteś zalogowany</div>';
    echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
    echo'</div></div>';
} else {
    if ($_SESSION['admin'] != 1) { // czy admin
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-danger" role="alert">Nie masz uprawnień</div>';
        echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
        echo '<a class="btn btn-block btn-success"href="index.php?t=admin">Wróć</a></div>';
        echo'</div></div>';
    } else {

        if (!isset($_POST['conf']) || $_POST['conf'] != 1) { //czy potwierdzone
            //brak potwierdzenia
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
                //zapytanie o potwierdzenie
                ?>
                
                <div class="container">
                    <div class="alert alert-danger" role="alert">Czy usuniąć użytkownika : <?php
                        echo $imie;
                        echo ' ';
                        echo $nazwisko;
                        echo ' ';
                        echo $loginu;                      
                        echo ' ';
                        echo $emailu;
                        echo ' ';
                        ?></div></div>
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
                        <input type="hidden" name="conf" id="conf" value="<?php echo 1; ?>">

                        <div> 
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div id="submit" class="col-md-2"><button type="submit" class=" btn btn-block btn-danger">Usuń użytkownika</button></div>
                                <div class="col-md-2"><a class="btn btn-block btn-success"href="index.php">Wróć</a></div>
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

                $id = $_POST['id'];
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $loginu = $_POST['loginu'];
                $datautw = $_POST['datautw'];
                $dataur = $_POST['dataur'];
                $emailu = $_POST['emailu'];
                $active = $_POST['active'];
                $admin = $_POST['admin'];


                if ($_SESSION['id'] == $id) { //czy nie jestes zalogowany na usuwane konto
                    echo '<div class="jumbotron"><div class="container">';
                    echo '<div class="alert alert-danger" role="alert">Nie możesz usunąć swojego konta</div>';
                    echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
                    echo '<a class="btn btn-block btn-success"href="index.php?t=admin">Wróć</a></div>';
                    echo'</div></div>';
                } else {

                    include 'bd.php';
                    // usuwanie konta
                    mysqli_query($link, "SET NAMES 'utf8'");
                    $sql = "DELETE FROM `uzytkownicy` WHERE imie = '$imie' AND nazwisko = '$nazwisko' AND login = '$loginu' AND dataurodzenia = '$dataur' AND datautworzenia = '$datautw' AND mail = '$emailu' AND active = '$active' AND admin = '$admin' AND id = '$id'";
                    $res = mysqli_query($link, $sql) or die("niepoprawne zapytanie: " . mysqli_errno($link));
                    echo '<div class="jumbotron"><div class="container">';
                    echo '<div class="alert alert-success" role="alert">Usunięto użytkownika ';
                    echo '<a class="btn btn-block btn-success"href="index.php?t=admin">Wróć</a></div>';
                    mysqli_close($link);
                }
            }
        }
    }
}
