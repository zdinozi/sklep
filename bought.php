    <?php
        $id=$_COOKIE['id'];
        echo "Następuje przekierowanie.<br/>";
        echo $_COOKIE['id'];
        $conn=mysqli_connect('localhost','root','','uzytkownicy') or die ('Błędne zapytanie');
        $sql='SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and login="'.$_COOKIE['logowanie'].'"';
        $wynik=mysqli_query($conn, $sql) or die ('Błędne zapytanie');
        $ile=mysqli_num_rows($wynik);
        for($i=0;$i<$ile;$i++)
        {
            $wiersz=mysqli_fetch_row($wynik);
            $ilosc=$wiersz[0];
        }

        $sql2='SELECT id FROM uzytkownicy where login="'.$_COOKIE['logowanie'].'"';
        $wynik2=mysqli_query($conn,$sql2);
        $ile2=mysqli_num_rows($wynik2);
        for($i=0;$i<$ile2;$i++)
            {
            $wiersz2=mysqli_fetch_row($wynik2);
            $id_uzytkownika=$wiersz2[0];
        }

        $sql1='SELECT cena, Nazwa, ID_uzytkownika FROM przedmioty where ID_przedmiotu="'.$id.'"';
        $wynik1=mysqli_query($conn,$sql1);
        $ile1=mysqli_num_rows($wynik1);
        for($i=0;$i<$ile1;$i++)
            {
            $wiersz1=mysqli_fetch_row($wynik1);
            $cena_przedmiotu=$wiersz1[0];
            $nazwa_przedmiotu=$wiersz1[1];
            $id_user=$wiersz1[2];
        }

        if($ilosc>=$cena_przedmiotu)
        {
        $nowa_ilosc=($ilosc-$cena_przedmiotu);
        echo $nowa_ilosc.' Nowa ilosc<br/>';
        $sql3='UPDATE pieniadze SET ilosc="'.$nowa_ilosc.'" where id_uzytkownika="'.$id_uzytkownika.'"';
        $wynik3=mysqli_query($conn,$sql3) or die ('bledne zapytanie');


        $sql_kupno='UPDATE uzytkownicy SET purchaseditems=(purchaseditems+1) where login="'.$_COOKIE["logowanie"].'"';
        $wynik6=mysqli_query($conn,$sql_kupno) or die ('bledne zapytanie');

        $sql4='INSERT INTO transakcje VALUES (NULL, "'.$id_uzytkownika.'" , "'.$nazwa_przedmiotu.'" , "'.$cena_przedmiotu.'" ,current_timestamp())';
        $wynik4=mysqli_query($conn,$sql4) or die ('bledne zapytanie');

        $sql5='DELETE FROM przedmioty WHERE ID_przedmiotu='.$_COOKIE["id"].'';
        $wynik5=mysqli_query($conn,$sql5) or die ('bledne zapytanie');
          
        $sql_user='SELECT ilosc FROM pieniadze,uzytkownicy where pieniadze.id_uzytkownika=uzytkownicy.id and Id_uzytkownika='.$id_user.'';
        $wynik_user=mysqli_query($conn, $sql_user) or die ('Błędne zapytanie');
        $ile_user=mysqli_num_rows($wynik_user);
        for($i=0;$i<$ile_user;$i++)
        {
            $wiersz_user=mysqli_fetch_row($wynik_user);
            $ilosc_user=$wiersz_user[0];
        }
        $ilosc_user=($ilosc_user+$cena_przedmiotu);
        $sql6='UPDATE pieniadze SET ilosc="'.$ilosc_user.'" where id_uzytkownika="'.$id_user.'"';
        $wynik6=mysqli_query($conn,$sql6) or die ('bledne zapytanie');
        }
        
        
        

        mysqli_close($conn);
        setcookie('id','','time()-3600');
        echo $_COOKIE['id']."<br/>";
        echo $_COOKIE['logowanie']."<br/>";
        echo $id_user."<br/>";
        echo $ilosc_user."<br/>";

        $link='<script>window.open("markt.php","_self")</script>';
        echo $link;
    ?>
