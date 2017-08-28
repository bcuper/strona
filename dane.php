<h2>Twoje dane:</h2>

<table class="table table-bordered table-condensed table-hover text-center" > 
    <tbody>
        <tr>
            <td>Id</td>
            <td><?php echo $_SESSION['id']; ?></td>
        </tr>
        <tr>
            <td>Imie</td>
            <td><?php echo $_SESSION['imie']; ?></td>
        </tr>
        <tr>
            <td>Nazwisko</td>
            <td><?php echo $_SESSION['nazwisko']; ?></td>
        </tr>
        <tr>
            <td>Login</td>
            <td><?php echo $_SESSION['login']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $_SESSION['mail']; ?></td>
        </tr>
        <tr>
            <td>Data urodzenia</td>
            <td><?php echo $_SESSION['dataurodzenia']; ?></td>
        </tr>
        <tr>
            <td>Data utworzenia konta</td>
            <td><?php echo $_SESSION['datautworzenia']; ?></td>
        </tr>
        <tr>
            <td>Konto aktywne</td>
            <td><?php if ($_SESSION['active'] == 0) echo 'NIE';
elseif ($_SESSION['active'] == 1) echo 'TAK'; ?></td>
        </tr>

    </tbody>
</table>

