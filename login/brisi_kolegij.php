<?php
    include 'dbconfig.php';

    if(isset($_POST['kolegij']) && isset($_POST['id_student'])) {
        $id_predmet = $_POST["kolegij"];
        $id_student = $_POST["id_student"];

        $sql = "DELETE FROM student_predmet
        WHERE id_predmet = '$id_predmet' AND id_student = '$id_student'";

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