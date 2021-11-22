<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styl.css'>
    <title>1-Rejestracja</title>
</head>
<body>
<div id="register-reg"><h1>REGISTRATION</h1></div>
<div id='register-register'>
    <form action='' method='post'>
        <table>
            <tr>
                <td>Nick:</td>
                <td><input type='text' name='nick' pattern="([A-Za-z0-9]){2,}"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type='password' name='haslo' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type='text' name='imie' pattern="[a-zA-Ząęźżśóćńł]{3,20}$"></td>
            </tr>
            <tr>
                <td>Surname:</td><td><input type='text' name='nazwisko' pattern="[a-zA-Ząęźżśóćńł]{3,20}$"></td>
            </tr>
            <tr>
                <td>E-mail:</td><td><input type='email' name='mail'></td>
            </tr>
            <tr>
                <td></td>
                <td><input type=submit value="Register" class="sbm"> <input type='reset' value="Clear" class="sbm"></td>
            </tr>
        </table>
    </form>
</div>
<a href='login.php' class="aclass">Already have an account? Sign in.</a>
<?php
    class Register
    {
        public $nick;
        public $haslo;
        public $imie;
        public $nazwisko;
        public $mail;

        public function __construct()
        {
            if(!empty($_POST['nick']) && !empty($_POST['haslo']) && !empty($_POST['mail']) && !empty($_POST['imie']) && !empty($_POST['nazwisko'])) {
                $this->nick = strtolower($_POST['nick']);
                $this->haslo = md5($_POST['haslo']);
                $this->imie = strtolower($_POST['imie']);
                $this->nazwisko = strtolower($_POST['nazwisko']);
                $this->mail = $_POST['mail'];
            }
            else{
                echo '<p style="text-align: center; margin-top: 5px;"><b>Please complete the form.</b></p>';
            }
        }
        public function register()
        {
            $conn = new mysqli('localhost','zdinozi_zdinozi-shop','straz1pozarna','zdinozi_zdinozi-shop') or die("Can't connect with database.");
            $conn->set_charset("utf8");

//            echo $this->nick.' '.$this->nazwisko." ".$this->imie." ".$this->haslo." ".$this->mail;
            $sql = "INSERT INTO uzytkownicy VALUES (NULL,'" . $this->nick . "','" . $this->imie . "','" . $this->nazwisko . "','" . $this->mail . "','" . $this->haslo . "',current_timestamp(),0,0)";
            $wynik=$conn->query($sql) or die ('<p style="text-align: center; margin-top: 5px;"><b>Nie udało się dodać użytkownika do bazy danych.</b></p>');

            echo '<p style="text-align: center; margin-top: 5px;"><b> User has been registered.</b></p>';

            $conn->close();
        }
        public function money()
        {
            $conn = new mysqli('localhost','zdinozi_zdinozi-shop','straz1pozarna','zdinozi_zdinozi-shop') or die("Can't connect with database.");
            $conn->set_charset("utf8");

            $sql1 = 'SELECT id FROM uzytkownicy WHERE login="' . $this->nick . '"';
            $wynik1 = $conn->query($sql1) or die ("błędne zapytanie sql1");

            while($wiersz = $wynik1->fetch_row())
            {
                $id = $wiersz[0];
                $sql2 = 'INSERT INTO pieniadze VALUES (NULL,0,"' . $id . '")';
                $wynik2 = $conn->query($sql2) or die ('Błędne zapytanie sql2');
            }
            $conn->close();
        }
        public function acces(){
            if(!empty($_POST['nick']) && !empty($_POST['haslo']) && !empty($_POST['mail']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }

    }
    $reg=new Register;
    if($reg->acces()==1) {
        $reg->register();
        $reg->money();
    }
    else
    {
        echo '<p style="text-align: center; margin-top: 5px;"><b>Insert values again.</b></p>';
    }
    ?>
<footer>
    <a href="https://github.com/zdinozi" target="_blank"><img src="github-ww.png" style="width: 50px; height: 50px;"></a>&nbsp;&nbsp;
    <a href="https://www.linkedin.com/in/wiktor-banasiak-672425222/" target="_blank"><img src="linkedin.png" style="width: 50px; height: 50px;"></a>
</footer>
</body>
</html>
