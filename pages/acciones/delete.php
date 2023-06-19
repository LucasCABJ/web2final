<?php

include('../connectdb.php');

if (isset($_POST['eliminar'])) {

    $id = $_POST['eliminar'];

    $query = "SELECT * FROM user WHERE id_user = '$id';";

    $execute_query = mysqli_query($db_connect, $query);

    $result = mysqli_fetch_row($execute_query);

    if ($result != null) {

        mysqli_query($db_connect, "DELETE FROM user WHERE id_user = '$id';");
        header('Location: ../usuarios.php?alumnosSearch=');

    } else {
        header('Location: ../usuarios.php?alumnosSearch=');
    }

} else {

    header('Location: ../usuarios.php?alumnosSearch=');

}

// while ($row = mysqli_fetch_array($execute_query)) {

// }

?>