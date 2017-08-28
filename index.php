<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="funkcje.js" type="text/javascript"></script>
       <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <?php
        if (isset($_POST['imie']) || isset($_POST['nazwisko']) || isset($_POST['login']) || isset($_POST['haslo']) ||
                isset($_POST['haslo2']) || isset($_POST['dataur']) || isset($_POST['email'])) {
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
            $haslo2 = $_POST['haslo2'];
            $dataur = $_POST['dataur'];
            $email = $_POST['email'];
        }
        ?>

        <div><h1>Uzupełnij formularz</h1></div>
        <div><form class="form-horizontal"  method="post" action="wyslij.php">

                <div id="divimie" class="form-group form-inline">                    
                    <label  class="col-sm-4 control-label" for="imie">Imię:</label>
                    <div class="col-md-4">
                    <input type="text" id="imie" name="imie" required="wymagane pole"  class="form-control" value="<?php
                    if (isset($_POST['imie']))
                        echo ($imie);
                    else
                        echo '';
                    ?>"></input>
                    
                    <span class="help-block"></span>
                    </div>
                    
                </div>

                <div id="divnazwisko" class="form-group form-inline">
                    <label class="col-sm-4 control-label" for="nazwisko">Nazwisko:</label>
                    <div class="col-md-4">
                    <input type="text" class="form-control" id="nazwisko" name="nazwisko" required="wymagane pole" value="<?php
                    if (isset($_POST['nazwisko']))
                        echo $nazwisko;
                    else
                        echo '';
                    ?>"></input>
                    <span class="help-block"></span>
                    </div>
                </div>

                <div id="divlogin"class="form-group form-inline">
                    <label class="col-sm-4 control-label" for="login">Login:</label>
                    <div class="col-md-4">
                    <input type="text" class="form-control" id="login" name="login" required="wymagane pole" value="<?php
                    if (isset($_POST['login']))
                        echo $login;
                    else
                        echo '';
                    ?>"></input>
                    <span class="help-block"></span>
                    </div>
                </div>

                <div id="divhaslo" class="form-group form-inline">
                    <label class="col-sm-4 control-label" for="haslo">Hasło:</label>
                    <div class="col-md-4">
                    <input type="password" class="form-control" id="haslo" name="haslo" required="wymagane pole" value="<?php
                    if (isset($_POST['haslo']))
                        echo $haslo;
                    else
                        echo '';
                    ?>"></input>
                    <span class="help-block"></span>
                    </div>
                </div>

                <div id="divhaslo2" class="form-group form-inline">
                    <label class="col-sm-4 control-label" for="haslo2">Powtórz hasło:</label>
                    <div class="col-md-4">
                    <input type="password" class="form-control" id="haslo2" name="haslo2" required="wymagane pole" value="<?php
                    if (isset($_POST['haslo2']))
                        echo $haslo2;
                    else
                        echo '';
                    ?>"></input>
                    <span class="help-block"></span>
                    </div>
                </div>

                <div id="divdataur" class="form-group form-inline">
                    <label class="col-sm-4 control-label" for="dataur">Data urodzenia:</label>
                    <div class="col-md-4">
                    <input type="date" class="form-control" id="dataur" name="dataur" max="<?php echo date("Y.m.d"); ?>" required="wymagane pole" placeholder="RRRR-MM-DD" value="<?php
                    if (isset($_POST['dataur']))
                        echo $dataur;
                    else
                        echo '';
                    ?>"></input>
                    <span class="help-block"></span>
                    </div>
                </div>

                <div id="divemail" class="form-group form-inline">
                    <label class="col-sm-4 control-label" for="email">Email:</label>
                    <div class="col-md-4">
                    <input type="email" class="form-control" id="email" name="email" required="wymagane pole" value="<?php
                    if (isset($_POST['email']))
                        echo $email;
                    else
                        echo '';
                    ?>"></input>
                    <span class="help-block">   
                        </div>
                </div> 


                <div id="submit col-md-4"> 
                    <div class="col-md-4"></div>
                    <button type="submit" class="btn btn-success">Wyślij</button>
               
                </div>
                

            </form>
        </div>
    </body>
</html>
