<?php
    include 'dbconfig.php';

    if(isset($_POST['kolegij'])) {
        $id_predmet = $_POST["kolegij"];

        $sql = "DELETE FROM predmet
        WHERE id_predmet = '$id_predmet'";

        $result = mysqli_query($connect, $sql);
        if($result) {
            echo "Uspješno";
        } else {
            echo "Neuspješno".mysqli_error($connect);
        }
    } else {
        echo "Neuspješno!!!!!!".mysqli_error($connect);
    }
?>