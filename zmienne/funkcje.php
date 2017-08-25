<?php

function wyswietl_podstrone($tablica)
{
    $strona1 = "strona_glowna";
    $zm = "PodStrony/html/";
    if (isset($_GET['strona']))
    {
        $strona = filter_var($_GET['strona'],FILTER_SANITIZE_STRING);
        if (!empty($strona))
        {
            if (!in_array($strona,$tablica))
            {
                echo "<div class='alert alert-danger'>Taka strona nie istnieje!<br>Brak rekordu <strong>".$strona."</strong> w tablicy!</div>";
            }
            else
            {                                                                            
                if(is_file($zm.$strona.".html"))
                {
                    include ($zm.$strona.".html");
                }
                else
                {
                    if (is_file($zm.$strona.".php"))
                    {
                        include ($zm.$strona.".php");
                    }
                    else
                    {
                        echo "<div class='alert alert-danger'>Taka strona nie istnieje!<br>Brak pliku <strong>".$strona."</strong> w folderze <strong>".$zm."</strong></div>";
                    }                                                
                }                                                                  
             }  
        }
        else
        {
            include ($zm.$strona1.".html");
        }
    }
    else
    {
        include ($zm.$strona1.".html");
    }
}
function polacz_z_mysql($adres,$user,$password)
{
    $mysqlConnection = @mysql_connect($adres,$user,$password);
  
    if (!@mysql_ping($mysqlConnection))
    {
        echo "<div class='alert alert-danger'>Błąd podczas próby łączenia z bazą!<br>Adres: <strong>".$adres."</strong><br>Użytkownik: <strong>".$user."</strong></div>";
        echo "<div class='alert alert-info'>";
        echo mysql_error();
        echo "</div>";
    }
    else
    {
        echo "<div class='alert alert-success'>Połączono z bazą danych!<br>Adres: <strong>".$adres."</strong><br>Użytkownik: <strong>".$user."</strong></div>";
    }
    return $mysqlConnection;
}
function polacz_z_db($db)
{
    $db_selected = mysql_select_db($db);
        if ($db_selected)
        {
            echo "<div class='alert alert-info'>Pracujesz na <strong>".$db."</strong></div>";
        }
        else
        {
            echo "<div class='alert alert-info'>";
            echo mysql_error();
            echo "</div>";
        }   
        mysql_set_charset("utf8");
}
function rozlacz_z_mysql($connection,$adres)
{
     $mysql_close_connection = mysql_close($connection);
       if ( $mysql_close_connection)
        {
            echo "<div class='alert alert-info'>Zamykam połączenie z <strong>".$adres."</strong><br>".$connection."</div>";
        }
        else
        {
            echo "<div class='alert alert-info'>";
            echo mysql_error();
            echo "</div>";
        }
}
function dodaj_do_mysql($login,$password)
{    
    require ("/zmienne/glowne.php"); 
    $login = filter_var($login, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
    $conn = polacz_z_mysql($mysql_adres, $mysql_user, $mysql_password);
    polacz_z_db($mysql_database);
        $query = "
               INSERT INTO kursphp_users (login,password)
               VALUES
               ('$login', '$password')              
            ";
    $wykonano = mysql_query($query);
    if ($wykonano)
    {
        echo "<div class='alert alert-success'><strong>Wykonano:</strong><br>".$query."</div>";
    }
    else
    {
        echo "<div class='alert alert-danger'>". mysql_error()."</div>";
    }
    rozlacz_z_mysql($conn, $mysql_adres);
}
function wyswietl_users()
{
    require ("/zmienne/glowne.php"); 
    $conn = polacz_z_mysql($mysql_adres, $mysql_user, $mysql_password);
    polacz_z_db($mysql_database);
        $query = "
               SELECT * FROM kursphp_users                      
            ";
    $result = mysql_query($query) or die(mysql_error());
    
    echo "
        <div class='row'>
            <div class='col-md-8'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Login</th>
                            <th>Hasło</th>
                        </tr>
                    </thead>
        "
        ;
    for ($i = 0; $i < mysql_num_rows($result); $i++)
                {
                     $row = mysql_fetch_assoc($result);
                     
                     echo "<tr>";
                     foreach($row as $key => $value)
                     {
                         echo "<td>".$value."</td>";
                     }
                     echo "</tr>";                     
                }
    echo "</table></div></div>";   
    rozlacz_z_mysql($conn, $mysql_adres);
}
function usun_z_mysql($id)
{
 require ("/zmienne/glowne.php"); 
    
        $id = (int)$id;
    
    if ($id != 0)
    {
        $conn = polacz_z_mysql($mysql_adres, $mysql_user, $mysql_password);
        polacz_z_db($mysql_database);

        $query = "
               DELETE FROM kursphp_users
               WHERE
               Id = $id
            ";
        $wykonano = mysql_query($query);
        if ($wykonano)
        {
            echo "<div class='alert alert-success'><strong>Wykonano:</strong><br>".$query."</div>";
        }
        else
        {
            echo "<div class='alert alert-danger'>". mysql_error()."</div>";
        }
    
        rozlacz_z_mysql($conn, $mysql_adres);
    }
    else
    {
        echo "<div class='alert alert-danger'>Musisz podać numer rekordu do usunięcia!</div>";
    }
}
function zapytanie_do_mysql($zapytanie)
{
    require ("/zmienne/glowne.php"); 
    //$zapytanie = filter_var($zapytanie,FILTER_SANITIZE_STRING);
    $conn = polacz_z_mysql($mysql_adres, $mysql_user, $mysql_password);
    polacz_z_db($mysql_database);
    $wykonano = mysql_query($zapytanie);
    if ($wykonano)
    {
        echo "<div class='alert alert-success'><strong>Wykonano:</strong><br>".$zapytanie."</div>";
        echo "
        <div class='row'>
            <div class='col-md-8'>
                <table class='table'>                   
        "
        ;
        for ($i = 0; $i < mysql_num_rows($wykonano); $i++)
                {
                     $row = mysql_fetch_assoc($wykonano);
                     
                     echo "<tr>";
                     foreach($row as $key => $value)
                     {
                        echo "<td>".$value."</td>";
                     }
                     echo "</tr>";                     
                         
                }
        echo "</table></div></div>";   
    }
    else
    {
        echo "<div class='alert alert-danger'>". mysql_error()."</div>";
    }

    rozlacz_z_mysql($conn, $mysql_adres);
}
?>


