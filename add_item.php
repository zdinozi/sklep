<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Dodaj Przedmiot</title>
</head>
<body>
    <div id='add-main'>
    <form action='' method='post'>
        <h3>PUT ITEM UP FOR SALE</h3>
    <center><table>
        <tr><td>ITEM NAME:</td><td><input type='text' name='przedmiot'></td></tr>
    <tr><td>PRICE:</td><td><input type='number' step='0.01' name='cena'></td></tr>
        <tr><td></td><td><input type='submit' value='ADD' class='sbm'></td></tr>
    </table></center>
    </form>
    </div>
    <?php 
    echo '<center>';    
    if(isset($_POST['przedmiot']))
        {
            $przedmiot=$_POST['przedmiot'];
            $cena=$_POST['cena'];
            $name=$_COOKIE['logowanie'];
            if($przedmiot!="" and $cena!="")
            {
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
                mysqli_close($conn);
            }
            else{
                    echo "Proszę podać nazwę oraz cenę przedmiotu.";
            }
        }
    else{
    }
    echo '</center>';
    ?>
    <div id='logout' style='position: fixed; right:0; top:0;'>
    <form action='logout.php' method='post'>
    <input type='button' value='MARKET' onclick='shop()' class='btn'>
    <input type='submit' value='LOGOUT' class='btn'>
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
