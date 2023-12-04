<?php

include('../connectdb.php');

function validar_input($campo)
{
    $campo = trim($campo);
    $campo = htmlspecialchars($campo);
    $campo = stripslashes($campo);
    return $campo;
}

if (isset($_POST['editar']) && isset($_POST['task'])) {

    $task = validar_input($_POST['task']);

    if(!empty($_POST['task'])) {
        $id = $_POST['editar'];
        var_dump($task);

        $query = "SELECT * FROM task WHERE id_task = '$id';";

        $execute_query = mysqli_query($db_connect, $query);

        $result = mysqli_fetch_row($execute_query);

        if ($result != null) {

            mysqli_query($db_connect, "UPDATE `task` SET `content`='$task' WHERE `id_task`='$id'");
            header('Location: ../index.php');

        } else {
            header('Location: ../index.php');
        }
    } else {
        header('Location:../index.php');
    }

} else {

    header('Location: ../index.php');

}

// while ($row = mysqli_fetch_array($execute_query)) {

// }

?>