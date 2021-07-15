<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>main</title>
</head>
<body>
<?php 
    if(isset($_COOKIE['logowanie']))
    {
    echo '<div id="powitanie"><span id="powitanie">Witaj '.strtoupper($_COOKIE['logowanie']).'!</span></div><br/>';
    }
    else{
    echo 'nie znaleziono ciasteczek';
    }
    ?>
    <div id='logout' style='position: fixed; right:0; top:0;'>
    <form action='logout.php' method='post'>
    <input type='submit' value='LOGOUT' class='btn'>
    </form>
        </div>
    <div id='animation'>
    <div id='shop'>
    <a href='markt.php'><img src='shop.png' class="main" alt='shop'></a>
        </div>
    <div id='user'>
    <a href='account.php'><img src='uzytkownik.png' class="main" alt='user'></a>
    </div></div>
</body>
</html>
