<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "zavrsni");

    $username = $_SESSION['username'];
    $query = $db->query("SELECT * FROM predmet AS pr
    INNER JOIN profesor_predmet AS pp
    ON pp.id_predmet = pr.id_predmet
    INNER JOIN profesor AS p
    ON p.id_profesor = pp.id_profesor
    WHERE username = '$username' 
    ORDER BY naziv ASC");

    $rowCount = $query->num_rows;
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <title>Status studenata na kolegiju</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <script tipe="text/javascript">
        $(document).ready(function() {
                $('#kolegij').on('change',function() {
                    var idpredmet = $(this).val();
                    if(idpredmet) {
                        $.ajax({
                            type:'POST',
                            url:'ajaxData(status_studenata).php',
                            data:'id_predmet='+idpredmet,
                            success:function(data){
                                $('#sve').append(data);
                            },
                            complete: function(data) {
                                console.log("Poruka: " + data);
                            }
                        });
                    } else {
                        $('#sve').html('<option value="">Molimo odaberite kolegij</option>');
                    }
                });
                $("#kolegij").change(function(){
                    $("#sve").html("");
                });
            });
    </script>
    <style>
        body {
            background-color: #e6ffff;
            padding: 0px;
            margin: 0px;
        }

        table, td {
            border-radius: 5px;
            background-color: white;
        }

        select {
            width: 356px;
            height: 33px;
            font-size: 16px;
            border-radius: 7px;
        }

        td {
            font-size: 17px;
            padding-right: 5px;
        }

        form {
            padding: 5px;
        }

        .header{
            background-color: #485C5C;
            color: white;
            text-align: center;
            top: 0px;
            width: 99,9%;
            padding: 5px;
        }

        .logo {
            margin-left: 15px;
        }

        .natrag {
            color: blue;
            padding-left: 10px;
        }

        .natrag:link {
            text-decoration: none;
        }

        .natrag:hover {
            text-decoration: underline;
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
    <div>
        <a class="natrag" href="profesor.php">Natrag</a>
    </div>
    <br>
    <br>
    <br>
    <form>
        <div>
            <h3>Kolegij:</h3>
        </div>
        <div>
            <select name="kolegij" id="kolegij">
                <option value="">Odaberite kolegij</option>
                <?php
                    if($rowCount > 0) {
                        while ($row = $query->fetch_assoc()) {
                            echo '<option value="'.$row['id_predmet'].'">'.$row['naziv'].'</option>';
                        }
                    } else {
                        echo '<option value="">Kolegij nije dostupan</option>';
                    }
                ?>
            </select>
        </div>
        <br/>
        <br/>
        <br/>
        <div>
            <table border="1" align="center">
                <thead>
                    <tr>
                        <th style="width: +10%">Ime i prezime</th>
                        <th style="width: +10%">Prisutnost</th>
                        <th style="width: +10%">Predavanja 1.kolokvij</th>
                        <th style="width: +10%">Predavanja 2.kolokvij</th>
                        <th style="width: +10%">Auditorne vježbe 1.kolokvij</th>
                        <th style="width: +10%">Auditorne vježbe 2.kolokvij</th>
                        <th style="width: +10%">Ispit predavanja</th>
                        <th style="width: +10%">Ispit auditorne vježbe</th>
                        <th style="width: +10%">Prijava ispita</th>
                        <th style="width: +10%">Potvrđivanje ocjene</th>
                    </tr>
                </thead>
                <tbody id="sve" align="right">
                
                </tbody>
            </table>
        </div>
    </form>
</body>
</html>