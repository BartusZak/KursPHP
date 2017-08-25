<?php
session_start();
if (!isset($_SESSION['initiate']))
{
    session_regenerate_id();
    $new_session_id = session_id();
    session_write_close();
    session_id($new_session_id);
    session_start();
    $_SESSION['initiate'] = 1;
}
//zmienne
require_once ("zmienne/glowne.php");
//funkcje
require_once ("zmienne/funkcje.php");


ob_start(); // wstrzymaj ładowanie html, najpierw przelec php
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
       <?php 
            if (isset($_GET['strona']))
            {
                $strona = filter_var($_GET['strona'], FILTER_SANITIZE_STRING);
                if (!empty ($strona))
                {
                    if (!in_array($strona,$dozwolone_strony))
                    {
                        $title = "ERROR 404";
                    }
                    else
                    {
                        if(is_file("PodStrony/php/".$strona.".php"))
                        {
                            include ("PodStrony/php/".$strona.".php"); 
                        }
                        else
                        {
                            $title = "ERROR 404";
                        }
                    }
                }
            }
            else
            {
                include ("PodStrony/php/".$strona1.".php");
            }
                echo "<title>KursPHP - ".$title."</title>";
        ?>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
        <body>                          
            <nav class="navbar navbar-inverse">
                <a class="navbar-brand" href="index.php">
                     <?php echo $logo;?>
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a>Test1</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right ">                        
                        <?php
                            if ((!empty($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == 1))
                            {
                                echo "<li><a>Zalogowany jako: <strong>".$_SESSION['login']."</strong>.</a></li><li><a>|</a></li><li><a href='?akcja=wyloguj'>Wyloguj</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='?strona=logowanie'>Zaloguj się</a></li>";
                            }
                        ?>
                    </ul>
                </div>   
            </nav>
                
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-sm-3 col-md-2" style="height: 100%; border-right: 1px solid #eee;">
                        <ul class="nav">
                            <?php
                            if (!empty($_SESSION['zalogowany']) && ($_SESSION['zalogowany'] == 1))
                            {
                                include ("menu/menu_zalogowany.php");
                            }
                            else
                            {
                                include ("menu/menu_nie_zalogowany.php");
                            }
                            ?>
                            
                        </ul>
                    </nav>
                    <?php
                        if ((isset($_GET['akcja']) && ($_GET['akcja'] == 'wyloguj')) || (!empty($_SESSION['time']) && (time() - $_SESSION['time'] > 60*60)))
                        {
                            $_SESSION['zalogowany'] = 0;
                            session_destroy();
                            header('Refresh: 2;url='.$plik_index);
                            include ("PodStrony/html/wylogowany.html");
                        }
                        echo "<div class='col-lg-10'>";                       
                        if (!empty($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == 1)
                        {
                            wyswietl_podstrone($dozwolone_strony);
                        }
                        else
                        {
                            wyswietl_podstrone($niezalogowany_strony);
                        }                                              
                        if ((!empty($_SESSION['zalogowany'])) &&($_SESSION['zalogowany'] == 1))
                        {
                             $_SESSION['time'] = time();
                        }
                       echo "</div>"
                   ?>
                 </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <span>
                    <?php require_once ("lib/class.Time.php");
                    $a = new Time;    
                    //echo $a ->setText();
                    //echo $a ->setTimeNow(); 
                    echo $a;
                    ?>
                    </span>
                </div>
            </footer>
            <?php           
            ob_end_flush(); //wyrzuc html
            ?>
        </body>
</html>

