<?php

include 'funkcje.php';
if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']) && isset($_GET['haslo']) && !empty($_GET['haslo'])) {
    // Verify data
    $email = ($_GET['email']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable
    $haslo = $_GET['haslo'];
    $bd = bd();
    $temp = $bd->prepare('SELECT * FROM uzytkownicy WHERE mail = :mail AND hash = :hash');
    $temp->bindValue(':mail', $email, PDO::PARAM_STR);
    $temp->bindValue(':hash', $hash, PDO::PARAM_LOB);
    $temp->execute();
    $match = $temp->rowCount();

    if ($match == 1) {
        // We have a match, activate the account
        $temp = $bd->prepare('UPDATE uzytkownicy SET haslo = :haslo WHERE mail = :mail AND hash = :hash');
        $temp->bindValue(':mail', $email, PDO::PARAM_STR);
        $temp->bindValue(':hash', $hash, PDO::PARAM_LOB);
        $temp->bindValue(':haslo', $haslo, PDO::PARAM_LOB);
        $temp->execute();

        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-success" role="alert">Hasło zostało zmienione.<a href="index.php" class="alert-link">Powrót</a></div>';
        echo'</div></div>';
    } else {
        // No match -> invalid url or account has already been activated.
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-danger" role="alert">Adres jest nieprawidłowy</div>';
        echo'</div></div>';
    }
} else {
    // Invalid approach
    echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert"><strong>Nieprawidłowy adres.</strong> Użyj linka podanego w mailu.</div>';
    echo'</div></div>';
}