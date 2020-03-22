<?php
    session_start();
    $_SESSION = array();
    unset($_SESSION['user']);
    session_destroy();
    $cookieexpiry = time() -60*60*24*3;
    setcookie("login", '', $cookieexpiry, '/');
    header("Location: ../../admin/login.php");
    exit;
?>