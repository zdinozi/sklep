<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
</head>
<body>
<?php 
    if(isset($_COOKIE['logowanie']))
    {
    echo 'Witaj '.strtoupper($_COOKIE['logowanie']).'!<br/>';
    }
    else{
    echo 'nie znaleziono ciasteczek';
    }
    ?>
    <div id='logout' style='position: fixed; right:0; top:0;'>
    <form action='logout.php' method='post'>
    <input type='submit' value='LOGOUT'>
    </form>
        </div>
    <a href='markt.php'>RYNEK</a>
    <a href='account.php'>Profil użytkownika</a>
    
</body>
</html>
