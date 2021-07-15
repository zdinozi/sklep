<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title></title>
</head>
<body>
    <?php
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
        echo $cena.'<br/>'; 
    
    
    
    ?>
    
    
    
    
</body>
</html>
