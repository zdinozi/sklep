<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='styl.css'>
        <title>Dodaj Przedmiot</title>
    </head>
    <body>
        <div class="title-main" style="text-align: center;">PUT ITEM UP FOR SALE</div>
        <div class="menu-block" onclick="menu()">&#9776;</div>

        <div id='add-table'>
            <form action='' method='post'>
                <table>
                    <tr>
                        <td>ITEM NAME:</td>
                        <td><input type='text' name='przedmiot'></td>
                    </tr>
                    <tr>
                        <td>PRICE:</td>
                        <td><input type='number' step='0.01' name='cena'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type='submit' value='ADD' class='sbm'></td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
        include 'config.php';
        if(!empty($_POST['przedmiot']))
            {
                $przedmiot=$_POST['przedmiot'];
                $cena=$_POST['cena'];
                $name=$_SESSION['login'];
                if($przedmiot!="" and $cena!="")
                {

                    $sql='SELECT id FROM uzytkownicy where login="'.$name.'"';
                    $wynik=$conn->query($sql) or die ('Błedne zapytanie.');
                    $ile=mysqli_num_rows($wynik);
                    while($wiersz = $wynik->fetch_row()) {

                        $sql1 = "INSERT INTO `przedmioty` VALUES (NULL,'" . $przedmiot . "','" . $wiersz[0] . "','" . $cena . "',NULL)";
                        $wynik2 = $conn ->query($sql1) or die ('Błedne zapytanie.');

                        $sql_wystawienie = 'UPDATE uzytkownicy SET exhibited_items=(exhibited_items+1) where login="' . $_SESSION["login"] . '"';
                        $wynik_wystawienie = $conn->query($sql_wystawienie) or die ('Błedne zapytanie.');

                        echo '<p style="text-align: center">Wystawiono przedmiot.</p>';

                        $conn->close();
                    }
                }
                else{
                    echo '<p style="text-align: center">Proszę podać nazwę oraz cenę przedmiotu.</p>';
                }
            }
        else{
            echo '';
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
