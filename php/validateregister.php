<?php

require("connectdb.php");

function validar_input($campo)
{
    $campo = trim($campo);
    $campo = htmlspecialchars($campo);
    $campo = stripslashes($campo);
    return $campo;
}

if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['dni']) || empty($_POST['rpassword']) || empty($_POST['rusername'])) {
    header('Location: ./login.php?signup=empty');
} elseif ($_POST['rpassword'] != $_POST['rconfirmpassword']) {
    header('Location: ./login.php?signup=confirmpassword');
} else {

    $fname = validar_input($_POST['firstname']);
    $lname = validar_input($_POST['lastname']);
    $dni = validar_input($_POST['dni']);
    $password = validar_input($_POST['rpassword']);
    $username = validar_input($_POST['rusername']);

    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!.?$#_@])[a-zA-Z0-9!.?$#_@]{8,}$/", $password) || !preg_match("/^[a-zA-Z0-9]{8,}$/", $username) || !preg_match("/^([a-zA-Z '\-])+$/", $fname) || !preg_match("/^([a-zA-Z '\-])+$/", $lname) || !preg_match("/^\d{7,10}$/", $dni)) {

        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!.?$#_@])[a-zA-Z0-9!.?$#_@]{8,}$/", $password)) {
            header('Location: ./login.php?signup=invalidspecialchar');
        } else {
            header('Location: ./login.php?signup=error');
        }
    } else {

        $query = "SELECT username, dni from user where username='$username' or dni='$dni'";
        $execute_query = mysqli_query($db_connect, $query);
        $record = mysqli_fetch_row($execute_query);

        if ($record) {

            if ($record[0] == $username && $record[1] == $dni) {
                header('Location: ./login.php?signup=already_registered');
            } else if ($record[0] == $username) {
                header('Location: ./login.php?signup=user_already_registered');
            } else {
                header('Location: ./login.php?signup=dni_already_registered');
            }

        } else {
            $execute_query = mysqli_query($db_connect, "INSERT INTO `user`(`firstname`, `lastname`, `dni`, `username`, `password`, `admin`) VALUES ('$fname','$lname','$dni','$username','$password', 0)");
            echo 'Values inserted';
            var_dump($execute_query);
            var_dump($db_connect);
            die();
            header('Location: ./login.php?signup=success');
        }
    }
}