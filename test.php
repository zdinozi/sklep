<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title></title>
</head>
<body>
    <?php
        include 'acces.php';
        echo $_SESSION['login'].'<br>';
        global $acces;
        echo $acces;
    
    ?>
    
    
    
    
</body>
</html>
