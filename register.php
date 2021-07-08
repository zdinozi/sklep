<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-Rejestracja</title>
</head>
<body>
<form action='' method='post'>
    <h1>REJESTRACJA</h1>
NICK: <input type='text' name='nick'><br/>
PASSWORD: <input type='password' name='haslo'><br/>
<input type=submit value="Zarejestruj"><input type='reset' value="Wyczyść"><br/>
<a href='login.php'>Masz już konto? Zaloguj się!</a>
       </form>
<?php
    if(isset($_POST['nick']))
       {
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die('Jadymy');
        $nick=$_POST['nick'];
        $haslo=$_POST['haslo'];
        $sql="INSERT INTO uzytkownicy VALUES (NULL,'$nick','$haslo')";
        $wynik=mysqli_query($conn, $sql) or die("Błąd");
        echo "Dodano do bazy";
       }
    ?>
</body>
</html>
