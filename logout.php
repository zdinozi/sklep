<?php
    setcookie('logowanie','',time()-3600);
    $_SESSION['login']='';
    $_SESSION['start']=0;
    session_unset();
    session_destroy();
    header('Location: login.php');
    //błąd przy generowaniu sesji, trzeba sprawdzic( po zniszczeniu sesji, po wejsciu przez przegladarke sesja sie zaczyna. trzeba ustawic przy logowaniu tworzenie sesji | nigdzie indziej.)

?>