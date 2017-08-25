<h1>Zapytanie do bazy danej</h1>
<form action="?strona=mysql_connect&mysql=zapytanie" method="post">

    <textarea class="form-control" rows="5" name="query_mysql"></textarea>
    <button class="btn btn-default" type="submit">Wykonaj</button>
</form>
<?php
if ((isset($_POST['query_mysql'])))
{
    if ((!empty($_POST['query_mysql'])))
    {
        zapytanie_do_mysql($_POST['query_mysql']);
    }
    else
    {
        echo "<div class='alert alert-danger'>Nie podałeś <strong>zapytania</strong></div>";
    }
}

?>
