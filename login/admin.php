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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <style>
        body {
            background-color: #FADCE2;
            padding: 0px;
            margin: 0px;
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

        form {
            margin-left: auto;
            margin-right: auto;
            width: 40%
        }

        h5 {
            font-size: 19px;
        }

        h6 {
            font-size: 15px;
            font-family: sans-serif;
        }

        .kolegij {
            font-size: 17px;
        }

        .novi {
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }

        select {
            font-size: 17px;
            height: 30px;
            width: 415px;
            border-radius: 5px;
        }

        .unos {
            height: 30px;
            width: 76px;
            border-radius: 5px;
        }

        .unos2 {
            height: 30px;
            width: 76px;
            border-radius: 5px;
        }

        .unos3 {
            height: 30px;
            width: 115px;
            border-radius: 5px;
        }

        .unos4 {
            border-radius: 5px;
        }

        .input2 {
            height: 23px;
            width: 410px;
            font-size: 17px;
            border-radius: 5px;
        }

        a:link {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .godina {
            width: 50px;
            height: 25px;
            font-size: 15px;
        }

        .natrag {
            color: blue;
            padding-left: 5px;
        }

        .natrag:link {
            text-decoration: none;
        }

        .natrag:hover {
            text-decoration: underline;
        }

        .admin {
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
    <div>
        <a class="natrag" href="../Web aplikacija za evidenciju i ocjenjivanje studenata.html">Natrag</a>
    </div>
    <br>
    
    <?php
        if(isset($_SESSION['message'])) {
            echo "<div id='error_msg'>".$_SESSION['message']."</div>";
            unset($_SESSION['message']);
        }
    ?>
    <div class="admin">
        <h4>Dobrodošli <?php echo $_SESSION['username']; ?>, Vi ste administrator.</h4>
    </div>
    <br>
    <form align="left">
        <h5>Naziv kolegija</h5>
        <select name="kolegij" id="kolegij" >
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
        </select>
        <input class="unos3" type="button" name="kolegij_brisi" id="kolegij_brisi" value="Uklonite kolegij">
        <h5>Profesori</h5>
        <select name="profesor" id="profesor">
            <option value="">Odaberite profesora</option>
            <?php
                $query = $db->query("SELECT * FROM profesor ORDER BY prezime ASC");

                $rowCount = $query->num_rows;

                if($rowCount > 0) {
                    while($row = $query->fetch_assoc()) {
                        echo '<option value="'.$row['id_profesor'].'">'.$row['prezime'].", ".$row['ime'].'</option>';
                    }
                } else {
                    echo '<option value="">Profesor nije dostupan</option>';
                }
            ?>
        </select>
        <input class="unos" type="button" name="unos" id="unos" value="Potvrdite">
        <br>
        <br>
        <div>
            <h4 class="kolegij">Novi kolegiji</h4>
            <input class="input2" type="text" name="kolegij2" id="kolegij2" placeholder="Unesite naziv novog kolegija">
            <input class="unos2" type="button" name="unos2" id="unos2" value="Potvrdite">
            <br>
            <br>
            <h6>Godina: 
            <select class="godina" name="godina" id="godina">
                <option value="1">1.</option>
                <option value="2">2.</option>
                <option value="3">3.</option>
            </select></h6>
            <input class="unos4" type="text" name="unos4" id="unos4" placeholder="Predavanja - koeficijent">
            <br>
            <br>
            <input class="unos4" type="text" name="unos5" id="unos5" placeholder="Auditorne - koeficijent">
        </div>
    </form>
</body>
<script>
    $(document).ready(function() {
        $(document).on('click', '#unos', function(e) {
            var kolegij = $("#kolegij").val();
            var profesor = $("#profesor").val();
            var data = {'kolegij': kolegij,
                        'id_profesor': profesor};
            $.ajax({
                data: data,
                type: "post",
                url: "admin-unos.php",
                success: function(data) {
                    swal(data, "Novi profesor je prijavljen.", "success");
                },
                complete: function(data) {
                    console.log("Poruka: " + data);
                }
            });
        });

        $(document).on('click', '#unos2', function(e) {
            var kolegij2 = $("#kolegij2").val();
            var unos4 = $("#unos4").val();
            var unos5 = $("#unos5").val();
            var godina = $("#godina").val();
            var data = {'kolegij2': kolegij2,
                        'pred_koef': unos4,
                        'aud_koef': unos5,
                        'godina': godina};

            $.ajax({
                data: data,
                type: "post",
                url: "admin_novi_kolegij.php",
                success: function(data) {
                    swal(data, "Novi kolegij je unesen.", "success");
                },
                complete: function(data) {
                    console.log("Poruka: " + data);
                }
            });
        });

        $(document).on('click', '#kolegij_brisi', function(e) {
            var kolegij = $("#kolegij").val();
            var data = {'kolegij': kolegij};

            $.ajax({
                data: data,
                type: "post",
                url: "brisi_kolegij2.php",
                success: function(data) {
                    swal(data, "Kolegij je uklonjen.", "success");
                },
                complete: function(data) {
                    console.log("Poruka: " + data);
                }
            });
        });
    });
</script>
</html>