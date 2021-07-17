<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Markt</title>
</head>
<body>
<div id='menu-markt'>
    <a href='main.php'> <div id='menu-markt-4'>MAIN PAGE</div></a>
    <a href='charge.php'><div id='menu-markt-1'>ADD FUNDS</div></a>
    <a href='add_item.php'><div id='menu-markt-3'>ADD ITEM</div></a>
    <a href='logout.php'><div id='menu-markt-2'>LOGOUT</div></a>
</div>
    
    
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
        echo '<div id="markt-items">';
        echo '<div id="markt-login"><span>LOGGED AS <u>'.$_COOKIE['logowanie'].'</u>. ACCOUNT BALANCE: '.$cena.'zł</span></div><br/>';
        echo "<span style='color:#981816;' id='markt-avilible'>Available items:</span>";
        $sql='SELECT ID_przedmiotu,nazwa, login, Cena FROM przedmioty,uzytkownicy where przedmioty.ID_uzytkownika=uzytkownicy.id';
        $wynik=mysqli_query($conn,$sql) or die ('Błędne zapytanie');
        $ile=mysqli_num_rows($wynik);
        echo "<div id='markt-table'><center><table><th>ID</th><th>NAME</th><th>USER</th><th>PRICE</th><th>-</th>";
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            echo '<tr><td>'.($i+1).'</td><td>'.$wiersz[1].'</td><td>'.$wiersz[2].'</td><td>'.$wiersz[3].'</td><td><input type="button" value="BUY" onclick="buy(this)" id="btn_buy" name="'.$wiersz[0].'"></td>';
        }
        echo '</table>';
        echo "<input type='hidden' value='0' id='wynik' name='xdd'>";
        mysqli_close($conn);
    }
    else{
        echo 'nie znaleziono ciasteczek';
    }
    echo '</div></center></div>';
?>
<script>
    function buy(ele){
                    console.log(ele.name);
                    var wartosc=ele.name;
                    var data=new Date();
                    data+=Date.now()+3600;
                    document.cookie='id='+wartosc+'; expires="'+data+'";path=/';
                    window.open("bought.php","_self");
                }
</script>
</body>
</html>
