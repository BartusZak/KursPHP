<h1>Usun rekord z bazy danej</h1>
<form action="index.php?strona=mysql_connect&mysql=usun" method="post">
    <label>Id rekordu:</label>
    <input name="id_mysql">
    <button class="btn btn-danger" type="submit">Usuń</button>
</form>
<?php
if ((isset($_POST['id_mysql'])))
{
    if ((!empty($_POST['id_mysql'])))
    {
        usun_z_mysql($_POST['id_mysql']);
    }
    else
    {
        echo "<div class='alert alert-danger'>Nie podałeś <strong>Id rekordu</strong></div>";
    }
}
?>
