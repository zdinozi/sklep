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
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udalo sie polaczyc z baza danych');
        $login='zdinozi';
        $sql1='SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and uzytkownicy.login="'.$login.'"';
        $wynik1=mysqli_query($conn,$sql1) or die ('Błędne zapytanie');
        $ile1=mysqli_num_rows($wynik1);
        for($i=0;$i<$ile1;$i++)
        {
        $wiersz1=mysqli_fetch_row($wynik1);
        $cena=$wiersz1[0];
        }
        
        echo '<span style="color:blue; font-family:comic sans ms;">Zalogowany jako '.$_COOKIE['logowanie'].'. Saldo konta: '.$cena.'zł</span><br/>';
        echo "<span style='color:red;'>Dostępne przedmioty:</span><br/>";
        $sql='SELECT ID_przedmiotu,nazwa, login, Cena FROM przedmioty,uzytkownicy where przedmioty.ID_uzytkownika=uzytkownicy.id';
        $wynik=mysqli_query($conn,$sql) or die ('Błędne zapytanie');
        $ile=mysqli_num_rows($wynik);
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            echo ($i+1).'. '.$wiersz[1].' od uzytkownika: '.$wiersz[2].' za: '.$wiersz[3].'zł <input type="button" value="KUP" id="'.$wiersz[0].'"><br/>';
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
            <input type='button' onclick='main()' value="STRONA GŁÓWNA" name='add'>
            <script>
                function main()
                {
                    window.open('main.php','_self');
                }
                function add_item()
                {
                    window.open('add_item.php','_self');
                }
            </script>
        </form>
    </div>
    
    
    
</body>
</html>
