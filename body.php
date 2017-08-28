<?php

if (isset($_GET['t'])) { //dane i wylogowywanaie
    $t = $_GET['t'];
} else
    $t = '';

switch ($t) {
    case 'out':
        $_SESSION['zalogowany'] = 0;
        unset($_SESSION);
        session_unset();
        session_destroy();
        echo '<div class="jumbotron"><div class="container">';
        echo '<div class="alert alert-success alert-dismissable fade in" role="alert">';
        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a> ';
        echo 'Zostałeś wylogowany z serwisu<br><a href="index.php" class="alert-link">Odśwież</a></div>';
        echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
        echo'</div></div>';

        break;
    case 'dane':
        include 'dane.php';
        break;
    case 'set':
        include 'ustawienia.php';
        break;
    case 'zh':
        include 'zamienhaslo.php';
        break;
    case 'reset':
        include 'reset.php';
        break;
    case 'foto':
        include 'foto.php';
        break;
    case 'str1':
        include 'strona_1.php';
        break;
    case 'str2':
        include 'strona_2.php';
        break;
    case 'admin':
        include 'admin.php';
        break;
    case 'usun':
        include 'usun.php';
        break;
    case 'str3':
        include 'strona_1_1.php';
        break;
     case 'szukaju':
        include 'szukauser.php';
        break;
    case 'art':
        include 'sklep/artykuly.php';
        break;
    case 'koszyk':
        include 'sklep/koszyk.php';
        break;
    case 'zakup':
        include 'sklep/zakup.php';
        break;
     case 'adr':
        include 'adresy.php';
        break;
     case 'hiszlec':
        include 'sklep/hiszlec.php';
        break;

    default :

        if ($_SESSION['zalogowany'] == 0) {
            if (empty($_POST['loginlog']) && empty($_POST['haslolog'])) {
                //gdy uzytkownik nie jest zalogowany
                echo '<div class="jumbotron"><div class="container">';
                echo '<h2>Witaj!!</h2>';
                echo '<p>Nie jesteś zalogowany. <br>Kliknij w przycisk zaloguj w menu aby uzyskać dostęp.</p>';
                echo '</div></div>';
                echo '<div class="container bs-docs-container">';
                    echo '<p>
                            Cras lacinia non ligula porta commodo. Praesent eu mauris risus. Donec porttitor lectus dolor, eget blandit neque sodales quis. 
                            Aliquam lacinia condimentum viverra. In vitae volutpat est. Praesent at euismod lorem, ut feugiat dui. Vestibulum semper quam non suscipit lobortis.
                         </p>';
                    echo '<p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse fringilla porta enim, sed venenatis metus pulvinar quis. 
                            Suspendisse id odio eu odio mattis mollis. Vestibulum scelerisque nisl sit amet justo dignissim, non semper turpis lacinia. 
                            Suspendisse quis blandit mi, quis consectetur lorem. Sed ex urna, consectetur elementum nisl ac, vehicula porta neque. 
                            Aliquam elementum dictum purus, sed viverra nisi interdum quis. Vivamus semper dapibus lorem, et tempor sem accumsan vel. 
                            Curabitur porta venenatis est, ut malesuada ex congue ac. Suspendisse venenatis tincidunt lacus porta cursus. 
                            Cras magna purus, fermentum id nulla at, egestas viverra ligula. Nulla facilisi. Suspendisse potenti. 
                            Vestibulum ultricies consequat neque rhoncus placerat. Proin vel mi dictum, suscipit diam non, ornare lectus.
                           </p>';
                    echo '</div>';
            } elseif (isset($_POST['loginlog']) || isset($_POST['haslolog'])) {
                //gdy przeslano login i haslo
                $login = $_POST['loginlog'];
                $haslo = md5($_POST['haslolog']);
                $_SESSION['haslo'] = $haslo;

                $bd = bd();              
       
                if (logowanie($login, $haslo, $bd) !== 1) { //sprawdzanie poprawnosci danych
                    echo '<div class="jumbotron"><div class="container">';
                    echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                    echo '<a href ="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo 'Nieprawidłowy login lub hasło. ';                    
                    echo '<br><a href="index.php" class="alert-link">Wstecz</a></div>';
                    echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
                    echo'</div></div>';
                    niepoprawnezalogowanie($login);                    
                } else {
                    
                    if (czyaktywny($login, $haslo, $bd) == 1) { //sprawdzanie czy konto aktywowane
 
                        if (isset($_SESSION['zalogowany'])) {
                            //gdy dane poprawne i konto aktywowane
                            $_SESSION['zalogowany'] = 1;
                            echo '<div class="alert alert-success" role="alert">Zalogowałeś się.<br><a href="index.php" class="alert-link">Odśwież</a></div>';
                            pobierzdanedosesji($login, $haslo, $bd);
                            header('Location: index.php');
                        }
                    } else {
                        //gdy konto nieaktywne
                        echo '<div class="jumbotron"><div class="container">';
                        echo '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
                        echo '<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        echo '<strong>Twoje konto nie jest aktywne.</strong><br><a href="index.php" class="alert-link">Wstecz</a><br>';
                        echo '<form class ="form-"action="wyslijponownie.php" method="POST"><input type="hidden" name="login" value="' . $login . '">';
                        echo '<input type="hidden" name="haslo" value="' . $haslo . '">';
                        echo '<input type="submit" type="button" class="alert-link btn-link" value="Wyślij ponownie link aktywacyjny" />';
                        echo '</form></div>';
                        echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
                        echo'</div></div>';
                    }
                }
            }
        } else {
            //po odswierzeniu i zalogowaniu
            echo '<div class="jumbotron"><div class="container">';
            echo '<h1>Witaj ' . $_SESSION['imie'] . ' ' . $_SESSION['nazwisko'] . '</h1>';
            echo '</div></div>';
            echo '<div class="container bs-docs-container">';
            echo '<p>
                Cras lacinia non ligula porta commodo. Praesent eu mauris risus. Donec porttitor lectus dolor, eget blandit neque sodales quis. 
                Aliquam lacinia condimentum viverra. In vitae volutpat est. Praesent at euismod lorem, ut feugiat dui. Vestibulum semper quam non suscipit lobortis.
                </p>';
            echo '<p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse fringilla porta enim, sed venenatis metus pulvinar quis. 
                Suspendisse id odio eu odio mattis mollis. Vestibulum scelerisque nisl sit amet justo dignissim, non semper turpis lacinia. 
                Suspendisse quis blandit mi, quis consectetur lorem. Sed ex urna, consectetur elementum nisl ac, vehicula porta neque. 
                Aliquam elementum dictum purus, sed viverra nisi interdum quis. Vivamus semper dapibus lorem, et tempor sem accumsan vel. 
                Curabitur porta venenatis est, ut malesuada ex congue ac. Suspendisse venenatis tincidunt lacus porta cursus. 
                Cras magna purus, fermentum id nulla at, egestas viverra ligula. Nulla facilisi. Suspendisse potenti. 
                Vestibulum ultricies consequat neque rhoncus placerat. Proin vel mi dictum, suscipit diam non, ornare lectus.
                </p>';
            echo '</div>';
        }
        break;
}
?>