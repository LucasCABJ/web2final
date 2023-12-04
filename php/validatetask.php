<?php

function validar_input($campo)
{
    $campo = trim($campo);
    $campo = htmlspecialchars($campo);
    $campo = stripslashes($campo);
    return $campo;
}

session_start();

require("connectdb.php");

if (!empty($_POST['todo-task']) && !empty($_SESSION['id'])) {

    $task = validar_input($_POST['todo-task']);
    $id = $_SESSION['id'];

    if (!empty($task)) {

        
        //$query = "INSERT INTO task('id_user', 'content') VALUES ('$id','$task')";
        $query = "INSERT INTO `task`(`id_user`, `content`, `completed`) VALUES ('$id','$task', 0)";
        $execute_query = mysqli_query($db_connect, $query);

        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}

?>