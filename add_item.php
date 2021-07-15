<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Dodaj Przedmiot</title>
</head>
<body>
    <form action='' method='post'>
        <h3>WYSTAW PRZEDMIOT NA SPRZEDAŻ</h3>
    Nazwa przedmiotu: <input type='text' name='przedmiot'><br/>
    Cena: <input type='number' step='0.01' name='cena'><br/>
    <input type='submit' value='DODAJ'>
    </form>
    <?php 
        if(isset($_POST['przedmiot']))
        {
            $przedmiot=$_POST['przedmiot'];
            $cena=$_POST['cena'];
            $name=$_COOKIE['logowanie'];
            $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Błędne połączenie z bazą danych.');
            $sql='SELECT id FROM uzytkownicy where login="'.$name.'"';
            $wynik=mysqli_query($conn,$sql) or die ('Błedne zapytanie.');
            $ile=mysqli_num_rows($wynik);
            for($i=0;$i<$ile;$i++)
            {
                $wiersz=mysqli_fetch_row($wynik);
            }
            $sql1="INSERT INTO `przedmioty` VALUES (NULL,'".$przedmiot."','".$wiersz[0]."','".$cena."',NULL)";
            $wynik2=mysqli_query($conn,$sql1) or die ('Błedne zapytanie.');
            $sql_wystawienie='UPDATE uzytkownicy SET exhibited_items=(exhibited_items+1) where login="'.$_COOKIE["logowanie"].'"';
            $wynik_wystawienie=mysqli_query($conn,$sql_wystawienie) or die ('Błedne zapytanie.');
            echo 'Wystawiono przedmiot.<br/>';
            echo '<a href="markt.php"><input type="button" value="Markt"></a>';
            mysqli_close($conn);
        }
    
    ?>
    <div id='logout' style='position: fixed; right:0; top:0;'>
    <form action='logout.php' method='post'>
    <input type='submit' value='LOGOUT'>
    <input type='button' value='PRZEGLĄDAJ SKLEP' onclick='shop()'>
    <script>
        function shop()
        {
            window.open('markt.php','_self');
        }
    </script>
    </form>
        </div>
</body>
</html>
