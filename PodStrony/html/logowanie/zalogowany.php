<?php
session_start();
?>
<head>
    <link rel="stylesheet" href="/KursPHP/css/bootstrap.min.css">
    <title>Logowanie</title>
</head>
<body>
    <div class="container">
        <?php
        if ((isset($_POST['login']) && isset($_POST['haslo'])) ||  ((!empty($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == 1)))
        {
            if((!empty($_POST['login']) && !empty($_POST['haslo'])) || ((!empty($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == 1)))
            {
                $login = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
                $haslo = filter_var($_POST['haslo'],FILTER_SANITIZE_STRING);
                if (($login == "123" && $haslo == "123") || ((!empty($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == 1)))
                {
                    echo "<div class='alert alert-success'>Zalogowano - <b>".$login."</b>.</div>";
                    $_SESSION['zalogowany'] = 1;
                    $_SESSION['login'] = $login;
                    $_SESSION['time'] = time();
                    $_SESSION['pc_info'] = $_SERVER['HTTP_USER_AGENT'];
                    header('Refresh: 2;url=/KursPHP/index.php');
                }
                else
                {
                    echo "<div class='alert alert-danger'>Błędny login lub hasło!</div>";
                    header('Refresh: 3;url=/KursPHP/index.php?strona=logowanie');
                }
            }
            else
            {
                echo "<div class='alert alert-danger'>Nie podaleś loginu lub hasła!</div>";
                header('Refresh: 3;url=/KursPHP/index.php?strona=logowanie');
            }
        }
        
        
        ?>
        <div class="alert alert-info">
            Zostaniesz przekierowany automatycznie! Jeśli nie kliknij <a href="/KursPHP/index.php"><strong>tutaj<strong></a>!
        </div>
    </div>
    
</body>

