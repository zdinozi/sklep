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
    echo 'Witaj '.$_COOKIE['logowanie'].' ';
    }
    else{
    echo 'nie znaleziono ciasteczek';
    }
    ?>
    <form action='logout.php' method='post'>
    <input type='submit' value='LOGOUT'>
    </form>
    
    <a href='markt.php'>RYNEK</a>
    
</body>
</html>
