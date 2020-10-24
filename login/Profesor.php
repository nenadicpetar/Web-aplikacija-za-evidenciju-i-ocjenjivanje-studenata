<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "zavrsni");

    $username = $_SESSION['username'];
    $query = $db->query("SELECT * FROM predmet pr
    INNER JOIN profesor_predmet AS pp
    ON pp.id_predmet = pr.id_predmet
    INNER JOIN profesor p
    ON p.id_profesor = pp.id_profesor
    WHERE username = '$username' 
    ORDER BY naziv ASC");

    $rowCount = $query->num_rows;
?>
<!DOCTYPE html>
<html lang="hr">
    <head>
        <title>Web sustav za evidenciju i ocjenjivanje studenata|Profesor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="javascript/jquery.min.js"></script>

        <style>
            body {
                padding: 0px;
                margin: 0px;
                background-color: lightgreen;
            }

            td {
                height: 70px;
                padding-left: 30px;
                padding-right: 30px;
                border-radius: 7px;
                font-size: 19px;
            }

            select, .ocjene {
                width: 415px;
                height: 28px;
                font-size: 19px;
                color: black;
                border-radius: 5px;
                -webkit-appearance: none;
                padding-left: 5px;
            }

            .logo {
                margin-left: 15px;
            }

            .ocjene {
                padding-left: 5px;
                text-align: right;
            }

            table {
                align: center;
                width: 950px;
                border-radius: 20px;
                background-color: lightblue;
                margin-top: 90px;
                margin-bottom: 90px;
                box-shadow: 40px 40px 40px green;
            }

            .unos {
                width: 415px;
                font-size: 19px;
                border-radius: 5px;
                padding-left: 5px;
            }

            .button {
                height: 45px;
                width: 135px;
                background-color: lightgray;
                border-radius: 5px;
                box-shadow: 3px 3px 3px black;
                font-size: 15px;
            }

            .button2 {
                height: 45px;
                width: auto;
                background-color: lightgray;
                border-radius: 5px;
                box-shadow: 3px 3px 3px black;
                font-size: 15px;
            }

            .button3 {
                height: 30px;
                font-size: 15px;
                width: 81px;
                margin-right: 62px;
                background-color: #dedede;
                border-radius: 5px;
                box-shadow: 2px 2px 2px black;
            }

            .button3:hover, .button:hover, .button2:hover {
                background-color: #BDBDBD;
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

            .header{
                background-color: #485C5C;
                color: white;
                text-align: center;
                top: 0px;
                width: 99,9%;
                padding: 5px;
            }

            .moje {
                padding-left: 5px;
            }

        </style>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script type="text/javascript" src="javascript/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#predmet').on('change',function() {
                    var idpredmet = $(this).val();
                    if(idpredmet) {
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'id_predmet='+idpredmet,
                            success:function(html){
                                $('#studenti').html(html);
                            }
                        });
                    } else {
                        $('#studenti').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                });
                $('#predmet').on('change', function() {
                    var idpredmet = $(this).val();
                    if(idpredmet) {
                        $.ajax({
                            type: 'POST',
                            url: 'koeficijenti_predavanja.php',
                            data: 'id_predmet='+idpredmet,
                            success: function(data) {
                                $('#predavanje2').html(data);
                            }
                        });
                    } else {
                        $('#predavanje2').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                });
                $('#predmet').on('change', function() {
                    var idpredmet = $(this).val();
                    if(idpredmet) {
                        $.ajax({
                            type: 'POST',
                            url: 'koeficijenti_auditorne.php',
                            data: 'id_predmet='+idpredmet,
                            success: function(data) {
                                $('#auditorne2').html(data);
                            }
                        });
                    } else {
                        $('#auditorne2').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                });
                //  
            });

            $(document).on('click', '#unesi', function(e){
                var prisutnost = $("#prisutnost");
                var pred1 = $("#pred1");
                var pred2 = $("#pred2");
                var aud1 = $("#aud1");
                var aud2 = $("#aud2");
                var isp1 = $("#isp1");
                var isp2 = $("#isp2");
                var idPredmet = $('#predmet');
                var idStudent = $('#studenti');
                $.ajax({
                    data: {'prisutnost': prisutnost.val(),
                            'pred1': pred1.val(),
                            'pred2': pred2.val(),
                            'aud1': aud1.val(),
                            'aud2': aud2.val(),
                            'isp1': isp1.val(),
                            'isp2': isp2.val(),
                            'predmet': idPredmet.val(),
                            'studenti': idStudent.val()},
                    type: "post",
                    url: "prisutnost.php",
                    success: function(data){
                        swal(data, "Unijeli ste podatke!", "success");
                    },
                    complete: function(data) {
                        console.log("poruka: " + data);
                    }
                });
            });
            
            $(document).on('click', '#predavanja', function(e){
                var idPredmet = $('#predmet');
                var idStudent = $('#studenti');
                var predavanje2 = $('#predavanje2');
                $.ajax({
                    data: {'predmet': idPredmet.val(),
                                'studenti': idStudent.val(),
                                'predavanje2': predavanje2.val()},
                    type: "post",
                    url: "predavanja_ukupno.php",
                    success: function(data) {
                        $('#pred_ukupno').html(data);
                    },
                    complete: function (data) {
                        console.log("poruka: " + data);
                    }
                });
            });

            $(document).on('click', '#aud_vjez', function(e){
                var idPredmet = $('#predmet');
                var idStudent = $('#studenti');
                var auditorne2 = $('#auditorne2');
                $.ajax({
                    data: {'predmet': idPredmet.val(),
                                    'studenti': idStudent.val(),
                                    'auditorne2': auditorne2.val()},
                    type: "post",
                    url: "auditorne_ukupno.php",
                    success: function(data) {
                        $('#aud_ukupno').html(data);
                    },
                    complete: function(data) {
                        console.log("Poruka: " + data);
                    }
                });
            });

            $(document).on('click', '#ispit', function(e){
                var idPredmet = $('#predmet');
                var idStudent = $('#studenti');
                var predavanje2 = $('#predavanje2');
                var auditorne2 = $('#auditorne2');
                $.ajax({
                    data: {'predmet': idPredmet.val(),
                                    'studenti': idStudent.val(),
                                    'predavanje2': predavanje2.val(),
                                    'auditorne2': auditorne2.val()},
                    type: "post",
                    url: "ispit_ukupno.php",
                    success: function(data) {
                        $('#isp_ukupno').html(data);
                    },
                    complete: function(data) {
                        console.log("Poruka: " + data);
                    }
                });
            });

            $(document).on('click', '#izračunaj', function(e){
                var idPredmet = $('#predmet');
                var idStudent = $('#studenti');
                var predavanje2 = $('#predavanje2');
                var auditorne2 = $('#auditorne2');
                $.ajax({
                    data: {'predmet': idPredmet.val(),
                                    'studenti': idStudent.val(),
                                    'predavanje2': predavanje2.val(),
                                    'auditorne2': auditorne2.val()},
                    type: "post",
                    url: "ocj_kol.php",
                    success: function(data) {
                        $('#rezultat').html(data);
                    },
                    complete: function(data) {
                        console.log("Poruka: " + data);
                    }
                });
            });

        </script>
        
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

        <div class="moje">
            <h4>Dobrodošli <?php echo $_SESSION['username']; ?></h4>
        </div>
        <div class="moje">
            <a href="../Profesor/logout.php">Odjavite se</a>
        </div>

        <form name="form1">
            <table align="center" border="0" class="shadow">
                
                <tr>
                    <td>Naziv kolegija</td>
                    <td align="center"><select id="predmet" name="predmet" class="select" style="width: 415px; font-size: 19px;">
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

                <tr>
                    <td>Student</td>
                    <td align="center"><select id="studenti" name="studenti" class="select" style="width: 415px; font-size: 19px;">
                            <option value="">Odaberite prvo kolegij</option>
                        </select>
                    </td>
                </tr>

                <tr></tr>
                <tr></tr>
                <tr style="height: 50px;"></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size: 20px;"><strong>Uspjeh na kolegiju</strong></td>
                </tr>
                <tr></tr>
                <tr style="height: 20px;"></tr>
                <tr>
                    <td>Prisutnost</td>
                    <td align="center">
                        <input class="unos" type="text" id="prisutnost" name="prisutnost">
                    </td>
                </tr>
                <tr>
                    <td>Predavanja 1.kolokvij</td>
                    <td align="center">
                        <input class="unos" type="text" id="pred1" name="pred1">
                    </td>
                </tr>
                <tr>
                    <td>Predavanja 2.kolokvij</td>
                    <td align="center">
                        <input class="unos" type="text" id="pred2" name="pred2">
                    </td>
                </tr>
                <tr>
                    <td>Auditorne vježbe 1.kolokvij</td>
                    <td align="center">
                        <input class="unos" type="text" id="aud1" name="aud1">
                    </td>
                </tr>
                <tr>
                    <td>Auditorne vježbe 2.kolokvij</td>
                    <td align="center">
                        <input class="unos" type="text" id="aud2" name="aud2">
                    </td>
                </tr>
                <tr>
                    <td>Ispit predavanja</td>
                    <td align="center">
                        <input class="unos" type="text" id="isp1" name="isp1">
                    </td>
                </tr>
                <tr>
                    <td>Ispit auditorne vježbe</td>
                    <td align="center">
                        <input class="unos" type="text" id="isp2" name="isp2">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right"><input class="button3" type="button" id="unesi" value="Potvrdite" /></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr style="height: 50px;"></tr>
                <tr>
                    <td align="center" colspan="2">
                        <form action="">
                            <input class="button" type="button" name="predavanja" id="predavanja" value="Predavanja" />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="button" type="button" name="aud_vjez" id="aud_vjez" value="Auditorne vježbe" />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="button" type="button" name="ispit" id="ispit" value="Ispit" /></td>
                        </form>
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr style="height: 50px;"></tr>
                <tr>
                    <td>Ocjena iz predavanja</td>
                    <td align="center"><select class="ocjene" name="pred_ukupno" id="pred_ukupno" disabled></select></td>
                </tr>
                <tr>
                    <td>Ocjena iz auditornih vježbi</td>
                    <td align="center"><select class="ocjene" name="aud_ukupno" id="aud_ukupno" disabled></select></td>
                </tr>
                <tr>
                    <td>Ocjena ispita</td>
                    <td align="center"><select class="ocjene" name="isp_ukupno" id="isp_ukupno" disabled></td>
                </tr>
                <tr>
                    <td>Rezultat</td>
                    <td align="center"><select class="ocjene" name="rezultat" id="rezultat" disabled></td>
                </tr>
                <tr></tr>
                <tr style="height: 50px;"></tr>
                <tr>
                    <td align="center" colspan="2"><input class="button" type="button" id="izračunaj" value="Status" /></td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><input class="button2" type="button" value="Status studenata na kolegiju" onclick="window.location = 'status_studenata.php'"></td>
                </tr>
            </table>
        </form>
        <p style="display: none">
            <select name="predavanje2" id="predavanje2">
                <option value="">Odaberite kolegij</option>
            </select>
            <br>
            <select name="auditorne2" id="auditorne2">
                <option value="">Odaberite kolegij</option>
            </select>
        </p>
    </body>
</html>