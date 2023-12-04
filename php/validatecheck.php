<?php

include('connectdb.php');

session_start();

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $query = "SELECT completed FROM task WHERE id_task = '$id';";

    $execute_query = mysqli_query($db_connect, $query);

    $result = mysqli_fetch_row($execute_query);

    if ($result != null) {

        $new_value = 0;

        if ($result[0] == '0') {
            $new_value = 1;
        }

        mysqli_query($db_connect, "UPDATE task SET completed = $new_value WHERE id_task = $id;");

        $id = $_SESSION['id'];
        $query = "SELECT * FROM task WHERE id_user  = '$id'";
        $execute_query = mysqli_query($db_connect, $query);

        $counter = 0;

        while ($result = mysqli_fetch_assoc($execute_query)) {
            $counter++;
            $task = $result['content'];
            $id_task = $result['id_task'];
            $icon = 'fa-check';
            $text_class = '';
            $btn_class = '';

            if ($result['completed'] == '1') {
                $icon = 'fa-x';
                $text_class = 'completed-task';
                $btn_class = 'completed-task-btn';
            }

            echo "<div class='todo-list__task'>";
            echo "<div id='task-$id_task' class='todo-list__text $text_class'>$task</div>";
            // echo "<form class='todo-list__check-form' action='validatecheck.php' method='post'>";
            // echo "<input type='hidden' name='update' value='$id_task'>";
            echo "<button onclick='toggleCheck($id_task)' class='todo-list__checkbtn $btn_class text-light' name='editar'><i class='fa-solid $icon'></i></button>";
            // echo "</form>";
            echo "<button type='submit' class='todo-list__finishbtn btn btn-secondary text-light' onclick='openEditModal($id_task)' name='editar' data-bs-toggle='modal' data-bs-target='#modal-editar'><i class='fa-solid fa-pencil'></i></button>";
            echo "<button class='todo-list__finishbtn' onclick='openDeleteModal($id_task)' name='eliminar' data-bs-toggle='modal' data-bs-target='#modal-eliminar'><i class='fa-solid fa-trash-can'></i></button>";
            echo "</div>";
        }

        if ($counter == 0) {
            echo '<div class="todo-list__no-pending">
                <p class="no-pending__text">No tienes ninguna tarea pendiente.</p>
                </div>';
        }

    } else {
        echo '<div class="todo-list__no-pending">
                <p class="no-pending__text">Algo ha salido mal.</p>
                </div>';
    }

} else {
    echo '<div class="todo-list__no-pending">
    <p class="no-pending__text">Algo ha salido mal.</p>
    </div>';
}
?>