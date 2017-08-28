<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['zalogowany'])) { // 2
    $_SESSION['zalogowany'] = 0;
}
include 'funkcje.php';
?>
<html>
    <head>
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
                position: relative;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
        <style>
            .modal-header, h4 {
                background-color: #5cb85c;
                color:white !important;
                text-align: center;
                font-size: 30px;
            }
            .mocl {
                background-color: #5cb85c;
                color:white !important;
                text-align: center;
                font-size: 30px;
            }
            .modal-footer {
                background-color: #f9f9f9;
            }
            .modal-body {
                max-height: calc(80vh - 110px);
                overflow-y: auto;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="js/funkcje.js" type="text/javascript"></script>


        <style>

            #instr1 {padding-top:50px;height:7000px;color: #fff; background-color: #1E88E5;}
            #instr2 {padding-top:50px;height:7000px;color: #fff; background-color: #673ab7;}
            #instr3 {padding-top:50px;height:4000px;color: #fff; background-color: #00bcd4;}
            #instr4 {padding-top:50px;height:7000px;color: #fff; background-color: #1E88E5;}
            #instr5 {padding-top:50px;height:7000px;color: #fff; background-color: #673ab7;}
            #instr6 {padding-top:50px;height:4000px;color: #fff; background-color: #00bcd4;}


        </style>

    </head>
    <body data-spy="scroll" data-target=".navbar" data-offset="50">


        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> WebSiteName</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <?php
                    include 'menu.php';
                    ?>                                

                </div>

        </nav> 
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div>
            <div id="dane">
                <?php include 'dane.php'; ?>
            </div>
            <div id="set">
                <?php include 'ustawienia.php'; ?>
            </div>
            <div id="zh">
                <?php include 'zamienhaslo.php'; ?>
            </div>
            <div id="reset">
                <?php include 'reset.php'; ?>
            </div>
            <div id="foto">
                <?php include 'foto.php'; ?>
            </div>
            <div id="str1">
                <?php include 'strona_1.php'; ?>
            </div>
            <div id="str2">
                <?php include 'strona_2.php'; ?>
            </div>
            <div id="admin">
                <?php include 'admin.php'; ?>
            </div>
            <div id="usun">
                <?php include 'usun.php'; ?>
            </div>
            <div id="instr1">
                <?php include 'instr1.php'; ?>
            </div>
            

        </div>

        <div class="container text-center">
            <!-- Example row of columns -->


            <nav class="container navbar navbar-fixed-bottom">

                <p class="navbar-text">&copy; Company 2017</p>
            </nav>
        </div> <!-- /container -->       
        <!-- Modal -->
        <div class="container">

            <!-- Modal logowanie -->
            <div class="modal fade" id="zalogujmodal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close mocl" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-lock"></span> Zaloguj się</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <?php include 'zaloguj.php'; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anuluj</button>
                            <p>Nie masz konta? <a data-toggle="modal" data-target="#zarejestrujmodal">Zarejestruj się</a></p>
                            <p>Zapomniałeś <a href="index.php?t=reset">hasła?</a></p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- modal rejestracja -->
            <div class="modal fade" id="zarejestrujmodal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="mocl close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-user"></span> Zarejestruj się</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <?php include 'rejestracjamodal.php'; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anuluj</button>
                            <p>Zapomniałeś <a href="index.php?t=reset">hasła?</a></p>
                        </div>
                    </div>

                </div>
            </div>  





        </div>


    </body>
</html>
