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
        if($_COOKIE['logowanie']==$wiersz[1])
        {
            echo "<h1>INFORMACJE</h1><br/>";
            echo "Imie: ".$wiersz[2]."<br/>";
            echo "Nazwisko: ".$wiersz[3]."<br/>";
            echo "Login: ".$wiersz[1]."<br/>";
            echo "E-mail: ".$wiersz[4]."<br/>";
            echo "Kupione rzeczy: ".$wiersz[7]."<br/>";
            echo "Wystawione rzeczy: ".$wiersz[8]."<br/>";
            echo "Data dołączenia: ".$wiersz[6];
            
            
        }
    }
    mysqli_close($conn);
    ?>
</body>
</html>
