<?php
    include 'dbconfig.php';

    if(!empty($_POST["id_predmet"])) {
        $query = $connect->query("SELECT * FROM student AS st
        INNER JOIN student_predmet AS sp
        ON sp.id_student = st.id_student
        INNER JOIN predmet pr
        ON pr.id_predmet = sp.id_predmet
        WHERE pr.id_predmet = ".$_POST['id_predmet']." ORDER BY prezime ASC");

            $rowCount = $query->num_rows;

            if($rowCount > 0){
                while($row = $query->fetch_assoc()) {
                    echo '<option value="'.$row['id_student'].'">'.$row['ime']." ".$row['prezime'].'</option>';
                }
            } else {
                echo '<option value="">Student nije dostupan</option>';
            }
    }
?>