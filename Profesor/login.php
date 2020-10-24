<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "zavrsni");

    if(isset($_POST['login_btn'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $password = md5($password); // hashirali smo lozinku prije početka
        $sql = "SELECT * FROM profesor WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['message'] = "Ulogirani ste";
            $_SESSION['username'] = $username;
            header("location: ../login/Profesor.php");
        } elseif (empty($_POST['username']) OR empty($_POST['password'])) {
            $_SESSION['message'] = "Korisničko ime i lozinka ne mogu biti prazni";
        } else {
            $_SESSION['message'] = "Korisničko ime ili lozinka su netočni!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prijava - profesor</title>
    <link rel="stylesheet" type="text/css" href="" />
    <style>
        body {
            background-color: lightskyblue;
            padding: 0px;
            margin: 0px;
        }

        .header{
            background-color: #1A3333;
            color: white;
            text-align: center;
            width: 100%;
            padding: 5px;
        }

        form {
            width: 25%;
            margin: 5px auto;
            padding: 30px;
            border: 1px solid #cbcbcb;
            border-radius: 5px;
            background-color: white;
        }

        .textInput{
            margin-top: 2px;
            height: 28px;
            border: 1px solid #5E6E66;
            font-size: 16px;
            padding: 1px;
            width: 100%;
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
            text-align: left;
        }

        .select {
            margin-top: 2px;
            height: 28px;
            border: 1px solid #5E6E66;
            font-size: 16px;
            padding: 1px;
            width: 100%;
        }

        .unos {
            height: 20px;
            font-size: 15px;
            border-radius: 3px;
        }

        .submit {
            border-radius: 2px;
        }

        .submit:hover {
            background-color: #ACACAC;
        }

        .tekst {
            font-size: 18px;
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
        <h3>Stranica za prijavu - Profesor</h3>
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
    <br>
    <br>

    <form method="post" action="login.php">
        <table align="center">
            <tr>
                <td class="tekst">Korisničko ime:</td>
                <td><input class="unos" type="text" name="username" class="textInput"></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td class="tekst">Lozinka:</td>
                <td><input class="unos" type="password" name="password" class="textInput"></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td></td>
                <td><input class="submit" type="submit" name="login_btn" value="Prijavite se"></td>
            </tr>
        </table>
    </form>
</body>
</html>