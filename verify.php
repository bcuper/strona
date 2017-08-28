<?php

include 'bd.php';
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = ($_GET['email']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable
                 
    $search = mysqli_query($link, "SELECT mail, hash, active FROM uzytkownicy WHERE mail='".$email."' AND hash='".$hash."' AND active='0'") or die(mysqli_errno()); 
    $match  = mysqli_num_rows($search);
                 
    if($match > 0){
        // We have a match, activate the account
        mysqli_query($link, "UPDATE uzytkownicy SET active='1' WHERE mail='".$email."' AND hash='".$hash."' AND active='0'") or die(mysqli_errno());
        echo '<div class="alert alert-success" role="alert">Twoje konto zostało aktywowane.<a href="index.php" class="alert-link">Powrót</a></div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="alert alert-danger" role="alert">Adres jest nieprawidłowy lub już aktywowałeś konto</div>';
    }
                 
}else{
    // Invalid approach
    echo '<div class="alert alert-danger" role="alert"><strong>Nieprawidłowy adres.</strong> Użyj linka podanego w mailu.</div>';
    
}