<?php

    session_start();
    $db = mysqli_connect("localhost", "root", "", "zavrsni");

    $username = $_SESSION['username'];
    
    $query = $db->query("SELECT * FROM predmet ORDER BY naziv ASC");

    $rowCount = $query->num_rows;
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="utf-8" />
    <title>Prijava studenata na kolegije</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <style>
        body {
            background-color: #D6B5F5;
            padding: 0px;
            margin: 0px;
        }

        .div1 {
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }

        .div2 {
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }
        
        h4 {
            font-size: 20px;
        }

        input, select {
            border-radius: 5px;
        }

        input, a {
            font-size: 17px;
        }
        select {
            font-size: 17px;
            width: 400px;
            height: 30px;
        }

        input {
            background-color: #E6E6E6;
        }

        input:hover {
            background-color: #C0C0C0;
        }

        a {
            color: blue;
        }

        a:link, a:visited {
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
            width: 100%;
            padding: 5px;
        }

        .natrag {
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
    <div class="natrag">
        <a href="Student.php">Natrag</a>
    </div>

    <form>
        <div style="height: 30px;"></div>
        <div class="div1" align="left">
            <h4>Kolegiji:</h4>
            <br> 
            <select name="kolegij" id="kolegij">
                <?php
                    if($rowCount > 0) {
                        while($row = $query->fetch_assoc()) {
                            echo '<option value="'.$row['id_predmet'].'">'.$row['naziv'].'</option>';
                        }
                    } else {
                        echo '<option value="">Kolegij nije dostupan</option>';
                    }
                ?>
            </select>
        <br>
        <br>
            <input type="button" name="novi_kolegij" id="novi_kolegij" value="Prijavite novi kolegij">
        </div>
        <div style="display: none">
            <select name="student" id="student">
                <?php
                    $username = $_SESSION['username'];
                    $query = $db->query("SELECT * FROM student
                    WHERE username = '$username'");

                    $rowCount = $query->num_rows;

                    if($rowCount > 0) {
                        while($row =$query->fetch_assoc()) {
                            echo '<option value="'.$row['id_student'].'">'.$row['id_student'].'</option>';
                        }
                    } else {
                        echo '<option value="">Nije dostupno</option>';
                    }
                      
                ?>
            </select> 
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="div2" align="left">
            <h4>Odjavite se s kolegija:</h4>
            <select name="upisani_kolegiji" id="upisani_kolegiji">
                <?php
                    $username = $_SESSION['username'];
                    $query = $db->query("SELECT * FROM predmet AS p
                    INNER JOIN student_predmet AS sp
                    ON p.id_predmet = sp.id_predmet
                    INNER JOIN student AS s
                    ON sp.id_student = s.id_student
                    WHERE username = '$username'
                    ORDER BY naziv ASC");

                    $rowCount = $query->num_rows;

                    if($rowCount > 0) {
                        while($row = $query->fetch_assoc()) {
                            echo '<option value="'.$row['id_predmet'].'">'.$row['naziv'].'</option>';
                        }
                    } else {
                        echo '<option value="">Nije dostupno</option>';
                    }

                ?>
            </select>
        <br />
        <br />
            <input type="button" name="brisi_kolegij" id="brisi_kolegij" value="Potvrdite">
        </div>
        <br/>
        <br/>
        <br/>
    </form>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#novi_kolegij', function(e) {
            var kolegij = $("#kolegij").val();
            var student = $("#student").val();
            var data = {'kolegij': kolegij,
                        'id_student': student};
            $.ajax({
                data: data,
                type: "post",
                url: "studentUnosNoviKolegij.php",
                success: function(data) {
                    swal(data, "Prijavili ste se na novi kolegij!", "success");
                },
                complete: function(data) {
                    console.log("Poruka: " + data);
                }
            });
        });

        $(document).on('click', '#brisi_kolegij', function(e) {
            var upisani_kolegiji = $("#upisani_kolegiji").val();
            var student = $("#student").val();
            var data = {'kolegij': upisani_kolegiji,
                        'id_student': student};
            $.ajax({
                data: data,
                type: "post",
                url: "brisi_kolegij.php",
                success: function(data) {
                    swal(data, "Izbrisali ste kolegij.", "success");
                },
                complete: function(data) {
                    console.log("Poruka: " + data);
                }
            });
        });
    });
</script>
</html>