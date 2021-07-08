<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markt</title>
</head>
<body>
    <?php
    if(isset($_COOKIE['logowanie']))
    {
        echo '<span style="color:blue; font-family:comic sans ms;">Zalogowany jako '.$_COOKIE['logowanie'].'</span><br/>';
        echo "<span style='color:red;'>Dostępne przedmioty:</span><br/>";
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udalo sie polaczyc z baza danych');
        $sql='SELECT nazwa, login, Cena FROM przedmioty,uzytkownicy where przedmioty.ID_uzytkownika=uzytkownicy.id';
        $wynik=mysqli_query($conn,$sql) or die ('Bledne zapytanie');
        $ile=mysqli_num_rows($wynik);
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            echo ($i+1).'. '.$wiersz[0].' od uzytkownika: '.$wiersz[1].' za: '.$wiersz[2].'zł<br/>'; 
        }
        mysqli_close($conn);
    }
    else{
        echo 'nie znaleziono ciasteczek';
    }
    
    
    ?>
    <div id='logout' style='position: fixed; right:0; top:0;'>
        <form action='logout.php' method='post'>
            <input type='submit' value='LOGOUT' name='logout'>
            <input type='button' onclick='add_item()' value="DODAJ PRZEDMIOT" name='add'>
            <script>
                function add_item()
                {
                    window.open('add_item.php','_self');
                }
            </script>
        </form>
    </div>
    
    
    
</body>
</html>
