<?php
session_start();
$conn = new mysqli('localhost','zdinozi_zdinozi-shop','straz1pozarna','zdinozi_zdinozi-shop') or die("Can't connect with database.");
$conn->set_charset("utf8")
?>