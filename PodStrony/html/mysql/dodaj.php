<h1>Dodajesz rekord do bazy</h1>
<form action="index.php?strona=mysql_connect&mysql=dodaj" method="post">
    <label>Login:</label>
    <input name="login_mysql">
    <label>Hasło:</label>
    <input name="password_mysql">
    <button class="btn btn-default" type="submit">Utwórz</button>
</form>
<?php
if ((isset($_POST['login_mysql'])) && (isset($_POST['password_mysql'])))
{
    if ((!empty($_POST['login_mysql'])) && (!empty($_POST['password_mysql'])))
    {
        dodaj_do_mysql($_POST['login_mysql'],$_POST['password_mysql']);
    }
    else
    {
        echo "<div class='alert alert-danger'>Nie podałeś <strong>login</strong> lub <strong>hasło</strong></div>";
    }
}

?>
