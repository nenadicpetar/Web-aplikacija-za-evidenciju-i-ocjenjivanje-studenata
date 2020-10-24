<?php
    include 'dbconfig.php';

    if(!empty($_POST["id_predmet"])) {
        $query = $connect->query("SELECT * FROM student AS st
        INNER JOIN student_predmet AS sp
        ON sp.id_student = st.id_student
        INNER JOIN predmet pr
        ON pr.id_predmet = sp.id_predmet
        WHERE pr.id_predmet = ".$_POST['id_predmet']."
        ORDER BY prezime ASC ");

            $rowCount = $query->num_rows;

            if($rowCount > 0){
                while($row = $query->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td align="left" style="width: +10%; padding-left: 5px;">'.$row['ime']." ".$row['prezime'].'</td>';
                    echo '<td style="width: +10%">'.$row['prisutnost'].'</td>';
                    echo '<td style="width: +10%">'.$row['kolokvij_pred1'].'</td>';
                    echo '<td style="width: +10%">'.$row['kolokvij_pred2'].'</td>';
                    echo '<td style="width: +10%">'.$row['kolokvij_aud1'].'</td>';
                    echo '<td style="width: +10%">'.$row['kolokvij_aud2'].'</td>';
                    echo '<td style="width: +10%">'.$row['ispit_predavanja'].'</td>';
                    echo '<td style="width: +10%">'.$row['ispit_auditorne'].'</td>';
                    echo '<td style="width: +10%">'.$row['ispit_prijava'].'</td>';
                    echo '<td style="width: +10%">'.$row['potvrda'].'</td>';
                    echo '</tr>';
                }
            } else {
                echo '<option value=""></option>';
            }
    } else {
        echo "Neuspješno !!!!!!!";
    }
?>