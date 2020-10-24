<?php
    include 'dbconfig.php';

    if(!empty($_POST["id_predmet"])) {
        $id_predmet = $_POST['id_predmet'];
        $query = $connect->query("SELECT * FROM predmet
        WHERE id_predmet = '$id_predmet'");

        $rowCount = $query->num_rows;

        if($rowCount > 0) {
            while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row['pred_koef'].'">'.$row['pred_koef'].'</option>';
            }
        } else {
            echo '<option value="">Nije dostupno</option>';
        }
    }
?>