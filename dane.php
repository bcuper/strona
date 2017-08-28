<?php
if ($_SESSION['zalogowany'] != 1) { //sprawdzenie czy zalogowany
     echo '<div class="jumbotron"><div class="container">';
            echo '<div class="alert alert-danger alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>Nie jesteś zalogowany</strong></div>';
            echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
            echo'</div></div>';
        } else {
?>



<div class="container bs-docs-container">
<h2>Twoje dane:</h2>
<table class="table table-bordered table-condensed table-hover text-center" > 
    <tbody>
        <tr>
        <td>Id</td>
        <td><?php echo $_SESSION['id']; ?></td>
        </tr>
        <tr>
        <td>Imie</td>
        <td><?php echo $_SESSION['imie']; ?></td>
        </tr>
        <tr>
        <td>Nazwisko</td>
        <td><?php echo $_SESSION['nazwisko']; ?></td>
        </tr>
        <tr>
        <td>Login</td>
        <td><?php echo $_SESSION['login']; ?></td>
        </tr>
        <tr>
        <td>Email</td>
        <td><?php echo $_SESSION['mail']; ?></td>
        </tr>
        <tr>
        <td>Data urodzenia</td>
        <td><?php echo $_SESSION['dataurodzenia']; ?></td>
        </tr>
        <tr>
        <td>Data utworzenia konta</td>
        <td><?php echo $_SESSION['datautworzenia']; ?></td>
        </tr>
        <tr>
        <td>Konto aktywne</td>
        <td><?php
            if ($_SESSION['active'] == 0)
                echo 'NIE';
            elseif ($_SESSION['active'] == 1)
                echo 'TAK';
            ?></td>
        </tr>
        <tr>
        <td>Zdjęcie</td>
        <td>
            <?php
            echo '<img height="200"  src="data:image/jpeg;base64,' . base64_encode($_SESSION['fotozaw']) . '"/>';
            ?>
            <br>
            <a href="index.php?t=foto" class="link">Zmień zdjęcie</a>
        </td>
        </tr>

    </tbody>
</table>
</div>
<?php
        }