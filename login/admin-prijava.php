<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "zavrsni");
    if(isset($_POST['login_btn'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) == 1) {
            $_SESSION['message'] = "Ulogirani ste";
            $_SESSION['username'] = $username;
            header("location: admin.php");
        } elseif (empty($_POST['username']) OR empty($_POST['password'])) {
            $_SESSION['message'] = "Korisničko ime i lozinka ne mogu biti prazni";
        } else {
            $_SESSION['message'] = "Korisničko ime i lozinka su netočni";
        }
    }
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prijava - admin</title>
</head>
<style>
    body {
        background-color: lightcyan;
        padding: 0px;
        margin: 0px;
    }

    .header {
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
    
    .unos {
        height: 20px;
        font-size: 15px;
        border-radius: 3px;
    }

    .submit {
        border-radius: 2px;
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
<body>
    <div class="header">
        <h1>WEB aplikacija za evidenciju i ocjenjivanje studenata</h1>
        <h3>Stranica za prijavu - admin</h3>
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
                echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                unset($_SESSION['message']);
            }
        ?>
    <br>
    <br>
    <br>
    <form method="post" action="admin-prijava.php">
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
            <tr>
                <td></td>
                <td><input class="submit" type="submit" name="login_btn" value="Prijavite se"></td>
            </tr>
        </table>
    </form>
</body>
</html>