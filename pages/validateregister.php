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
    header('Location: ../index.php?signup=empty');
} elseif ($_POST['rpassword'] != $_POST['rconfirmpassword']) {
    header('Location: ../index.php?signup=confirmpassword');
} else {

    $fname = validar_input($_POST['firstname']);
    $lname = validar_input($_POST['lastname']);
    $dni = validar_input($_POST['dni']);
    $password = validar_input($_POST['rpassword']);
    $username = validar_input($_POST['rusername']);

    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!.?#_@])[a-zA-Z0-9!.?#_@]{8,}$/", $password) || !preg_match("/^[a-zA-Z0-9]{8,}$/", $username) || !preg_match("/^([a-zA-Z '\-])+$/", $fname) || !preg_match("/^([a-zA-Z '\-])+$/", $lname) || !preg_match("/^([a-zA-Z0-9]){8,}$/", $username) || !preg_match("/^\d{7,10}$/", $dni)) {
        echo "Invalid data";
        header('Location: ../index.php?signup=error');
    } else {
        // Agregar validacion RegEx

        $query = "SELECT dni from user where dni='$dni'";
        $execute_query = mysqli_query($db_connect, $query);
        $record = mysqli_fetch_row($execute_query);

        if ($record != null) {
            header('Location: ../index.php?signup=already_registered');
        } else {
            $execute_query = mysqli_query($db_connect, "INSERT INTO `user`(`firstname`, `lastname`, `dni`, `username`, `password`, `admin`) VALUES ('$fname','$lname','$dni','$username','$password', 0)");
            echo 'Values inserted';
            header('Location: ../index.php?signup=success');
        }
    }
}
