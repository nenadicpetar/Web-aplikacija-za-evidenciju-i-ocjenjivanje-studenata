<?php
    include_once 'dbconfig.php';

    if(isset($_POST['kolegij2']) && isset($_POST['pred_koef']) && isset($_POST['aud_koef']) && isset($_POST['godina'])) {

        $kolegij = $_POST['kolegij2'];
        $unos1 = $_POST['pred_koef'];
        $unos2 = $_POST['aud_koef'];
        $godina = $_POST['godina'];

        $sql = "INSERT INTO predmet (naziv, pred_koef, aud_koef, godina)
        VALUES ('$kolegij', '$unos1', '$unos2', '$godina')";

        $result = mysqli_query($connect, $sql);
        if($result) {
            echo 'Uspješno';
        } else {
            echo 'Neuspješno'.mysqli_error($connect);
        }
    } else {
        echo 'Neuspješno!!!'.mysqli_error($connect);
    }
?>