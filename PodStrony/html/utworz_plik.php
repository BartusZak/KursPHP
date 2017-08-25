<?php
if ((isset($_POST['plik'])) && (isset($_POST['rozszerzenie'])) && (isset($_POST['tresc'])))
{
    if ((!empty($_POST['plik'])) && (!empty($_POST['rozszerzenie'])) && (!empty($_POST['tresc'])))
    {
        $wskaznik = fopen("pliki/".$_POST['plik'].$_POST['rozszerzenie'],"w");
        if ($wskaznik)
        {
            fwrite($wskaznik,$_POST['tresc']);
             echo "<div class='alert alert-success'>Utworzono plik: <strong>".$_POST['plik'].$_POST['rozszerzenie']."</strong></div>";
        }
    }
    else
    {
        echo "<div class='alert alert-danger'>Nie podałeś <strong>nazwy, rozszerzenia lub treści pliku</strong>, który chcesz utworzyć!</div>";
    }
}
?>
<form action="?strona=utworz_plik" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nazwa">Nazwa pliku:</label>
        <input name="plik" type="text"/>
    </div>
    <div class="form-group">
        <label for="sel1">Rozszerzenie:</label>
        <select class="form-control" name="rozszerzenie">
            <option>.txt</option>
            <option>.pdf</option>
            <option>.doc</option>
            <option>.docx</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tresc">Treść pliku:</label>
        <textarea class="form-control" rows="5" name="tresc"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="utworz">Utwórz</button>
</form>