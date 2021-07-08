<?php
    setcookie('logowanie','',time()-3600);
    $link='<script>window.open("login.php","_self")</script>';
    echo $link;
?>