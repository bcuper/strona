<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
     echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert">Nie jesteś zalogowany</div>';
    echo'</div></div>';
} else {
   
    if (isset($_FILES['foto']['size']) && $_FILES['foto']['size'] > 0 && isset($_POST['id'])) {
        $id = $_POST['id'];
        $fotonazwa = $_FILES['foto']['name'];
        $tmpnazwa = $_FILES['foto']['tmp_name'];
        $fotosize = $_FILES['foto']['size'];
        $fototyp = $_FILES['foto']['type'];
       
        if (strpos($fototyp, 'image') === 0) { //czy plik jest obrazem
            // gdy obraz
            $fp = fopen($tmpnazwa, 'r');
            $fotozaw = fread($fp, filesize($tmpnazwa));
            $fotozaw = addslashes($fotozaw);
            fclose($fp);

            if (!get_magic_quotes_gpc()) {
                $fotonazwa = addslashes($fotonazwa);
            }

            include 'bd.php';

            $query = "UPDATE uzytkownicy SET fotonazwa='$fotonazwa', fotosize='$fotosize', fototyp='$fototyp', fotozaw='$fotozaw' WHERE id='$id'";

            mysqli_query($link, $query) or die('Error, query failed');
            //poczatek komunikatu
             echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
            echo '<a href="index.php?t=foto" class="close" data-dismiss="alert" aria-label="close">&times;</a>';

            $query = "SELECT fotonazwa, fotozaw FROM uzytkownicy where id='" . $_SESSION['id'] . "'";
            $result = mysqli_query($link, $query) or die('Error, query failed');
            
            while ($row = mysqli_fetch_array($result)) {
                echo 'Załadowano zdjęcie: ' . $row[0] . '<br><br>';
                echo '<img height="200" src="data:image/jpeg;base64,' . base64_encode($row[1]) . '"/>';
                echo '<br> Zaloguj się ponownie ';
                echo '<a href="index.php?t=out" class="alert-link">Wyloguj się</a></div>';
                echo '<meta http-equiv="refresh" content="3; URL=index.php?t=out" />';
                
            }
            
            echo '</div>';
            echo'</div></div>';//koniec komunikatu
            
        } else {
            //gdy nie obraz
             echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
            echo '<a href="index.php?t=foto" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo ' Załadowany plik nie jest obrazem ';
            echo '</div>';
            echo'</div></div>';
            
        }
    }
    ?>
<div class="container bs-docs-container">
    <h2>Zmień zdjęcie</h2>
    <div>
        <form method="post" action="index.php?t=foto" class="form-horizontal form-group" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <div id="divfoto" class="form-group has-feedback">                    
                <label  class="control-label col-sm-4" for="foto">Wybierz plik</label>
                <div class="col-md-4">            
                    <input name="foto" accept="image/*" type="file" id="foto">

                    <span class="help-block"></span>

                </div>
            </div>
            <div> 
                <div class="row">
                    <div class="col-md-4"></div>

                    <div class="col-md-4"> <button type="submit" class=" btn btn-block btn-success">Zmień zdjęcie</button>
                        <div class="col-md-4"></div>
                    </div>  
                </div>
            </div>

        </form>
    </div>
</div>
    <?php
}