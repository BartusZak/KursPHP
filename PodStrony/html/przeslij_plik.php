<?php
$max_file_size_bytes = 30720;
$max_file_size = $max_file_size_bytes/1024;

            if(isset($_FILES['plik']))
            {       
                $max_file_size_uploaded = (round(($_FILES['plik']['size'])/1024));
                if ($max_file_size_uploaded <= $max_file_size)
                {
                    switch($_FILES['plik']['error'])
                    {
                        case 0:
                        {
                            if ($_FILES['plik']['type'] == "image/jpeg" || $_FILES['plik']['type'] == "image/gif" || $_FILES['plik']['type'] == "image/png")
                            {
                                move_uploaded_file($_FILES['plik']['tmp_name'], "images/przeslij_plik/".date('Y-m-d').md5(rand()*rand()+rand()).$_FILES['plik']['name']);
                                echo "<div class='alert alert-success'>Plik <strong>".$_FILES['plik']['name']."</strong> został przesłany na serwer.</div>";
                            }
                            else
                            {
                               echo "<div class='alert alert-danger'>Niedozwolone rozszerzenie piku!</div>";
                               echo "<div class='alert alert-info'>Dozwolone rozszerzenia pliku: <strong>.png .jpg .gif</strong>.</div>";
                            }
                        }
                            break;
                        case 1:
                        {
                            echo "<div class='alert alert-danger'>Za duży plik (php.ini)";
                        }
                            break;
                        case 2:
                            echo "<div class='alert alert-danger'>Zbyt duży plik <strong>".$max_file_size_uploaded."</strong> KB.</div>";
                            echo "<div class='alert alert-info'>Dozwolona wielkość pliku: <strong>".$max_file_size."</strong> KB.</div>";
                            break;
                        case 3:
                            echo "<div class='alert alert-danger'>Uszkodzony plik <strong>".$_FILES['plik']['name']."</strong>.</div>";
                            break;
                        case 4:
                            echo "<div class='alert alert-danger'>Nie wybrano pliku!</div>";
                            break;                    
                        default:
                            echo "<div class='alert alert-danger'>Błąd!</div>";                        
                    }   
                }
                else
                {
                    echo "<div class='alert alert-danger'>Zbyt duży plik <strong>".$_FILES['plik']['name']."</strong>.</div>";
                    echo "<div class='alert alert-info'>Dozwolona wielkość pliku: <strong>".$max_file_size."</strong> KB.<br>Wielkość przesłanego pliku: <strong>".$max_file_size_uploaded."</strong> KB</div>";
                }
                
            }
?>
<form action="index.php?strona=przeslij_plik" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="3072000"/>
        <input type="file" name="plik"/>
        <hr>
        <button class="btn" type="submit">Dodaj plik</button>
    </div>
</form>

<?php
if(isset($_FILES['plik']))
{
    echo "<h3>Tablica z informacjami o przesłanym pliku</h3>";
    print_r($_FILES['plik']);
}
?>

