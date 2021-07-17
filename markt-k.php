<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl-k.css'>
    <title>Markt</title>
</head>
<body>
    <?php
    if(isset($_COOKIE['logowanie']))
    {
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udalo sie polaczyc z baza danych');
        $login=$_COOKIE['logowanie'];
        $sql1='SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and uzytkownicy.login="'.$login.'"';
        $wynik1=mysqli_query($conn,$sql1) or die ('Błędne zapytanie');
        $ile1=mysqli_num_rows($wynik1);
        for($i=0;$i<$ile1;$i++)
            {
            $wiersz1=mysqli_fetch_row($wynik1);
            $cena=$wiersz1[0];
        }
        
        echo '<div id="text"><span style="color:blue; font-family:comic sans ms;">Zalogowany jako '.$_COOKIE['logowanie'].'. Saldo konta: '.$cena.'zł</span><br/>';
        echo "<span style='color:red;'>Dostępne przedmioty:</span><br/>";
        $sql='SELECT ID_przedmiotu,nazwa, login, Cena FROM przedmioty,uzytkownicy where przedmioty.ID_uzytkownika=uzytkownicy.id';
        $wynik=mysqli_query($conn,$sql) or die ('Błędne zapytanie');
        $ile=mysqli_num_rows($wynik);
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            echo ($i+1).'. '.$wiersz[1].' od uzytkownika: '.$wiersz[2].' za: '.$wiersz[3].'zł <input type="button" value="KUP" onclick="buy(this)" class="kup" name="'.$wiersz[0].'"><br/>';
        }
        echo "<input type='hidden' value='0' id='wynik' name='xdd'></div>";
        mysqli_close($conn);
    }
    else{
        echo 'nie znaleziono ciasteczek';
    }
    
    
    ?>
    
    
   
    <div id='menu' class='nav'>
    <a href='charge.php' class='btn'>Add Funds</a>
    <a href='add_item.php' class='btn'>Add Item</a>
    <a href='main.php' class='btn'>Main Page</a>
    <a href='logout.php' class='btn'>Main Page</a>
    <a href='javasript:void(0)' class='closebtn' onclick="closeNav()">&#x2613;</a>
    </div>
    
    <div id='men' onclick='otworz()'><center><span class='menu'>M E N U</span></center></div>
    
    <script>      
    function otworz(){
    document.getElementById('menu').style.width='10%';
    }
    function closeNav(){
    document.getElementById('menu').style.width='0';
    }
    </script>
    
</body>
</html>
