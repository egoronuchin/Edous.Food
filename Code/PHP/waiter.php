<?php
session_start();
if(!isset($_SESSION['ID_CONTACT'])){ //Если не авторизован - идм на ../Code/PHP/index.php
    session_destroy();
    header('location: ../Code/PHP/index.php');
}
?>
<!-- Код страницы официанта -->