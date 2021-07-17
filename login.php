<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>login</title>
</head>
<body id="login-body">
    <div id='login-main'>
    <h1>SIGN IN</h1></div>
    
    <div id='login-data'>
    <form action='' method='post'>
    <center><table>
        </center><tr><td>USER LOGIN:</td><td><input type='text' name='login' pattern="([A-Za-z9-0]){2,}"></td></tr>
        <tr><td>PASSWORD:</td><td><input type='password' name='password'></td></tr></table></center>
    <input type='submit' value='Sign in' class="sbm"><br/>
    <a href='register.php'>Don't have an account? Register here.</a>
    </form>
    <?php
    if (isset($_POST['login']))
    {
        $login=$_POST['login'];
        $login=strtolower($login);
        $password=$_POST['password'];
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Nie udalo sie polaczyc');        
        $sql='SELECT login, password FROM uzytkownicy';
        $wynik=mysqli_query($conn,$sql) or die ('Bledne zapytanie');
        $ile=mysqli_num_rows($wynik);
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            if($login==$wiersz[0] && $password==$wiersz[1])
            {
                setcookie('logowanie',$login,time()+3600);
                $link='<script>window.open("main.php","_self")</script>';
                echo $link;
            }
            else continue;
        }
        echo "Failed logging in.";
    }
    else{
    }
        ?>
        
        </div>
</body>
</html>
