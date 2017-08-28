<?php
include 'bd.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $row = mysqli_query($link, "SELECT haslo FROM uzytkownicy WHERE id='" . $id . "'");
    $row1 = mysqli_fetch_array($row);
    echo $row1['haslo'];
} else
    echo 'brak';
?>
<div>
    <form class="form-horizontal" action="index.php" method="POST">
        <div class="form-group form-inline">
            <label class="col-sm-4 control-label" for="login">Login</label>
            <div class="col-md-4">
                <input type="text" id="login" name="login" />
            </div>
        </div>
        <div class="form-group form-inline">
            <label class="col-sm-4 control-label" for="haslo">Hasło</label>
            <div class="col-md-4">
                <input type="password" id="haslo" name="haslo" />
            </div>
        </div>
        <div id="submit col-md-4"> 
            <div class="col-md-4"></div>
            <button type="submit" class="btn btn-success">Wyślij</button> 
            <a href="rejestracja.php"><input type="button" class="btn btn-success" value="Zarejestruj się" /></a>
        </div>

    </form>            
</div>
<div>
    <a href="rejestracja.php">Zarejestruj się</a>
</form>
</div>