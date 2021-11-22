<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Main site</title>
</head>
<body>
<?php 
    if(isset($_COOKIE['logowanie']))
    {
    echo '<div id="main-hello"><span id="powitanie">WELCOME '.strtoupper($_COOKIE['logowanie']).'!</span></div><br/>';
    }
    else{
    echo 'nie znaleziono ciasteczek';
    }
    ?>
<!--    <div id='logout' style='position: fixed; right:0; top:0;'>-->
<!--        <form action='logout.php' method='post'>-->
<!--            <input type='submit' value='LOGOUT' class='btn'>-->
<!--        </form>-->
<!--    </div>-->
    <div id='animation'>
        <div id='shop'>
            <a href='markt.php'>
                <img src='shop.png' class="main" alt='shop'>
                <br/>
                <h2>MARKET</h2>
            </a>
        </div>
        <div id='user'>
                <a href='account.php'>
                    <img src='uzytkownik.png' class="main" alt='user'>
                    <br/>
                    <h2>USER INFO</h2>
                </a>
        </div>
    </div>
<footer>
    <a href="https://github.com/zdinozi" target="_blank">
        <img src="github-ww.png" style="width: 50px; height: 50px;">
    </a>&nbsp;&nbsp;
    <a href="https://www.linkedin.com/in/wiktor-banasiak-672425222/" target="_blank">
        <img src="linkedin.png" style="width: 50px; height: 50px;">
    </a>
</footer>
</body>
</html>
