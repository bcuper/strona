<?php

include 'funkcje.php';
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = ($_GET['email']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable
                 
    $bd = bd();
    $temp = $bd->prepare('SELECT * FORM uzytkownicy WHERE mail = :email AND hash = :hash AND active = 0');
    $temp->bindValue(':email', $email, PDO::PARAM_STR);
    $temp->bindValue(':hash', $hash, PDO::PARAM_LOB);
    $temp->execute();    
    $match  = $temp->rowCount();
                 
    if($match > 0){
        // We have a match, activate the account
        $temp = $bd->prepare('UPDATE uzytkownicy SET active = 1 WHERE mail = :mail AND hash = :hash AND active = 0');
        $temp->bindValue(':email', $email, PDO::PARAM_STR);
        $temp->bindValue(':hash', $hash, PDO::PARAM_LOB);
        $temp->execute();
         echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-success" role="alert">Twoje konto zostało aktywowane.<a href="index.php" class="alert-link">Powrót</a></div>';
        echo'</div></div>';
    }else{
        // No match -> invalid url or account has already been activated.
         echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-danger" role="alert">Adres jest nieprawidłowy lub już aktywowałeś konto</div>';
        echo'</div></div>';
    }
                 
}else{
    // Invalid approach
     echo '<div class="jumbotron"><div class="container">';
    echo '<div class="alert alert-danger" role="alert"><strong>Nieprawidłowy adres.</strong> Użyj linka podanego w mailu.</div>';
    echo'</div></div>';
    
}