<?php
    include 'dbconfig.php';
    
    if(isset($_POST['kolegij']) && isset($_POST['id_student'])) {
        $id_predmet = $_POST["kolegij"];
        $id_student = $_POST["id_student"];

        $sql = "INSERT INTO student_predmet (id_student, id_predmet)
        VALUES ('$id_student', '$id_predmet')";

        $result = mysqli_query($connect, $sql);
        if($result) {
            echo "Uspješno";
        } else {
            echo "Neuspješno".mysqli_error($connect);
        }
    } else {
        echo "Neuspješno!!!!!".mysqli_error($connect);
    }
?>