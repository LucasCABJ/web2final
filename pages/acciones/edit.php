<?php

include('../connectdb.php');

if (isset($_POST['editar'])) {

    $id = $_POST['editar'];

    echo "id a editar: ".$id."<br>";

    $query = "SELECT * FROM user WHERE id_user = '$id';";

    $execute_query = mysqli_query($db_connect, $query);

    $result = mysqli_fetch_row($execute_query);

    if ($result != null) {

        var_dump($result);

        if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["dni"])) {

            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $dni = $_POST["dni"];

            if(isset($_POST['admin'])) {
                $admin = 1;
            } else {
                $admin = 0;
            }

            var_dump($admin);

            mysqli_query($db_connect, "UPDATE user SET firstname = '$firstName', lastname = '$lastName', dni = '$dni', admin = '$admin' where id_user = '$id'");
            header('Location: ../usuarios.php?alumnosSearch=');

        } else {
            echo 'FIRSTNAME NOT SETTED';
            header('Location: ../usuarios.php?alumnosSearch=');
        }

    } else {

        echo 'RESULTADO NULO';
        header('Location: ../usuarios.php?alumnosSearch=');
    }

} else {

    header('Location: ../usuarios.php?alumnosSearch=');

}

// while ($row = mysqli_fetch_array($execute_query)) {

// }

?>