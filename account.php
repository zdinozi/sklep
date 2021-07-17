<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Profil uzytkownika</title>
</head>
<body>
    <div id='logout' style='position: fixed; right:0; top:0;'>
    <form action='logout.php' method='post'>
    <input type='submit' value='LOGOUT' class='btn'>
    <input type='button' value='STRONA GŁÓWNA' onclick='main()' class='btn'>
    <script>
        function main()
        {
            window.open('main.php','_self');
        }
    </script>
    </form>
        </div>
    
    <?php
    $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udało się połączyć z bazą danych');
    $sql="SELECT * FROM uzytkownicy";
    $wynik=mysqli_query($conn,$sql) or die ('Błędne zapytanie.');
    $ile=mysqli_num_rows($wynik);
    for($i=0; $i<$ile; $i++)
    {
        $wiersz=mysqli_fetch_row($wynik);
        echo '<center><table>';
        if($_COOKIE['logowanie']==$wiersz[1])
        {
            echo "<div id='account-info'><h1>INFORMACJE</h1></div>";
            echo "<div id='account-table'><tr><td>Imie:</td><td>".$wiersz[2]."</td></tr>";
            echo "<tr><td>Nazwisko:</td><td>".$wiersz[3]."</td></tr>";
            echo "<tr><td>Login:</td><td>".$wiersz[1]."</td></tr>";
            echo "<tr><td>E-mail:</td><td>".$wiersz[4]."</td></tr>";
            echo "<tr><td>Kupione rzeczy:</td><td>".$wiersz[7]."</td></tr>";
            echo "<tr><td>Wystawione rzeczy:</td><td>".$wiersz[8]."</td></tr>";
            echo "<tr><td>Data dołączenia:</td><td>".$wiersz[6]."</td></tr>";
            echo "</table></center></div>";
            
            echo "<div id='account-item-text'><h2>Kupione przedmioty</h2></div>";
            $id='SELECT id FROM uzytkownicy WHERE login="'.$_COOKIE['logowanie'].'"';
            $wynik_id=mysqli_query($conn,$id) or die ('Błąd.');
            $ile_id=mysqli_num_rows($wynik_id);
            for($i=0;$i<$ile_id;$i++)
            {
            $wiersz_id=mysqli_fetch_row($wynik_id);
            $user_id=$wiersz_id[0];
            }
            
            $transakcje="SELECT nazwa_przedmiotu, cena, data_kupna from transakcje where id_kupca='$user_id'";
            $wynik_transakcje=mysqli_query($conn,$transakcje) or die ('Błąd');
            $ile_transakcje=mysqli_num_rows($wynik_transakcje);
            echo "<center><table><th>AI</th><th>NAME</th><th>PRICE</th><th>DATE</th>";
            for($i=0;$i<$ile_transakcje;$i++)
            {
            $wiersz_transakcje=mysqli_fetch_row($wynik_transakcje);
            echo "<tr><td>".($i+1)."</td><td>".$wiersz_transakcje[0]."</td><td>".$wiersz_transakcje[1]."</td><td>".$wiersz_transakcje[2]."</td></tr>";
            }
            echo "</table></center>";
            
        }
    }
    mysqli_close($conn);
    ?>
</body>
</html>
