<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>1-Rejestracja</title>
</head>
<body>
<form action='' method='post'>
    <h1>REJESTRACJA</h1>
NICK: <input type='text' name='nick' pattern="([A-Za-z0-9]){2,}" class='btn'><br/>
PASSWORD: <input type='password' name='haslo' class='btn'><br/>
Imię: <input type='text' name='imie' class='btn'><br/>
Nazwisko: <input type='text' name='nazwisko' class='btn'><br/>
E-mail: <input type='email' name='mail' class='btn'><br/>
<input type=submit value="Zarejestruj" class='btn'><input type='reset' value="Wyczyść" class='btn'><br/>
<a href='login.php'>Masz już konto? Zaloguj się!</a>
       </form>
<?php
    if(isset($_POST['nick']))
       {
        function register(){
            
            $conn=mysqli_connect('localhost','root','','uzytkownicy') or die('Jadymy');
            $nick=$_POST['nick'];
            $haslo=$_POST['haslo'];
            $imie=$_POST['imie'];
            $nazwisko=$_POST['nazwisko'];
            $mail=$_POST['mail'];
            $sql="INSERT INTO uzytkownicy VALUES (NULL,'$nick','$imie','$nazwisko','$mail','$haslo',current_timestamp(),0,0)";
            $wynik=mysqli_query($conn, $sql) or die("Błąd");
            echo "Zarejestrowano użytkownika.";

            $sql1='SELECT id FROM uzytkownicy WHERE login="'.$nick.'"';
            $wynik1=mysqli_query($conn,$sql1);
            $ile=mysqli_num_rows($wynik1);
            for($i=0;$i<$ile;$i++)
            {
            $wiersz=mysqli_fetch_row($wynik1);
            $id=$wiersz[0];
            }

            $sql2='INSERT INTO pieniadze VALUES (NULL,0,"'.$id.'")';
            $wynik2=mysqli_query($conn,$sql2) or die ('Błędne zapytanie');

            mysqli_close($conn);
        }
        register();
        }
    ?>
</body>
</html>
