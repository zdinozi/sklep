<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>1-Rejestracja</title>
</head>
<body>
<div id='register-register'>
<form action='' method='post'>
    <h1>REGISTRATION</h1>
    <center><table>
        <tr><td>Nick:</td><td><input type='text' name='nick' pattern="([A-Za-z0-9]){2,}"></td></tr>
        <tr><td>Password:</td><td><input type='password' name='haslo' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"></td></tr>
        <tr><td>Name:</td><td><input type='text' name='imie' pattern="[a-zA-Ząęźżśóćńł]{3,20}$"></td></tr>
        <tr><td>Surname:</td><td><input type='text' name='nazwisko' pattern="[a-zA-Ząęźżśóćńł]{3,20}$"></td></tr>
        <tr><td>E-mail:</td><td><input type='email' name='mail'></td></tr>
        <tr><td></td><td><input type=submit value="Register" class="sbm"> <input type='reset' value="Clear" class="sbm"></td></tr></table>
<a href='login.php'>Already have an account? Sign in.</a>
       </form></div></center>
<?php
    if(isset($_POST['nick']))
       {
        function register(){
            
            $conn=mysqli_connect('localhost','root','','uzytkownicy') or die('Jadymy');
            $nick=$_POST['nick'];
            $nick=strtolower($nick);
            $haslo=$_POST['haslo'];
            $imie=$_POST['imie'];
            $imie=strtolower($imie);
            $nazwisko=$_POST['nazwisko'];
            $nazwisko=strtolower($nazwisko);
            $mail=$_POST['mail'];
            $sql="INSERT INTO uzytkownicy VALUES (NULL,'$nick','$imie','$nazwisko','$mail','$haslo',current_timestamp(),0,0)";
            $wynik=mysqli_query($conn, $sql) or die("Błąd");
            echo "<center>User has been registered.</center>";

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
