<?php
   
    $cookieexpiry = time() -60*60*24*3;
    session_start();
    $_SESSION = array();
    unset($_SESSION['user']);
    session_destroy();
    setcookie("login", '', $cookieexpiry, '/');
    header("Location: ../../login.php");
    exit;
?>