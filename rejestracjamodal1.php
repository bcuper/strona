<?php

include 'funkcje.php';
//waliacja
if (isset($_POST['imie']) || isset($_POST['nazwisko']) || isset($_POST['login']) || isset($_POST['haslo']) ||
        isset($_POST['haslo2']) || isset($_POST['dataur']) || isset($_POST['email']) || isset($_POST['rok']) || isset($_POST['miesiac']) || isset($_POST['dzien']) || isset($_POST['tel'])) {
   $imie = $_POST['imie'];
   $nazwisko=$_POST['nazwisko'];
   $login = $_POST['login'];
   $haslo = $_POST['haslo'];
   $haslo2 = $_POST['haslo2'];
   $dataur = $_POST['rok'].'-'.$_POST['miesiac'].'-'.$_POST['dzien'];
   $email = $_POST['email'];
   $tel = $_POST['tel'];
   $datautw = date("Y-m-d");
   $hash = md5(rand(0,1000));
   echo $dataur;
   echo '<br>';
   echo $datautw;
    // walidacja danych
   
    //walidacja zmiennych
    $nazwa[0][0] = 'imie';      $nazwa[0][1] = 'imię';             
    $nazwa[1][0] = 'nazwisko';  $nazwa[1][1] = 'nazwisko';          
    $nazwa[2][0] = 'login';     $nazwa[2][1] = 'login';          
    $nazwa[3][0] = 'haslo';     $nazwa[3][1] = 'haslo';           
    $nazwa[4][0] = 'haslo2';    $nazwa[4][1] = 'ponownie hasło';   
   $waliderror = 0;
   $i=0;
   
   do{
    walidacja1($$nazwa[$i][0], $nazwa[$i][1]);
    $i++;           
   } while ($i == 4 || $waliderror != 0);
    
    
      
     if ($waliderror != 0) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Popraw dane<br />";
        echo '</div>';
    } elseif ($haslo != $haslo2) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Hasła się różnią<br />";
        echo '</div>';
    } elseif (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/", $email)) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Wprowadzony e-mail jest za krótki, lub nieprawny, musi zawierać znak @.<br />";
        echo '</div>';
    } elseif (waliddata($_POST['dzien'], $_POST['miesiac'], $_POST['rok']) == 0) {
        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "Data nieprawidłowa, zadużo dni w miesiącu<br />";
        echo '</div>';
    }else{
        //sprawdzenie czy intnieje login i email w bazie
        include 'bd.php';
        $bd = bd();
        $temp = $bd->prepare('SELECT * FROM uzytkownicy WHERE login = :login');
        $temp1 = $bd->prepare('SELECT * FROM uzytkownicy WHERE mail = :email');
        $temp->bindValue(':login', $login, PDO::PARAM_STR);
        $temp1->bindValue(':email', $email, PDO::PARAM_STR);
        $temp->execute();
        $temp1->execute();
        $res1 = $temp->fetch();
        $res2 = $temp1->fetch();
        if ($res1 != 0) {
            echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Podany login istnieje w bazie<br>';
            echo '</div>';
        } elseif ($res2 != 0) {
            echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
            echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo 'Podany adres email istnieje w bazie<br>';
            echo '</div>';
        } else {

            if (isset($_FILES['foto']['size']) && $_FILES['foto']['size'] > 0) { // czy dodano zdj
                $fotonazwa = $_FILES['foto']['name'];
                $tmpnazwa = $_FILES['foto']['tmp_name'];
                $fotosize = $_FILES['foto']['size'];
                $fototyp = $_FILES['foto']['type'];

                if (strpos($fototyp, 'image') === 0) { //czy przeslany plik to obraz
                    
                    $fp = fopen($tmpnazwa, 'r');
                    $fotozaw = fread($fp, filesize($tmpnazwa));
                    $fotozaw = addslashes($fotozaw);
                    fclose($fp);

                    if (!get_magic_quotes_gpc()) {
                        $fotonazwa = addslashes($fotonazwa);
                    }
                    //wstawienie uzytkownika do bd ze zdj
                  
                   wstawuserdobd($imie, $nazwisko, $login, $haslo, $dataur, $email, $datautw, $hash, $tel, $bd);
                   $id = getiduser($imie, $nazwisko, $login, $email, $bd);
                   
                   zaladujzdjdobd($fotonazwa, $fotosize, $fototyp, $fotozaw, $id);
                   
                
                    //wyslanie maila aktywacyjnego
                    wyslijmail($imie, $nazwisko, $login, $email, $hash);
                    echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
                    echo '<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo '<strong>Dodano wpis </strong><br>Wysłano link aktywacyjny. ';
                  
                    echo '<br><a href="index.php" class="alert-link">Powrót</a></div>';
                   
                } else { //gdy przesłany plik nie jest plikiem graficznym
                    echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                    echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo 'Nieprawidłowy typ pliku<br>';
                    echo '</div>';
                }
            } else {
                //wstawienie uzytkownika do bd bez zdj
                wstawuserdobd($imie, $nazwisko, $login, $haslo, $dataur, $email, $datautw, $hash, $tel, $bd);
                //wyslanie maila aktywacyjnego
                 wyslijmail($imie, $nazwisko, $login, $email, $hash);
                echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
                echo '<a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo '<strong>Dodano wpis</strong><br>Wysłano link aktywacyjny. ';
                echo '<br><a href="index.php" class="alert-link">Powrót</a></div>';
          
            }
        }
    }
}
        
    ?>
    