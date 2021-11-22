<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Markt</title>
</head>
<body>
<?php
    include 'config.php';
    class Markt
    {
        public $login;
        public function __construct()
        {
            $this->login=$_SESSION['login'];

        }

        public function title()
        {
            global $conn;
            $sql_kasa = 'SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and uzytkownicy.login="' . $this->login . '"';
            $kasa = $conn->query($sql_kasa) or die ('Błędne zapytanie');

            while ($wiersz_kasa = $kasa->fetch_row()) {
                $cena = $wiersz_kasa[0];
            }

            echo '<div class="title-main" style="text-align: center;">LOGGED AS <u>' . $_SESSION['login'] . '</u>. ACCOUNT BALANCE: ' . $cena . 'zł</div><div class="menu-block" onclick="menu()">&#9776;</div></div><br/>';
        }

        public function items()
        {
            global $conn;
            echo "<span id='markt-avilible'>Available items:</span>";

            $sql_sklep = 'SELECT ID_przedmiotu,nazwa, login, Cena FROM przedmioty,uzytkownicy where przedmioty.ID_uzytkownika=uzytkownicy.id';
            $wynik_sklep = $conn->query($sql_sklep) or die ('Błędne zapytanie');

            echo "<div id='markt-table'><table><th class='markt-th'>ID</th><th class='markt-th'>NAME</th><th class='markt-th'>USER</th><th class='markt-th'>PRICE</th><th class='markt-th'>-</th>";

            $i = 0;

            while ($wiersz_sklep = $wynik_sklep->fetch_row()) {
                echo '<tr><td>' . ($i + 1) . '</td><td>' . $wiersz_sklep[1] . '</td><td>' . $wiersz_sklep[2] . '</td><td>' . $wiersz_sklep[3] . '</td><td><input type="button" value="BUY" onclick="buy(this)" id="btn_buy" name="' . $wiersz_sklep[0] . '"></td>';
                $i++;
            }

            echo '</table>';
            echo "<input type='hidden' value='0' id='wynik' name='xdd'>";
            echo '</div>';

            $conn->close();
        }
    }
    if($_SESSION['start']==1) {
        $m1 = new Markt;
        $m1->title();
        $m1->items();
    }
    else{
        header('Location: login.php');
    }

?>
<script>
    function buy(ele){
                    console.log(ele.name);

                    var wartosc = ele.name;
                    var data = new Date();

                    data += Date.now() + 3600;
                    document.cookie = 'id=' + wartosc + '; expires="' + data + '";path=/';
                    window.open("bought.php","_self");
                }
    function menu(){
        if(document.getElementById('menuu').style.opacity==0)
        {
            document.getElementById('menuu').style.opacity=1;
            document.getElementById('menuu').style.width='15%';
        }
        else{
            document.getElementById('menuu').style.opacity=0;
            document.getElementById('menuu').style.width=0;
        }
    }
    function add_item(){
        window.open("add_item.php","_self");
    }
    function add_funds(){
        window.open("charge.php","_self");
    }
    function logout(){
        window.open("logout.php","_self");
    }
    function main(){
        window.open("main.php","_self");
    }
    function markt(){
        window.open("markt.php","_self");
    }
    function usrinfo(){
        window.open("account.php","_self");
    }
</script>

<div id="menuu">
    <div class="menuu" onclick="markt()">Markt</div>
    <div class="menuu" onclick="add_item()">Add Item</div>
    <div class="menuu" onclick="add_funds()">Add Funds</div>
    <div class="menuu" onclick="main()">Main Site</div>
    <div class="menuu" onclick="usrinfo()">User Info</div>
    <div class="menuu" onclick="logout()">Logout</div>
    <div class="menuu" onclick="menu()">X</div>
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
