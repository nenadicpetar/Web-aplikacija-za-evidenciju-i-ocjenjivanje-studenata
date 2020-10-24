<?php

    include 'dbconfig.php';

    if(isset($_POST['prijava_ispita']) && isset($_POST['predmet']) && isset($_POST['id_student'])){
        $id_predmet = $_POST["predmet"];
        $id_student = $_POST["id_student"];
        $pris = $_POST["prijava_ispita"];

        $sql = "UPDATE student_predmet AS sp
        INNER JOIN student AS s
        ON s.id_student = sp.id_student
        SET ispit_prijava = '$pris'
        WHERE s.username = '$id_student'
        AND sp.id_predmet = '$id_predmet'";

        $result = mysqli_query($connect, $sql);
        if($result){
            echo "Uspješno";
        } else {
            echo "Neuspješno".mysqli_error($connect);
        }
    } else {
        echo "Neuspješno!!!!!";
    }
?>