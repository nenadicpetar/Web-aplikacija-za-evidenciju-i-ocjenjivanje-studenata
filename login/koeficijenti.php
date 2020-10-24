<?php
    include 'dbconfig.php';

    if(!empty($_POST["id_predmet"])) {
        $query = $connect->query("SELECT * FROM predmet");

        $rowCount = $query->num_rows;

        if($rowCount > 0) {
            while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row['id_predmet'].'">'.$row['pred_koef'].'</option>';
            }
        } else {
            echo '<opton value="">Nije dostupno</option>';
        }
    }
?>