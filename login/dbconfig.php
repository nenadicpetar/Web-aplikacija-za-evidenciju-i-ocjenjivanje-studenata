<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "zavrsni";

    $connect = new mysqli($hostname, $username, $password, $databaseName);

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
?>