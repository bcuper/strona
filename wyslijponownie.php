<?php

include 'bd.php';
include 'funkcje.php';
if (isset($_POST['login']) || isset($_POST['haslo'])) {
    //gdy przeslano login i haslo
    $login = $_POST['login'];
    $haslo = md5($_POST['haslo']);
    $row = mysqli_fetch_array(mysqli_query($link, "SELECT imie, nazwisko, mail, hash  FROM uzytkownicy WHERE login='" . $login . "' AND haslo='" . $haslo . "'"));
    $imie = $row['imie'];
    $nazwisko = $row['nazwisko'];
    $hash = $row['hash'];
    $email = $row['mail'];
    mysqli_close($link);
    wyslijmail($imie, $nazwisko, $login, $email, $hash);
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
}
    