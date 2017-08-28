
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!isset($_SESSION['zalogowany'])) { // 2
    $_SESSION['zalogowany'] = 0;
}
?>
<html>
    <head>        
        <meta charset="UTF-8">
        <title>Strona główna</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/funkcje.js" type="text/javascript"></script>
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
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">WebSiteName</a>
                </div>
                <?php
                include 'menu.php';
                ?>                                
                
            </div>
        </nav> 

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
<?php include 'body.php'; ?>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Example row of columns -->


            <hr>

            <footer>
                <p>&copy; Company 2017</p>
            </footer>
        </div>
    </body>
</html>
