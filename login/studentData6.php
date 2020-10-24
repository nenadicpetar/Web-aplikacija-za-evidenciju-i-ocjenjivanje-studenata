<?php
    include 'dbconfig.php';

    if(isset($_POST['id_predmet']) && isset($_POST['id_student'])) {
        $return_arr = array();
        $id_predmet = $_POST["id_predmet"];
        $id_student = $_POST["id_student"];

        $query = "SELECT * FROM student_predmet AS sp
        INNER JOIN predmet AS p
        ON sp.id_predmet = p.id_predmet
        INNER JOIN student AS s
        ON sp.id_student = s.id_student
        WHERE p.id_predmet = '$id_predmet' AND s.username = '$id_student'";

        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)) {
            $pred_ispit = $row['ispit_predavanja'];

            $return_arr[] = array("ispit_predavanja" => $pred_ispit);
        }

        echo json_encode($return_arr);

    } else {
        echo "neuspješno";
    }
?>