<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="?strona=mysql_connect" >Operacje na MySQL</a>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="?strona=mysql_connect&mysql=dodaj">Dodaj</a>
                </li>
                <li>
                    <a href="?strona=mysql_connect&mysql=usun">Usuń</a>
                </li>
                <li>
                    <a href="?strona=mysql_connect&mysql=zapytanie">Zapytanie</a>
                </li>
            </ul>
        </div>
    </div>
</div>
    <?php
    if (isset($_GET['mysql']))
    {
        $mysql = filter_var($_GET['mysql'], FILTER_SANITIZE_STRING);
        if (!empty($_GET['mysql']))
        {
           if ($_GET['mysql']== "dodaj")
           {
               require ("mysql/dodaj.php");
           }
           if ($_GET['mysql']== "usun")
           {
               require ("mysql/usun.php");
           }
           if ($_GET['mysql']== "zapytanie")
           {
               require ("mysql/zapytanie.php");
           }
        }
        else
        {
            echo "<div class='alert alert-danger'>ERROR 404</div>";
        }        
    }
    if (@$_GET['mysql'] != 'zapytanie')
    {
        wyswietl_users();
    }
    ?>