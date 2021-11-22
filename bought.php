    <?php
        include 'config.php';
        global $conn;
        $id=$_COOKIE['id'];
        echo $_COOKIE['id'];
        $sql='SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and login="'.$_COOKIE['logowanie'].'"';
        $wynik=$conn->query($sql) or die ('Błędne zapytanie  sql');
        $ile=mysqli_num_rows($wynik);
        $ilosc=0;
        while($wiersz=$wynik->fetch_row())
        {
            $ilosc=$wiersz[0];
        }

        $sql_id='SELECT id FROM uzytkownicy where login="'.$_COOKIE['logowanie'].'"';
        $wynik2=$conn->query($sql_id) or die("sqlid");
        $ile2=mysqli_num_rows($wynik2);
        $id_uzytkownika=0;
        while($wiersz2=$wynik2->fetch_row())
            {
            $id_uzytkownika=$wiersz2[0];
        }

        $sql1='SELECT cena, Nazwa, ID_uzytkownika FROM przedmioty where ID_przedmiotu="'.$id.'"';
        $wynik1=$conn->query($sql1) or die( "sql1");
        $ile1=mysqli_num_rows($wynik1);
        $cena_przedmiotu=0;
        $nazwa_przedmiotu='';
        $id_user=0;
        while($wiersz1=$wynik1->fetch_row())
            {
            $cena_przedmiotu=$wiersz1[0];
            $nazwa_przedmiotu=$wiersz1[1];
            $id_user=$wiersz1[2];
        }

        if($ilosc>=$cena_przedmiotu)
        {
            $nowa_ilosc=($ilosc-$cena_przedmiotu);

            echo $nowa_ilosc.' Nowa ilosc<br/>';

            $sql_aktualizacja='UPDATE pieniadze SET ilosc="'.$nowa_ilosc.'" where id_uzytkownika="'.$id_uzytkownika.'"';
            $wynik3=$conn->query($sql_aktualizacja) or die ('bledne zapytanie sqlaktualizacja');


            $sql_kupno='UPDATE uzytkownicy SET purchaseditems=(purchaseditems+1) where login="'.$_COOKIE["logowanie"].'"';
            $wynik6=$conn->query($sql_kupno) or die ('bledne zapytanie sqlkupno');

            $sql4='INSERT INTO transakcje VALUES (NULL, "'.$id_uzytkownika.'" , "'.$nazwa_przedmiotu.'" , "'.$cena_przedmiotu.'" ,current_timestamp())';
            $wynik4=$conn->query($sql4) or die ('bledne zapytanie sql4');

            $sql5='DELETE FROM przedmioty WHERE ID_przedmiotu='.$_COOKIE["id"].'';
            $wynik5=$conn->query($sql5) or die ('bledne zapytanie sql5');

            $sql_user='SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and Id_uzytkownika='.$id_user.'';
            $wynik_user=mysqli_query($conn, $sql_user) or die ('Błędne zapytanie sqluser');
            $ilosc_user=0;
            while($wiersz_user=$wynik_user->fetch_row())
            {
                $ilosc_user=$wiersz_user[0];
            }
            $ilosc_user=($ilosc_user+$cena_przedmiotu);
            $sql6='UPDATE pieniadze SET ilosc="'.$ilosc_user.'" where id_uzytkownika="'.$id_user.'"';
            $wynik6=$conn->query($sql6) or die ('bledne zapytanie sql6');
        }
        
        
        

        $conn->close();
        setcookie('id','','time()-3600');
        echo $_COOKIE['id']."<br/>";
        echo $_COOKIE['logowanie']."<br/>";
        echo $id_user."<br/>";
        echo $ilosc_user."<br/>";

//        header('Location: markt.php');
    ?>
