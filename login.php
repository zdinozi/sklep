<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>login</title>
</head>
<body>
    <div id='login-main'>
        <h1>SIGN IN</h1>
    </div>
    
    <div id='login-data'>
        <form action='' method='post'>
            <table>
                <tr>
                    <td>User Login:</td>
                    <td><input type='text' name='login' pattern="([A-Za-z9-0]){2,}"></td>
                </tr>
                <tr>
                    <td>Password:</td><td><input type='password' name='password'></td>
                </tr>
                <tr><td></td>
                    <td><input type='submit' value='Sign in' class="sbm"></td>
                </tr>
            </table>
        </form>
    </div>
    <a href='register.php' class="aclass">Don't have an account? Register here.</a>
    <?php

    class Login
    {
        public $login;
        public $password;
        public function __construct()
        {
            if(!empty($_POST['login']) && !empty($_POST['password'])) {
                $this->login = strtolower($_POST['login']);
                $this->password = md5($_POST['password']);
            }
            else{
                echo '<p style="text-align: center; font-weight: bold;">Please complete the form.</p>';
            }
        }
        public function loggin()
        {
            $conn = new mysqli('localhost','zdinozi_zdinozi-shop','straz1pozarna','zdinozi_zdinozi-shop') or die("Can't connect with database.");
            $conn->set_charset("utf8");
            $sql='SELECT password FROM uzytkownicy WHERE login="'.$this->login.'" LIMIT 1';
            $wynik = $conn -> query($sql) or die ('Błędne zapytanie.');
            while($obj = $wynik->fetch_object())
            {
                if($this->password==$obj->password)
                {
                    session_start();
                    setcookie('logowanie',$this->login,time()+3600);
                    $_SESSION['login']=$this->login;
                    $_SESSION['start']=1;
                    header('Location: main.php');
                }
                else{
                    echo 'Podano błędne hasło.';
                }
            }
        }
    }
    if(!empty($_POST['login']) && !empty($_POST['password'])) {
        $log=new Login;
        $log->loggin();
    }
    else{
        echo '<p style="text-align: center; font-weight: bold;">Please complete the form.</p>';
    }
        ?>

    <footer>
        <a href="https://github.com/zdinozi" target="_blank"><img src="github-ww.png" style="width: 50px; height: 50px;"></a>&nbsp;&nbsp;
        <a href="https://www.linkedin.com/in/wiktor-banasiak-672425222/" target="_blank"><img src="linkedin.png" style="width: 50px; height: 50px;"></a>
    </footer>
</body>
</html>
