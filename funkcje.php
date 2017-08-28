<?php

//--------------------------------
// sklep
function rozbijart($a) {

    $b = explode(" ", $a);

    foreach ($b as $key => $value) {
        $c[$key] = explode("(", $value);
    }

    $count = count($c);

    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < 2; $j++) {
            $d[$i][$j] = explode(")", $c[$i][$j]);
        }
    }

    $count = count($d);

    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < 2; $j++) {
            $e[$i][$j] = $d[$i][$j][0];
        }
    }
    return $e;
}

function adresyid($id, $dbh) {
    $temp = $dbh->prepare('SELECT * FROM adresy WHERE id = :id');
    $temp->bindValue(':id', $id, PDO::PARAM_INT);
    $temp->execute();
    $row = $temp->fetch();
    $adres = $row[1] . ' ' . $row[2] . ' ul. ' . $row[3] . ' ' . $row[4] . '/' . $row[5];
    return $adres;
}

function getcena($idarty, $ilosc, $dbh) {
    $temp = $dbh->prepare('SELECT * FROM artykuly WHERE id = :idarty');
    $temp->bindValue(':idarty', $idarty, PDO::PARAM_INT);
    $temp->execute();
    $row = $temp->fetch();
    $cena = $row['cena'];
    $return = $ilosc * $cena;
    return $return;
}

function pnazwa($idn, $dbh) {
    $temp = $dbh->prepare('SELECT nazwa FROM artykuly WHERE id = :idn');
    $temp->bindValue(':idn', $idn, PDO::PARAM_INT);
    $temp->execute();
    $row = $temp->fetch();
    return $row['nazwa'];
}

function adresy($id, $dbh) {
    $temp = $dbh->prepare('SELECT * FROM adresy WHERE iduz = :id');
    $temp->bindValue(':id', $id, PDO::PARAM_INT);
    $temp->execute();
    while ($row = $temp->fetch()) {
        $adres[] = $row[1] . ' ' . $row[2] . ' ul. ' . $row[3] . ' ' . $row[4] . '/' . $row[5];
    }
    return $adres;
}

function getidadres($adres, $iduz, $dbh) {
    list($miej, $kod, $b, $ulica, $a) = explode(" ", $adres, 5);
    $temp = $dbh->prepare('SELECT id FROM adresy WHERE miejscowosc = :miej AND kodpocztowy = :kod AND ulica = :ulica AND iduz = :iduz');
    $temp->bindValue(':iduz', $iduz, PDO::PARAM_INT);
    $temp->bindValue(':miej', $miej, PDO::PARAM_STR);
    $temp->bindValue(':kod', $kod, PDO::PARAM_STR);
    $temp->bindValue(':ulica', $ulica, PDO::PARAM_STR);
    $temp->execute();
    $row = $temp->fetch();
    return $row['id'];
}

function iloscprod($idprod, $dbh) {
    $temp = $dbh->prepare('SELECT ilosc FROM artykuly WHERE id = :idprod');
    $temp->bindValue(':idprod', $idprod, PDO::PARAM_INT);
    $temp->execute();
    $row = $temp->fetch();
    return $row['ilosc'];
}

//------------------------------------
// inne
//---------------------------------------------- logowanie
function bd() {
    $dbconfig = array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'db' => '20170602',
        'db_type' => 'mysql',
        'encoding' => 'utf-8');

    try {
        $dsn = $dbconfig['db_type'] .
                ':host=' . $dbconfig['host'] .
                ';encoding=' . $dbconfig['encoding'] .
                ';dbname=' . $dbconfig['db'];

        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        $dbh = new PDO($dsn, $dbconfig['user'], $dbconfig['pass'], $options);

        define('DB_CONNECTED', true);
       
    } catch (PDOException $e) {
        die('Błąd połączenia z bd: ' . $e->getMessage());
    }

    return $dbh;
}

function logowanie($login, $haslo, $dbh) {

    $temp = $dbh->prepare('SELECT * FROM uzytkownicy WHERE login = :login AND haslo = :haslo');
    $temp->bindValue(':login', $login, PDO::PARAM_STR);
    $temp->bindValue(':haslo', $haslo, PDO::PARAM_LOB);
    $temp->execute();
    $count = $temp->rowCount();
    if ($count === 1)
        return 1; //gdy ok
    else
        return 0; //gdy nie
}

