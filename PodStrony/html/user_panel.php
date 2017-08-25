<?php
$title = "USER PANEL";
    echo "Jesteś już zalogowany jako <strong>".$_SESSION['login'].".</strong><br>";
    echo "<strong>Informacje o twojej przeglądarce:</strong> ".$_SESSION['pc_info']."</br>";
    echo "<a href='index.php?akcja=wyloguj'>Wyloguj się</a>";
?>