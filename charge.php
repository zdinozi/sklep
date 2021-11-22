<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>Doładuj</title>
</head>
<body>
    <div class="title-main" style="text-align: center;">CHARGE ACCOUNT</div>
    <div class="menu-block" onclick="menu()">&#9776;</div>
        <div id="charge-table">
            <form action='' method='post'>
                <table>
                    <tr>
                        <td>
                            <span>Amount to boost: </span>
                        </td>
                        <td>
                            <input type='number' step='0.01' name='kwota'>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value="Boost" class='sbm'>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    <?php
    if(!empty($_POST['kwota']))
    {
        if($_POST['kwota']>0)
        {
            include 'config.php';
            global $conn;

            $kwota=$_POST['kwota'];
            $sql='Update pieniadze SET ilosc=(ilosc+'.$kwota.') WHERE uzytkownicy.id=pieniadze.id_uzytkownika and uzytkownicy.login="'.$_SESSION["login"].'"';
            $wynik=$conn->query($sql) or die ('Błąd');
            echo '<p style="text-align: center; font-weight: bold;">Account topped up.</p>';
            }
        else 
        {
            echo '<p style="text-align: center; font-weight: bold;">Please insert amount.</p>';
        }
    }
    else{
        echo '<p style="text-align: center; font-weight: bold;">Please insert amount.</p>';
        }
    ?>
    </div>
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
