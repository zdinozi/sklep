<!DOCTYPE html>
<html lang="pl">
<head>
<!--    <title>USER PROFILE</title>-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
</head>
<body>
<div class="title-main" style="text-align: center;">INFORMATION</div>
<div class="menu-block" onclick="menu()">&#9776;</div>
    <?php
    include 'config.php';
    if($_SESSION['login']!='')
    {
        global $conn;
        $sql = "SELECT * FROM uzytkownicy";
        $wynik = $conn->query($sql) or die ('Błędne zapytanie.');
        $ile = $wynik->num_rows;
        while ($wiersz = $wynik->fetch_row()) {
            echo '<table>';
            if ($_SESSION['login'] == $wiersz[1]) {
                echo "<div id='account-table' style='margin-top: 10px;'><table id='account-table-table'><tr><td class='fontt'>Name:</td><td>" . ucfirst($wiersz[2]) . "</td></tr>";
                echo "<tr><td class='fontt'>Surname:</td><td>" . ucfirst($wiersz[3]) . "</td></tr>";
                echo "<tr><td class='fontt'>Login:</td><td>" . ucfirst($wiersz[1]) . "</td></tr>";
                echo "<tr><td class='fontt'>E-mail:</td><td>" . $wiersz[4] . "</td></tr>";
                echo "<tr><td class='fontt'>Bought items:</td><td>" . $wiersz[7] . "</td></tr>";
                echo "<tr><td class='fontt'>Issued items:</td><td>" . $wiersz[8] . "</td></tr>";
                echo "<tr><td class='fontt'>User creation date:</td><td>" . $wiersz[6] . "</td></tr>";
                echo "</table></div>";

                echo "<div id='account-item-text'><h2>Bought items</h2></div>";
                $id = 'SELECT id FROM uzytkownicy WHERE login="' . $_SESSION['login'] . '"';
                $wynik_id = $conn->query($id) or die ('Błąd.');
                $ile_id = $wynik_id->num_rows;
                while ($wiersz_id = $wynik_id->fetch_row()) {
                    $user_id = $wiersz_id[0];
                }

                $transakcje = "SELECT nazwa_przedmiotu, cena, data_kupna from transakcje where id_kupca='$user_id'";
                $wynik_transakcje = $conn->query($transakcje) or die ('Błąd');
                $ile_transakcje = $wynik_transakcje->num_rows;
                $i = 0;
                if ($ile_transakcje != 0) {
                    echo "<div id='account-ttable'><table><th>AI</th><th>NAME</th><th>PRICE</th><th>DATE</th>";
                    while ($wiersz_transakcje = $wynik_transakcje->fetch_row()) {
                        echo "<tr><td class='account-t'>" . ($i + 1) . "</td><td class='account-t'>" . $wiersz_transakcje[0] . "</td><td class='account-t'>" . $wiersz_transakcje[1] . "</td><td class='account-t'>" . $wiersz_transakcje[2] . "</td></tr>";
                        $i++;
                    }
                    echo "</table></div>";
                } else {
                    echo "<p style='text-align: center'><b>No items have been purchased yet</b></p>";
                    $i++;
                }


            }
        }
        $conn->close();
    }
    else{
        header('Location: login.php');
    }
    ?>
<script>
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
        <a href="https://github.com/zdinozi" target="_blank"><img src="github-ww.png" style="width: 50px; height: 50px;"></a>&nbsp;&nbsp<a href="https://www.linkedin.com/in/wiktor-banasiak-672425222/" target="_blank"><img src="linkedin.png" style="width: 50px; height: 50px;"></a>
    </footer>
</body>
</html>
