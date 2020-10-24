<?php

session_start();

if (isset($_POST['submit'])){

    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //error handlers
    //Provjerava unose
    if(empty($uid) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM profesor WHERE prezime='$uid' AND ime='$pwd'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            $_SESSION['u_id'] = $row['id_profesor'];
            header("Location: ../Profesor.php");
            exit();
        }
        header("Location: ../index.php?login=error");
        exit();
    }

}

?>