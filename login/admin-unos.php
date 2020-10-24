<?php
    include 'dbconfig.php';

    if(isset($_POST['kolegij']) && isset($_POST['id_profesor'])) {
        $id_predmet = $_POST["kolegij"];
        $id_profesor = $_POST["id_profesor"];

        $sql = "INSERT INTO profesor_predmet (id_profesor, id_predmet)
        VALUES ('$id_profesor', '$id_predmet')";

        $result = mysqli_query($connect, $sql);
        if($result) {
            echo "Uspješno";
        } else {
            echo "Neuspješno".mysqli_error($connect);
        }
    } else {
        echo "Neuspješno!!!!!!!!!".mysqli_error($connect);
    }
?>