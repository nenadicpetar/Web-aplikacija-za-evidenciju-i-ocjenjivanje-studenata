<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "zavrsni");

    if(isset($_POST['register_btn'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $ime = mysqli_real_escape_string($db, $_POST['ime']);
        $prezime = mysqli_real_escape_string($db, $_POST['prezime']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password2 = mysqli_real_escape_string($db, $_POST['password2']);

        if($password == $password2) {
            $password = md5($password); // hashiraj lozinku prije pohrane zbog sigurnosti
            $sql = "SELECT * FROM profesor WHERE username = '$username' OR email = '$email'";
            $query = mysqli_query($db, $sql);
            if(mysqli_num_rows($query) > 0){
                $_SESSION['message'] = 'Korisničko ime i e-mail već postoje!';
            } else {
                $sql = "INSERT INTO profesor (ime, prezime, username, password, email) VALUES ('$ime', '$prezime', '$username', '$password', '$email')";
                $query = mysqli_query($db, $sql);
                header ("Location: login.php");
            }
        } else {
            $_SESSION['message'] = "Lozinke se ne podudaraju.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profesori - registracija</title>
    <link rel="stylesheet" type="text/css" href="" />  
    <style>
    
        body {
            background-color: lightgrey;
            padding: 0px;
            margin: 0px;
        }

        .header{
            background-color: #1A3333;
            color: white;
            text-align: center;
            top: 0px;
            width: 100%;
            padding: 5px;
        }

        form {
            width: 35%;
            padding: 30px;
            border: 1px solid #cbcbcb;
            margin: 5px auto;
            background-color: white;
        }

        .textInput{
            margin-top: 2px;
            height: 28px;
            border: 1px solid #5E6E66;
            font-size: 16px;
            padding: 1px;
            width: 356px;
        }

        #error_msg {
            width: 50%;
            margin: 5px auto;
            height: 30px;
            border: 1px solid #FF0000;
            background: #FFB9B8;
            color: #FF0000;
            text-align: center;
            padding-top: 10px;
        }

        td {
            text-align: right;
        }

        .select {
            margin-top: 2px;
            height: 28px;
            border: 1px solid #5E6E66;
            font-size: 16px;
            padding: 1px;
            width: 100%;
        }

        .submit {
            font-size: 15px;
            height: 25px;
            border-radius: 2px;
        }

        .logo {
            margin-left: 15px;
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

    </style>
</head>
<body>
    <div class="header">
        <h1>WEB aplikacija za evidenciju i ocjenjivanje studenata</h1>
        <h3>Registracija za stranicu Profesori</h3>
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
    <?php
        if(isset($_SESSION['message'])) {
            echo "<div id= 'error_msg'>".$_SESSION['message']."</div>";
            unset($_SESSION['message']);
        }
    ?>
    <form method="post" action="register.php">
        <table>
            <tr>
                <td>Korisničko ime:</td>
                <td><input type="text" name="username" class="textInput"></td>
            </tr>
            <tr>
                <td>Ime:</td>
                <td><input type="text" name="ime" class="textInput"></td>
            </tr>
            <tr>
                <td>Prezime:</td>
                <td><input type="text" name="prezime" class="textInput"></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><input type="email" name="email" class="textInput" placeholder="*@ferit.hr"></td>
            </tr>
            <tr>
                <td>Lozinka:</td>
                <td><input type="password" name="password" class="textInput"></td>
            </tr>
            <tr>
                <td>Ponovite lozinku:</td>
                <td><input type="password" name="password2" class="textInput"></td>
            </tr>
            <tr style="height: 25px;"></tr>
            <tr>
                <td></td>
                <td><input class="submit" type="submit" name="register_btn" value="Registrirajte se"></td>
            </tr>
        </table>
    </form>
</body>
</html>