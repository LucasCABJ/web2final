<?php

include('../connectdb.php');

if (isset($_POST['eliminar'])) {

    $id = $_POST['eliminar'];

    $query = "SELECT * FROM task WHERE id_task = '$id';";

    $execute_query = mysqli_query($db_connect, $query);

    $result = mysqli_fetch_row($execute_query);

    if ($result != null) {

        mysqli_query($db_connect, "DELETE FROM task WHERE id_task = $id;");
        header('Location: ../index.php');

    } else {
        header('Location: ../index.php');
    }

} else {

    header('Location: ../index.php');

}

// while ($row = mysqli_fetch_array($execute_query)) {

// }

?>