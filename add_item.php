<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Przedmiot</title>
</head>
<body>
    <form action='' method='post'>
        <h3>WYSTAW PRZEDMIOT NA SPRZEDAŻ</h3>
    Nazwa przedmiotu: <input type='text' name='przedmiot'><br/>
    Cena: <input type='number' name='cena'><br/>
    <input type='submit' value='DODAJ'>
    </form>
    <?php 
    $przedmiot=$_POST['przedmiot'];
    $cena=$_POST['cena'];
    $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Błędne połączenie z bazą danych.');
    $id=
    
    
    
    ?>
</body>
</html>
