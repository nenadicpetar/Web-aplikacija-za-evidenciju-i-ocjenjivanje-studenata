<?php
    session_start();
    session_destroy();
    unset($_SESSION['username']);
    $_SESSION['message'] = "Odjavljeni ste";
    header("location: login.php");
?>