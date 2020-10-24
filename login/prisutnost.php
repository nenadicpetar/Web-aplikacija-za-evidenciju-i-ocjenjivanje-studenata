<?php
    include_once 'dbconfig.php';
    if(isset($_POST['prisutnost']) && isset($_POST['predmet']) && isset($_POST['studenti'])
        && isset($_POST['pred1']) && isset($_POST ['pred2'])
        && isset($_POST['aud1']) && isset($_POST['aud2'])
        && isset($_POST['isp1']) && isset($_POST['isp2'])){

        $prisutnost = $_POST['prisutnost'];
        $pred1 = $_POST['pred1'];
        $pred2 = $_POST['pred2'];
        $aud1 = $_POST['aud1'];
        $aud2 = $_POST['aud2'];
        $isp1 = $_POST['isp1'];
        $isp2 = $_POST['isp2'];

        if(!empty($prisutnost)){
            $update_fields[] = "prisutnost = '$prisutnost'";
        }
        if(!empty($pred1)){
            $update_fields[] = "kolokvij_pred1 = '$pred1'";
        }
        if(!empty($pred2)){
            $update_fields[] = "kolokvij_pred2 = '$pred2'";
        }
        if(!empty($aud1)){
            $update_fields[] = "kolokvij_aud1 = '$aud1'";
        }
        if(!empty($aud2)){
            $update_fields[] = "kolokvij_aud2 = '$aud2'";
        }
        if(!empty($isp1)){
            $update_fields[] = "ispit_predavanja = '$isp1'";
        }
        if(!empty($isp2)){
            $update_fields[] = "ispit_auditorne = '$isp2'";
        }
        if(count($update_fields) > 0){
            $nonempty_fields = implode(", ", $update_fields);
            $insert = mysqli_query($connect, "UPDATE student_predmet
            SET $nonempty_fields WHERE id_predmet = ".$_POST['predmet']." AND id_student = ".$_POST['studenti']." ");
        } else {
            echo "Must not update!!!".mysqli_error($connect);
        }
    } else {
        echo "Neuspješno!!".mysqli_error($connect);
    }
?>