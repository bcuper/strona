<?php

include 'funkcje.php';
if (isset($_POST['login']) || isset($_POST['haslo'])) {
    //gdy przeslano login i haslo
    $login = $_POST['login'];
    $haslo = md5($_POST['haslo']);
    $temp = bd()->prepare('SELECT imie, nazwisko, mail, hash FROM uzytkownicy WHERE login = :login AND haslo = :haslo');
    $temp->bindValue(':login', $login, PDO::PARAM_STR);
    $temp->bindValue(':haslo', $haslo, PDO::PARAM_LOB);
    $temp->execute();
    $row = $temp->fetch();
    $imie = $row['imie'];
    $nazwisko = $row['nazwisko'];
    $hash = $row['hash'];
    $email = $row['mail'];
    wyslijmail($imie, $nazwisko, $login, $email, $hash);
    
}
    