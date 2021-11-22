<?php
include 'config.php';
class Acces
{
    public $acces;
    public function __construct()
    {
        if ($_SESSION['login'] != '') {
            $this->acces=1;
        }
        else
        {
            $this->acces=0;
        }
    }
}
$p1=new Acces();
?>