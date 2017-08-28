<?php

include 'bd.php';
if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']) && isset($_GET['haslo']) && !empty($_GET['haslo'])){
    // Verify data
    $email = ($_GET['email']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable
    $haslo = $_GET['haslo'];
                 
    $search = mysqli_query($link, "SELECT * FROM uzytkownicy WHERE mail='".$email."' AND hash='".$hash."'") or die(mysqli_errno()); 
    $match  = mysqli_num_rows($search);
                 
    if($match == 1){
        // We have a match, activate the account
        mysqli_query($link, "UPDATE uzytkownicy SET haslo='". $haslo ."' WHERE mail='".$email."' AND hash='".$hash."'") or die(mysqli_errno());
        echo '<div class="alert alert-success" role="alert">Hasło zostało zmienione.<a href="index.php" class="alert-link">Powrót</a></div>';
    } else {
        // No match -> invalid url or account has already been activated.
        echo '<div class="alert alert-danger" role="alert">Adres jest nieprawidłowy</div>';
    }
                 
}else{
    // Invalid approach
    echo '<div class="alert alert-danger" role="alert"><strong>Nieprawidłowy adres.</strong> Użyj linka podanego w mailu.</div>';
    
}