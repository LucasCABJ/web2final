<?php

session_start();

include('../connectdb.php');

function validar_input($campo)
{
    $campo = trim($campo);
    $campo = htmlspecialchars($campo);
    $campo = stripslashes($campo);
    return $campo;
}

if (isset($_POST['editar'])) {

    $id = $_POST['editar'];

    echo "id a editar: " . $id . "<br>";

    $query = "SELECT * FROM user WHERE id_user = '$id';";

    $execute_query = mysqli_query($db_connect, $query);

    $result = mysqli_fetch_row($execute_query);

    if ($result != null) {

        var_dump($result);

        if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["dni"]) && isset($_POST['password'])) {

            if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["dni"]) && !empty($_POST['password'])) {

                $firstName = validar_input($_POST['firstName']);
                $lastName = validar_input($_POST['lastName']);
                $dni = validar_input($_POST['dni']);
                $password = validar_input($_POST['password']);

                if ($result[4] == $_SESSION['username'] && !isset($_POST['admin'])) {
                    $admin = 1;
                    $changed_admin = true;
                } else if ($result[4] == $_SESSION['username']) {
                    $admin = 1;
                    $changed_admin = false;
                } else if (isset($_POST['admin'])) {
                    $admin = 1;
                    $changed_admin = false;
                } else {
                    $admin = 0;
                    $changed_admin = false;
                }

                var_dump($admin);

                if (preg_match("/^[a-zA-Z ]*$/", $firstName) && preg_match("/^[a-zA-Z ]*$/", $lastName) && preg_match("/^\d{7,10}$/", $dni) && preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!.?#_@])[a-zA-Z0-9!.?#_@]{8,}$/", $password) && !$changed_admin) {
                    mysqli_query($db_connect, "UPDATE user SET firstname = '$firstName', lastname = '$lastName', dni = '$dni', admin = '$admin', password = '$password' where id_user = '$id'");
                    header('Location: ../usuarios.php?edit=success');
                } else if ($changed_admin) {
                    header('Location: ../usuarios.php?edit=failed2');
                } else {
                    header('Location: ../usuarios.php?edit=failed');
                }

            } else {
                header('Location: ../usuarios.php?edit=failed');
            }
        } else {
            echo 'FIRSTNAME NOT SETTED';
            header('Location: ../usuarios.php?edit=failed');
        }
    } else {

        echo 'RESULTADO NULO';
        header('Location: ../usuarios.php?edit=failed');
    }
} else {

    header('Location: ../usuarios.php?edit=failed');
}

// while ($row = mysqli_fetch_array($execute_query)) {

// }