function czyaktywny($login, $haslo, $dbh) {

    $temp = $dbh->prepare('SELECT active FROM uzytkownicy WHERE login = :login AND haslo = :haslo');
    $temp->bindValue(':login', $login, PDO::PARAM_STR);
    $temp->bindValue(':haslo', $haslo, PDO::PARAM_LOB);
    $temp->execute();
    $tmp = $temp->fetch();
    if ($tmp['active'] == 1)
        return 1; //jest
    else
        return 0; //nie
}

function pokazzdj($id, $bd) {

    $temp = $bd->prepare('SELECT fotonazwa, fototyp, fotosize, fotozaw FROM uzytkownicy WHERE id = :id');
    $temp->bindValue(':id', $id, PDO::PARAM_INT);
    $temp->execute();
    $tmp = $temp->fetch();
    return $tmp;
}

function pobierzdanedosesji($login, $haslo, $dbh) {
    $temp = $dbh->prepare('SELECT imie, nazwisko, mail, id, dataurodzenia, datautworzenia, active, fotozaw, admin, tel FROM uzytkownicy WHERE login = :login AND haslo = :haslo');
    $temp->bindValue(':login', $login, PDO::PARAM_STR);
    $temp->bindValue(':haslo', $haslo, PDO::PARAM_LOB);
    $temp->execute();
    $row = $temp->fetch();
    $_SESSION['login'] = $login;
    $_SESSION['imie'] = $row['imie'];
    $_SESSION['nazwisko'] = $row['nazwisko'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['dataurodzenia'] = $row['dataurodzenia'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['datautworzenia'] = $row['datautworzenia'];
    $_SESSION['active'] = $row['active'];
    $_SESSION['fotozaw'] = $row['fotozaw'];
    $_SESSION['admin'] = $row['admin'];
    $_SESSION['tel'] = $row['tel'];
}

function uaktualnijdane($id, $login, $imie, $nazwisko, $dataur, $mail, $tel, $bdh) {
    $temp = $bdh->prepare('UPDATE uzytkownicy SET imie = :imie, nazwisko = :nazwisko, login = :login, dataurodzenia = :dataur, mail = :mail, tel = :tel WHERE id = :id');
    $temp->bindValue(':imie', $imie, PDO::PARAM_STR);
    $temp->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
    $temp->bindValue(':login', $login, PDO::PARAM_STR);
    $temp->bindValue(':dataur', $dataur, PDO::PARAM_STR);
    $temp->bindValue(':mail', $mail, PDO::PARAM_STR);
    $temp->bindValue(':tel', $tel, PDO::PARAM_INT);
    $temp->bindValue(':id', $id, PDO::PARAM_INT);
    $temp->execute();
}

function zaladujzdjdobd($fotonazwa, $fotosize, $fototyp, $fotozaw, $id) {
    include 'bd.php';
    $query = "UPDATE uzytkownicy SET fotonazwa='$fotonazwa', fotosize='$fotosize', fototyp='$fototyp', fotozaw='$fotozaw' WHERE id='$id'";
    mysqli_query($link, $query) or die('Error, query failed');
}

function wstawuserdobd($imie, $nazwisko, $login, $haslo, $dataur, $email, $datautw, $hash, $tel, $bd) {
    $temp = $bd->prepare('INSERT INTO uzytkownicy (imie, nazwisko, login, haslo, dataurodzenia, mail, datautworzenia, hash, tel) VALUES (:imie, :nazwisko, :login, :haslo, :dataur, :email, :datautw, :hash, :tel)');
    $temp->bindValue(':imie', $imie, PDO::PARAM_STR);
    $temp->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
    $temp->bindValue(':login', $login, PDO::PARAM_STR);
    $temp->bindValue(':haslo', $haslo, PDO::PARAM_LOB);
    $temp->bindValue(':dataur', $dataur, PDO::PARAM_STR);
    $temp->bindValue(':email', $email, PDO::PARAM_STR);
    $temp->bindValue(':datautw', $datautw, PDO::PARAM_STR);
    $temp->bindValue(':hash', $hash, PDO::PARAM_LOB);
    $temp->bindValue(':tel', $tel, PDO::PARAM_INT);
    $temp->execute();
}

function getiduser($imie, $nazwisko, $login, $email, $bd) {
    $temp2 = $bd->prepare('SELECT * FROM uzytkownicy WHERE imie = :imie AND nazwisko = :nazwisko AND login = :login AND mail = :mail');
    $temp2->bindValue(':imie', $imie, PDO::PARAM_STR);
    $temp2->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
    $temp2->bindValue(':login', $login, PDO::PARAM_STR); 
    $temp2->bindValue(':mail', $email, PDO::PARAM_STR);     
    $temp2->execute();
    $temp1 = $temp2->fetch();
    $temp = $temp1['id'];
    return $temp;
}

//-----------------------------------
//inne

function niepoprawnezalogowanie($login) {
    $tresc = date("Y-m-d H:i:s") . ' Nieudana próba logowania na login: ' . $login . " \r\n";
    $plik = fopen("logerror.txt", "a+") or die("Plik nie istnieje.");
    fwrite($plik, $tresc);
    fclose($plik);
}

function wyslijmail($imie, $nazwisko, $login, $email, $hash) {
    $do = $email;
    $temat = 'Weryfikacja konta';
    $tresc = '
Twoje konto zostało utworzone.
Twoje dane:
Imie: ' . $imie . '
Nazwisko: ' . $nazwisko . '
Login: ' . $login . '
Email: ' . $email . '
Potwirdź za pomocą linku aktywacyjnego poniżej.
http://10.10.10.10/i2/strona/verify.php?email=' . $email . '&hash=' . $hash . '';

    $naglowki = 'From:bartlomiej.cuper@standard.lublin.pl' . "\r\n";
    mail($do, $temat, $tresc, $naglowki);
}

function wyslijhaslo($haslo, $login, $email, $hash) {
    $do = $email;
    $temat = 'Weryfikacja zmiany hasła';
    $tresc = '
Twoje hasło zostało zmienione.
Twoje dane:
Login: ' . $login . '
Email: ' . $email . '
Nowe hasło: ' . $haslo . '
Potwirdź za pomocą linku aktywacyjnego poniżej.
http://10.10.10.10/i2/strona/verifyzh.php?email=' . $email . '&hash=' . $hash . '&haslo=' . md5($haslo) . '';

    $naglowki = 'From:bartlomiej.cuper@standard.lublin.pl' . "\r\n";
    mail($do, $temat, $tresc, $naglowki);
}

//-------------------------------------
// walidacja

function waliddata($dzien, $miesiac, $rok) {
    $dni = cal_days_in_month(CAL_GREGORIAN, $miesiac, $rok);
    if ($dzien <= $dni)
        return 1; //ok
    else
        return 0;
}

function walidacja1($zmienna, $nzmienna) {
    global $waliderror;
    //walidacja imie, login; $min - min ilosc znakow
    if (empty($zmienna) || strlen($zmienna) <= 4) {
        echo '<div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo 'Proszę podać ' . $nzmienna . ', musi on zawierać przynajmiej 4 znaki ';
        echo'</div></div>';
        exit();
    }
}

function walidacjamail($mail) {
    global $waliderror;
    if (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $mail)) {
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="index.php?t=set" class="close" data-dismiss="alert" aria-label="close">&times;</a>';

        echo 'Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @. ';
        echo'</div></div></div>';
        exit();
    }
}

function checkmail($email) {
    if (!empty($email)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE mail='" . $email . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

function checkmaillog($email) {
    if (!empty($email)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE mail='" . $email . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count == 1)
            echo '0';
        else
            echo '1';
    }
}

function checkmailu($emailu) {
    if (!empty($emailu)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE mail='" . $emailu . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];

        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

function username($login) {
    if (!empty($login)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE login='" . $login . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

function usernamelog($login) {
    if (!empty($login)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE login='" . $login . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count == 1)
            echo '0';
        else
            echo '1';
    }
}

function usernameu($loginu) {
    if (!empty($loginu)) {
        include 'bd.php';
        $result = mysqli_query($link, "SELECT count(*) FROM uzytkownicy WHERE login='" . $loginu . "'");
        $row = mysqli_fetch_row($result);
        $user_count = $row[0];
        if ($user_count > 0)
            echo '0';
        else
            echo '1';
    }
}

if (isset($_POST['akcja']) && !empty($_POST['akcja']) && isset($_POST['zmienna']) && !empty($_POST['zmienna'])) {
    $action = $_POST['akcja'];
    switch ($action) {
        case 'checkmail' : checkmail($_POST['zmienna']);
            break;
        case 'checkmaillog' : checkmaillog($_POST['zmienna']);
            break;
        case 'checkmailu' : checkmailu($_POST['zmienna']);
            break;
        case 'checkusername' : username($_POST['zmienna']);
            break;
        case 'checkusernamelog' : usernamelog($_POST['zmienna']);
            break;
        case 'checkusernameu' : usernameu($_POST['zmienna']);
            break;
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

