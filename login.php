<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>login</title>
</head>
<body>
    <h1>LOGOWANIE</h1>
    <form action='' method='post'>
    LOGIN: <input type='text' name='login' pattern="([A-Za-z9-0]){2,}"><br/>
    PASSWORD: <input type='password' name='password'><br/>
    <input type='submit' value='ZALOGUJ'><br/>
    <a href='register.php'>Nie masz konta? Zarejestruj się!</a>
    </form>
    <?php
    if (isset($_POST['login']))
    {
        $login=$_POST['login'];
        $password=$_POST['password'];
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udalo sie polaczyc');        
        $sql='SELECT login, password FROM uzytkownicy';
        $wynik=mysqli_query($conn,$sql) or die ('Bledne zapytanie');
        $ile=mysqli_num_rows($wynik);
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            if($login==$wiersz[0] && $password==$wiersz[1])
            {
                setcookie('logowanie',$login,time()+3600);
                $link='<script>window.open("main.php","_self")</script>';
                echo $link;
            }
            else continue;
        }
        echo 'nie udalo sie zalogowac.';
    }
    else{
    }
        ?>
        
        
</body>
</html>
