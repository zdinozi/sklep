<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Doładuj</title>
</head>
<body>

<div id='logout' style='position: fixed; right:0; top:0;'>
        <form action='logout.php' method='post'>
            <input type='submit' value='LOGOUT' name='logout' class='btn'>
            <input type='button' onclick='markt()' value="MARKT" name='add' class='btn'>
            <input type='button' onclick='main()' value="STRONA GŁÓWNA" name='add' class='btn'>
            <script>
                function main()
                {
                    window.open('main.php','_self');
                }
                function markt()
                {
                    window.open('markt.php','_self');
                }
                function buy(ele){
                    console.log(ele.name);
                    var wartosc=ele.name;
                    var data=new Date();
                    data+=Date.now()+3600;
                    document.cookie='id='+wartosc+'; expires="'+data+'";path=/';
                    window.open("bought.php","_self");
                }
            </script>
        </form>
    </div>
    
<form action='' method='post'><label>Kwota do doładowania: </label><input type='number' step='0.01' name='kwota'><input type='submit' value="Doładuj"></form>
    <?php
    if(isset($_POST['kwota']))
    {
        if($_POST['kwota']>0)
        {
            $kwota=$_POST['kwota'];
            $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udalo sie polaczyc z baza danych');
            $sql='Update pieniadze SET ilosc=(ilosc+'.$kwota.')';
            $wynik=mysqli_query($conn,$sql);
            echo 'Doładowano konto.';
            }
        else 
        {
            echo 'Wprowadź poprawną kwotę.';
        }}
    else{
        echo 'Proszę wprowadzić kwotę.';
            }   
    ?>
</body>
</html>
