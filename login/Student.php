<?php
    session_start();
    include 'dbconfig.php';

    $username = $_SESSION['username'];
    $query = $connect->query("SELECT * FROM predmet AS pr
    INNER JOIN student_predmet AS sp
    ON sp.id_predmet = pr.id_predmet
    INNER JOIN student AS st
    ON st.id_student = sp.id_student
    WHERE username = '$username'
    ORDER BY naziv ASC");

    $rowCount = $query->num_rows;
     
?>
<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Web sustav za evidenciju i ocjenjivanje studenata|Student</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="javascript/jquery.min.js"></script>
        <style>
            body {
                background-color: lightsteelblue;
                padding: 0px;
                margin: 0px;
            }

            table {
                height: 1020px;
                width: 880px;
                border-radius: 20px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 90px;
                margin-bottom: 90px;
                background-color: lavender;
            }

            .shadow {
                box-shadow: 40px 40px 40px whitesmoke;
            }

            .button2 {
                height: 36px;
                width: 158px;
                font-size: 17px;
                background-color: lightcyan;
                border-radius: 5px;
                box-shadow: 3px 3px 3px black;
            }

            .button2:hover {
                background-color: #BED9D9;
            }

            select {
                border-radius: 7px;
                height: 36px;
                color: black;
                font-size: 17px;
            }

            .select2 {
                padding-left: 5px;
                width: 346px;
                -webkit-appearance: none;
            }

            td {
                padding-left: 30px;
                padding-right: 10px;
                border-radius: 7px;
                font-size: 19px;
            }

            .button4 {
                height: 35px;
                width: auto;
                font-size: 15px;
            }

            a {
                color: blue;
            }

            a:link {
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            .logo {
                margin-left: 15px;
            }

            .header{
                background-color: #485C5C;
                color: white;
                text-align: center;
                top: 0px;
                width: 99,9%;
                padding: 5px;
            }

            h4, .odjavi {
                padding-left: 5px;
            }
        </style>
        

    </head>
    <body>
        <div class="header">
            <h1>WEB aplikacija za evidenciju i ocjenjivanje studenata</h1>
        </div>
        <br>
        <div>
            <a class="logo" href="https://www.ferit.unios.hr/" target="_blank"><img src="ferit-logo-350.png" alt="FERIT - logo"></a>
        </div>
        <br>
        <br>

            <?php
                if(isset($_SESSION['message'])) {
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
            ?>
        <div>
            <h4>Dobrodošli <?php echo $_SESSION['username']; ?></h4>
        </div>
        <div class="odjavi">
            <a href="../Student/logout.php">Odjavite se</a>
        </div>

        <div>
            <table border="0" class="shadow">
                <tr></tr>
                <tr>
                    <td>Naziv kolegija</td>
                    <td align="center"><select name="predmet" id="predmet" style="width: 346px; font-size: 17px;">
                        <option value="">Odaberite kolegij</option>
                        <?php
                            if($rowCount > 0) {
                                while($row = $query->fetch_assoc()) {
                                    echo '<option value="'.$row['id_predmet'].'">'.$row['naziv'].'</option>';
                                }
                            } else {
                                echo '<option value="">Kolegij nije dostupan</option>';
                            }
                        ?>
                    </select></td>
                </tr>
                <tr style="display: none;">
                        <td><select name="idStudenti" id="idStudenti">

                             <?php
                             echo '<option value="'.$_SESSION['username'].'">'.$_SESSION['username'].'</option>';  
                             ?>
                        </select></td>
                </tr>
                <tr style="height: 50px;"></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size: 20px;"><strong>Uspjeh na kolegiju</strong></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>Prisutnost</td>
                    <td align="center"><select class="select2" name="prisutnost" id="prisutnost" disabled></select>
                    </td>
                </tr>
                <tr>
                    <td>Predavanja 1.kolokvij</td>
                    <td align="center"><select class="select2" name="pred_1kol" id="pred_1kol" disabled></select></td>
                </tr>
                <tr>
                    <td>Predavanja 2.kolokvij</td>
                    <td align="center"><select class="select2" name="pred_2kol" id="pred_2kol" disabled></select></td>
                </tr>
                <tr>
                    <td>Auditorne vježbe 1.kolokvij</td>
                    <td align="center"><select class="select2" name="aud_1kol" id="aud_1kol" disabled></select></td>
                </tr>
                <tr>
                    <td>Auditorne vježbe 2.kolokvij</td>
                    <td align="center"><select class="select2" name="aud_2kol" id="aud_2kol" disabled></select></td>
                </tr>
                <tr>
                    <td>Ispit Predavanja</td>
                    <td align="center"><select class="select2" name="pred_ispit" id="pred_ispit" disabled></select></td>
                </tr>
                <tr>
                    <td>Ispit Auditorne vježbe</td>
                    <td align="center"><select class="select2" name="aud_ispit" id="aud_ispit" disabled></select></td>
                </tr>
                <tr></tr>
                <tr>
                    <td>Kolokviji - ocjena</td>
                    <td align="center"><select class="select2" name="kol_oc" id="kol_oc" disabled></select></td>
                </tr>
                <tr>
                    <td>Ispiti - ocjena</td>
                    <td align="center"><select class="select2" name="isp_oc" id="isp_oc" disabled></select></td>
                </tr>
                <tr></tr>
                <tr style="height: 50px;"></tr>
                <tr>
                    <td>Potvrdite ocjenu</td>
                    <td align="center"><select name="potvrdi_1" id="potvrdi_1" style="width: 170px; font-size: 17px; padding-left: 5px;">
                            <option value="DA">DA</option>
                            <option value="NE">NE</option>
                    </select>
                    &nbsp;&nbsp;
                    <input class="button2" type="button" name="potvrda" id="potvrda" value="Potvrdite ocjenu">
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>Prijava ispita</td>
                    <td align="center"><select name="prijava_ispita" id="prijava_ispita" style="width: 170px; font-size: 17px; padding-left: 5px;">
                        <option value="Predavanja">Predavanja</option>
                        <option value="Auditorne vjezbe">Auditorne vježbe</option>
                        <option value="Cijeli kolegij">Cijeli kolegij</option>
                    </select>
                    &nbsp;&nbsp;
                    <input class="button2" type="button" name="ispit" id="ispit" value="Prijavite ispit" >
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
            </table>
        </div>
        <br>
        <br>
        <div class="odjavi">
            <h3>Prijavite se na kolegij</h3>
            <a href="novi_kolegiji.php">Novi kolegij</a>
        </div>
        <br>
        <br>
    </body>

    <script type="text/javascript">
            $(document).ready(function() {

                $('#predmet').on('change',function() {
                    var idpredmet = $(this).val();
                    var idStudent = $('#idStudenti').val();
                    var data = {'id_predmet': idpredmet,
                                'id_student': idStudent};
                    console.log(data);
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type:'post',
                            url:'studentData.php',
                            dataType: 'JSON',
                            success:function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#prisutnost").find(":selected").html(student_object.prisutnost);
                            }
                        });
                    } else {
                        $('#prisutnost').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData2.php',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#pred_1kol").find(":selected").html(student_object.kolokvij_pred1);
                            }
                        });
                    } else {
                        $('#pred_1kol').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData3.php',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#pred_2kol").find(":selected").html(student_object.kolokvij_pred2);
                            }
                        });
                    } else {
                        $('#pred_2kol').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData4.php',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#aud_1kol").find(":selected").html(student_object.kolokvij_aud1);
                            }
                        });
                    } else {
                        $('#aud_1kol').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData5.php',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#aud_2kol").find(":selected").html(student_object.kolokvij_aud2);
                            }
                        });
                    } else {
                        $('#aud_2kol').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData6.php',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#pred_ispit").find(":selected").html(student_object.ispit_predavanja);
                            }
                        });
                    } else {
                        $('#pred_ispit').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData7.php',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);
                                var student_object = data[0];
                                $("#aud_ispit").find(":selected").html(student_object.ispit_auditorne);
                            }
                        });
                    } else {
                        $('#aud_ispit').html('<option value="">Molimo odaberite kolegij</option>');
                    }

                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData8.php',
                            dataType: 'JSON',
                            success: function(data) {
                                console.log(data);
                                var student_object = data[0];
                                $("#kol_oc").find(":selected").html(student_object.suma_kolokviji);
                            }
                        });
                    } else {
                        $("#kol_oc").html('<option value="">Molimo odaberite kolegij</option>');
                    }

                    if(idpredmet) {
                        $.ajax({
                            data: data,
                            type: 'post',
                            url: 'studentData9.php',
                            dataType: 'JSON',
                            success: function(data) {
                                console.log(data);
                                var student_object = data[0];
                                $("#isp_oc").find(":selected").html(student_object.ispit_ocjena);
                            }
                        });
                    } else {
                        $("#isp_oc").html('<option value="">Molimo odaberite kolegij</option>');
                    }
                });

                $(document).on('click', '#potvrda', function(e){
                    var potvrdi_1 = $("#potvrdi_1").val();
                    var idpredmet = $("#predmet").val();
                    var idStudent2 = $('#idStudenti').val();
                    var data = {'potvrdi_1': potvrdi_1,
                                    'predmet': idpredmet,
                                    'id_student': idStudent2};
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "potvrdi.php",
                        success: function(data){
                            swal("Poruka: " + data, "Odabir evidentiran u bazi!", "success");
                        },
                        complete: function(data) {
                            console.log("poruka: " + data);
                        }
                    });
                });

                $(document).on('click', '#ispit', function(e){
                    var idpredmet = $('#predmet').val();
                    var idStudent2 = $('#idStudenti').val();
                    var prijava_ispita = $('#prijava_ispita').val();
                    $.ajax({
                        data: {'predmet': idpredmet,
                                'id_student': idStudent2,
                                'prijava_ispita': prijava_ispita},
                        type: "POST",
                        url: "prijava_ispita.php",
                        success: function(data){
                            swal(data, "Prijavili ste ispit!", "success");
                        },
                        complete: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
    </script>
</html>